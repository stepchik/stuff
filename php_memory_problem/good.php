<?php
/**
 * User: Peredriy Stepan
 * Date: 12/21/16
 * Time: 6:30 PM
 */

//It's not neccesary
//Just show that php can't fail by memory
ini_set("memory_limit", "256M");

$connection = new PDO("mysql:dbname=large_table;host=localhost", 'root', 'admin');

$sql = 'call test()'; // Call test cursor instead of select * from
$stmt = $connection->prepare($sql);

$stmt->execute();

function f(PDOStatement $stmt) {
    while ($stmt->columnCount() && $row = $stmt->fetch(PDO::FETCH_OBJ)) {
        yield $row;
        $stmt->nextRowset();
    }
};

$dataIterator = f($stmt);

$handle = fopen('/tmp/good', 'w');
foreach($dataIterator as $row) {
    fputcsv($handle, (array)$row, ';');
}

fclose($handle);

$stmt->closeCursor();
