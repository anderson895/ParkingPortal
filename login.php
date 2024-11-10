<?php
session_start();
header('Content-Type: application/json');

// Database connection settings
$host = "localhost";
$dbname = "parking_portal";
$username = "root";
$password = "";

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection error."]);
    exit();
}

// Get username and password from POST data
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';

// Validate user credentials
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['username'] = $user;
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid username or password."]);
}

$stmt->close();
$conn->close();
?>
