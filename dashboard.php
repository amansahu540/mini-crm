<?php
include 'auth_check.php';
include 'config.php';

$result = $conn->query("SELECT COUNT(*) as total FROM clients");
$total = $result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Mini CRM</title>
    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            perspective: 1000px;
        }

        .dashboard-box {
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: popIn3D 1s ease-out forwards;
            opacity: 0;
            text-align: center;
        }

        @keyframes popIn3D {
            from {
                transform: rotateX(-30deg) scale(0.9);
                opacity: 0;
            }
            to {
                transform: rotateX(0deg) scale(1);
                opacity: 1;
            }
        }

        .dashboard-box h2 {
            margin-bottom: 20px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="dashboard-box">
    <h2>Welcome to Mini CRM</h2>
    <p class="fs-5">📊 Total Clients: <strong><?= $total ?></strong></p>

    <div class="btn-group">
        <a href="clients.php" class="btn btn-primary">View Clients</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

</body>
</html>
