<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('img/kemenhub-logo.png') }}">
    <title>Lupa Password - Dashboard Humas Kemenhub</title>
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

        .forgot-container {
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

        .forgot-card {
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-strong);
            border: none;
            overflow: hidden;
            transition: var(--transition);
        }

        .forgot-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .forgot-header {
            background: linear-gradient(135deg, var(--kemenhub-blue) 0%, var(--kemenhub-blue-dark) 100%);
            color: white;
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .forgot-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--kemenhub-yellow);
        }

        .forgot-logo-container {
            position: relative;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .forgot-logo {
            max-height: 85px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            transition: var(--transition);
        }

        .forgot-logo:hover {
            transform: scale(1.05);
        }

        .forgot-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .forgot-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 0;
            font-weight: 500;
        }

        .forgot-body {
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

        .btn-submit {
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
            box-shadow: 0 10px 20px rgba(0, 84, 166, 0.3);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        .forgot-footer {
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
            background-color: #e3f2fd;
            border-left: 4px solid var(--kemenhub-blue);
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: var(--kemenhub-blue-dark);
            font-size: 0.9rem;
        }

        .info-box i {
            color: var(--kemenhub-blue);
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
            margin-bottom: 1rem;
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
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        .captcha-line {
            position: absolute;
            height: 2px;
            background: rgba(0, 0, 0, 0.12);
            opacity: 0.9;
            pointer-events: none;
        }

        .captcha-dot {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.12);
            pointer-events: none;
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
            .forgot-container {
                max-width: 100%;
            }

            .forgot-header {
                padding: 2rem 1.5rem 1.5rem;
            }

            .forgot-body {
                padding: 2rem 1.5rem;
            }

            .forgot-title {
                font-size: 1.4rem;
            }

            .forgot-logo-container {
                gap: 15px;
            }

            .forgot-logo {
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
    <div class="forgot-container">
        <div class="card forgot-card">
            <div class="forgot-header">
                <div class="forgot-logo-container">
                    <img src="{{ asset('img/kemenhub-logo.png') }}" alt="Logo Kemenhub" class="forgot-logo">
                    <img src="{{ asset('img/kplp-logo.png') }}" alt="Logo KPLP" class="forgot-logo">
                </div>
                <h3 class="forgot-title">LUPA PASSWORD</h3>
                <p class="forgot-subtitle">Reset Password Akun Anda</p>
            </div>
            <div class="forgot-body">
                <!-- Info Box -->
                <div class="info-box">
                    <p><i class="fas fa-info-circle me-2"></i>Masukkan alamat email yang terdaftar pada akun Anda. Jika
                        email ditemukan, Anda akan diarahkan ke halaman pembuatan password baru.</p>
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

                <form method="POST" action="{{ route('password.email') }}" id="forgotForm">
                    @csrf

                    <div class="form-section">
                        <label for="email" class="form-label required">
                            <i class="fas fa-envelope"></i>Email
                        </label>
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Masukkan email terdaftar" value="{{ old('email') }}" required autofocus
                                autocomplete="email">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>
                        <div class="info-text">Masukkan email yang terdaftar pada sistem</div>
                    </div>



                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-submit" id="submitButton">
                            <i class="fas fa-paper-plane me-2"></i>Verifikasi Email
                        </button>
                    </div>
                </form>
            </div>
            <div class="forgot-footer">
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

        // Form submission with loading state
        document.getElementById('forgotForm').addEventListener('submit', function (e) {
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
