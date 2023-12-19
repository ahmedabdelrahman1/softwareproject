document.addEventListener('DOMContentLoaded', function() {
    
    var toggleButton = document.getElementById('toggleChat');
    var chatForm = document.getElementById('chatForm');ly
    chatForm.style.display = 'none';

    toggleButton.addEventListener('click', function() {
        if (chatForm.style.display === 'none') {
            chatForm.style.display = 'block';
        } else {
            chatForm.style.display = 'none';
        }
    });
});
