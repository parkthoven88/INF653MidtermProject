<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate Author object
  $authors = new Author($db);

  // Get raw Author data
  $data = json_decode(file_get_contents("php://input"));

  if(isset($data->author)){ 
    
    $authors->author = $data->author;
    $authors->create();
    echo json_encode(array("id"=> $db->lastInsertId(), "author"=>$authors->author));
  }
  else{
    echo json_encode(array('message' => 'Missing Required Parameters'));
  }

  
?>