<?php
// models.php
require_once 'db.php';

function get_all_clients() {
    $db = get_db();
    return $db->query('SELECT * FROM clients')->fetchAll(PDO::FETCH_ASSOC);
}

function get_client($id) {
    $db = get_db();
    $stmt = $db->prepare('SELECT * FROM clients WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_client($name, $phone, $email, $dob, $notes, $fitoterapia, $acup1, $acup2, $acup3) {
    $db = get_db();
    $stmt = $db->prepare('INSERT INTO clients (name, phone, email, dob, notes, fitoterapia, acup_level1, acup_level2, acup_level3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$name, $phone, $email, $dob, $notes, $fitoterapia, $acup1, $acup2, $acup3]);
}

function update_client($id, $name, $phone, $email, $dob, $notes, $fitoterapia, $acup1, $acup2, $acup3) {
    $db = get_db();
    $stmt = $db->prepare('UPDATE clients SET name=?, phone=?, email=?, dob=?, notes=?, fitoterapia=?, acup_level1=?, acup_level2=?, acup_level3=? WHERE id=?');
    $stmt->execute([$name, $phone, $email, $dob, $notes, $fitoterapia, $acup1, $acup2, $acup3, $id]);
}

function delete_client($id) {
    $db = get_db();
    $stmt = $db->prepare('DELETE FROM clients WHERE id=?');
    $stmt->execute([$id]);
}

function get_visits_for_client($client_id) {
    $db = get_db();
    $stmt = $db->prepare('SELECT * FROM visits WHERE client_id=? ORDER BY visit_date DESC');
    $stmt->execute([$client_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add_visit($client_id, $visit_notes) {
    $db = get_db();
    $stmt = $db->prepare('INSERT INTO visits (client_id, visit_date, visit_notes) VALUES (?, datetime("now"), ?)');
    $stmt->execute([$client_id, $visit_notes]);
}
?>
