<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database file
include_once 'db.php';

$dbname = 'roytuts';
$collection = 'users';

//DB connection
$db = new DbManager();
$conn = $db->getConnection();

//record to update
$data = json_decode(file_get_contents("php://input", true));

$fields = $data->{'fields'};

$set_values = array();

foreach ($fields as $key => $fields) {
	$arr = (array)$fields;
	foreach ($fields as $key => $value) {
		$set_values[$key] = $value;
	}
}

//_id field value
$id = $data->{'where'};

// update record
/*
Basically here we are updating here first name and last name for the given _id
*/

$update = new MongoDB\Driver\BulkWrite();
$update->update(
	['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => $set_values], ['multi' => false, 'upsert' => false]
);
$result = $conn->executeBulkWrite("$dbname.$collection", $update);

// verify
if ($result->getModifiedCount() == 1) {
    echo json_encode(
		array("message" => "Record successfully updated")
	);
} else {
    echo json_encode(
            array("message" => "Error while updating record")
    );
}


/*

we have added few headers as we added for create operation but only one difference is that we have added here http PUT method for client’s request.

We are reading the request json in the same way we read for create operation.

We build the update array and where clause for performing update operation.

Finally we execute the query using executeBulkWrite() method. Then we verify the update result and display the result.

Se actualiza por id del documento

TO TEST THIS CODE USE A REST CLIENT:
	CONFIGURATION:
		METHOD: PUT
		URL: http://localtest3/php/mongo/update.php
		HEADERS: NONE
		BODY: application/json
			{
			  "where": "5b4c1a8e49a5013ff800452e",
			  "fields": [
			    {"first_name":"Ricardo"},
			    {"last_name":"Pepinillo"}
			  ]
			}

*/


?>