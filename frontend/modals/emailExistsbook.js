document.addEventListener('DOMContentLoaded', function () {
    // 1. Check if the URL has the error flag
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get('error') === 'emailBook_exists') {
        showEmailModal();
    }
});

function showEmailModal() {
    const overlay = document.createElement('div');
    Object.assign(overlay.style, {
        position: 'fixed', top: '0', left: '0', width: '100%', height: '100%',
        backgroundColor: 'rgba(0,0,0,0.7)', display: 'flex', alignItems: 'center',
        justifyContent: 'center', zIndex: '10000', opacity: '0', transition: 'opacity 0.3s'
    });

    const modal = document.createElement('div');
    Object.assign(modal.style, {
        background: 'white', padding: '30px', borderRadius: '15px',
        textAlign: 'center', maxWidth: '400px', width: '90%',
        boxShadow: '0 10px 30px rgba(0,0,0,0.3)', fontFamily: 'sans-serif'
    });

    modal.innerHTML = `
    <div style="margin-bottom: 20px;">
        <i class="fa-solid fa-envelope fa-5x" style="color: #208346;"></i>
    </div>
    
    <div class="h3" style="color: #333; margin: 0 0 15px 0; font-family: sans-serif; font-weight: bold;">
        Email Already Exists
    </div>
    
    <div class="text" style="color: #666; font-family: sans-serif; line-height: 1.5; margin-bottom: 20px;">
        Email already exists in BookStack! Please use a different email.
    </div>
    
    <button id="closeEmailModal" style="
        margin-top: 10px; padding: 12px 25px; 
        background: #198754; color: white; border: none; border-radius: 8px; 
        cursor: pointer; font-size: 16px; width: 100%; font-weight: bold;
        transition: background 0.2s;">
        Try Another Email
    </button>
`;

    overlay.appendChild(modal);
    document.body.appendChild(overlay);

    setTimeout(() => overlay.style.opacity = '1', 10);

    document.getElementById('closeEmailModal').onclick = function () {
        overlay.style.opacity = '0';
        window.history.replaceState({}, document.title, window.location.pathname);
        setTimeout(() => overlay.remove(), 300);
    };
}