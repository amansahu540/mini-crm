<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($email == "admin@test.com" && $pass == "admin123") {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Mini CRM</title>
    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
        }

        .login-box {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
            animation: pop3d 1s ease-out forwards;
            opacity: 0;
        }

        @keyframes pop3d {
            0% {
                transform: rotateX(-90deg) scale(0.8);
                opacity: 0;
            }
            60% {
                transform: rotateX(15deg) scale(1.05);
                opacity: 1;
            }
            100% {
                transform: rotateX(0deg) scale(1);
                opacity: 1;
            }
        }

        h3 {
            color: #333;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="text-center mb-4">Mini CRM Login</h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
