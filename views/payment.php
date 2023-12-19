<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include("partials/head.php");
?>

<body>

    <?php
    include("partials/navbar.php");
    ?>

    <div class="container mt-5">

        <form action="../controller/student_controller.php" method="post"onsubmit="return validatePaymentInfo();">
        <input type="hidden" name="action" value="enroll">

            <h3 class="title">Payment Information</h3>

            <div class="mb-3">
                <label for="cardHolderName" class="form-label">Card Holder's Name:</label>
                <input type="text" class="form-control" name="cardHolderName" placeholder="Enter your card holder name" id="cardHolderName" required>
            </div>
            <div class="mb-3">
                <label for="creditCardNumber" class="form-label">Credit Card Number:</label>
                <input type="text" class="form-control" name="creditCardNumber" placeholder="Enter credit card number" id="creditCardNumber"required>
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV:</label>
                <input type="text" class="form-control" name="cvv" placeholder="Enter CVV number" id="cvv"required>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="expirydate" class="form-label">Expiry Year:</label>
                        <input type="month" class="form-control" name="expiryYear" placeholder="Enter expiry year" id="expiryYear"required>
                    </div>
                </div>
            </div>

            <input type="hidden" name="courseID" value="<?php echo $_GET['course_ID']; ?>">
            <input type="hidden" name="studentID" value="<?php echo $_GET['student_ID']; ?>">

            <input type="submit" value="Proceed to Checkout" class="btn btn-primary">

        </form>

    </div>

    <?php
    include("partials/footer.php");
    ?>

<script>
    function validatePaymentInfo() {
    // Basic validation example
    var cardHolderName = document.getElementById('cardHolderName').value;
    var creditCardNumber = document.getElementById('creditCardNumber').value;
    var cvv = document.getElementById('cvv').value;
    var expiryDate = document.getElementById('expiryYear').value;

    // Add your validation logic here
    if (cardHolderName === '' || creditCardNumber === '' || cvv === '' || expiryDate === '') {
        alert('Please fill in all payment information fields.');
        return false;
    }

    // Check credit card number length (assuming a standard length of 16 digits)
    if (creditCardNumber.length !== 16) {
        alert('Invalid credit card number. Please enter a 16-digit number.');
        return false;
    }

    // Check CVV length (assuming a standard length of 3 digits)
    if (cvv.length !== 3) {
        alert('Invalid CVV. Please enter a 3-digit CVV.');
        return false;
    }

    // Check expiry date format (assuming YYYY-MM format)
    var currentYear = new Date().getFullYear();
    var currentMonth = new Date().getMonth() + 1; // Months are zero-based

    if (!/^\d{4}-\d{2}$/.test(expiryDate)) {
        alert('Invalid expiry date. Please enter the date in YYYY-MM format.');
        return false;
    }

    var enteredYear = parseInt(expiryDate.substring(0, 4), 10);
    var enteredMonth = parseInt(expiryDate.substring(5, 7), 10);

    // Check if the expiry date is in the future
    if (enteredYear < currentYear || (enteredYear === currentYear && enteredMonth < currentMonth)) {
        alert('Invalid expiry date. Please enter a date in the future.');
        return false;
    }

    // If everything is valid, the form will be submitted
    return true;
}
</script>


</body>

</html>
