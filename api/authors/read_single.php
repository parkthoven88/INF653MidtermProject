<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate Author object
  $authors = new Author($db);

  // Get ID
  $authors->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Author
  $authors->read_single();

  //Create Array
  $authors_arr = array(
    'id' => $authors->id,
    'author'=> $authors->author);
  
  if($authors->author !== null){
    echo json_encode($authors_arr, JSON_NUMERIC_CHECK);
  }
  else{
    echo json_encode(array('message' => 'author_id Not Found'));
  }
  
  ?>