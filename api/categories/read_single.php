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
  $categories_arr = array(
    'id' => $categories->id,
    'author' => $categories->category
  );

  // Make JSON
  print_r(json_encode($categories_arr));
  ?>