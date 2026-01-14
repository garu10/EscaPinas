// Handle login form submission
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);

    fetch('api/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = '../index.php';
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Login failed: ' + err.message);
    });
});