// packageView.js - Handles wishlist functionality for package view page

function toggleWishlist(btn, tourId) {
    fetch('api/toggle_wishlist.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `tour_id=${tourId}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log("Wishlist response:", data);

        if (data.status === 'added') {
            btn.classList.replace('btn-outline-danger', 'btn-danger');
            btn.innerHTML = '<i class="bi bi-heart-fill me-2"></i> Added to Wishlist';
        } else if (data.status === 'removed') {
            btn.classList.replace('btn-danger', 'btn-outline-danger');
            btn.innerHTML = '<i class="bi bi-heart me-2"></i> Add to Wishlist';
        } else if (data.status === 'error') {
            alert(data.message || 'An error occurred while updating wishlist');
        }
    })
    .catch(err => {
        console.error('Wishlist Error:', err);
        alert("Could not update wishlist. Please try again.");
    });
}