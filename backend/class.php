<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


    public function get_auto_archive() {
        // Get current date minus one month
        $one_month_ago = date('Y-m-d H:i:s', strtotime('-1 month'));
    
        // Query to select cars that either have no time logs or their most recent time log is older than 1 month
        $query = "
            UPDATE cars
            SET carStatus = 0
            WHERE carStatus = 1  -- Only update active cars (carStatus = 1)
            AND (
                -- Condition 1: Cars with no time logs
                car_id NOT IN (
                    SELECT DISTINCT time_car_id 
                    FROM time_logs
                )
                OR
                -- Condition 2: Cars with most recent time_in older than 1 month
                car_id IN (
                    SELECT time_car_id
                    FROM time_logs
                    GROUP BY time_car_id
                    HAVING MAX(time_in) < '$one_month_ago'
                )
            );
        ";
    
        // Log the query for debugging
        error_log("Query: " . $query);
    
        // Execute the query
        $result = $this->conn->query($query);
        
        if ($result) {
            // Log the number of affected rows
            error_log("Affected rows: " . $this->conn->affected_rows);
    
            // Return the number of affected rows to confirm how many cars were archived
            return $this->conn->affected_rows;
        } else {
            // Log the error if the query fails
            error_log("Error: " . $this->conn->error);
    
            // If there was an issue with the query, return NULL
            return NULL;
        }
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
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            return $product;
        } else {
            return null;
        }
    }


    public function get_cct_by_id($carId) {
        $query = "SELECT `cctImage` FROM `cars` WHERE `car_id` = $carId";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            return $product;
        } else {
            return null;
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



    public function AddnewCars($carName, $carType, $plateNumber, $condo, $RFID, $CarImage,$cctImage)
    {
        $query = $this->conn->prepare("INSERT INTO `cars` (carName, carType, plateNumber, condo, RFID, CarImage,cctImage) VALUES (?, ?, ?, ?, ?, ?,?)");
        if ($query === false) {
            return false; 
        }
        $query->bind_param("sssssss", $carName, $carType, $plateNumber, $condo, $RFID, $CarImage,$cctImage);
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }


    public function UpdateCars($carId, $carName, $carType, $plateNumber, $condo, $RFID, $CarImage, $CctImage)
    {
        // Base query
        $sql = "UPDATE `cars` 
                SET carName = ?, carType = ?, plateNumber = ?, condo = ?, RFID = ?";
        
        // Parameters array to match placeholders
        $params = [$carName, $carType, $plateNumber, $condo, $RFID];
        $types = "sssss"; // Data types: all strings here
        
        // Append CarImage to query and parameters if provided
        if (!empty($CarImage)) {
            $sql .= ", CarImage = ?";
            $params[] = $CarImage;
            $types .= "s"; // Add a type for CarImage
        }
        
        // Append CctImage to query and parameters if provided
        if (!empty($CctImage)) {
            $sql .= ", cctImage = ?";
            $params[] = $CctImage;
            $types .= "s"; // Add a type for CctImage
        }
        
        // Append the WHERE condition
        $sql .= " WHERE car_id = ?";
        $params[] = $carId;
        $types .= "s"; // Add a type for carId
    
        // Prepare the query
        $query = $this->conn->prepare($sql);
        if ($query === false) {
            return false;
        }
    
        // Bind parameters dynamically
        $query->bind_param($types, ...$params);
    
        // Execute the query
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