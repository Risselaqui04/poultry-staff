<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NB Poultry Farm Management System</title>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {

            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: linear-gradient(135deg, #2E7D32, #66BB6A);

            padding: 30px;

        }

        .login-wrapper {

            width: 1100px;
            max-width: 100%;

            background: #fff;

            border-radius: 25px;

            overflow: hidden;

            display: grid;

            grid-template-columns: 1fr 1fr;

            box-shadow: 0 20px 60px rgba(0, 0, 0, .18);

        }

        .left-panel {

            background: linear-gradient(160deg, #2E7D32, #43A047, #66BB6A);

            color: #fff;

            padding: 70px 50px;

            display: flex;

            flex-direction: column;

            justify-content: center;

        }

        .left-panel h1 {

            font-size: 42px;

            margin-bottom: 10px;

        }

        .left-panel h2 {

            font-size: 28px;

            margin-bottom: 20px;

            font-weight: 600;

        }

        .left-panel p {

            line-height: 28px;

            color: #F1F8E9;

            margin-bottom: 40px;

        }

        .feature {

            display: flex;

            align-items: center;

            gap: 15px;

            margin-bottom: 18px;

            font-size: 16px;

        }

        .feature-icon {

            width: 45px;

            height: 45px;

            border-radius: 50%;

            background: rgba(255, 255, 255, .2);

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 20px;

        }

        .right-panel {

            padding: 60px;

            background: #fff;

        }

        .logo {

            text-align: center;

            margin-bottom: 10px;

        }

        .logo span {

            font-size: 60px;

        }

        .title {

            text-align: center;

            color: #2E7D32;

            font-size: 30px;

            font-weight: 700;

        }

        .subtitle {

            text-align: center;

            color: #777;

            margin-top: 8px;

            margin-bottom: 35px;

        }

        label {

            display: block;

            margin-bottom: 8px;

            font-weight: 600;

            color: #333;

        }

        input[type=text],
        input[type=password] {

            width: 100%;

            padding: 14px 16px;

            border: 1px solid #ddd;

            border-radius: 10px;

            margin-bottom: 20px;

            transition: .3s;

            font-size: 15px;

        }

        input:focus {

            border-color: #2E7D32;

            outline: none;

            box-shadow: 0 0 10px rgba(46, 125, 50, .15);

        }

        .password-container {

            position: relative;

        }

        .password-container input {

            padding-right: 50px;

        }

        .toggle-password {

            position: absolute;

            right: 15px;

            top: 14px;

            cursor: pointer;

            font-size: 20px;

        }

        .error-box {

            background: #FFEBEE;

            color: #C62828;

            padding: 12px;

            border-radius: 8px;

            text-align: center;

            margin-bottom: 20px;

        }

        .terms {

            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 18px 0;
            font-size: 14px;
            color: #555;

        }

        .terms input {

            margin-top: 4px;

        }

        .terms a {

            color: #2E7D32;
            text-decoration: none;
            font-weight: 600;

        }

        .terms a:hover {

            text-decoration: underline;

        }

        .remember-row {

            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;

        }

        .remember {

            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;

        }

        .remember input {

            width: 16px;
            height: 16px;

        }

        .forgot-password {

            color: #2E7D32;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;

        }

        .forgot-password:hover {

            text-decoration: underline;

        }

        .g-recaptcha {

            margin: 20px 0;

        }

        .login-btn {

            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 12px;

            background: linear-gradient(135deg, #2E7D32, #43A047);

            color: #fff;

            font-size: 16px;

            font-weight: 600;

            cursor: pointer;

            transition: .3s;

        }

        .login-btn:hover {

            transform: translateY(-2px);

            box-shadow: 0 12px 25px rgba(46, 125, 50, .30);

        }

        .footer {

            margin-top: 30px;

            text-align: center;

            color: #999;

            font-size: 13px;

        }

        @media(max-width:992px) {

            .login-wrapper {

                grid-template-columns: 1fr;

            }

            .left-panel {

                display: none;

            }

            .right-panel {

                padding: 40px 30px;

            }

        }
    </style>

</head>

<body>
    <div class="login-wrapper">

        <div class="left-panel">

            <h1>🐔</h1>

            <h2>NB Poultry Farm</h2>

            <p>

                Manage egg production, inventory, QR code tracking,
                dispatch monitoring, and forecasting in one centralized
                management system.

            </p>

            <div class="feature">

                <div class="feature-icon">🥚</div>

                <div>

                    <strong>Production Monitoring</strong><br>

                    Track daily egg production accurately.

                </div>

            </div>

            <div class="feature">

                <div class="feature-icon">📦</div>

                <div>

                    <strong>Inventory Management</strong><br>

                    Monitor feeds, supplements and egg trays.

                </div>

            </div>

            <div class="feature">

                <div class="feature-icon">📱</div>

                <div>

                    <strong>QR Egg Tracking</strong><br>

                    Fast scanning with reusable QR codes.

                </div>

            </div>

            <div class="feature">

                <div class="feature-icon">📈</div>

                <div>

                    <strong>Forecasting</strong><br>

                    Predict future production trends.

                </div>

            </div>

        </div>

        <div class="right-panel">

            <div class="logo">

                <span>🐔</span>

            </div>

            <div class="title">

                Welcome Back

            </div>

            <div class="subtitle">

                Sign in to continue

            </div>

            @if($errors->any())

                <div class="error-box">

                    {{ $errors->first() }}

                </div>

            @endif
            <form method="POST" action="{{ route('login.submit') }}">

                @csrf

                <label>

                    Username

                </label>

                <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter your username"
                    required>

                <label>

                    Password

                </label>

                <div class="password-container">

                    <input type="password" id="password" name="password" placeholder="Enter your password" required>

                    <span class="toggle-password" onclick="togglePassword()">

                        👁️

                    </span>

                </div>
                <div class="terms">

                    <input type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>

                    <span>

                        I have read and agree to the

                        <a href="{{ route('terms') }}" target="_blank">

                            Terms and Conditions

                        </a>

                    </span>

                </div>

                <div class="remember-row">

                    <label class="remember">

                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>

                        <span>

                            Keep me logged in

                        </span>

                    </label>

                    <a href="{{ route('forgot.password') }}" class="forgot-password">

                        Forgot Password?

                    </a>

                </div>
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}">

                </div>

                @error('g-recaptcha-response')

                                    <div style="
                    margin-top:10px;
                    color:#d32f2f;
                    font-size:14px;
                    font-weight:500;
                    ">

                                        {{ $message }}

                                    </div>

                @enderror

                <button type="submit" class="login-btn">

                    Login

                </button>

            </form>

            <div class="footer">

                © {{ date('Y') }} NB Poultry Farm Management System

            </div>

        </div>

    </div>

    <script>

        function togglePassword() {

            let password = document.getElementById('password');

            if (password.type === 'password') {

                password.type = 'text';

            } else {

                password.type = 'password';

            }

        }

    </script>

</body>

</html>