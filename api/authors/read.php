<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate blog quote object
  $authors = new Author($db);

  //Blog quote query
  $result = $authors->read();
  //Get row count
  $num = $result->rowCount();

  //Check if any posts
  if($num > 0) {
    //Quote array
    $authors_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       extract($row);

       $authors_item = array(
            'id' => $id,
            'author' => $author
       );

       //Push to "data"
       //array_push($author_arr['data'], $author_item);
       array_push($authors_arr, $authors_item);
    }

    //Turn to JSON & output
    echo json_encode($authors_arr);

  } else {

    //No Posts
    echo json_encode(array('message' => 'No Authors Found'));
  }
  ?>