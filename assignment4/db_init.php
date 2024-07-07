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
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
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
    amount REAL NOT NULL,
    timestamp DATETIME NOT NULL
)");



// admin registration

$name = "admin";
$email = "admin@admin.com";
$password = password_hash("123", PASSWORD_DEFAULT); // Hash the password for security

// Check if a row with the admin email already exists
$stmt = $db->prepare("SELECT * FROM admins WHERE email = :email");
$stmt->bindParam(':email', $email);
$result = $stmt->execute();

$row = $result->fetchArray(SQLITE3_ASSOC);
if (!$row) {
    $stmt = $db->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $result = $stmt->execute();
}
