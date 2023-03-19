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
  $quote = new Quote($db);

  //Blog quote query
  $result = $quote->read();
  //Get row count
  $num = $result->rowCount();

  //Check if any posts
  if($num > 0) {
    //Quote array
    $quote_arr = array();
    // $quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       extract($row);

       $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author, //html_entity_decode($author_id),
            'category' => $category
       );

       //Push to "data"
       array_push($quote_arr, $quote_item);
    }

    //Turn to JSON & output
    echo json_encode($quote_arr);

  } else {

    //No Posts
    echo json_encode(array('message' => 'No Posts Found'));
  }
  ?>