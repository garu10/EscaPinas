document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('btn-claim-ajax')) {
        const currentBtn = e.target;
        const form = currentBtn.closest('.claim-form');
        const formData = new FormData(form);

        currentBtn.disabled = true;
        const originalHTML = currentBtn.innerHTML;
        currentBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

        fetch('frontend/integs/api/claimedVouchers.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const result = data.trim();

            if (result === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Claimed!',
                    text: 'Voucher saved to your wallet.',
                    timer: 2000,
                    showConfirmButton: false
                });
                currentBtn.classList.replace('btn-success', 'btn-secondary');
                currentBtn.innerHTML = 'Claimed';
            } 
            else if (result === 'already_claimed') {
                Swal.fire({
                    icon: 'info',
                    title: 'Notice',
                    text: 'You already have this voucher.',
                });
                currentBtn.innerHTML = 'Claimed';
            } 
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong. Check your connection.',
                });
                currentBtn.disabled = false;
                currentBtn.innerHTML = originalHTML;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            currentBtn.disabled = false;
            currentBtn.innerHTML = originalHTML;
        });
    }
});