<?php
// db.php
function get_db() {
    $db = new PDO('db.be-mons1.bengt.wasmernet.com');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function init_db() {
    $db = get_db();
    $db->exec('CREATE TABLE IF NOT EXISTS clients (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        phone TEXT,
        email TEXT,
        dob TEXT,
        notes TEXT,
        fitoterapia TEXT,
        acup_level1 TEXT,
        acup_level2 TEXT,
        acup_level3 TEXT
    )');
    $db->exec('CREATE TABLE IF NOT EXISTS visits (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        client_id INTEGER NOT NULL,
        visit_date TEXT NOT NULL,
        visit_notes TEXT,
        FOREIGN KEY(client_id) REFERENCES clients(id) ON DELETE CASCADE
    )');
    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        is_admin INTEGER DEFAULT 0
    )');
    // Create default admin if not exists
    $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
    $stmt->execute(['admin']);
    if ($stmt->fetchColumn() == 0) {
        $admin_hash = hash('sha256', 'admin');
        $db->prepare('INSERT INTO users (username, password_hash, is_admin) VALUES (?, ?, 1)')
           ->execute(['admin', $admin_hash]);
    }
}
?>
