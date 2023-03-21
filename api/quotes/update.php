<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//required files
require('../../config/Database.php');
require('../../models/Quote.php');

//Database
$database = new Database();
$db = $database->connect();

//Instantiate Category object
$quotes = new Quote($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if(! isset($data->quote) or ! isset($data->author_id) or ! isset($data->category_id)) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    exit();
}

//Set ID to update
$quotes->id = $data->id;
$quotes->quote = $data->quote;
$quotes->author_id = $data->author_id;
$quotes->category_id = $data->category_id;

//Update Category
if($quotes->update()) {
    echo json_encode(
        array('id'=>$quotes->id,
        'quote'=>$quotes->quote, 
        'author_id'=>$quotes->author_id, 
        'category_id'=>$quotes->category_id)
    );
} else {
    echo json_encode(array('message' => 'No Quotes Found'));
}