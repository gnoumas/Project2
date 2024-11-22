<?php

require('headerp.php'); 

$host = 'localhost';       
$dbname = 'gym_system';    
$username = 'root';        
$password = '';            

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $membership_type = $_POST['membership_type'];

    $sql = "INSERT INTO Members (first_name, last_name, email, phone_number, membership_type, password)
            VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$membership_type', '$password')";

    if ($pdo->query($sql)) {
        header('Location: login.php');
        exit;  
    } else {
        echo "Error: " . $pdo->errorInfo()[2];
    }
}

require('footerp.php');
?>