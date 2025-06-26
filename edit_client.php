<?php
include 'auth_check.php';
include 'config.php';

$id = $_GET['id'];
$row = $conn->query("SELECT * FROM clients WHERE id=$id")->fetch_assoc();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    if (empty($name) || empty($email)) {
        $error = "Name and Email are required!";
    } else {
        $conn->query("UPDATE clients SET name='$name', email='$email', phone='$phone',
                      company='$company', notes='$notes' WHERE id=$id");
        header("Location: clients.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Client</title>
    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f1f1;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
            margin: 0;
        }

        .form-box {
            width: 500px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: fade3d 1s ease-out forwards;
            opacity: 0;
        }

        @keyframes fade3d {
            from {
                opacity: 0;
                transform: rotateX(-30deg) scale(0.95);
            }
            to {
                opacity: 1;
                transform: rotateX(0deg) scale(1);
            }
        }

        .menu {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .menu a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            background-color: #0d6efd;
            color: white;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #084298;
        }
    </style>
</head>
<body>

<div class="form-box">

    <h3 class="text-center mb-3">Mini CRM - Edit Client</h3>

    <!-- ✅ Styled Top Menu Buttons -->
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- ✅ Error message -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- ✅ Edit Form -->
    <form method="post">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($row['phone']) ?>">
        </div>
        <div class="mb-3">
            <label>Company:</label>
            <input type="text" name="company" class="form-control" value="<?= htmlspecialchars($row['company']) ?>">
        </div>
        <div class="mb-3">
            <label>Notes:</label>
            <textarea name="notes" class="form-control"><?= htmlspecialchars($row['notes']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">Update</button>
        <button type="button" class="btn btn-secondary mt-2 w-100" onclick="window.location.href='clients.php'">Cancel</button>
    </form>

</div>

</body>
</html>
