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

  $authors->id = $data->id;
  $authors->author = $data->author;

  // Create authors
  if($authors->create()) {
    echo json_encode(
        array('message' => 'Author Created')
    );
  } else {
    echo json_encode(
        array('message' => 'Author Not Created')
    );
    }
  
?>