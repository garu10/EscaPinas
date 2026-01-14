
document.addEventListener('DOMContentLoaded', function () {
    // find the form that contains your password fields
    const form = document.querySelector('input[name="password"]').closest('form');

    form.addEventListener('submit', function (e) {
        const password = document.querySelector('input[name="password"]').value;
        const confirm = document.querySelector('input[name="confirm_password"]').value;

        if (password !== confirm) {
            e.preventDefault(); // stop the form from submitting
            showCustomModal("Password Mismatch", "The passwords you entered do not match. Please try again.");
        }
    });
});

function showCustomModal(title, message) {
    const overlay = document.createElement('div');
    Object.assign(overlay.style, {
        position: 'fixed',
        top: '0',
        left: '0',
        width: '100%',
        height: '100%',
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
        backdropFilter: 'blur(4px)',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        zIndex: '9999',
        opacity: '0',
        transition: 'opacity 0.3s ease'
    });

    // 2. Create Modal Box
    const modal = document.createElement('div');
    Object.assign(modal.style, {
        background: 'white',
        padding: '2rem',
        borderRadius: '15px',
        maxWidth: '400px',
        width: '90%',
        textAlign: 'center',
        boxShadow: '0 10px 25px rgba(0,0,0,0.2)',
        transform: 'scale(0.8)',
        transition: 'transform 0.3s ease',
        fontFamily: 'system-ui, -apple-system, sans-serif'
    });

    modal.innerHTML = `
    <div style="margin-bottom: 25px;">
        <i class="fa-solid fa-circle-exclamation fa-5x" style="color: #781717;"></i>
    </div>
    
    <h3 style="margin: 0 0 10px; color: #333; font-family: sans-serif;">${title}</h3>
    <p style="color: #666; margin-bottom: 25px; line-height: 1.5; font-family: sans-serif;">${message}</p>
    
    <button id="modalCloseBtn" style="
        background: #198754; color: white; border: none; 
        padding: 12px 30px; border-radius: 8px; font-weight: 600; 
        cursor: pointer; width: 100%; font-size: 16px; transition: 0.2s;">
        Go Back
    </button>
`;

    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    setTimeout(() => {
        overlay.style.opacity = '1';
        modal.style.transform = 'scale(1)';
    }, 10);

    document.getElementById('modalCloseBtn').addEventListener('click', () => {
        overlay.style.opacity = '0';
        modal.style.transform = 'scale(0.8)';
        setTimeout(() => overlay.remove(), 300);
    });
}
