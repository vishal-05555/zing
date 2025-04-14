<?php
// database.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicle_assistance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
// To open this file in the sidebar, you can use a file explorer or an IDE like Visual Studio Code.
// In Visual Studio Code, you can open the folder containing this file and it will appear in the sidebar.