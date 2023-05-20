<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "att";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the data from the AJAX request
$name = $_POST["name"];
$status = $_POST["status"];
$time = $_POST["time"];
$date = $_POST["date"];

// Prepare the SQL statement
$stmt = $conn->prepare("UPDATE attendance SET status=? WHERE name=? and time=? and date=?");
$stmt->bind_param("ssss", $status, $name, $time, $date);

// Execute the statement
if ($stmt->execute()) {
    echo '<script type=\"text/javascript\">alert("Attendance updated Successfully Refresh the window to see changes")</script>';
} else {
  echo "Error updating attendance: " . $stmt->error;
}

?>
