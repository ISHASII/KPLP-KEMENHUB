<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/kemenhub-logo.png') }}">
    <title>Reset Password - Dashboard Humas Kemenhub</title>
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

        .reset-container {
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

        .reset-card {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-strong);
            border: none;
            overflow: hidden;
            transition: var(--transition);
        }

        .reset-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .reset-header {
            background: linear-gradient(135deg, var(--kemenhub-blue) 0%, var(--kemenhub-blue-dark) 100%);
            color: white;
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .reset-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--kemenhub-yellow);
        }

        .reset-logo-container {
            position: relative;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .reset-logo {
            max-height: 85px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            transition: var(--transition);
        }

        .reset-logo:hover {
            transform: scale(1.05);
        }

        .reset-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .reset-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 0;
            font-weight: 500;
        }

        .reset-body {
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

        .form-control:disabled {
            background-color: var(--gray-light);
            cursor: not-allowed;
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

        .btn-submit {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
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

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        .reset-footer {
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

        .info-box {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: #155724;
            font-size: 0.9rem;
        }

        .info-box i {
            color: #28a745;
        }

        .email-badge {
            background-color: var(--kemenhub-blue);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .email-badge i {
            margin-right: 8px;
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

        /* Password strength indicator */
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 8px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }

        .strength-weak {
            width: 33%;
            background-color: #dc3545;
        }

        .strength-medium {
            width: 66%;
            background-color: #ffc107;
        }

        .strength-strong {
            width: 100%;
            background-color: #28a745;
        }

        .password-requirements {
            font-size: 0.8rem;
            color: var(--gray-medium);
            margin-top: 0.5rem;
            padding-left: 1.5rem;
        }

        .password-requirements li {
            margin-bottom: 0.25rem;
        }

        .requirement-met {
            color: #28a745;
        }

        .requirement-not-met {
            color: #dc3545;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .reset-container {
                max-width: 100%;
            }

            .reset-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .reset-body {
                padding: 2rem 1.5rem;
            }

            .reset-title {
                font-size: 1.4rem;
            }

            .reset-logo-container {
                gap: 15px;
            }

            .reset-logo {
                max-height: 70px;
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
    </style>
</head>

<body>
    <div class="reset-container">
        <div class="card reset-card">
            <div class="reset-header">
                <div class="reset-logo-container">
                    <img src="{{ asset('img/kemenhub-logo.png') }}" alt="Logo Kemenhub" class="reset-logo">
                    <img src="{{ asset('img/kplp-logo.png') }}" alt="Logo KPLP" class="reset-logo">
                </div>
                <h3 class="reset-title">RESET PASSWORD</h3>
                <p class="reset-subtitle">Buat Password Baru Anda</p>
            </div>
            <div class="reset-body">
                <!-- Info Box -->
                <div class="info-box">
                    <p><i class="fas fa-check-circle me-2"></i>Email terverifikasi! Silakan buat password baru untuk
                        akun Anda.</p>
                </div>

                <!-- Email Badge -->
                <div class="text-center mb-3">
                    <span class="email-badge">
                        <i class="fas fa-envelope"></i>{{ $email }}
                    </span>
                </div>

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

                <form method="POST" action="{{ route('password.update') }}" id="resetForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-section">
                        <label for="password" class="form-label required">
                            <i class="fas fa-lock"></i>Password Baru
                        </label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password baru" required autocomplete="new-password" minlength="8">
                            <span class="input-group-text password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                        <ul class="password-requirements" id="passwordRequirements">
                            <li id="req-length" class="requirement-not-met"><i class="fas fa-times me-1"></i>Minimal 8
                                karakter</li>
                            <li id="req-upper" class="requirement-not-met"><i class="fas fa-times me-1"></i>Minimal 1
                                huruf besar</li>
                            <li id="req-lower" class="requirement-not-met"><i class="fas fa-times me-1"></i>Minimal 1
                                huruf kecil</li>
                            <li id="req-number" class="requirement-not-met"><i class="fas fa-times me-1"></i>Minimal 1
                                angka</li>
                        </ul>
                    </div>

                    <div class="form-section">
                        <label for="password_confirmation" class="form-label required">
                            <i class="fas fa-lock"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Masukkan ulang password baru" required
                                autocomplete="new-password">
                            <span class="input-group-text password-toggle" id="togglePasswordConfirm">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="info-text" id="matchText">Pastikan kedua password sama</div>
                    </div>



                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-submit" id="submitButton">
                            <i class="fas fa-save me-2"></i>Simpan Password Baru
                        </button>
                    </div>
                </form>
            </div>
            <div class="reset-footer">
                <p class="mb-2">
                    Ingat password Anda?
                    <a href="{{ route('login') }}" class="footer-link">Kembali ke Login</a>
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
        document.getElementById('togglePassword').addEventListener('click', function () {
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

        document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
            const passwordInput = document.getElementById('password_confirmation');
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

        // Password strength checker
        document.getElementById('password').addEventListener('input', function () {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');

            // Check requirements
            const hasLength = password.length >= 8;
            const hasUpper = /[A-Z]/.test(password);
            const hasLower = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);

            // Update requirement indicators
            updateRequirement('req-length', hasLength);
            updateRequirement('req-upper', hasUpper);
            updateRequirement('req-lower', hasLower);
            updateRequirement('req-number', hasNumber);

            // Calculate strength
            const score = [hasLength, hasUpper, hasLower, hasNumber].filter(Boolean).length;

            strengthBar.className = 'password-strength-bar';
            if (score === 0) {
                strengthBar.style.width = '0';
            } else if (score <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (score === 3) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });

        function updateRequirement(id, met) {
            const el = document.getElementById(id);
            if (met) {
                el.classList.remove('requirement-not-met');
                el.classList.add('requirement-met');
                el.querySelector('i').classList.remove('fa-times');
                el.querySelector('i').classList.add('fa-check');
            } else {
                el.classList.remove('requirement-met');
                el.classList.add('requirement-not-met');
                el.querySelector('i').classList.remove('fa-check');
                el.querySelector('i').classList.add('fa-times');
            }
        }

        // Password match checker
        document.getElementById('password_confirmation').addEventListener('input', function () {
            const password = document.getElementById('password').value;
            const confirm = this.value;
            const matchText = document.getElementById('matchText');

            if (confirm.length === 0) {
                matchText.innerHTML = 'Pastikan kedua password sama';
                matchText.style.color = '';
            } else if (password === confirm) {
                matchText.innerHTML = '<i class="fas fa-check me-1"></i>Password cocok';
                matchText.style.color = '#28a745';
            } else {
                matchText.innerHTML = '<i class="fas fa-times me-1"></i>Password tidak cocok';
                matchText.style.color = '#dc3545';
            }
        });

        // Form submission with loading state
        document.getElementById('resetForm').addEventListener('submit', function (e) {
            const submitButton = document.getElementById('submitButton');

            // Show loading state
            submitButton.classList.add('btn-loading');
            submitButton.innerHTML = '<i class="fas fa-spinner me-2"></i>Memproses...';
            submitButton.disabled = true;
        });

        // Auto remove alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
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


    </script>
</body>

</html>
