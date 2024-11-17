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
        
        


    }else if($_POST['requestType'] == 'UpdateCar'){
            
        print_r($_POST);
        $carId = $_POST['carId'];
$carName = $_POST['carName'];
$carType = $_POST['carType'];
$plateNumber = $_POST['plateNumber'];
$condo = $_POST['condo'];
$RFID = $_POST['RFID'];

$currentCar = $db->get_car_by_id($carId); // Fetch current car details from the database

if (isset($_FILES['carImage']) && $_FILES['carImage']['error'] === UPLOAD_ERR_OK) {
    $targetDir = '../../CarImages/';
    $fileName = uniqid('car_', true) . '.' . strtolower(pathinfo($_FILES['carImage']['name'], PATHINFO_EXTENSION)); // Generate a unique file name
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image (optional)
    $check = getimagesize($_FILES['carImage']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file size (optional)
    if ($_FILES['carImage']['size'] > 500000) { // Adjust the size limit as needed
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (optional)
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, & WEBP files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['carImage']['tmp_name'], $targetFile)) {
            $filename = $fileName; // Save the unique filename to the database

            // Unlink the old image file from the directory if it's not the same as the new one
            if ($currentCar['CarImage'] && $currentCar['CarImage'] != $filename) {
                unlink($targetDir . $currentCar['CarImage']); // Delete the old image
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            $filename = ''; // Set filename to empty if upload failed
        }
    }
} else {
    // If no new image is uploaded, keep the existing image
    $filename = $currentCar['CarImage'];
}

// Update the car information in the database
$updateSuccess = $db->UpdateCars($carId, $carName, $carType, $plateNumber, $condo, $RFID, $filename);

// Check if the update was successful
if ($updateSuccess) {
    echo 200;  // Success response
} else {
    echo 'Failed to update car record in the database.';
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
