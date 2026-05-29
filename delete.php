<?php
include 'config.php';

// Get the ID from the URL parameters
$id = $_GET['id'] ?? '';

if ($id != '') {
    // Sanitize the ID to ensure it is a safe integer
    $id = intval($id);
    
    // Update the query to set isActive to 0 instead of deleting the row
    $conn->query("UPDATE loan_applications SET isActive = 0 WHERE id = '$id'");
}

// Redirect back to your main list view page
header("Location: index.php");
exit;
?>