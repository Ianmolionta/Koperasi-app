<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link rel="shortcut icon" href="{{asset ('assets/assets/favicon/icon.png')}}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --red-deep: #8B0000;
            --red-main: #C41E3A;
            --red-bright: #E63946;
            --red-light: #FF6B6B;
            --white: #FFFFFF;
            --off-white: #FAF7F5;
            --gray-light: #E8E0DC;
            --gray-text: #7A7178;
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
            overflow: hidden;
        }

        /* ─── Left Panel (Visual) ─── */
        .left-panel {
            flex: 1;
            position: relative;
            background: var(--red-deep);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Layered geometric bg */
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

        /* Floating circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.12;
            background: var(--white);
            animation: floatCircle 8s ease-in-out infinite;
        }

        .circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -80px;
            left: -60px;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 180px;
            height: 180px;
            bottom: 60px;
            left: 80px;
            animation-delay: 2s;
            opacity: 0.08;
        }

        .circle:nth-child(3) {
            width: 120px;
            height: 120px;
            top: 40%;
            right: 30px;
            animation-delay: 4s;
        }

        .circle:nth-child(4) {
            width: 60px;
            height: 60px;
            top: 15%;
            left: 45%;
            animation-delay: 1s;
            opacity: 0.15;
        }

        .circle:nth-child(5) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            right: -40px;
            animation-delay: 3s;
            opacity: 0.06;
        }

        @keyframes floatCircle {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-18px) scale(1.03);
            }
        }

        /* Diagonal stripe accent */
        .stripe {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            background: repeating-linear-gradient(-35deg,
                    transparent,
                    transparent 60px,
                    rgba(255, 255, 255, 0.02) 60px,
                    rgba(255, 255, 255, 0.02) 62px);
        }

        /* Content */
        .left-content {
            position: relative;
            z-index: 2;
            color: var(--white);
            padding: 60px;
            max-width: 420px;
            animation: fadeUp 1s ease 0.3s both;
        }

        .logo-mark {
            width: 56px;
            height: 56px;
            background: var(--white);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 48px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .logo-mark svg {
            width: 32px;
            height: 32px;
        }

        .left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 18px;
            letter-spacing: -0.5px;
        }

        .left-content h1 em {
            font-style: italic;
            color: var(--red-light);
        }

        .left-content p {
            font-size: 1rem;
            font-weight: 300;
            line-height: 1.7;
            opacity: 0.75;
            max-width: 340px;
        }

        /* Decorative bottom tag */
        .tag {
            position: absolute;
            bottom: 48px;
            left: 60px;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.78rem;
            letter-spacing: 0.5px;
        }

        .tag .dot {
            width: 8px;
            height: 8px;
            background: var(--red-light);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(0.8);
            }
        }

        /* ─── Right Panel (Form) ─── */
        .right-panel {
            flex: 0 0 460px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 50px;
            position: relative;
            background: var(--white);
            box-shadow: -20px 0 60px rgba(139, 0, 0, 0.07);
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
            max-width: 340px;
            animation: fadeUp 0.9s ease 0.5s both;
        }

        .form-header {
            margin-bottom: 38px;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: var(--red-deep);
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 0.88rem;
            color: var(--gray-text);
            font-weight: 300;
        }

        /* Input Group */
        .input-group {
            margin-bottom: 22px;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--gray-text);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
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
            color: var(--gray-light);
            transition: color 0.3s;
            pointer-events: none;
        }

        .input-group:focus-within .icon {
            color: var(--red-main);
        }

        .input-wrap input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.92rem;
            color: #2c2427;
            background: var(--off-white);
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
            outline: none;
        }

        .input-wrap input::placeholder {
            color: #bbb;
        }

        .input-group:focus-within input {
            border-color: var(--red-main);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
        }

        /* Row: Remember + Forgot */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            margin-top: -8px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            color: var(--gray-text);
            cursor: pointer;
            user-select: none;
        }

        .remember input[type="checkbox"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid var(--gray-light);
            border-radius: 5px;
            background: var(--off-white);
            transition: all 0.25s;
            cursor: pointer;
            position: relative;
        }

        .remember input[type="checkbox"]:checked {
            background: var(--red-main);
            border-color: var(--red-main);
        }

        .remember input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .forgot {
            font-size: 0.82rem;
            color: var(--red-main);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot:hover {
            color: var(--red-bright);
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--red-main), var(--red-deep));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.8px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.3s;
            box-shadow: 0 6px 20px rgba(196, 30, 58, 0.35);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(196, 30, 58, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            gap: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-light);
        }

        .divider span {
            font-size: 0.76rem;
            color: var(--gray-text);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* Social */
        .social-row {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            flex: 1;
            padding: 12px 0;
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            background: var(--white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            color: #2c2427;
            font-weight: 500;
            transition: border-color 0.25s, background 0.25s, transform 0.2s;
        }

        .social-btn:hover {
            border-color: var(--red-light);
            background: #fff5f6;
            transform: translateY(-1px);
        }

        .social-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Sign Up Link */
        .signup-link {
            text-align: center;
            margin-top: 32px;
            font-size: 0.84rem;
            color: var(--gray-text);
        }

        .signup-link a {
            color: var(--red-main);
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* ─── Animations ─── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── Responsive ─── */
        @media (max-width: 900px) {
            body {
                flex-direction: column;
                overflow: auto;
            }

            .left-panel {
                flex: none;
                height: 38vh;
                min-height: 280px;
            }

            .left-content {
                padding: 40px;
                max-width: 100%;
            }

            .left-content h1 {
                font-size: 2rem;
            }

            .tag {
                bottom: 24px;
                left: 40px;
            }

            .right-panel {
                flex: none;
                width: 100%;
                padding: 50px 30px;
            }
        }

        @media (max-width: 500px) {
            .left-panel {
                height: 30vh;
                min-height: 220px;
            }

            .left-content {
                padding: 32px 28px;
            }

            .left-content h1 {
                font-size: 1.6rem;
            }

            .left-content p {
                display: none;
            }

            .right-panel {
                padding: 40px 24px;
            }

            .form-wrapper {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- ─── Left: Visual Panel ─── -->
    <div class="left-panel">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="stripe"></div>

        <div class="left-content">
            <div class="logo-mark">
                <svg viewBox="0 0 32 32" fill="none">
                    <path d="M16 4L28 10V22L16 28L4 22V10L16 4Z" fill="#C41E3A" />
                    <path d="M16 10L22 13.5V20.5L16 24L10 20.5V13.5L16 10Z" fill="white" />
                </svg>
            </div>
            <h1>Welcome<br>back to <em>our</em><br>platform.</h1>
            <p>Masuk ke akun Anda untuk mengakses dasbor, laporan, dan semua fitur eksklusif yang tersedia.</p>
        </div>

        <div class="tag">
            <span class="dot"></span>
            Sistem online &middot; Versi 2.4.1
        </div>
    </div>

    <!-- ─── Right: Login Form ─── -->
    <div class="right-panel">
        <div class="form-wrapper">
            <div class="form-header">
                <h2>Masuk</h2>
                <p>Masukkan kredensial Anda untuk melanjutkan</p>
            </div>

            <form onsubmit="event.preventDefault(); handleLogin();">
                @csrf
                <div class="input-group">
                    <label>Username</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M22 7l-10 6L2 7" />
                        </svg>
                        <input type="text" placeholder="Fajrian" required id="usernameInput">
                    </div>
                </div>

                <div class="input-group">
                    <label>Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input type="password" placeholder="••••••••" required id="passwordInput">
                    </div>
                </div>

                <div class="options-row">
                    <label class="remember">
                        <input type="checkbox"> Ingat saya
                    </label>
                    <a href="#" class="forgot">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="btn-login">MASUK</button>
            </form>

            <div class="divider"><span>atau</span></div>

            <div class="social-row">
                <!-- Google -->
                <button class="social-btn" type="button">
                    <svg viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Google
                </button>
                <!-- GitHub -->
                <button class="social-btn" type="button">
                    <svg viewBox="0 0 24 24" fill="#24292e">
                        <path
                            d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C5.422 18.07 4.388 17.67 4.388 17.67c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                    </svg>
                    GitHub
                </button>
            </div>

            <p class="signup-link">Belum punya akun? <a href="#">Daftar di sini</a></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // CSRF Setup untuk jQuery Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Gunakan window agar bisa dipanggil dari onsubmit di HTML
            window.handleLogin = function() {
                const username = $('#usernameInput').val().trim();
                const password = $('#passwordInput').val();
                const $btn = $('.btn-login');

                // 1. Validasi Sederhana (Frontend)
                if (!username || !password) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Opps...',
                        text: 'Email dan Password wajib diisi!',
                        confirmButtonColor: '#C41E3A'
                    });
                    return;
                }

                // 2. Efek Loading
                const originalText = $btn.text();
                $btn.text('Memproses...').prop('disabled', true).css('opacity', '0.7');

                // 3. Eksekusi Ajax
                $.ajax({
                    url: '/login-proses',
                    method: 'POST',
                    data: JSON.stringify({
                        username,
                        password
                    }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function(response) {
                        // Notifikasi Sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Selamat datang kembali.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = '/';
                        });
                    },
                    error: function(xhr) {
                        // Ambil pesan error dari server
                        let errorMsg = 'Email atau password salah.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: errorMsg,
                            confirmButtonColor: '#8B0000'
                        });

                        // Reset Button
                        $btn.text(originalText).prop('disabled', false).css('opacity', '1');
                    }
                });
            };

            // Toggle password visibility (Bonus)
            $('.input-group:last-of-type label').on('dblclick', function() {
                const input = $('#passwordInput');
                input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
            });
        });
    </script>
</body>

</html>
