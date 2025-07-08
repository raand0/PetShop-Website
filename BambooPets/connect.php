<?php

$host = 'localhost';
$dbname = 'petshop';
$db_user = 'root';
$db_pass = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>