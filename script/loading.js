
let start = 10;  // Start at the 10th item (because you already loaded the first 10)
const content = document.getElementById('content');
const loading = document.getElementById('loading');

// Function to check if the user has scrolled to the bottom
function checkScroll() {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
            loadMoreContent();
    }
}

// Function to load more content
function loadMoreContent() {
        loading.style.display = 'block';  // Show loading text

        // Use AJAX to fetch more content
    fetch(`user.php?start=${start}`)
        .then(response => response.text())
        .then(data => {
                content.innerHTML += data;  // Append the new divs to the existing content
                start += 10;  // Increment the starting point for the next batch
                loading.style.display = 'none';  // Hide loading text
            })
            .catch(error => {
                console.error('Error loading more content:', error);
                loading.style.display = 'none';
            });
    }

    // Detect scroll events
    window.addEventListener('scroll', checkScroll);

    // Initial content loading
    loadMoreContent();

