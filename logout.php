<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Logging Out...</title>
  <!-- ✅ Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .logout-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      text-align: center;
      animation: fadeZoomIn 1s ease-in-out;
    }

    @keyframes fadeZoomIn {
      from {
        opacity: 0;
        transform: scale(0.8) rotateX(-90deg);
      }
      to {
        opacity: 1;
        transform: scale(1) rotateX(0deg);
      }
    }

    .logout-box h2 {
      color: #198754;
    }
  </style>

  <!-- ✅ Auto Redirect in 3 seconds -->
  <meta http-equiv="refresh" content="3;url=login.php?message=logout">
</head>
<body>

<div class="logout-box">
  <h2>✅ You have been logged out!</h2>
  <p>Redirecting to login page...</p>
</div>

</body>
</html>
