<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  //Instantiate DE & connect
  $database = new Database();
  $db = $database->connect();

  //Instantiate Category object
  $category = new Category($db);

  //Category query
  $result = $category->read();

  //Get row count
  $num = $result->rowCount();

  // Check if any category
  if($num > 0){
    //Author array
    $category_arr = array();
    //$authors_arr['data'] = array();

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = array(
          'id' => $id, 
          'category' => $category);

        //Push to "data"
        array_push($category_arr, $category_item);
      }

    //Turn to JSON & output
    echo json_encode($category_arr);
    }
    else{
      echo json_encode(array('message' => 'No Categories found'));
    }
  ?>