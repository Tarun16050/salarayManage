<?php
 include '../database.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Query to check if email exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Email exists
        echo "exists";
    } else {
        // Email doesn't exist
        echo "not_exists";
    }
}

$con->close();
?>
