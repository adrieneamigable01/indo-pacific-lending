
<?php
$conn = new mysqli("localhost", "root", "", "indo_lending");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
