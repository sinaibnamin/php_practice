<?php
session_start();
$dataDir = __DIR__ . '/data'; // Path to the data directory
$dbFile = $dataDir . '/bank.db'; // Path to the database file

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0777, true);
}

// Check if the database file is writable
if (!is_writable($dataDir)) {
    chmod($dataDir, 0777);
}

$db = new SQLite3($dbFile);
// $db = new PDO('sqlite:'.$dbFile);
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS customers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL
)");

$db->exec("CREATE TABLE IF NOT EXISTS admins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL
)");

$db->exec("CREATE TABLE IF NOT EXISTS transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type TEXT NOT NULL,
    from_account_email TEXT NOT NULL,
    to_account_email TEXT,
    from_account_name TEXT NOT NULL,
    to_account_name TEXT,
    amount REAL NOT NULL,
    timestamp DATETIME NOT NULL
)");



// $db->close();