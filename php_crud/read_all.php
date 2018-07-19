<?php

// Configuration
$dbhost = 'localhost';
$dbport = '27017';

$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");


$dbname='roytuts';
$c_users='users';


$filter = [];
$option = [];
$read = new MongoDB\Driver\Query($filter, $option);

$all_users = $conn->executeQuery("$dbname.$c_users", $read);


echo nl2br("All users => \n");

foreach ($all_users as $user) {
	echo nl2br($user->first_name.' '.$user->last_name.' has following roles'."\n");
	foreach ($user->tags as $tag) {
		echo nl2br($tag."\n");
	}
}





?>