<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pet Appointment System</title>
    <link rel="shortcut icon" href="https://i.ibb.co/5kFjS0v/pet-logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --accent-color: #36b9cc;
            --light-bg: #f8f9fc;
            --dark-text: #5a5c69;
            --success-color: #1cc88a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
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
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
            position: relative;
            overflow: hidden;
        }
        
        .brand-section::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .brand-section::after {
            content: "";
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
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
            z-index: 2;
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
            z-index: 2;
        }
        
        .brand-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 350px;
            z-index: 2;
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
            z-index: 2;
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
            position: relative;
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
            transition: all 0.3s;
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
            transition: all 0.3s;
            margin-bottom: 1.2rem;
            cursor: pointer;
        }
        
        .btn-login:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(78, 115, 223, 0.3);
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
        
        .alert-success {
            background: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(28, 200, 138, 0.25);
        }
        
        .progress-container {
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s;
        }
        
        .password-strength {
            font-size: 0.8rem;
            margin-top: 5px;
            text-align: right;
            color: var(--secondary-color);
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }
        
        .form-col {
            padding-right: 5px;
            padding-left: 5px;
            flex: 1;
            min-width: 150px;
        }
        
        .pet-illustration {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 80px;
            opacity: 0.7;
            z-index: 1;
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
            
            .form-row {
                flex-direction: column;
            }
            
            .form-col {
                width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container-main">
        <div class="card-container">
            <div class="brand-section">
                <div class="logo-container">
                    <img src="{{asset('imgs/cute.png')}}" alt="Pet Logo" style="border-radius: 50%; width: 100%; height: auto;">
                </div>
                <h1 class="brand-title">Pet Appointment System</h1>
                <p class="brand-subtitle">Create an account to schedule appointments for your furry friends</p>
                <a href="/services" class="btn-services">
                    <i class="fas fa-paw mr-2"></i>View Services
                </a>
                <img src="{{asset('imgs/cute.png')}}" alt="Pets" class="pet-illustration">
            </div>
            
            <div class="login-section">
                <h2 class="login-title">Create Your Account</h2>
                
                <div id="beforeRegister" class="alert-box alert-primary">Creating your account...</div>
                <div id="errorMessage" class="alert-box alert-danger"></div>
                <div id="successMessage" class="alert-box alert-success"></div>
                
                <div class="social-login">
                    <p>Sign up with your Google account</p>
                    <button class="google-btn" id="googleSignIn">
                        Sign up with Google
                    </button>
                </div>
                
                <div class="divider">
                    <span class="divider-text">Or register with email</span>
                </div>
                
                <form id="registerForm" method="POST" action="{{route('auth.register.submit')}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="firstname">First Name *</label>
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="John" required>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Last Name *</label>
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Doe" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address *</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="john.doe@example.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="(123) 456-7890">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password *</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                            <span class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" id="passwordStrengthBar"></div>
                        </div>
                        <div class="password-strength" id="passwordStrengthText">Password strength: weak</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="confirmPassword">Confirm Password *</label>
                        <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    </div>
                    
                    <div class="checkbox-container">
                        <input type="checkbox" id="termsCheckbox" name="terms">
                        <label for="termsCheckbox">I agree to the <a href="#" style="color: var(--primary-color);">Terms and Conditions</a> and <a href="#" style="color: var(--primary-color);">Privacy Policy</a></label>
                    </div>
                    
                    <button type="submit" id="registerBtn" class="btn-login">Create Account</button>
                </form>
                
                <div class="register-link">
                    Already have an account? <a href="{{route('auth.login')}}">Log in here</a>
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
        
        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');
            
            // Check length
            if (password.length >= 8) strength += 25;
            
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) strength += 25;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength += 25;
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength += 25;
            
            // Update UI
            strengthBar.style.width = strength + '%';
            
            if (strength < 50) {
                strengthBar.style.backgroundColor = '#dc3545';
                strengthText.textContent = 'Password strength: weak';
                strengthText.style.color = '#dc3545';
            } else if (strength < 75) {
                strengthBar.style.backgroundColor = '#ffc107';
                strengthText.textContent = 'Password strength: medium';
                strengthText.style.color = '#ffc107';
            } else {
                strengthBar.style.backgroundColor = '#1cc88a';
                strengthText.textContent = 'Password strength: strong';
                strengthText.style.color = '#1cc88a';
            }
        }
        
        // Handle form submission
        $(document).ready(function(){
            // Password toggle event
            document.getElementById('togglePassword').addEventListener('click', togglePassword);
            
            // Password strength checker
            document.getElementById('password').addEventListener('input', function(e) {
                checkPasswordStrength(e.target.value);
            });
            
            // Register button click
            $("#registerBtn").click(function(){
                // Reset messages
                $("#errorMessage").hide();
                $("#successMessage").hide();
                
                // Get form values
                const firstName = $("#firstName").val().trim();
                const lastName = $("#lastName").val().trim();
                const email = $("#email").val().trim();
                const accountType = $("#accountType").val();
                const password = $("#password").val();
                const confirmPassword = $("#confirmPassword").val();
                const termsChecked = $("#termsCheckbox").is(":checked");
                
                // Validate form
                let valid = true;
                let errorMsg = "";
                
                if (!firstName) {
                    valid = false;
                    errorMsg = "First name is required";
                } else if (!lastName) {
                    valid = false;
                    errorMsg = "Last name is required";
                } else if (!email || !validateEmail(email)) {
                    valid = false;
                    errorMsg = "Valid email is required";
                } else if (!accountType) {
                    valid = false;
                    errorMsg = "Please select an account type";
                } else if (password.length < 8) {
                    valid = false;
                    errorMsg = "Password must be at least 8 characters";
                } else if (password !== confirmPassword) {
                    valid = false;
                    errorMsg = "Passwords do not match";
                } else if (!termsChecked) {
                    valid = false;
                    errorMsg = "You must agree to the terms and conditions";
                }
                
                if (!valid) {
                    $("#errorMessage").text(errorMsg).show();
                    return;
                }
                
                // Show loading message
                $("#beforeRegister").show();
                
                // Simulate registration process
                setTimeout(function() {
                    $("#beforeRegister").hide();
                    
                    // Show success message
                    $("#successMessage").text("Account created successfully! Redirecting...").show();
                    
                    // Simulate successful registration
                    setTimeout(function() {
                        // Redirect to login page
                        window.location.href = "{{route('auth.login')}}";
                    }, 2000);
                }, 2000);
            });
            
            // Google sign in button handler
            $("#googleSignIn").click(function() {
                Swal.fire({
                    title: 'Google Sign Up',
                    text: 'Google sign up functionality would be implemented here',
                    icon: 'info',
                    confirmButtonColor: '#4e73df'
                });
            });
        });
        
        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    </script>
</body>
</html>