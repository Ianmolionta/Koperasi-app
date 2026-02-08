<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sistem Informasi Koperasi Desa</title>
    <link rel="shortcut icon" href="{{ asset('assets/assets/img/favicon/icon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* ══════════════════════════════════════════════════════════════════════════════
           CSS VARIABLES & RESET
        ══════════════════════════════════════════════════════════════════════════════ */
        :root {
            --red-deep: #8B0000;
            --red-main: #C41E3A;
            --red-bright: #E63946;
            --red-light: #FF6B6B;
            --white: #FFFFFF;
            --off-white: #FAF7F5;
            --gray-light: #E8E0DC;
            --gray-medium: #C4B5AE;
            --gray-text: #7A7178;
            --gray-dark: #2C2427;
            --error-red: #DC2626;
            --success-green: #10B981;
            --warning-yellow: #F59E0B;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 6px 20px rgba(196, 30, 58, 0.25);
            --shadow-lg: 0 12px 40px rgba(139, 0, 0, 0.15);
            --transition-base: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-fast: 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--off-white);
            color: var(--gray-dark);
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           LEFT PANEL - VISUAL DESIGN
        ══════════════════════════════════════════════════════════════════════════════ */
        .left-panel {
            flex: 1;
            position: relative;
            background: var(--red-deep);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Gradient overlay background */
        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 80%, rgba(198, 31, 58, 0.6) 0%, transparent 70%),
                radial-gradient(ellipse 60% 50% at 80% 20%, rgba(139, 0, 0, 0.8) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 50% 50%, rgba(198, 31, 58, 0.3) 0%, transparent 70%);
            z-index: 1;
        }

        /* Floating circles animation */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.12;
            background: var(--white);
            animation: floatCircle 8s ease-in-out infinite;
            will-change: transform;
        }

        .circle:nth-child(1) { width: 300px; height: 300px; top: -80px; left: -60px; animation-delay: 0s; }
        .circle:nth-child(2) { width: 180px; height: 180px; bottom: 60px; left: 80px; animation-delay: 2s; opacity: 0.08; }
        .circle:nth-child(3) { width: 120px; height: 120px; top: 40%; right: 30px; animation-delay: 4s; }
        .circle:nth-child(4) { width: 60px; height: 60px; top: 15%; left: 45%; animation-delay: 1s; opacity: 0.15; }
        .circle:nth-child(5) { width: 200px; height: 200px; bottom: -50px; right: -40px; animation-delay: 3s; opacity: 0.06; }

        @keyframes floatCircle {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-18px) scale(1.03); }
        }

        /* Diagonal stripe pattern */
        .stripe {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: repeating-linear-gradient(
                -35deg,
                transparent,
                transparent 60px,
                rgba(255, 255, 255, 0.02) 60px,
                rgba(255, 255, 255, 0.02) 62px
            );
            pointer-events: none;
        }

        /* Left content */
        .left-content {
            position: relative;
            z-index: 2;
            color: var(--white);
            padding: 60px;
            max-width: 480px;
            animation: fadeUp 1s ease 0.3s both;
        }

        .left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .left-content p {
            font-size: 1.05rem;
            font-weight: 300;
            line-height: 1.75;
            opacity: 0.85;
            max-width: 400px;
        }

        /* Version tag */
        .tag {
            position: absolute;
            bottom: 48px;
            left: 60px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            font-weight: 400;
        }

        .tag .dot {
            width: 8px;
            height: 8px;
            background: var(--red-light);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.8); }
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           RIGHT PANEL - LOGIN FORM
        ══════════════════════════════════════════════════════════════════════════════ */
        .right-panel {
            flex: 0 0 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 50px;
            position: relative;
            background: var(--white);
            box-shadow: -20px 0 60px rgba(139, 0, 0, 0.08);
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 4px;
            background: linear-gradient(180deg, transparent, var(--red-main), transparent);
        }

        .form-wrapper {
            width: 100%;
            max-width: 380px;
            animation: fadeUp 0.9s ease 0.5s both;
        }

        /* Form header */
        .form-header {
            margin-bottom: 40px;
            text-align: left;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--red-deep);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .form-header p {
            font-size: 0.9rem;
            color: var(--gray-text);
            font-weight: 400;
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           INPUT GROUPS WITH PROFESSIONAL VALIDATION
        ══════════════════════════════════════════════════════════════════════════════ */
        .input-group {
            margin-bottom: 24px;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-dark);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 10px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--gray-medium);
            transition: color var(--transition-base);
            pointer-events: none;
            z-index: 2;
        }

        .input-wrap input {
            width: 100%;
            padding: 15px 16px 15px 46px;
            border: 2px solid var(--gray-light);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--gray-dark);
            background: var(--off-white);
            transition: all var(--transition-base);
            outline: none;
        }

        .input-wrap input::placeholder {
            color: var(--gray-medium);
            opacity: 0.7;
        }

        /* Input focus state */
        .input-group:focus-within .icon {
            color: var(--red-main);
        }

        .input-group:focus-within input {
            border-color: var(--red-main);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           VALIDATION STATES - PROFESSIONAL ERROR HANDLING
        ══════════════════════════════════════════════════════════════════════════════ */
        
        /* Error state */
        .input-group.error .icon {
            color: var(--error-red);
        }

        .input-group.error input {
            border-color: var(--error-red);
            background: #FEF2F2;
        }

        .input-group.error:focus-within input {
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        }

        /* Success state */
        .input-group.success .icon {
            color: var(--success-green);
        }

        .input-group.success input {
            border-color: var(--success-green);
            background: #F0FDF4;
        }

        .input-group.success:focus-within input {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        /* Validation message */
        .validation-message {
            display: none;
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 500;
            align-items: center;
            gap: 8px;
            animation: slideDown 0.3s ease;
        }

        .validation-message.show {
            display: flex;
        }

        .validation-message.error {
            background: #FEF2F2;
            color: var(--error-red);
            border-left: 3px solid var(--error-red);
        }

        .validation-message.success {
            background: #F0FDF4;
            color: var(--success-green);
            border-left: 3px solid var(--success-green);
        }

        .validation-message.warning {
            background: #FFFBEB;
            color: var(--warning-yellow);
            border-left: 3px solid var(--warning-yellow);
        }

        .validation-message svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           BUTTON & INTERACTIVE ELEMENTS
        ══════════════════════════════════════════════════════════════════════════════ */
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--red-main), var(--red-deep));
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all var(--transition-base);
            box-shadow: var(--shadow-md);
            text-transform: uppercase;
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

        .btn-login:hover:not(:disabled)::before {
            left: 100%;
        }

        .btn-login:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(196, 30, 58, 0.4);
        }

        .btn-login:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-login.loading {
            pointer-events: none;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--white);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           LOGO DISPLAY SECTION
        ══════════════════════════════════════════════════════════════════════════════ */
        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0 28px 0;
            gap: 14px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gray-light), transparent);
        }

        .divider span {
            font-size: 0.75rem;
            color: var(--gray-text);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 500;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            margin-top: 20px;
        }

        .logo-mark {
            width: 72px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--off-white);
            border: 2px solid var(--gray-light);
            transition: all var(--transition-base);
            overflow: hidden;
        }

        .logo-mark:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-sm);
            border-color: var(--red-light);
        }

        .logo-mark img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           ANIMATIONS
        ══════════════════════════════════════════════════════════════════════════════ */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ══════════════════════════════════════════════════════════════════════════════
           RESPONSIVE DESIGN
        ══════════════════════════════════════════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .right-panel {
                flex: 0 0 440px;
            }
        }

        @media (max-width: 900px) {
            body {
                flex-direction: column;
                overflow: auto;
            }

            .left-panel {
                flex: none;
                height: 40vh;
                min-height: 300px;
            }

            .left-content {
                padding: 40px;
                max-width: 100%;
            }

            .left-content h1 {
                font-size: 2.2rem;
            }

            .tag {
                bottom: 24px;
                left: 40px;
            }

            .right-panel {
                flex: none;
                width: 100%;
                padding: 50px 32px;
            }
        }

        @media (max-width: 600px) {
            .left-panel {
                height: 32vh;
                min-height: 240px;
            }

            .left-content {
                padding: 32px 24px;
            }

            .left-content h1 {
                font-size: 1.8rem;
            }

            .left-content p {
                font-size: 0.92rem;
            }

            .right-panel {
                padding: 40px 24px;
            }

            .form-wrapper {
                max-width: 100%;
            }

            .form-header h2 {
                font-size: 1.7rem;
            }

            .logo-container {
                gap: 12px;
            }

            .logo-mark {
                width: 64px;
                height: 64px;
            }

            .logo-mark img {
                width: 44px;
                height: 44px;
            }
        }

        @media (max-width: 400px) {
            .left-content p {
                display: none;
            }

            .tag {
                font-size: 0.7rem;
            }
        }
    </style>
