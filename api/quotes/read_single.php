<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate blog quote object
  $quotes = new Quote($db);

  // Get ID
  $quotes->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Author
  $quotes->read_single();

  // Create array
  $quotes_arr = array(
    'id' => $quotes->id,
    'quote' => $quotes->quote,
    'author'=>$quotes->author,
    'category'=>$quotes->category
  );

  // Make JSON
  print_r(json_encode($quotes_arr, JSON_NUMERIC_CHECK));
  ?>