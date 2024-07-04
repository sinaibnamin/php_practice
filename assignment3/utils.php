<?php
function createDatabase() {
    $dataDir = 'data';
    $dbFile = 'data/users.db';

    // Create data directory if it doesn't exist
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0777, true);
    }

    // Check if the database file is writable
    if (!is_writable($dataDir)) {
        chmod($dataDir, 0777);
    }

    $db = new SQLite3($dbFile);
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        email TEXT NOT NULL,
        password TEXT NOT NULL
    )");
    $db->exec("CREATE TABLE IF NOT EXISTS feedback (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        feedback TEXT NOT NULL
    )");
    $db->close();
}

createDatabase();
?>
