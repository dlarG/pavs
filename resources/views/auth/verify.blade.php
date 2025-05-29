<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #36b9cc;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .verification-card {
            max-width: 600px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .verification-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .verification-body {
            background: white;
            padding: 3rem;
        }
        
        .verification-icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        .btn-resend {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-resend:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="verification-card">
            <div class="verification-header">
                <h2>Verify Your Email Address</h2>
            </div>
            
            <div class="verification-body text-center">
                <div class="verification-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> A fresh verification link has been sent to your email address.
                    </div>
                @endif

                <p class="lead">Before proceeding, please check your email for a verification link.</p>
                <p>If you did not receive the email, click the button below to request another.</p>
                
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-resend mt-3">
                        <i class="fas fa-paper-plane me-2"></i>Resend Verification Email
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>