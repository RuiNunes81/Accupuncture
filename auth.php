<?php
// auth.php
require_once 'db.php';

function check_user_credentials($username, $password) {
    $db = get_db();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    print(hash('sha256', $password))
    if ($user && $user['password_hash'] === hash('sha256', $password)) {
        return $user;
    }
    return false;
}

function is_admin($username) {
    $db = get_db();
    $stmt = $db->prepare('SELECT is_admin FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user && $user['is_admin'] == 1;
}
?>
