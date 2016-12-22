<?php
/**
 * User: Peredriy Stepan
 * Date: 12/21/16
 * Time: 6:30 PM
 */

/*
set_time_limit(240);
ini_set("memory_limit", "256M");
ob_clean();*/

set_time_limit(240);
ini_set("memory_limit", "256M");

$connection = new PDO("mysql:dbname=large_table;host=localhost", 'root', 'admin');

$sql = 'select * from large_table';
$stmt = $connection->prepare($sql);

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$handle = fopen('/tmp/bad', 'w');
foreach ($rows as $row) {
    fputcsv($handle, array_values($row), ';');
}
fclose($handle);
