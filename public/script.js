const container = document.getElementById('container');
const loginLink = document.querySelector('.SignInLink');
const registerLink = document.querySelector('.SignUpLink');

const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

const loginUserInput = document.getElementById('loginUsername');
const loginPassInput = document.getElementById('loginPassword');
const toggleLoginPass = document.getElementById('toggleLoginPass');

const regUserInput = document.getElementById('regUsername');
const regEmailInput = document.getElementById('regEmail');
const regPassInput = document.getElementById('regPassword');
const toggleRegPass = document.getElementById('toggleRegPass');

const strengthBar = document.getElementById('strengthBar');
const strengthLabel = document.getElementById('strengthLabel');
const strengthHint = document.getElementById('strengthHint');

const lockoutNotice = document.getElementById('lockoutNotice');
const lockoutTimer = document.getElementById('lockoutTimer');
const btnLogin = document.getElementById('btnLogin');
const btnRegister = document.getElementById('btnRegister');

const authSuccessOverlay = document.getElementById('authSuccessOverlay');
const authUsername = document.getElementById('authUsername');
const btnLogout = document.getElementById('btnLogout');

const toast = document.getElementById('toast');
const toastIcon = document.getElementById('toastIcon');
const toastMsg = document.getElementById('toastMsg');

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const BANNED_PASSWORDS = new Set([
    'password', 'password123', 'admin', 'admin123', '12345678',
    '123456789', 'qwerty', 'qwerty123', 'letmein', 'welcome123'
]);

let lockoutInterval = null;

// ================= 1. VIEW TOGGLING =================
registerLink.addEventListener('click', (e) => {
    e.preventDefault();
    container.classList.add('active');
    clearInputs();
});

loginLink.addEventListener('click', (e) => {
    e.preventDefault();
    container.classList.remove('active');
    clearInputs();
});

function clearInputs() {
    loginForm.reset();
    registerForm.reset();
    updatePasswordStrength('');
    document.querySelectorAll('.input-box').forEach(box => box.classList.remove('has-val'));
}

document.querySelectorAll('.input-box input').forEach(input => {
    if (input.value.trim() !== '') {
        input.closest('.input-box').classList.add('has-val');
    }
    input.addEventListener('input', () => {
        const box = input.closest('.input-box');
        if (input.value.trim() !== '') {
            box.classList.add('has-val');
        } else {
            box.classList.remove('has-val');
        }
    });
});

// ================= 2. PASSWORD VISIBILITY TOGGLE =================
function setupPasswordToggle(btn, input) {
    if (!btn || !input) return;
    btn.addEventListener('click', () => {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        btn.classList.toggle('bx-show', isPassword);
        btn.classList.toggle('bx-hide', !isPassword);
    });
}
setupPasswordToggle(toggleLoginPass, loginPassInput);
setupPasswordToggle(toggleRegPass, regPassInput);

// ================= 3. PASSWORD COMPLEXITY & STRENGTH METER =================
function evaluatePassword(password) {
    if (!password) {
        return { score: 0, label: '', className: '', isValid: false, reasons: ['Enter a password'] };
    }

    const lower = password.toLowerCase();
    if (BANNED_PASSWORDS.has(lower)) {
        return {
            score: 1,
            label: 'Weak',
            className: 'weak',
            isValid: false,
            reasons: ['Choose a less common password']
        };
    }

    const hasMinLength = password.length >= 8;
    const hasUpper = /[A-Z]/.test(password);
    const hasLower = /[a-z]/.test(password);
    const hasDigit = /[0-9]/.test(password);
    const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);

    const reasons = [];
    if (!hasMinLength) reasons.push('8+ chars');
    if (!hasUpper) reasons.push('uppercase');
    if (!hasLower) reasons.push('lowercase');
    if (!hasDigit) reasons.push('number');
    if (!hasSpecial) reasons.push('symbol');

    let score = 0;
    if (hasMinLength) score++;
    if (hasUpper && hasLower) score++;
    if (hasDigit) score++;
    if (hasSpecial) score++;
    if (password.length >= 12 && hasSpecial && hasDigit) score = 4;

    let label = 'Weak';
    let className = 'weak';

    if (score === 2) {
        label = 'Fair';
        className = 'fair';
    } else if (score === 3) {
        label = 'Good';
        className = 'good';
    } else if (score === 4) {
        label = 'Strong';
        className = 'strong';
    }

    const isValid = hasMinLength && hasUpper && hasLower && hasDigit && hasSpecial;

    return { score, label, className, isValid, reasons };
}

function updatePasswordStrength(password) {
    const { label, className, reasons } = evaluatePassword(password);

    strengthBar.className = 'strength-bar ' + className;
    strengthLabel.className = 'strength-label ' + className;

    if (!password) {
        strengthLabel.textContent = '';
        strengthHint.textContent = '';
    } else if (reasons.length > 0) {
        strengthLabel.textContent = label;
        strengthHint.textContent = `Add: ${reasons.join(', ')}`;
        strengthHint.style.color = '#f87171';
    } else {
        strengthLabel.textContent = label;
        strengthHint.textContent = '';
    }
}

