<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/kemenhub-logo.png') }}">
    <title>Login - Dashboard Humas Kemenhub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --kemenhub-blue: #0054A6;
            --kemenhub-blue-dark: #003366;
            --kemenhub-red: #E30613;
            --kemenhub-yellow: #FFD100;
            --gray-light: #f8f9fa;
            --gray-medium: #6c757d;
            --gray-dark: #343a40;
            --shadow-light: 0 4px 6px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 8px 25px rgba(0, 0, 0, 0.1);
            --shadow-strong: 0 15px 35px rgba(0, 0, 0, 0.15);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, var(--kemenhub-blue) 0%, var(--kemenhub-blue-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
        }

        .login-container {
            max-width: 460px;
            width: 100%;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-strong);
            border: none;
            overflow: hidden;
            transition: var(--transition);
        }

        .login-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            background: linear-gradient(135deg, var(--kemenhub-blue) 0%, var(--kemenhub-blue-dark) 100%);
            color: white;
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--kemenhub-yellow);
        }

        .login-logo-container {
            position: relative;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .login-logo {
            max-height: 85px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            transition: var(--transition);
        }

        .login-logo:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .login-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 0;
            font-weight: 500;
        }

        .login-body {
            padding: 2.5rem 2rem;
            background-color: white;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--gray-dark);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: var(--kemenhub-blue);
        }

        .form-control {
            border-radius: 10px;
            padding: 0.85rem 1rem;
            border: 1.5px solid #e1e5e9;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--kemenhub-blue);
            box-shadow: 0 0 0 3px rgba(0, 84, 166, 0.15);
        }

        .input-group {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
        }

        .input-group-text {
            background-color: var(--gray-light);
            border: 1.5px solid #e1e5e9;
            color: var(--gray-medium);
            transition: var(--transition);
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--kemenhub-blue);
            color: var(--kemenhub-blue);
        }

        .password-toggle {
            cursor: pointer;
            transition: var(--transition);
        }

        .password-toggle:hover {
            background-color: #e9ecef;
            color: var(--kemenhub-blue);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--kemenhub-blue) 0%, var(--kemenhub-blue-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            font-weight: 600;
            width: 100%;
            transition: var(--transition);
            font-size: 1rem;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 84, 166, 0.3);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .login-footer {
            background-color: var(--gray-light);
            padding: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: var(--gray-medium);
            border-top: 1px solid #e9ecef;
        }

        .footer-link {
            color: var(--kemenhub-blue);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .footer-link:hover {
            color: var(--kemenhub-blue-dark);
            text-decoration: underline;
        }

        .required::after {
            content: " *";
            color: var(--kemenhub-red);
        }

        .form-section {
            margin-bottom: 1.8rem;
        }

        .info-text {
            font-size: 0.85rem;
            color: var(--gray-medium);
            margin-top: 0.5rem;
            padding-left: 1.5rem;
        }

        /* Captcha Styles */
        .captcha-container {
            background-color: var(--gray-light);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.8rem;
            border: 1.5px solid #e1e5e9;
        }

        .captcha-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .captcha-title {
            font-weight: 600;
            color: var(--gray-dark);
            font-size: 0.95rem;
            margin: 0;
        }

        .captcha-refresh {
            background: none;
            border: none;
            color: var(--kemenhub-blue);
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
        }

        .captcha-refresh:hover {
            background-color: rgba(0, 84, 166, 0.1);
            transform: rotate(90deg);
        }

        .captcha-image {
            background: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 3px;
            color: var(--kemenhub-blue-dark);
            user-select: none;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        }

        .captcha-input {
            width: 100%;
        }

        /* Alert styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 1rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                max-width: 100%;
            }

            .login-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .login-body {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.4rem;
            }

            .login-logo-container {
                gap: 15px;
            }

            .login-logo {
                max-height: 70px;
            }

            .captcha-container {
                padding: 1.25rem;
            }
        }

        @media (max-width: 400px) {
            .login-header {
                padding: 1.5rem 1rem 1.5rem;
            }

            .login-body {
                padding: 1.5rem 1rem;
            }

            .login-title {
                font-size: 1.3rem;
            }

            .login-subtitle {
                font-size: 0.85rem;
            }

            .login-logo-container {
                gap: 10px;
            }

            .login-logo {
                max-height: 60px;
            }

            .captcha-container {
                padding: 1rem;
            }
        }

        /* Loading animation for form submission */
        .btn-loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }

            to {
                transform: rotate(1turn);
            }
        }

        .form-check-input:checked {
            background-color: var(--kemenhub-blue);
            border-color: var(--kemenhub-blue);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="login-header">
                <div class="login-logo-container">
                    <img src="{{ asset('img/kemenhub-logo.png') }}" alt="Logo Kemenhub" class="login-logo">
                    <img src="{{ asset('img/kplp-logo.png') }}" alt="Logo KPLP" class="login-logo">
                </div>
                <h3 class="login-title">DASHBOARD HUMAS</h3>
                <p class="login-subtitle">PANGKALAN PENJAGAAN LAUT DAN PANTAI</p>
            </div>
            <div class="login-body">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="form-section">
                        <label for="username" class="form-label required">
                            <i class="fas fa-user"></i>Username
                        </label>
                        <div class="input-group">
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Masukkan username" value="{{ old('username') }}" required autofocus
                                autocomplete="username">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <div class="info-text">Gunakan username yang telah terdaftar</div>
                    </div>

                    <div class="form-section">
                        <label for="password" class="form-label required">
                            <i class="fas fa-lock"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password" required autocomplete="current-password">
                            <span class="input-group-text password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="info-text">Gunakan password yang aman dan kuat</div>
                    </div>

                    <!-- Captcha Section -->
                    <div class="captcha-container">
                        <div class="captcha-header">
                            <h6 class="captcha-title">Verifikasi Keamanan</h6>
                            <button type="button" class="captcha-refresh" id="refreshCaptcha" title="Refresh Captcha">
                                <i class="fas fa-redo-alt"></i>
                            </button>
                        </div>
                        <div class="captcha-image" id="captchaImage" aria-hidden="true"></div>
                        <div class="input-group">
                            <input type="text" id="captcha" name="captcha" class="form-control captcha-input"
                                placeholder="Masukkan kode captcha di atas" required maxlength="6"
                                value="{{ old('captcha') }}" inputmode="numeric" pattern="\d{6}">
                            <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
                        </div>
                        <div class="info-text">Masukkan 6 angka yang terlihat di atas</div>

                        <style>
                            /* Captcha visual styles */
                            .captcha-image {
                                position: relative;
                                background: linear-gradient(45deg, #f8f9fa, #e9ecef);
                                border-radius: 8px;
                                padding: 10px 12px;
                                min-height: 60px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                overflow: hidden;
                                border: 1px solid #dee2e6;
                                user-select: none;
                            }

                            .captcha-char {
                                display: inline-block;
                                font-family: 'Courier New', monospace;
                                font-weight: 700;
                                font-size: 1.6rem;
                                color: #003366;
                                margin: 0 4px;
                                transform-origin: center;
                                transition: transform 0.15s;
                                text-shadow: 0 1px 0 rgba(255,255,255,0.6);
                            }

                            .captcha-line {
                                position: absolute;
                                height: 2px;
                                background: rgba(0,0,0,0.12);
                                opacity: 0.9;
                                pointer-events: none;
                            }

                            .captcha-dot {
                                position: absolute;
                                width: 6px;
                                height: 6px;
                                border-radius: 50%;
                                background: rgba(0,0,0,0.12);
                                pointer-events: none;
                            }
                        </style>
                    </div>

                    <div class="form-section">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-login" id="loginButton">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Dashboard
                        </button>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <p class="mb-2">
                    Lupa password?
                    <a href="{{ route('password.request') }}" class="footer-link">Reset Password</a>
                </p>
                <p class="mt-2 mb-0 text-xs">
                    &copy; {{ date('Y') }} Kementerian Perhubungan Republik Indonesia
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Get CSRF token from meta tag
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginButton = document.getElementById('loginButton');

            // Show loading state
            loginButton.classList.add('btn-loading');
            loginButton.innerHTML = '<i class="fas fa-spinner me-2"></i>Memproses...';
            loginButton.disabled = true;
        });

        // Add focus effects to form inputs
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Auto remove alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const fadeEffect = setInterval(() => {
                        if (!alert.style.opacity) {
                            alert.style.opacity = 1;
                        }
                        if (alert.style.opacity > 0) {
                            alert.style.opacity -= 0.1;
                        } else {
                            clearInterval(fadeEffect);
                            alert.remove();
                        }
                    }, 50);
                }, 5000);
            });
        });

        // Auto focus on username field if there are errors
        @if ($errors->has('username') || $errors->any())
            document.getElementById('username').focus();
        @else
            document.getElementById('username').focus();
        @endif

        // Captcha rendering and refresh functionality
        function renderCaptcha(text) {
            const container = document.getElementById('captchaImage');
            if (!container) return;
            container.innerHTML = '';

            // add chars
            for (let i = 0; i < text.length; i++) {
                const ch = document.createElement('span');
                ch.className = 'captcha-char';
                ch.textContent = text[i];
                const angle = (Math.random() * 26) - 13; // -13..13 deg
                const y = (Math.random() * 8) - 4; // vertical jitter
                const scale = 0.9 + Math.random() * 0.3; // 0.9..1.2
                ch.style.transform = `rotate(${angle}deg) translateY(${y}px) scale(${scale})`;
                ch.style.color = `rgb(${20 + Math.random()*40}, ${30 + Math.random()*60}, ${60 + Math.random()*80})`;
                ch.style.fontSize = `${18 + Math.floor(Math.random()*10)}px`;
                container.appendChild(ch);
            }

            // overlay random lines
            const lineCount = 3 + Math.floor(Math.random() * 3);
            for (let i = 0; i < lineCount; i++) {
                const line = document.createElement('div');
                line.className = 'captcha-line';
                const w = 30 + Math.random() * (container.clientWidth - 20);
                line.style.width = `${w}px`;
                line.style.left = `${Math.random() * (container.clientWidth - w)}px`;
                line.style.top = `${Math.random() * container.clientHeight}px`;
                const rot = (Math.random() * 80) - 40;
                line.style.transform = `rotate(${rot}deg)`;
                line.style.opacity = `${0.08 + Math.random() * 0.2}`;
                container.appendChild(line);
            }

            // overlay random dots
            const dotCount = 6 + Math.floor(Math.random() * 6);
            for (let i = 0; i < dotCount; i++) {
                const dot = document.createElement('div');
                dot.className = 'captcha-dot';
                dot.style.left = `${Math.random() * (container.clientWidth - 6)}px`;
                dot.style.top = `${Math.random() * (container.clientHeight - 6)}px`;
                dot.style.opacity = `${0.06 + Math.random() * 0.25}`;
                container.appendChild(dot);
            }
        }

        document.getElementById('refreshCaptcha').addEventListener('click', function() {
            const captchaImage = document.getElementById('captchaImage');
            const captchaInput = document.getElementById('captcha');

            // Show loading state
            captchaImage.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            // Make AJAX request to refresh captcha
            fetch('{{ route('refresh.captcha') }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': getCsrfToken()
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.captcha_text) {
                        renderCaptcha(data.captcha_text);
                        captchaInput.value = '';
                        captchaInput.focus();
                    }
                })
                .catch(error => {
                    console.error('Error refreshing captcha:', error);
                    captchaImage.textContent = 'ERROR';
                });
        });

        // On page load render server-side captcha if present else refresh
        document.addEventListener('DOMContentLoaded', function() {
            const serverCaptcha = {!! json_encode(session('captcha_text')) !!} || '';
            if (serverCaptcha) {
                renderCaptcha(serverCaptcha);
            } else {
                // fallback: fetch new captcha
                document.getElementById('refreshCaptcha').click();
            }
        });
    </script>
</body>

</html>
