<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate blog quote object
  $authors = new Author($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $authors->id = $data->id;
  $authors->author = $data->author;

  // Create authors
  if($authors->update()) {
    echo json_encode(
        array('message' => 'Author updated')
    );
  } else {
    echo json_encode(
        array('message' => 'Author Not updated')
    );
    }
  
?>