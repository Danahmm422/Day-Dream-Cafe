<?php
foreach ([3306, 3307, 3308] as $port) {
    try {
        new PDO("mysql:host=127.0.0.1;port=$port;dbname=daydream", 'root', '');
        echo "Port $port: CONNECTED OK<br>";
    } catch (PDOException $e) {
        echo "Port $port: " . $e->getMessage() . "<br>";
    }
}