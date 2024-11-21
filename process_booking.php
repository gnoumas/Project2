<?php
// Database connection settings
$host = 'localhost';       
$dbname = 'gym_system';    
$username = 'root';        
$password = '';            
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

session_start();
if (!isset($_SESSION['member_id'])) {
    header('Location: login.php'); 
}

$member_id = $_SESSION['member_id'];

//Retrieve Data
$stmt = $pdo->prepare("SELECT * FROM Members WHERE member_id = ?");
$stmt->execute([$member_id]);
$member = $stmt->fetch();

//Available Classes
$stmt = $pdo->prepare("SELECT * FROM Classes");
$stmt->execute();
$classes = $stmt->fetchAll();

//Class booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];  

    $stmt = $pdo->prepare("SELECT COUNT(*) AS bookings_count, capacity FROM Bookings JOIN Classes ON Bookings.class_id = Classes.class_id WHERE class_id = ?");
    $stmt->execute([$class_id]);
    $class = $stmt->fetch();

    if ($class['bookings_count'] < $class['capacity']) {
        $stmt = $pdo->prepare("INSERT INTO Bookings (member_id, class_id, booking_date) VALUES (?, ?, NOW())");
        $stmt->execute([$member_id, $class_id]);

        echo "Booking successful!";
    } else {
        echo "Sorry, this class is fully booked!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Class</title>
</head>
<body>
    <h1>Welcome, <?= $member['first_name'] ?> <?= $member['last_name'] ?></h1>
    <p>Membership Type: <?= $member['membership_type'] ?></p>
    <p>Email: <?= $member['email'] ?></p>
    
    <h2>Available Classes</h2>
    <form action="book_class.php" method="post">
        <label for="class_id">Choose a class:</label>
        <select name="class_id" id="class_id">
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['class_id'] ?>">
                    <?= $class['class_name'] ?> by <?= $class['instructor'] ?> (<?= $class['schedule_time'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Book Class</button>
    </form>
</body>
</html>