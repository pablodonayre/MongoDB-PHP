<?php


// Configuration
$dbhost = 'localhost';
$dbport = '27017';

$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");


$dbname='roytuts';
$c_users='users';


$delete = new MongoDB\Driver\BulkWrite();
$delete->delete(
    ['first_name' => 'Liton'],
    ['limit' => 0]
);

$result = $conn->executeBulkWrite("$dbname.$c_users", $delete);

if($result) {
	echo nl2br("Record deleted successfullyn");
}

/*

limit (boolean): Delete all matching documents (limit=0), or only the first matching document (limit=1)
*/

?>