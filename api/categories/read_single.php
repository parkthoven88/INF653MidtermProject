<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate blog quote object
  $categories = new Category($db);

  // Get ID
  $categories->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Author
  $categories->read_single();

  // Create array
  $categories_array = array(
    "id" => $categories->id,
    "category" => $categories->category);

  if($categories->category !== null){
    //Convert to JSON and output
    echo json_encode($categories_array, JSON_NUMERIC_CHECK);
  }
  else{
      echo json_encode(array('message' => 'category_id Not Found'));
  }
  ?>