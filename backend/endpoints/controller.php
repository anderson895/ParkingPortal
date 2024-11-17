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
                    if (isset($_FILES['carImage']) && $_FILES['carImage']['error'] == 0) {
                        $uploadedFile = $_FILES['carImage'];
                        $uploadDir = '../../CarImages/';
                        
                        // Get the original file extension
                        $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
                        
                        // Generate a unique file name using a timestamp and a random unique ID
                        $uniqueFileName = uniqid('car_', true) . '.' . $fileExtension;
                        $uploadFilePath = $uploadDir . $uniqueFileName;
                    
                        // Ensure the directory exists
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }
                    
                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
                            $carImage = $uniqueFileName; // Store the unique file name
                        } else {
                            $carImage = null; // File upload failed
                        }
                    } else {
                        $carImage = null; // No file uploaded
                    }
                    
                    // Collect other form data
                    $carName = $_POST['carName'];
                    $carType = $_POST['carType'];
                    $plateNumber = $_POST['plateNumber'];
                    $condo = $_POST['condo'];
                    $RFID = $_POST['RFID'];
                    
                    // Insert the car record into the database
                    $user = $db->AddnewCars($carName, $carType, $plateNumber, $condo, $RFID, $carImage);
                    
                    if ($user) {
                        echo "Car record added successfully!";
                    } else {
                        echo "Error adding car record.";
                    }
        
            }
        


    }else if($_POST['requestType'] == 'UpdateCar'){
        if (isset($_FILES['carImage']) && $_FILES['carImage']['error'] == 0) {
            $uploadedFile = $_FILES['carImage'];
            $uploadDir = '../../CarImages/';
            
            // Extract file extension
            $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
            
            // Generate a unique file name using uniqid and append the file extension
            $uniqueFileName = uniqid('car_', true) . '.' . $fileExtension;
            $uploadFilePath = $uploadDir . $uniqueFileName;
            
            // Ensure the directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            // Create a temporary file path
            $tempFilePath = $uploadDir . 'temp_' . $uniqueFileName;
            
            // Move the uploaded file to the temporary file path
            if (move_uploaded_file($uploadedFile['tmp_name'], $tempFilePath)) {
                $carImage = $uniqueFileName; // Store the unique file name for the database
            } else {
                $carImage = null; // File upload failed
            }
        } else {
            $carImage = null; // No file uploaded
        }
        
        $carName = $_POST['carName'];
        $carType = $_POST['carType'];
        $plateNumber = $_POST['plateNumber'];
        $condo = $_POST['condo'];
        $RFID = $_POST['RFID'];
        
        // Call the UpdateCars function to update the car record in the database
        $user = $db->UpdateCars($carName, $carType, $plateNumber, $condo, $RFID, $carImage);
        
        if ($user) {
            if ($carImage) {
                // If an image was uploaded, replace the existing image file
                $existingFilePath = $uploadDir . $uniqueFileName;
                
                // Remove the existing file if it exists
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
        
                // Rename the temporary file to the final file name
                rename($tempFilePath, $existingFilePath);
            }
        
            echo "Car record updated successfully!";
        } else {
            // Clean up the temporary file if the update failed
            if (isset($tempFilePath) && file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        
            echo "Error updating car record.";
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
