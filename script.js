// JavaScript for handling the cart functionality

// Event listener for adding a course to the cart
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('add-to-cart')) {
        const courseName = event.target.parentElement.querySelector('h3').textContent;
        const coursePrice = event.target.parentElement.querySelector('p').textContent;
        
        // Create a new cart item element
        const cartItem = document.createElement('li');
        cartItem.textContent = `${courseName} - ${coursePrice}`;
        
        // Append the cart item to the cart
        document.getElementById('cart-items').appendChild(cartItem);
    }
});

