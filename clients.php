<?php
include 'auth_check.php';
include 'config.php';

$search = $_GET['search'] ?? '';

// ✅ Secure query with prepared statement
$stmt = $conn->prepare("SELECT * FROM clients WHERE name LIKE ?");
$search_param = "%{$search}%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clients - Mini CRM</title>
    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            perspective: 1000px;
            margin: 0;
        }

        .client-box {
            width: 90%;
            max-width: 1000px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: fade3d 1s ease-out forwards;
            opacity: 0;
        }

        @keyframes fade3d {
            from {
                opacity: 0;
                transform: rotateX(-20deg) scale(0.95);
            }
            to {
                opacity: 1;
                transform: rotateX(0deg) scale(1);
            }
        }

        .top-menu {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .top-menu a {
            margin: 5px;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            background-color: #0d6efd;
            color: white;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .top-menu a:hover {
            background-color: #084298;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form input {
            width: 250px;
        }

        table {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="client-box">
    <h3 class="text-center mb-3">Clients List</h3>

    <!-- ✅ Top Menu Buttons -->
    <div class="top-menu text-center">
        <a href="add_client.php">Add Client</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="export.php">Export CSV</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- ✅ Search Form -->
    <form method="get" class="search-form d-flex mb-3">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>

    <!-- ✅ Client Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['company']) ?></td>
                <td><?= htmlspecialchars($row['notes']) ?></td>
                <td>
                    <a href="edit_client.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete_client.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
