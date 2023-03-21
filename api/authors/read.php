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

  // Author query
  $result = $authors->read();

  //Get row count
  $num = $result->rowCount();


  // Check if any authors
  if($num > 0){
    //Author array
    $authors_arr = array();
    //$authors_arr['data'] = array();

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $authors_item = array(
          'id' => $id, 
          'author' => $author);

        //Push to "data"
        array_push($authors_arr, $authors_item);
      }

    //Turn to JSON & output
    echo json_encode($authors_arr);
    }
    else{
      echo json_encode(array('message' => 'No Authors found'));
    }
  ?>