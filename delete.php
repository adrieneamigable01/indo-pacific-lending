
<?php
include 'config.php';

$id = $_GET['id'];
$conn->query("DELETE FROM loan_applications WHERE id='$id'");

header("Location: index.php");
?>
