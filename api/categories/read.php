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
  $category = new Category($db);

  //Blog quote query
  $result = $category->read();
  //Get row count
  $num = $result->rowCount();

  //Check if any posts
  if($num > 0) {
    //Quote array
    $category_arr = array();
    //$author_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       extract($row);

       $category_item = array(
            'id' => $id,
            'category' => $category
       );

       //Push to "data"
       //array_push($author_arr['data'], $author_item);
       array_push($category_arr, $category_item);
    }

    //Turn to JSON & output
    echo json_encode($category_arr);

  } else {

    //No Posts
    echo json_encode(array('message' => 'No Posts Found'));
  }
  ?>