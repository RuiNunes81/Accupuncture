<?php
// index.php
require_once 'db.php';
require_once 'models.php';
session_start();
init_db();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$clients = get_all_clients();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Acupuncture Clinic - Clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <img src="logo.png" alt="Clinic Logo" style="height:60px;">
        <h1 style="margin:0; flex:1; text-align:center; color:#2c3e50;">Acupuncture Clinic - Clients</h1>
        <a href="logout.php" class="button logout">Logout</a>
    </div>
    <a href="add_client.php" class="button">Add Client</a>
    <table>
        <tr><th>Name</th><th>Phone</th><th>Email</th><th>DOB</th><th>Notes</th><th>Fitoterapia</th><th>Acup. Level 1</th><th>Acup. Level 2</th><th>Acup. Level 3</th><th>Actions</th></tr>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= htmlspecialchars($client['name']) ?></td>
            <td><?= htmlspecialchars($client['phone']) ?></td>
            <td><?= htmlspecialchars($client['email']) ?></td>
            <td><?= htmlspecialchars($client['dob']) ?></td>
            <td><?= htmlspecialchars($client['notes']) ?></td>
            <td><?= htmlspecialchars($client['fitoterapia']) ?></td>
            <td><?= htmlspecialchars($client['acup_level1']) ?></td>
            <td><?= htmlspecialchars($client['acup_level2']) ?></td>
            <td><?= htmlspecialchars($client['acup_level3']) ?></td>
            <td>
                <a href="edit_client.php?id=<?= $client['id'] ?>" class="button">Edit</a>
                <a href="delete_client.php?id=<?= $client['id'] ?>" class="button" style="background:#e74c3c;">Delete</a>
                <a href="visits.php?client_id=<?= $client['id'] ?>" class="button" style="background:#27ae60;">Visits</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