</head>

<body>
    <!-- ══════════════════════════════════════════════════════════════════════════════
         LEFT PANEL - VISUAL DESIGN
    ══════════════════════════════════════════════════════════════════════════════ -->
    <div class="left-panel">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="stripe"></div>

        <div class="left-content">
            <h1>Selamat Datang Di<br>Sistem Informasi<br>Koperasi Desa</h1>
            <p>Masuk ke akun Anda untuk mengakses dasbor, dan laporan untuk pengelolaan koperasi.</p>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════════════════════════════
         RIGHT PANEL - LOGIN FORM
    ══════════════════════════════════════════════════════════════════════════════ -->
    <div class="right-panel">
        <div class="form-wrapper">
            <div class="form-header">
                <h2>Masuk</h2>
                <p>Masukkan kredensial Anda untuk melanjutkan</p>
            </div>

            <form id="loginForm">
                @csrf
                
                <!-- Username Input -->
                <div class="input-group" id="usernameGroup">
                    <label for="usernameInput">Username</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input 
                            type="text" 
                            id="usernameInput" 
                            name="username"
                            placeholder="Masukkan username Anda" 
                            autocomplete="username"
                            maxlength="50"
                        >
                    </div>
                    <div class="validation-message" id="usernameError">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span></span>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="input-group" id="passwordGroup">
                    <label for="passwordInput">Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input 
                            type="password" 
                            id="passwordInput" 
                            name="password"
                            placeholder="Masukkan kata sandi Anda" 
                            autocomplete="current-password"
                            maxlength="100"
                        >
                    </div>
                    <div class="validation-message" id="passwordError">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span></span>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <span id="btnText">Masuk</span>
                </button>
            </form>

            <div class="divider">
                <span>Partner Sistem</span>
            </div>

            <!-- Logo Section -->
            <div class="logo-container">
                <div class="logo-mark">
                    <img src="{{ asset('assets/assets/img/favicon/icon.png') }}" alt="Logo Koperasi">
                </div>
                <div class="logo-mark">
                    <img src="{{ asset('assets/assets/img/favicon/joCodes.jpeg') }}" alt="Logo JoCodes">
                </div>
                <div class="logo-mark">
                    <img src="{{ asset('assets/assets/img/favicon/STMIK.jpg') }}" alt="Logo STMIK">
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════════════════════════════
         SCRIPTS
    ══════════════════════════════════════════════════════════════════════════════ -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // ═══════════════════════════════════════════════════════════════════════
            // CSRF TOKEN SETUP
            // ═══════════════════════════════════════════════════════════════════════
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ═══════════════════════════════════════════════════════════════════════
            // VALIDATION HELPER FUNCTIONS
            // ═══════════════════════════════════════════════════════════════════════
            const ValidationHelper = {
                // Show error message
                showError: function(groupId, message) {
                    const $group = $(`#${groupId}`);
                    const $errorMsg = $group.find('.validation-message');
                    
                    $group.removeClass('success').addClass('error');
                    $errorMsg.removeClass('success warning').addClass('error show');
                    $errorMsg.find('span').text(message);
                },

                // Show success message
                showSuccess: function(groupId) {
                    const $group = $(`#${groupId}`);
                    const $errorMsg = $group.find('.validation-message');
                    
                    $group.removeClass('error').addClass('success');
                    $errorMsg.removeClass('show'); // Hide message for success
                },

                // Clear validation state
                clearValidation: function(groupId) {
                    const $group = $(`#${groupId}`);
                    const $errorMsg = $group.find('.validation-message');
                    
                    $group.removeClass('error success');
                    $errorMsg.removeClass('error success warning show');
                },

                // Clear all validations
                clearAll: function() {
                    this.clearValidation('usernameGroup');
                    this.clearValidation('passwordGroup');
                },

                // Validate username
                validateUsername: function(username) {
                    if (!username || username.trim() === '') {
                        return { valid: false, message: 'Username tidak boleh kosong' };
                    }
                    
                    if (username.length < 3) {
                        return { valid: false, message: 'Username minimal 3 karakter' };
                    }
                    
                    if (username.length > 50) {
                        return { valid: false, message: 'Username maksimal 50 karakter' };
                    }
                    
                    // Only allow alphanumeric, underscore, dash, and dot
                    const usernamePattern = /^[a-zA-Z0-9._-]+$/;
                    if (!usernamePattern.test(username)) {
                        return { valid: false, message: 'Username hanya boleh mengandung huruf, angka, titik, garis bawah, dan strip' };
                    }
                    
                    return { valid: true, message: '' };
                },

                // Validate password
                validatePassword: function(password) {
                    if (!password || password.trim() === '') {
                        return { valid: false, message: 'Kata sandi tidak boleh kosong' };
                    }
                    
                    if (password.length < 6) {
                        return { valid: false, message: 'Kata sandi minimal 6 karakter' };
                    }
                    
                    if (password.length > 100) {
                        return { valid: false, message: 'Kata sandi terlalu panjang' };
                    }
                    
                    return { valid: true, message: '' };
                }
            };

            // ═══════════════════════════════════════════════════════════════════════
            // REAL-TIME VALIDATION ON INPUT
            // ═══════════════════════════════════════════════════════════════════════
            let usernameTimer, passwordTimer;

            $('#usernameInput').on('input', function() {
                clearTimeout(usernameTimer);
                const username = $(this).val().trim();
                
                // Clear validation if empty
                if (username === '') {
                    ValidationHelper.clearValidation('usernameGroup');
                    return;
                }
                
                // Debounce validation
                usernameTimer = setTimeout(function() {
                    const validation = ValidationHelper.validateUsername(username);
                    if (!validation.valid) {
                        ValidationHelper.showError('usernameGroup', validation.message);
                    } else {
                        ValidationHelper.showSuccess('usernameGroup');
                    }
                }, 500);
            });

            $('#passwordInput').on('input', function() {
                clearTimeout(passwordTimer);
                const password = $(this).val();
                
                // Clear validation if empty
                if (password === '') {
                    ValidationHelper.clearValidation('passwordGroup');
                    return;
                }
                
                // Debounce validation
                passwordTimer = setTimeout(function() {
                    const validation = ValidationHelper.validatePassword(password);
                    if (!validation.valid) {
                        ValidationHelper.showError('passwordGroup', validation.message);
                    } else {
                        ValidationHelper.showSuccess('passwordGroup');
                    }
                }, 500);
            });

            // ═══════════════════════════════════════════════════════════════════════
            // FORM SUBMISSION HANDLER
            // ═══════════════════════════════════════════════════════════════════════
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                // Get values
                const username = $('#usernameInput').val().trim();
                const password = $('#passwordInput').val();
                const $btn = $('#loginBtn');
                const $btnText = $('#btnText');

                // Clear previous validations
                ValidationHelper.clearAll();

                // Validate username
                const usernameValidation = ValidationHelper.validateUsername(username);
                if (!usernameValidation.valid) {
                    ValidationHelper.showError('usernameGroup', usernameValidation.message);
                    $('#usernameInput').focus();
                    return;
                }

                // Validate password
                const passwordValidation = ValidationHelper.validatePassword(password);
                if (!passwordValidation.valid) {
                    ValidationHelper.showError('passwordGroup', passwordValidation.message);
                    $('#passwordInput').focus();
                    return;
                }

                // Show loading state
                $btn.prop('disabled', true).addClass('loading');
                $btnText.text('Memproses...');

                // Execute AJAX request
                $.ajax({
                    url: '/login-proses',
                    method: 'POST',
                    data: JSON.stringify({
                        username: username,
                        password: password
                    }),
                    contentType: 'application/json',
                    dataType: 'json',
                    timeout: 30000, // 30 seconds timeout
                    
                    success: function(response) {
                        // Show success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil!',
                            text: 'Selamat datang kembali. Anda akan diarahkan ke dashboard...',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal-custom'
                            }
                        }).then(() => {
                            // Redirect to dashboard
                            window.location.href = response.redirect || '/';
                        });
                    },
                    
                    error: function(xhr, status, error) {
                        // Reset button state
                        $btn.prop('disabled', false).removeClass('loading');
                        $btnText.text('Masuk');

                        let errorTitle = 'Login Gagal';
                        let errorMsg = 'Terjadi kesalahan saat login. Silakan coba lagi.';

                        // Handle different error scenarios
                        if (status === 'timeout') {
                            errorMsg = 'Koneksi timeout. Periksa koneksi internet Anda dan coba lagi.';
                        } else if (xhr.status === 401 || xhr.status === 422) {
                            errorTitle = 'Kredensial Tidak Valid';
                            errorMsg = 'Username atau kata sandi yang Anda masukkan salah. Silakan periksa kembali.';
                            
                            // Show validation errors
                            ValidationHelper.showError('usernameGroup', 'Username atau kata sandi salah');
                            ValidationHelper.showError('passwordGroup', 'Username atau kata sandi salah');
                        } else if (xhr.status === 429) {
                            errorMsg = 'Terlalu banyak percobaan login. Silakan tunggu beberapa saat.';
                        } else if (xhr.status === 500) {
                            errorMsg = 'Terjadi kesalahan pada server. Silakan hubungi administrator.';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        // Show error notification
                        Swal.fire({
                            icon: 'error',
                            title: errorTitle,
                            text: errorMsg,
                            confirmButtonColor: '#C41E3A',
                            confirmButtonText: 'Coba Lagi',
                            customClass: {
                                popup: 'swal-custom'
                            }
                        });
                    }
                });
            });

            // ═══════════════════════════════════════════════════════════════════════
            // ADDITIONAL FEATURES
            // ═══════════════════════════════════════════════════════════════════════
            
            // Press Enter to submit
            $('#usernameInput, #passwordInput').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#loginForm').submit();
                }
            });

            // Clear validation on focus
            $('#usernameInput').on('focus', function() {
                if ($(this).val().trim() !== '') return;
                ValidationHelper.clearValidation('usernameGroup');
            });

            $('#passwordInput').on('focus', function() {
                if ($(this).val() !== '') return;
                ValidationHelper.clearValidation('passwordGroup');
            });

            // Prevent XSS in input fields
            $('#usernameInput, #passwordInput').on('paste', function(e) {
                setTimeout(() => {
                    const val = $(this).val();
                    // Remove any HTML tags
                    const cleaned = val.replace(/<[^>]*>/g, '');
                    if (val !== cleaned) {
                        $(this).val(cleaned);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Karakter HTML tidak diperbolehkan',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }, 10);
            });
        });
    </script>

    <!-- Custom SweetAlert2 Styles -->
    <style>
        .swal-custom {
            font-family: 'DM Sans', sans-serif !important;
        }
        
        .swal2-timer-progress-bar {
            background: var(--red-main) !important;
        }
    </style>
</body>

</html>