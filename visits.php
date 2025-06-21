<?php
// visits.php
require_once 'models.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$client_id = $_GET['client_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visit_notes = $_POST['visit_notes'];
    add_visit($client_id, $visit_notes);
}
$client = get_client($client_id);
$visits = get_visits_for_client($client_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visit Notes for <?= htmlspecialchars($client['name']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container" style="max-width:700px;">
    <h1>Visit Notes for <?= htmlspecialchars($client['name']) ?></h1>
    <form method="post">
        <label>Add New Visit Note:</label>
        <textarea name="visit_notes" required></textarea>
        <input type="submit" value="Add Visit">
    </form>
    <h2>Previous Visits</h2>
    <table>
        <tr><th>Date</th><th>Notes</th></tr>
        <?php foreach ($visits as $visit): ?>
        <tr>
            <td><?= htmlspecialchars($visit['visit_date']) ?></td>
            <td><?= nl2br(htmlspecialchars($visit['visit_notes'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php" class="button">Back to Clients</a>
</div>
</body>
</html>
