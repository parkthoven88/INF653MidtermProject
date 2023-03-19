<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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
  // Create authors
  if($categories->update()) {
    echo json_encode(
        array('message' => 'Categories Deleted')
    );
  } else {
    echo json_encode(
        array('message' => 'Categories Not Deleted')
    );
    }
  
?>