regPassInput.addEventListener('input', (e) => {
    updatePasswordStrength(e.target.value);
});

// ================= 4. LOCKOUT COUNTDOWN =================
function startLockoutCountdown(seconds) {
    let remainingSec = Math.ceil(seconds);
    lockoutNotice.style.display = 'flex';
    lockoutTimer.textContent = `Too many failed attempts. Try again in ${remainingSec}s.`;
    btnLogin.disabled = true;

    if (lockoutInterval) clearInterval(lockoutInterval);
    lockoutInterval = setInterval(() => {
        remainingSec -= 1;
        if (remainingSec <= 0) {
            clearInterval(lockoutInterval);
            lockoutNotice.style.display = 'none';
            btnLogin.disabled = false;
        } else {
            lockoutTimer.textContent = `Too many failed attempts. Try again in ${remainingSec}s.`;
        }
    }, 1000);
}

// ================= 5. TOAST NOTIFICATIONS =================
let toastTimeout = null;
function showToast(message, type = 'info') {
    if (toastTimeout) clearTimeout(toastTimeout);

    toast.className = `toast ${type} show`;
    toastMsg.textContent = message;

    if (type === 'success') {
        toastIcon.className = 'bx bx-check-circle';
    } else if (type === 'error') {
        toastIcon.className = 'bx bx-x-circle';
    } else {
        toastIcon.className = 'bx bx-error-circle';
    }

    toastTimeout = setTimeout(() => {
        toast.className = 'toast';
    }, 4000);
}

// ================= 6. REGISTRATION HANDLER =================
registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = regUserInput.value.trim();
    const email = regEmailInput.value.trim().toLowerCase();
    const password = regPassInput.value;

    if (!/^[a-zA-Z0-9_]{3,20}$/.test(username)) {
        showToast('Username must be 3–20 letters, numbers, or underscores.', 'error');
        regUserInput.focus();
        return;
    }

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        showToast('Please enter a valid email address.', 'error');
        regEmailInput.focus();
        return;
    }

    const passwordEval = evaluatePassword(password);
    if (!passwordEval.isValid) {
        showToast(`Password requires: ${passwordEval.reasons.join(', ')}.`, 'error');
        regPassInput.focus();
        return;
    }

    btnRegister.disabled = true;
    btnRegister.textContent = 'Creating account...';

    try {
        const response = await fetch(registerForm.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ username, email, password }),
        });

        const data = await response.json();

        if (!response.ok) {
            const firstError = data.errors
                ? Object.values(data.errors).flat()[0]
                : (data.message || 'Could not create account.');
            showToast(firstError, 'error');
            return;
        }

        showToast(data.message || 'Account created successfully. Please sign in.', 'success');
        setTimeout(() => {
            container.classList.remove('active');
            clearInputs();
            loginUserInput.value = data.username || username;
            loginUserInput.closest('.input-box').classList.add('has-val');
            loginPassInput.focus();
        }, 1000);
    } catch {
        showToast('Unable to reach server. Please try again.', 'error');
    } finally {
        btnRegister.disabled = false;
        btnRegister.textContent = 'Register';
    }
});

// ================= 7. LOGIN HANDLER =================
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = loginUserInput.value.trim();
    const password = loginPassInput.value;

    if (!username || !password) {
        showToast('Please enter your username and password.', 'error');
        return;
    }

    btnLogin.disabled = true;
    btnLogin.textContent = 'Signing in...';

    try {
        const response = await fetch(loginForm.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ username, password }),
        });

        const data = await response.json();

        if (response.status === 429) {
            startLockoutCountdown(data.retry_after || 30);
            showToast(data.message || 'Too many failed attempts.', 'error');
            return;
        }

        if (!response.ok) {
            const firstError = data.errors
                ? Object.values(data.errors).flat()[0]
                : (data.message || 'Invalid username or password.');
            showToast(firstError, 'error');
            return;
        }

        lockoutNotice.style.display = 'none';
        showToast(data.message || 'Signed in successfully.', 'success');
        displayActiveSession(data.username || username);

        if (data.redirect_url) {
            setTimeout(() => {
                window.location.href = data.redirect_url;
            }, 900);
        }
    } catch {
        showToast('Unable to reach server. Please try again.', 'error');
    } finally {
        if (lockoutNotice.style.display === 'none') {
            btnLogin.disabled = false;
        }
        btnLogin.textContent = 'Login';
    }
});

// ================= 8. SESSION DISPLAY & LOGOUT =================
function displayActiveSession(username) {
    authUsername.textContent = username;
    authSuccessOverlay.style.display = 'flex';
}

btnLogout.addEventListener('click', async () => {
    const logoutUrl = btnLogout.getAttribute('data-logout-url') || '/logout';
    try {
        await fetch(logoutUrl, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
        });
    } catch {
        // Ignore network errors on sign out
    }
    authSuccessOverlay.style.display = 'none';
    clearInputs();
    showToast('Signed out.', 'info');
});
