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


    public function getAllCars()
    {
        // Prepare the query
        $query = "SELECT * FROM cars WHERE carStatus='1'";
    
        // Execute the query
        $result = $this->conn->query($query);
    
        // Check if the query was successful
        if ($result === false) {
            // Log or handle the error
            error_log("Query execution failed: " . $this->conn->error);
            return false;
        }
    
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Fetch the results and return them as an associative array
            $cars = [];
            while ($row = $result->fetch_assoc()) {
                $cars[] = $row;
            }
            return $cars;
        } else {
            // No cars found
            return false;
        }
    }
    

    
}

?>