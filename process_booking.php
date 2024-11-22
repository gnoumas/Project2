<?php
// Database connection
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

$query = "SELECT * FROM Classes";
$result = mysqli_query($conn, $query);
$classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];  

    $query = "SELECT COUNT(*) AS bookings_count, capacity FROM Bookings JOIN Classes ON Bookings.class_id = Classes.class_id WHERE class_id = '$class_id'";
    $result = mysqli_query($conn, $query);
    $class = mysqli_fetch_assoc($result);

    if ($class['bookings_count'] < $class['capacity']) {
        $query = "INSERT INTO Bookings (member_id, class_id, booking_date) VALUES ('$member_id', '$class_id', NOW())";
        mysqli_query($conn, $query);

        $membershipType = $member['membership_type'];
        define('BASIC_MEMBERSHIP', 30);
        define('PREMIUM_MEMBERSHIP', 50);
        
        $membershipCost = ($membershipType == 'premium') ? PREMIUM_MEMBERSHIP : BASIC_MEMBERSHIP;

        $payment_query = "INSERT INTO Payments (member_id, payment_date, amount, payment_method) VALUES ('$member_id', NOW(), '$membershipCost', 'Online Payment')";
        mysqli_query($conn, $payment_query);

        $date = date('H:i, jS F Y');
        $outputString = $date . "\t" . $member_id . "\t" . $member['username'] . "\t" . $class['class_name'] . "\t" . $membershipType . "\t" . $membershipCost . "\n";

      if (!isset($_SESSION['member_id'])) {
          header('Location: login.php');
          exit; 
        }

        if ($fp) {
            fwrite($fp, $outputString, strlen($outputString));
            fclose($fp);
            echo "<p>You have successfully booked the class: " . htmlspecialchars($class['class_name']) . ".</p>";
            echo "<p>Booking Date: " . htmlspecialchars(date('Y-m-d')) . "</p>";
            echo "<p>Membership Fee: $" . number_format($membershipCost, 2) . "</p>";
        } else {
            echo "<p><strong>There was an error logging the transaction. Please try again later.</strong></p>";
        }
    } else {
        echo "<p>Sorry, this class is fully booked! Please choose another class or time.</p>";
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