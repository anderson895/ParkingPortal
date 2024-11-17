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
        // Simple query with sorting by date (assuming 'log_date' is the date column)
        $query = "SELECT * FROM `time_logs`
            LEFT JOIN cars
            ON cars.car_id = time_logs.time_car_id
            WHERE `time_car_id` = $carId
            ORDER BY time_logs.time_date DESC"; // or ASC for ascending order
        
        // Execute the query
        $result = $this->conn->query($query);
        
        return $result;
    }
    


    public function fetch_daily_logHistory($carId) {
        // Get the current date in 'YYYY-MM-DD' format
        $currentDate = date('Y-m-d');
        
        // Query to fetch logs for today only (filtering by current date)
        $query = "SELECT * FROM `time_logs`
            LEFT JOIN cars
            ON cars.car_id = time_logs.time_car_id
            WHERE `time_car_id` = $carId 
            AND DATE(time_logs.time_date) = '$currentDate' 
            ORDER BY time_logs.time_date DESC";
        
        // Execute the query
        $result = $this->conn->query($query);
        
        // Return the result
        return $result;
    }





    public function fetch_weekly_logHistory($carId) {
        // Get the current date
        $currentDate = date('Y-m-d');
        
        // Get the start and end dates of the current week (Monday to Sunday)
        $startOfWeek = date('Y-m-d', strtotime('monday this week', strtotime($currentDate)));
        $endOfWeek = date('Y-m-d', strtotime('sunday this week', strtotime($currentDate)));
        
        // Query to fetch logs from the current week
        $query = "SELECT * FROM `time_logs`
            LEFT JOIN cars
            ON cars.car_id = time_logs.time_car_id
            WHERE `time_car_id` = $carId 
            AND DATE(time_logs.time_date) BETWEEN '$startOfWeek' AND '$endOfWeek'
            ORDER BY time_logs.time_date DESC";
        
        // Execute the query
        $result = $this->conn->query($query);
        
        return $result;
    }

    
    public function fetch_monthly_logHistory($carId) {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        // Get the first and last date of the current month
        $startOfMonth = "$currentYear-$currentMonth-01"; // First day of the month
        $endOfMonth = date("Y-m-t", strtotime($startOfMonth)); // Last day of the month
        
        // Query to fetch logs from the current month
        $query = "SELECT * FROM `time_logs`
            LEFT JOIN cars
            ON cars.car_id = time_logs.time_car_id
            WHERE `time_car_id` = $carId 
            AND DATE(time_logs.time_date) BETWEEN '$startOfMonth' AND '$endOfMonth'
            ORDER BY time_logs.time_date DESC";
        
        // Execute the query
        $result = $this->conn->query($query);
        
        return $result;
    }

    
    public function fetch_yearly_logHistory($carId) {
        // Get the current year
        $currentYear = date('Y');
        
        // Get the first and last date of the current year
        $startOfYear = "$currentYear-01-01"; // First day of the year
        $endOfYear = "$currentYear-12-31"; // Last day of the year
        
        // Query to fetch logs from the current year
        $query = "SELECT * FROM `time_logs`
            LEFT JOIN cars
            ON cars.car_id = time_logs.time_car_id
            WHERE `time_car_id` = $carId 
            AND DATE(time_logs.time_date) BETWEEN '$startOfYear' AND '$endOfYear'
            ORDER BY time_logs.time_date DESC";
        
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
    // SQL query to fetch all cars, even those without time logs for today
    $query = "
    SELECT *
    FROM cars
    LEFT JOIN time_logs
    ON cars.car_id = time_logs.time_car_id
    AND DATE(time_logs.time_date) = CURDATE()  -- Include today's logs, if available
    WHERE carStatus = '1'  -- Only cars with active status
    ";

    // Execute the query
    $result = $this->conn->query($query);

    // Check if the query was successful
    if ($result === false) {
        error_log("Query execution failed: " . $this->conn->error);
        return false;  // Return false if the query fails
    }

    // If there are rows, fetch and return them as an array
    if ($result->num_rows > 0) {
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;  // Add each row to the cars array
        }
        return $cars;  // Return the list of cars
    } else {
        return false;  // No cars found
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