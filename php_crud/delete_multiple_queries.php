<?php


// Configuration
$dbhost = 'localhost';
$dbport = '27017';

$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");


$dbname='roytuts';
$c_users='users';

$deletes = new MongoDB\Driver\BulkWrite();
$deletes->delete(
    ['first_name' => 'Liton'],
    ['limit' => 1]
);

$deletes->delete(
    ['first_name' => 'Arup'],
    ['limit' => 1]
);

$result = $conn->executeBulkWrite("$dbname.$c_users", $deletes);
/*

limit (boolean): Delete all matching documents (limit=0), or only the first matching document (limit=1)
*/

?>