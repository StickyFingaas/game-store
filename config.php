<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'k2api';
    $konekcija = new mysqli($servername, $username, $password, $database);
    if ($konekcija->connect_error) {
    die("Neuspjesna konekcija" . $konekcija->connect_error);
}
?>