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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderName = $_POST["sender_name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Additional validation can be added here

    $adminEmail = "admin@example.com"; // Change this to the admin's email address
    $subject = "New Message from $senderName";
    $headers = "From: $email";

    $emailMessage = "New message from $senderName:\n\n$message";

    mail($adminEmail, $subject, $emailMessage, $headers);

    // Optionally, you can store the message in a database for future reference
    // Database insertion code can be added here

    // Redirect to the form page with a success parameter
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
