<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate Category object
  $categories = new Category($db);

  // Get raw category data
  $data = json_decode(file_get_contents("php://input"));

  $categories->id = $data->id;
  $categories->category = $data->category;

  // Update Category
  if($categories->update()) {
    echo json_encode(
        array('message' => 'Categories Created')
    );
  } else {
    echo json_encode(
        array('message' => 'Categories Not Created')
    );
    }
  
?>