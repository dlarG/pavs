<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Pet Appointment System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('asset/cutienobg.png') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta name="csrf-token" content="{{csrf_token() }}">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --accent-color: #36b9cc;
            --light-bg: #f8f9fc;
            --dark-text: #5a5c69;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container-main {
            max-width: 1200px;
            width: 95%;
            margin: 2rem auto;
        }
        
        .card-container {
            display: flex;
            flex-wrap: wrap;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 1rem;
            overflow: hidden;
            background: white;
        }
        
        .brand-section {
            flex: 1;
            min-width: 300px;
            background: linear-gradient(to bottom right, var(--primary-color), #2a5bd7);
            color: white;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .login-section {
            flex: 1;
            min-width: 350px;
            padding: 3rem 2.5rem;
            background: white;
        }
        
        .logo-container {
            width: 180px;
            height: 180px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .logo-container img {
            width: 140px;
            height: auto;
        }
        
        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .brand-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 350px;
        }
        
        .btn-services {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 2rem;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .btn-services:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .login-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
        }
        
        .social-login {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .social-login p {
            color: var(--dark-text);
            margin-bottom: 0.8rem;
        }
        
        .google-btn {
            width: 100%;
            max-width: 300px;
            height: 45px;
            border-radius: 4px;
            background: #4285F4;
            color: white;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .google-btn:hover {
            background: #3367d6;
        }
        
        .google-icon {
            background: white;
            height: 38px;
            width: 38px;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--secondary-color);
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e3e6f0;
        }
        
        .divider-text {
            padding: 0 1rem;
            font-size: 0.9rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.5rem;
            transition: border-color 0.15s;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--secondary-color);
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .checkbox-container input {
            margin-right: 0.5rem;
        }
        
        .btn-login {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.9rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            transition: background 0.3s;
            margin-bottom: 1.2rem;
        }
        
        .btn-login:hover {
            background: #2e59d9;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1rem;
            color: var(--secondary-color);
        }
        
        .register-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .alert-box {
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: none;
        }
        
        .alert-primary {
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
            border: 1px solid rgba(78, 115, 223, 0.25);
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.25);
        }
        
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
            }
            
            .brand-section, .login-section {
                min-width: 100%;
            }
            
            .brand-section {
                padding: 2rem 1.5rem;
                border-radius: 1rem 1rem 0 0;
            }
            
            .login-section {
                padding: 2rem 1.5rem;
                border-radius: 0 0 1rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-main">
        <div class="card-container">
            <div class="brand-section">
                <div class="logo-container">
                    <img src="{{asset('imgs/cute.png')}}" alt="Pet Logo" style="border-radius: 50%">
                </div>
                <h1 class="brand-title">Pet Appointment System</h1>
                <p class="brand-subtitle">Schedule appointments for your pets with trusted veterinarians</p>
                <a href="{{route('services')}}" class="btn-services">
                    <i class="fas fa-paw mr-2"></i>View Services
                </a>
            </div>
            
            <div class="login-section">
                <h2 class="login-title">Login to Your Account</h2>
                <div id="beforeLogIn" class="alert-box alert-primary" style="display: none;">Logging In...</div>
                <div id="rateLimitter" class="alert-box alert-danger"></div>
                
				<div class="social-login">
					<p>Sign in with your Google account</p>
					<button class="google-btn" id="googleSignIn">
						Sign in with Google
					</button>
				</div>
                
                <div class="divider">
                    <span class="divider-text">Or continue with</span>
                </div>
                
                <form id="loginForm" method="post" action="{{ route('auth.login.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="accnum">Email Account</label>
                        <input type="text" name="login" id="accnum" class="form-control" placeholder="Enter your account number or email" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-container">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                            <span class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="checkbox-container">
                        <input type="checkbox" id="chk1" onclick="togglePassword()">
                        <label for="chk1">Show Password</label>
                    </div>
                    
                    <button type="submit" class="btn-login">Login</button>
                </form>
                
                <div class="register-link">
                    Don't have an account? <a href="{{route('auth.register')}}">Register here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('#togglePassword i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('loginForm');
            const loadingBox = document.getElementById('beforeLogIn');
            const rateLimiterBox = document.getElementById('rateLimitter');

            // Initially hide the loading and error messages
            if (loadingBox) loadingBox.style.display = 'none';
            if (rateLimiterBox) rateLimiterBox.style.display = 'none';

            // Show "Logging In..." message when form is submitted
            loginForm.addEventListener('submit', function () {
                if (loadingBox) loadingBox.style.display = 'block';
                if (rateLimiterBox) rateLimiterBox.style.display = 'none';
            });

            // Google Sign-in simulation
            const googleBtn = document.getElementById("googleSignIn");
            if (googleBtn) {
                googleBtn.addEventListener("click", function () {
                    Swal.fire({
                        title: 'Google Sign In',
                        text: 'Google sign in functionality would be implemented here',
                        icon: 'info',
                        confirmButtonColor: '#4e73df'
                    });
                });
            }
        });
    </script>
</body>
</html>