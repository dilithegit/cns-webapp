<?php
session_start();
try {
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=CAT2', '192072-Dili', 'CHANGE_ME', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed.');
}
