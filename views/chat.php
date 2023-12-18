<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>
    <h1>Chat Form</h1>

    <form action="process_contact_form.php" method="post">
        <label for="sender_name">Your Name:</label>
        <input type="text" name="sender_name" required>

        <label for="email">Your Email:</label>
        <input type="email" name="email" required>

        <label for="message">Message:</label>
        <textarea name="message" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>
    <?php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $senderName = filter_input(INPUT_POST, 'sender_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Check if any of the inputs are empty or invalid
    if (empty($senderName) || !$email || empty($message)) {
        // Redirect to the form page with an error parameter
        header("Location: contact_form.php?error=true");
        exit();
    }

    // Additional validation and processing can be added here

    // Database configuration
    $dbHost = "your_database_host";
    $dbUser = "your_database_user";
    $dbPassword = "your_database_password";
    $dbName = "your_database_name";

    // Create a database connection
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check the connection
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
    $adminEmail = "arwaa2110478@miuegypt.edu.eg; 
    $adminSubject = "New Form Submission";
    $adminHeaders = "From: $adminEmail";

    $adminMessage = "New form submission:\n\n";
    $adminMessage .= "Sender Name: $senderName\n";
    $adminMessage .= "Email: $email\n";
    $adminMessage .= "Message:\n$message";

    mail($adminEmail, $adminSubject, $adminMessage, $adminHeaders);
    header("Location: contact_form.php?success=true");
    exit();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: contact_form.php");
    exit();
}
?>


</body>
</html>
