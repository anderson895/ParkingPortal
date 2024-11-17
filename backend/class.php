<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


    public function Login($username, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");

        $query->bind_param("ss", $username, $password);
        
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                session_start();
                $_SESSION['password'] = $user['password'];
                $_SESSION['id'] = $user['id'];

                return $user;
            } else {
                return false; 
            }
        } else {
            return false;
        }
    }



    public function get_car_by_id($carId) {
        $query = "SELECT `CarImage` FROM `cars` WHERE `car_id` = $carId";
    
        // Execute the query
        $result = $this->conn->query($query);
    
        // Check if a product was found
        if ($result->num_rows > 0) {
            // Fetch the product details as an associative array
            $product = $result->fetch_assoc();
            return $product; // Return the product details
        } else {
            return null; // Return null if no product was found
        }
    }


    public function fetch_all_logHistory($carId) {
        // Simple query without bind_param(), directly injecting the product ID
        $query = "SELECT * FROM `time_logs`
        LEFT JOIN cars
        ON cars.car_id = time_logs.time_car_id
         WHERE `time_car_id` = $carId";
    
        // Execute the query
        $result = $this->conn->query($query);
    
        return $result;
    }
       
    


    public function AddnewCars($carName, $carType, $plateNumber, $condo, $RFID, $CarImage)
    {
        $query = $this->conn->prepare("INSERT INTO `cars` (carName, carType, plateNumber, condo, RFID, CarImage) VALUES (?, ?, ?, ?, ?, ?)");
        if ($query === false) {
            return false; 
        }
        $query->bind_param("ssssss", $carName, $carType, $plateNumber, $condo, $RFID, $CarImage);
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }


    public function UpdateCars($carId,$carName, $carType, $plateNumber, $condo, $RFID, $CarImage)
    {
        // Base query without CarImage update
        $sql = "UPDATE `cars` 
                SET carName = ?, carType = ?, plateNumber = ?, condo = ?, RFID = ?";
        
        // Append CarImage update only if it's provided
        if (!empty($CarImage)) {
            $sql .= ", CarImage = ?";
        }
    
        // Add a condition to identify the record to update (e.g., by RFID or plateNumber)
        $sql .= " WHERE car_id  = ?";
    
        $query = $this->conn->prepare($sql);
        if ($query === false) {
            return false;
        }
    
        // Bind parameters dynamically based on CarImage presence
        if (!empty($CarImage)) {
            $query->bind_param("sssssss", $carName, $carType, $plateNumber, $condo, $RFID, $CarImage, $carId);
        } else {
            $query->bind_param("ssssss", $carName, $carType, $plateNumber, $condo, $RFID, $carId);
        }
    
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    

    
    public function ArchivedCar($carID){
        $query = $this->conn->prepare("UPDATE `cars` SET `carStatus` = '0' WHERE `cars`.`car_id` = ?");
        if ($query === false) {
            return false; 
        }
        $query->bind_param("i", $carID);
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }


    public function restoreCar($carID){
        $query = $this->conn->prepare("UPDATE `cars` SET `carStatus` = '1' WHERE `cars`.`car_id` = ?");
        if ($query === false) {
            return false; 
        }
        $query->bind_param("i", $carID);
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    

    public function getAllCars()
    {
        $query = "SELECT * FROM cars WHERE carStatus='1'";
        $result = $this->conn->query($query);
        if ($result === false) {
            error_log("Query execution failed: " . $this->conn->error);
            return false;
        }
        if ($result->num_rows > 0) {
            $cars = [];
            while ($row = $result->fetch_assoc()) {
                $cars[] = $row;
            }
            return $cars;
        } else {
            return false;
        }
    }
    


    public function GetAllArchiveCars()
    {
        $query = "SELECT * FROM cars WHERE carStatus='0'";
        $result = $this->conn->query($query);
        if ($result === false) {
            error_log("Query execution failed: " . $this->conn->error);
            return false;
        }
        if ($result->num_rows > 0) {
            $cars = [];
            while ($row = $result->fetch_assoc()) {
                $cars[] = $row;
            }
            return $cars;
        } else {
            return false;
        }
    }


    

    
}

?>