<?php
// Show errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include DB connection
include_once 'connection.php'; // Make sure this connects to your DB properly

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form inputs
    $current_rank  = $_POST['current_rank'] ?? '';
    $desired_rank  = $_POST['desired_rank'] ?? '';
    $username      = $_POST['Username'] ?? '';
    $email         = $_POST['email'] ?? '';
    $password      = $_POST['password'] ?? '';
    $phone         = $_POST['phone_number'] ?? '';
    $price         = $_POST['price'] ?? '';

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (current_rank, desired_rank, username, email, password, phone, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $current_rank, $desired_rank, $username, $email, $password, $phone, $price);

    if ($stmt->execute()) {
        echo "<script>alert('Order submitted successfully!'); window.location.href='termsCondition1.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
