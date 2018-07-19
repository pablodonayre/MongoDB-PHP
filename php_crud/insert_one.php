<?php

// Configuration
$dbhost = 'localhost';
$dbport = '27017';

$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");

print_r($conn);

//-----------------------------------------------
$dbname='roytuts';
$c_users='users';


$user1 = array(
    'first_name' => 'Soumitra2',
    'last_name' => 'Roy2',
    'tags' => array('developer','admin')
);

$single_insert = new MongoDB\Driver\BulkWrite();
$single_insert->insert($user1);

$conn->executeBulkWrite("$dbname.$c_users", $single_insert);


?>