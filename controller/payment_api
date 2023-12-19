<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Example: Validate required payment fields
    $requiredFields = ['cardHolderName', 'creditCardNumber', 'cvv', 'expiryYear', 'expiryMonth', 'courseid', 'studentID'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            // Handle validation error, redirect to an error page or show a message
            echo "Payment and enrollment failed. Please fill in all required fields.";
            exit();
        }
    }

    // Example payment processing logic (replace this with your actual payment gateway integration)
    $creditCardNumber = $_POST['creditCardNumber'];
    $cvv = $_POST['cvv'];
    $expiryYear = $_POST['expiryYear'];
    $expiryMonth = $_POST['expiryMonth'];

    // Implement your payment gateway integration logic here
    $paymentGateway = new PaymentGateway();
    $paymentResult = $paymentGateway->processPayment($creditCardNumber, $cvv, $expiryYear, $expiryMonth);

    // Check if the payment was successful
    if ($paymentResult) {
        // Payment was successful

        // After successful payment, you might want to update the database to mark the student as paid/enrolled
        // Example: Update the payment status in your database
        // Replace this with your actual database update query
        $studentObject = new Student();
        $studentId = $_POST['studentID'];
        $courseId = $_POST['courseID'];
        $enrollmentSuccess = $studentObject->enrollStudent($studentId, $courseId);

        if ($enrollmentSuccess) {
            // Display a simple success message
            echo "Payment and enrollment successful! Thank you for choosing our course.";
            // Redirect to the index page after enrollment
            header('Refresh:5; url=index.php'); // Redirect to index.php after 5 seconds
            exit();
        } else {
            // Handle enrollment failure, redirect or show an error message
            echo "Payment succeeded, but enrollment failed. Please try again.";
            exit();
        }
    } else {
        // Payment failed, redirect or show an error message
        echo "Payment failed. Please check your payment details and try again.";
        exit();
    }
} else {
    // Invalid request, redirect to an error page
    echo "Invalid request.";
    exit();
}
?>
