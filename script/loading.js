let isLoading = false;
const content = document.getElementById('content_load');
const loading = document.getElementById('load');

// Function to check if the user has scrolled to the bottom
function checkScroll() {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 700) {
        loadMoreContent();
    }
}

// Function to load more content using AJAX
function loadMoreContent() {
    if (isLoading) return; // Prevent duplicate requests
    isLoading = true;
    loading.style.display = 'flex';  // Show loading indicator

    // Use AJAX to fetch content from the server (session is handled on the server)
    fetch('user_load.php')  // Call the new PHP file to load more content
        .then(response => response.text())
        .then(data => {
            if (data === "No more content to load.") {
                loading.style.display = 'none';
                alert("No more products available.");
                return;  // Stop further requests when no more content
            }

            content.innerHTML += data;  // Append new content to existing content
            loading.style.display = 'none';  // Hide loading indicator
            isLoading = false;
        })
        .catch(error => {
            console.error('Error loading more content:', error);
            loading.style.display = 'none';
            isLoading = false;
        });
}

// Detect scroll events to trigger loading more content
window.addEventListener('scroll', checkScroll);

// Initial content loading
document.addEventListener('DOMContentLoaded', () => {
    loadMoreContent();  // Load initial content when the page is loaded
});
