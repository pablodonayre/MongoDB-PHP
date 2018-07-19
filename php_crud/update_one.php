<?php

// Configuration
$dbhost = 'localhost';
$dbport = '27017';

$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");


$dbname='roytuts';
$c_users='users';


$single_update = new MongoDB\Driver\BulkWrite();
$single_update->update(
    ['last_name' => 'Roy'],
    ['$set' => ['first_name' => 'Liton', 'last_name' => 'Sarkar']],
    ['multi' => false, 'upsert' => false]
);
$result = $conn->executeBulkWrite("$dbname.$c_users", $single_update);

if($result) {
	echo nl2br("Record updated successfullyn");
}


/*
multi (boolean): Update only the first matching document (multi=false), or all matching documents (multi=true). FALSE
upsert (boolean): If filter does not match an existing document, insert a single document. The document will be created from newObj if it is a replacement document (i.e. no update operators); otherwise, the operators in newObj will be applied to filter to create the new document.

*/

?>