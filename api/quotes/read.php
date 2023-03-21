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

  //Blog quote query
  $result = $quotes->read();
  //Get row count
  $num = $result->rowCount();

  //Check if any posts
  if($num > 0) {
    //Quote array
    $quotes_arr = array();
    // $quote_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       extract($row);

       $quotes_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author, //html_entity_decode($author_id),
            'category' => $category
       );

       //Push to "data"
       array_push($quotes_arr, $quotes_item);
    }

    //Turn to JSON & output
    echo json_encode($quotes_arr);

    } else {

      //No Posts
      echo json_encode(array('message' => 'No Quote Found'));
    }
  ?>