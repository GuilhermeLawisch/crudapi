<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));

$msg['message'] = '';

if(isset($data->title) && isset($data->body) && isset($data->author)){

  if(!empty($data->title) && !empty($data->body) && !empty($data->author)){
      
    $insert_query = "INSERT INTO `posts`(title,body,author) VALUES(:title,:body,:author)";
      
    $insert_stmt = $conn->prepare($insert_query);

    $insert_stmt->bindValue(':title', htmlspecialchars(strip_tags($data->title)),PDO::PARAM_STR);
    $insert_stmt->bindValue(':body', htmlspecialchars(strip_tags($data->body)),PDO::PARAM_STR);
    $insert_stmt->bindValue(':author', htmlspecialchars(strip_tags($data->author)),PDO::PARAM_STR);
      
    if($insert_stmt->execute()){
      $msg['message'] = 'Data Inserted Successfully';
    }else{
      $msg['message'] = 'Data not Inserted';
    } 
      
  }else{
      $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
  }
}
else{
  $msg['message'] = 'Please fill all the fields | title, body, author';
}

echo  json_encode($msg);
?>