<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT member_id, password FROM Members WHERE email = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $stmt = $pdo->prepare("INSERT INTO Users (username, password, member_ID) VALUES (?, ?, ?)");
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
            $stmt->execute([$username, $hashed_password, $user['member_id']]);

            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Username not found.";
    }
}
?>