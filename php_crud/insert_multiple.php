<?php

// Configuration
$dbhost = 'localhost';
$dbport = '27017';

$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");

//print_r($conn);

//-----------------------------------------------
$dbname='roytuts';
$c_users='users';


$user1 = array(
    'first_name' => 'Soumitra5',
    'last_name' => 'RoyQ',
    'tags' => array('developer','admin')
);

$user2 = array(
    'first_name' => 'Arup5',
    'last_name' => 'Chatterjee',
    'tags' => array('developer')
);

$inserts = new MongoDB\Driver\BulkWrite();
$inserts->insert($user1);
$inserts->insert($user2);

$conn->executeBulkWrite("$dbname.$c_users", $inserts);


?>