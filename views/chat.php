<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat  Form</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <h1>Chat Form</h1>

    <form action="process_contact_form.php" method="post">
        <label for="sender_name"> Enter Your Name:</label>
        <input type="text" name="sender_name" required>

        <label for="email"> Enter Your Email:</label>
        <input type="email" name="email" required>

        <label for="message"> Enter your Message:</label>
        <textarea name="message" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>
</body>
</html>


