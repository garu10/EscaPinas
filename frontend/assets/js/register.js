let countdown;

function startCountdown(duration, display) {
    let timer = duration,
        minutes, seconds;
    clearInterval(countdown);
    countdown = setInterval(function() {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        display.textContent = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        if (--timer < 0) {
            clearInterval(countdown);
            document.getElementById('btnVerify').disabled = true;
            document.getElementById('otp_input').disabled = true;
            document.getElementById('resendContainer').style.display = 'block';
        }
    }, 1000);
}

function resendOTP() {
    let emailInput = document.getElementById('resendEmail');
    let email = emailInput.value;

    if (!email) {
        alert("Email not found. Please refresh the page.");
        return;
    }

    const resendBtn = document.querySelector('#resendContainer button');
    resendBtn.disabled = true;
    resendBtn.innerText = "Sending...";

    fetch('api/resend_otp.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email })
        })
        .then(async response => {
            const text = await response.text();
            try {
                if (!response.ok) throw new Error(`Server Error: ${response.status}`);
                return JSON.parse(text);
            } catch (err) {
                console.error("Raw Response:", text);
                throw new Error("Ang server ay nagbigay ng invalid response. I-check ang Network Tab.");
            }
        })
        .then(data => {
            if (data.status === 'success') {
                alert('Bagong code ang ipinadala!');
                document.getElementById('btnVerify').disabled = false;
                document.getElementById('otp_input').disabled = false;
                document.getElementById('otp_input').value = '';
                document.getElementById('resendContainer').style.display = 'none';

                clearInterval(countdown);
                startCountdown(60, document.querySelector('#timer'));
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Connection Error: " + err.message);
        })
        .finally(() => {
            resendBtn.disabled = false;
            resendBtn.innerText = "RESEND NEW CODE";
        });
}

document.getElementById('otpForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('resendEmail').value;
    const otp = document.getElementById('otp_input').value;

    if (!otp) {
        alert("Pakilagay ang OTP code.");
        return;
    }

    fetch('api/verify_otp.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email, otp_input: otp })
        })
        .then(async response => {
            const text = await response.text();
            try {
                if (!response.ok) throw new Error(`Server Error: ${response.status}`);
                return JSON.parse(text);
            } catch (err) {
                console.error("Raw Response:", text);
                throw new Error("Invalid response mula sa server.");
            }
        })
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = 'login.php';
            } else {
                alert(data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Verification Error: " + err.message);
        });
});

// Handle registration form submission
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);

    fetch('api/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = 'registerAccount.php?verify=true&email=' + encodeURIComponent(data.email);
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Registration failed: ' + err.message);
    });
});
