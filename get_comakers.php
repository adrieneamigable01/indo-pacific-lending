<?php
// 1. Database Connection (Replace with your actual configuration details)
include 'config.php';

// 2. Set Content-Type header to JSON format
header('Content-Type: application/json; charset=utf-8');

// 3. Process the Incoming request parameter
$loan_application_id = isset($_GET['loan_application_id']) ? intval($_GET['loan_application_id']) : 0;

if ($loan_application_id <= 0) {
    // If no valid application ID is supplied, return an empty array safely
    echo json_encode([]);
    exit;
}

// 4. Secure Database Query using Prepared Statements
$query = "SELECT id, loan_application_id, name, phone, address 
          FROM co_makers 
          WHERE loan_application_id = ? 
          ORDER BY id ASC";

if ($stmt = $conn->prepare($query)) {
    // Bind parameters ("i" denotes an integer input type)
    $stmt->bind_param("i", $loan_application_id);
    
    // Execute query
    $stmt->execute();
    
    // Fetch result sets
    $result = $stmt->get_result();
    
    $comakers = [];
    while ($row = $result->fetch_assoc()) {
        $comakers[] = [
            "id"                  => $row['id'],
            "loan_application_id" => $row['loan_application_id'],
            "name"                => htmlspecialchars($row['name'] ?? ''),
            "phone"               => htmlspecialchars($row['phone'] ?? ''),
            "address"             => htmlspecialchars($row['address'] ?? '')
        ];
    }
    
    // Close Statement safely
    $stmt->close();
    
    // 5. Output the results cleanly to JSON
    echo json_encode($comakers);

} else {
    // Fail-safe response if SQL structural issues occur
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(["error" => "Failed to prepare database query statement"]);
}

// Close connection context
$conn->close();
?>