<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Form</title>
    <link rel="stylesheet" href="../../public/css/chat.css">
</head>
<body>


    <!-- Chat Form -->
    <form id="chatForm" action="process_contact_form.php" method="post">
        <label for="sender_name"><br> Enter Your Name:</label><br>
        <input type="text" name="sender_name" required>

        <label for="email"><br> Enter Your Email:</label><br>
        <input type="email" name="email" required>

        <label for="message"><br> Enter your Message:</label><br>
        <textarea name="message" rows="4" required></textarea>
            <br>
        <input type="submit" value="Submit"><br>
    </form>

    <script src="chat.js"></script>
</body>
</html>
