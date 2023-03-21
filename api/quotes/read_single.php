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

  if( isset($_GET['id'])){
   
    $quotes->id = isset($_GET['id']) ? $_GET['id'] : die();
        //quote query
    $quote->read_single();

    //Create array
    $quotes_arr = array(
        'id' => $quotes->id,
        'quote' => $quotes->quote,
        'author'=>$quotes->author,
        'category'=>$quotes->category
    );

    if($quotes->quote !== null){
        //Change to JSON data
        print_r(json_encode($quotes_arr, JSON_NUMERIC_CHECK));
        }

    else
        {
            echo json_encode(
                array('message' => 'No Quotes Found')
            );
        }
  } 

  else if(isset($_GET['author_id']) and isset($_GET['category_id'])){
    
    $quotes->author_id = isset($_GET['author_id']) ? $_GET['author_id'] : die();
    $quotes->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();
    
    //quote query
    $result = $quote->read_single();

    $num = $result->rowCount();

    if($num > 0) {
      //Quote array
      $quotes_arr = array();
        

      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quotes_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );

        //Push data
        array_push($quotes_arr, $quotes_item);
      }

      echo (json_encode($quotes_arr)); 
      
    }
    else{
          echo json_encode(array('message' => 'No Quotes Found'));
    }

  }

  else if(isset($_GET['author_id'])){
    
      $quotes->author_id = isset($_GET['author_id']) ? $_GET['author_id'] : die();
      
      $result = $quotes->read_single();

      $num = $result->rowCount();

      if($num > 0) {
        //Quote array
        $quotes_arr = array();
          

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $quotes_item = array(
              'id' => $id,
              'quote' => $quote,
              'author' => $author,
              'category' => $category
          );

          //Push data
          array_push($quotes_arr, $quotes_item);
        }

        echo (json_encode($quotes_arr)); 
      
      }
      else{
        echo json_encode(array('message' => 'No Quotes Found'));
      }

  }

  else if(isset($_GET['category_id'])){
    
      $quotes->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();
          //quote query
      $result = $quotes->read_single();

      $num = $result->rowCount();

      if($num > 0) {
          //Quote array
          $quotes_arr = array();
          

          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);

              $quotes_item = array(
                  'id' => $id,
                  'quote' => $quote,
                  'author' => $author,
                  'category' => $category
              );

              //Push data
              array_push($quotes_arr, $quotes_item);
          }

              echo (json_encode($quotes_arr)); 
      
      }
      else{
        echo json_encode(array('message' => 'No Quotes Found'));
      }
  }

?>
