<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate blog quote object
  $categories = new Category($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $categories->id = $data->id;
  $categories->category = $data->category;

  // Create authors
  if($categories->create()) {
    echo json_encode(
        array('message' => 'Categories Created')
    );
  } else {
    echo json_encode(
        array('message' => 'Categories Not Created')
    );
    }
  
?>