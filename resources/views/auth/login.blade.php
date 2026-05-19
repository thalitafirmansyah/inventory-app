<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            font-family: 'Segoe UI', 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Hiasan background sederhana */
        body::before {
            content: '🏪';
            position: absolute;
            font-size: 300px;
            opacity: 0.05;
            bottom: -50px;
            right: -50px;
            pointer-events: none;
        }

        body::after {
            content: '📦';
            position: absolute;
            font-size: 200px;
            opacity: 0.05;
            top: -50px;
            left: -50px;
            pointer-events: none;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s ease-out;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .login-header h3 {
            font-size: 26px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 14px;
        }

        .input-group-custom {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.3s;
            outline: none;
            background: #f8fafc;
        }

        .input-group-custom input:focus {
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #3b82f6;
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
        }

        .alert-custom {
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            background: #fee2e2;
            border: none;
            color: #dc2626;
        }

        .footer-info {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .footer-info small {
            color: #94a3b8;
            font-size: 11px;
        }

        .demo-cred {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 12px;
            margin-top: 20px;
            text-align: center;
        }

        .demo-cred p {
            font-size: 12px;
            color: #475569;
            margin-bottom: 5px;
        }

        .demo-cred .badge-demo {
            display: inline-block;
            background: #e2e8f0;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            margin: 3px;
            color: #1e293b;
        }

        @media (max-width: 480px) {
            .login-card {
                margin: 20px;
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="icon">🏪📦</div>
            <h3>Inventory System</h3>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        @if(session('error'))
            <div class="alert-custom">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="input-group-custom">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required autocomplete="off">
            </div>

            <div class="input-group-custom">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> SIGN IN
            </button>
        </form>
    </div>
</body>
</html>