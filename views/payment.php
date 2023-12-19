 <!DOCTYPE html>
<html lang="en">
//<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>

<div class="container">

    <form action="payment_api.php" method="post">

        <h3 class="title">Payment Information</h3>

        <div class="inputBox">
            <span>Card Holder's Name:</span>
            <input type="text" name="cardHolderName" placeholder="Enter your card holder name" required>
        </div>
        <div class="inputBox">
            <span>Credit Card Number:</span>
            <input type="text" name="creditCardNumber" placeholder="Enter credit card number" required>
        </div>
        <div class="inputBox">
            <span>CVV:</span>
            <input type="text" name="cvv" placeholder="Enter CVV number" required>
        </div>

        <div class="flex">
            <div class="inputBox">
                <span>Expiry Year:</span>
                <input type="text" name="expiryYear" placeholder="Enter expiry year" required>
            </div>
            <div class="inputBox">
                <span>Expiry Month:</span>
                <input type="text" name="expiryMonth" placeholder="Enter expiry month" required>
            </div>
        </div>

        <input type="hidden" name="sectionID" value="<?php echo $_GET['sectionID']; ?>">
        <input type="hidden" name="studentID" value="<?php echo $_GET['studentID']; ?>">

        <input type="submit" value="Proceed to Checkout" class="submit-btn">

    </form>

</div>

<?php
include("partials/footer.php");
?>

</body>

</html>










<!--
<div class="container">

    <form action="">

        <div class="row">

            <div class="col">

                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Full name :</span>
                    <input type="text" placeholder="Enter your name">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="Enter your email">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder=" Enter your address detailes">
                </div>
                <div class="inputBox">
                    <span>Governorate :</span>
                    <input type="text" placeholder="Enter your governorate name">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" placeholder="Enter Your city name">
                    </div>
                </div>
                <div class="inputBox">
                    <span>Telephone number</span>
                    <input type="number"placeholder="Enter your telephone number">
                </div>
                    <div class="inputBox">
                        <span>Zip code :</span>
                        <input type="text" placeholder="Enter yor city Zip code">
                    </div>
                </div>

           

            <div class="col">

                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>Card Name  :</span>
                    <input type="text" placeholder="Enter your card holder name ">
                </div>
                <div class="inputBox">
                    <span>Credit card number :</span>
                    <input type="number" placeholder="Enter creidt card number">
                </div>
                <div class="inputBox">
                    <span>CVV :</span>
                    <input type="text" placeholder="Enter Cvv number">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Expiry year :</span>
                        <input type="number" placeholder="year">
                    </div>
                    <div class="inputBox">
                        <span>Expiry month :</span>
                        <input type="text" placeholder="month ">
                    </div>
            
                </div>

            </div>
    
        </div>

        <input type="submit" value="proceed to checkout" class="submit-btn">

    </form>

</div>   
<?php
 include("partials/footer.php")
?> 
    
</body>
</html> -->
