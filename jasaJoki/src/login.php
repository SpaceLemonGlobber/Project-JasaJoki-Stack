<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = $_POST['identifier']; // This can be username or email
    $password   = $_POST['password'];

    echo "DEBUG: Identifier = $identifier<br>";

    // Check for either username or email
    $stmt = $conn->prepare("SELECT User_Password FROM data_user WHERE User_Nama = ? OR User_Email = ?");
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    echo "DEBUG: Executed query<br>";

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['User_Password']) { // Change to password_verify() if using hashes
            echo "Login successful";
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>
