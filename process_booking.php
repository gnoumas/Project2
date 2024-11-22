<?php

$host = 'localhost';       
$dbname = 'gym_system';    
$username = 'root';        
$password = '';            

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
if (!isset($_SESSION['member_id'])) {
    header('Location: login.php');
    exit;
}

$member_id = $_SESSION['member_id'];

$query = "SELECT * FROM Members WHERE member_id = '$member_id'";
$result = mysqli_query($conn, $query);
$member = mysqli_fetch_assoc($result);

if (!$member) {
    echo "<p>Member not found.</p>";
    exit;
}

$query = "SELECT * FROM Classes";
$result = mysqli_query($conn, $query);
$classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = (int) $_POST['class_id'];
    $booking_date = date('Y-m-d H:i:s');

    $query = "SELECT * FROM Classes WHERE class_id = '$class_id'";
    $result = mysqli_query($conn, $query);
    $class = mysqli_fetch_assoc($result);

    if (!$class) {
        echo "<p>Invalid class selected.</p>";
    } else {
        $query = "SELECT COUNT(*) FROM Bookings WHERE class_id = '$class_id'";
        $result = mysqli_query($conn, $query);
        $classBookings = mysqli_fetch_row($result)[0];
        $availableSlots = 20 - $classBookings;

        if ($availableSlots > 0) {
            echo "<p>You have successfully booked the class: " . htmlspecialchars($class['class_name']) . ".</p>";
            echo "<p>Booking Date: " . htmlspecialchars($booking_date) . "</p>";

            $query = "INSERT INTO Bookings (member_id, class_id, booking_date) VALUES ('$member_id', '$class_id', '$booking_date')";
            mysqli_query($conn, $query);

            $membershipType = $member['membership_type'];
            $membershipCost = ($membershipType == 'premium') ? 50 : 30;

            echo "<p>Membership Type: " . ucfirst($membershipType) . "</p>";
            echo "<p>Membership Fee: $" . number_format($membershipCost, 2) . "</p>";

            $query = "INSERT INTO Payments (member_id, payment_date, amount, payment_method) VALUES ('$member_id', '$booking_date', '$membershipCost', 'Online Payment')";
            mysqli_query($conn, $query);

            $document_root = $_SERVER['DOCUMENT_ROOT'];
            $date = date('H:i, jS F Y');
            $outputString = $date . "\t" . $member_id . "\t" . $member['username'] . "\t"
                . $class['class_name'] . "\t" . $membershipType . "\t"
                . $membershipCost . "\n";

            $fp = fopen("$document_root/../orders/orders.txt", 'ab');
            if ($fp) {
                fwrite($fp, $outputString, strlen($outputString));
                fclose($fp);
                echo "<p>Booking and payment processed successfully.</p>";
            } else {
                echo "<p><strong>Error: Could not open orders file. Please contact the webmaster.</strong></p>";
            }
        } else {
            echo "<p>Sorry, this class is fully booked. Please choose another class or time.</p>";
        }
    }
}
?>

<?php
require('headerp.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Class</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($member['first_name']) ?> <?= htmlspecialchars($member['last_name']) ?></h1>
    <p>Membership Type: <?= htmlspecialchars($member['membership_type']) ?></p>
    <p>Email: <?= htmlspecialchars($member['email']) ?></p>

    <h2>Available Classes</h2>
    <form action="book_class.php" method="post">
        <label for="class_id">Choose a class:</label>
        <select name="class_id" id="class_id">
            <?php foreach ($classes as $class): ?>
            <option value="<?= htmlspecialchars($class['class_id']) ?>">
                <?= htmlspecialchars($class['class_name']) ?> by <?= htmlspecialchars($class['instructor']) ?> (<?= htmlspecialchars($class['schedule_time']) ?>)
            </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Book Class</button>
    </form>
</body>
</html>

<?php
require('footerp.php'); 
?>