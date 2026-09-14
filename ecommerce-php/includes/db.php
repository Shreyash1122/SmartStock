<?php
require_once __DIR__ . '/config.php';

function db()
{
    static $connection = null;

    if ($connection !== null) {
        return $connection;
    }

    mysqli_report(MYSQLI_REPORT_OFF);
    $connection = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($connection->connect_errno) {
        $connection = false;
        return null;
    }

    $connection->set_charset('utf8mb4');
    return $connection;
}
