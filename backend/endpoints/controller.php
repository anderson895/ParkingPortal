<?php
include('../class.php');

$db = new global_class();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ($_POST['requestType'] == 'Login') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Call the Login method and get the result
            $user = $db->Login($username, $password);

            // Check if login was successful
            if ($user) {
                // Convert the result to JSON format to echo as a response
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => $user
                ]);
            } else {
                // Return JSON error response
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid Username or password'
                ]);
            }
       
    }else if($_POST['requestType'] == 'AddNewCar'){
        
            // Handle the uploaded file
            if (isset($_FILES['carImage']) && $_FILES['carImage']['error'] == 0) {
                $uploadedFile = $_FILES['carImage'];
                $uploadDir = '../../CarImages/'; // Directory to save images
                $fileName = basename($uploadedFile['name']); // Get the file name
                $uploadFilePath = $uploadDir . $fileName;
        
                // Ensure the upload directory exists, create if it doesn't
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
        
                // Move the uploaded file to the desired directory
                if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
                    // File uploaded successfully
                    $carImage = $fileName; // Store the filename in the variable
                } else {
                    // Handle file upload failure
                    $carImage = null; // No image uploaded
                }
            } else {
                // No image uploaded
                $carImage = null;
            }
        
            // Collect other form data
            $carName = $_POST['carName'];
            $carType = $_POST['carType'];
            $plateNumber = $_POST['plateNumber'];
            $condo = $_POST['condo'];
            $RFID = $_POST['RFID'];
        
            // Call the AddnewCars function to insert the data into the database
            $user = $db->AddnewCars($carName, $carType, $plateNumber, $condo, $RFID, $carImage);
        
            if ($user) {
                echo "Car record added successfully!";
            } else {
                echo "Error adding car record.";
            }
        


    }else if($_POST['requestType'] == 'ArchivedCar'){

        $carID=$_POST['carID'];

        $car = $db->ArchivedCar($carID);
        
        if ($car) {
            echo "success";
        } else {
            echo "Error adding car record.";
        }
    }else if($_POST['requestType'] == 'restoreCar'){

        $carID=$_POST['carID'];

        $car = $db->restoreCar($carID);
        
        if ($car) {
            echo "success";
        } else {
            echo "Error adding car record.";
        }
        // restoreCar

    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Access Denied! No Request Type.'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if ($_GET['requestType'] == 'GetAllCars') {
        // Fetch the cars from the database
        $cars = $db->getAllCars();
    
        // Check if cars data exists
        if ($cars !== false) {
            // Return the cars data as JSON
            echo json_encode(['status' => 'success', 'data' => $cars]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No cars found or error retrieving data.']);
        }
    }else if ($_GET['requestType'] == 'GetAllArchiveCars') {
        // Fetch the cars from the database
        $cars = $db->GetAllArchiveCars();
    
        // Check if cars data exists
        if ($cars !== false) {
            // Return the cars data as JSON
            echo json_encode(['status' => 'success', 'data' => $cars]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No cars found or error retrieving data.']);
        }
    }
    
}
?>
