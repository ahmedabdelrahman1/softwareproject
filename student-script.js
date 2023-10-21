document.addEventListener('DOMContentLoaded', function () {
    const courseList = document.getElementById('course-list');
    const cartItems = document.getElementById('cart-items');
    const saveCartButton = document.getElementById('save-cart');

    // Retrieve the available courses and the cart from localStorage
    const availableCourses = JSON.parse(localStorage.getItem('courses')) || [];
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Function to display available courses
    function displayCourses() {
        courseList.innerHTML = ''; // Clear the list

        availableCourses.forEach((course) => {
            const courseItem = document.createElement('li');
            courseItem.textContent = `Course: ${course.name} - Cost: $${course.cost}`;
            
            // Create an "Add to Cart" button for students
            const addToCartButton = document.createElement('button');
            addToCartButton.textContent = 'Add to Cart';
            addToCartButton.addEventListener('click', function () {
                // Add the course to the cart
                cart.push(course);

                // Store the updated cart in localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                displayCart(); // Refresh the cart display
            });

            courseItem.appendChild(addToCartButton);
            courseList.appendChild(courseItem);
        });
    }

    // Function to display the cart
    function displayCart() {
        cartItems.innerHTML = ''; // Clear the cart

        cart.forEach((course, index) => {
            const cartItem = document.createElement('li');
            cartItem.textContent = `Course: ${course.name} - Cost: $${course.cost}`;

            // Create a "Remove" button for students
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function () {
                // Remove the course from the cart
                cart.splice(index, 1);

                // Store the updated cart in localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                displayCart(); // Refresh the cart display
            });

            cartItem.appendChild(removeButton);
            cartItems.appendChild(cartItem);
        });
    }

    // Display the available courses and the cart on page load
    displayCourses();
    displayCart();

    // Handle saving the cart
    saveCartButton.addEventListener('click', function () {
        // You can add functionality to save the cart data, e.g., sending it to a server.
        alert('Cart has been saved.');
    });
});
