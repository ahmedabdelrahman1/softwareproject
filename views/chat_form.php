<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderName = filter_input(INPUT_POST, 'sender_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);


    if (empty($senderName) || !$email || empty($message)) {
        // Redirect to the form page with an error parameter
        header("Location: chat.php?error=true");
        exit();
    }

    // Database configuration
    $dbHost = "your_database_host";
    $dbUser = "your_database_user";
    $dbName = "miu";


    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO messages (sender_name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $senderName, $email, $message);
    $stmt->execute();
    $stmt->close();

    $conn->close();

    // Send email notification to the admin
    $adminEmail = "arwaa2110478@miuegypt.edu.eg"; 
    $adminSubject = "New Form Submission";
    $adminHeaders = "From: $adminEmail";

    $adminMessage = "New form submission:\n\n";
    $adminMessage .= "Sender Name: $senderName\n";
    $adminMessage .= "Email: $email\n";
    $adminMessage .= "Message:\n$message";

    mail($adminEmail, $adminSubject, $adminMessage, $adminHeaders);

    // Redirect to the form page with a success parameter
    header("Location: chat.php?success=true");
    exit();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: chat.php");
    exit();
}
?>
