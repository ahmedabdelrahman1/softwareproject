// JavaScript for deleting bookmarks
function deleteBookmark(index) {
    if (confirm("Are you sure you want to delete this bookmark?")) {
        // Send an AJAX request to the server to delete the bookmark
        // Here, we'll just remove the row from the HTML table (client-side)

        // Remove the table row associated with the clicked "Remove" button
        var table = document.querySelector('table');
        table.deleteRow(index + 1); // +1 because the first row is the table header

        // You can also send an AJAX request to the server to delete the bookmark from the database
    }
}
