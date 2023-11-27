<?php


// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Fetch course details from your database
$cartItems = array(); // Array to store cart item details
$totalPrice = 0; // Total price of items in the cart

if (!empty($_SESSION['cart'])) {
    // Replace 'your_database_connection' with your actual database connection code
    require 'your_database_connection.php';

    // Fetch course details for items in the cart
    $cartItems = array(); // Initialize an array to store cart items
    $courseIds = implode(',', $_SESSION['cart']); // Convert array of course IDs to a comma-separated string

    $query = "SELECT * FROM courses WHERE ID IN ($courseIds)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cartItems[] = $row;
            $totalPrice += $row['price'];
        }
    }
}

// Handle course removal if the "Remove" button is clicked
if (isset($_POST['remove_course'])) {
    $courseIdToRemove = $_POST['course_id'];
    $key = array_search($courseIdToRemove, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset array keys
        header('Location: cart.php?removed=true'); // Redirect back to the cart page with a confirmation message
        exit;
    }
}

// Handle the checkout process
if (isset($_POST['checkout'])) {
    // Redirect to an order confirmation page
    header('Location: orderConfirmation.php');
    exit;
}

// Close your database connection if open
if (isset($conn)) {
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<?php   
            session_start();
            include("partials/head.php");
           
    echo'<body>';
            include("partials/navbar.php");
    ?>
    <div class="container py-5">
        <h2>Your Shopping Cart</h2>
        <?php if (isset($_GET['removed']) && $_GET['removed'] == 'true') : ?>
            <div class="alert alert-success">Course removed from the cart.</div>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item) : ?>
                    <tr>
                        <td><?= $item['name']; ?></td>
                        <td>$<?= $item['price']; ?></td>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="course_id" value="<?= $item['ID']; ?>">
                                <input type="submit" name="remove_course" value="Remove" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Price: $<?= $totalPrice; ?></p>
        <form method="post" action="cart.php">
            <input type="submit" name="checkout" value="Proceed to Checkout" class="btn btn-primary">
        </form>
    </div>
    <?php
       include("partials/footer.php")
    ?>
</body>
</html>
