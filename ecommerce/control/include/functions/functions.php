<?php
  $dsn ='mysql:host=localhost;dbname=shop';
  $user = 'root';
  $pass ='';
  $option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'
  );
  try{
    $con = new PDO($dsn,$user,$pass,$option);
    $con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo 'you fail to connect to your databse'.$e ->getMessage();
    
  }
 
// This function to change the title of page for any page you visit it 
function getTitle(){
   global $pageTitle ;
   if(isset($pageTitle)){
    echo $pageTitle;
   }
   else{
    echo 'defualt';
   }
}
// This function to check if person or item or any thing is exist in data base or not
function check_if_you_want_this_thing_exist_in_database_or_not($colum,$table,$value){
   global $con;
   $select = $con ->prepare("SELECT $colum FROM $table WHERE $colum = ?");
   $select ->execute(array($value));
   $result =$select ->rowCount();
   return $result;

   
}

// This Function To Bring The count Of Items In Database
function countitem($column,$table){
   global $con;
   $select = $con->prepare("SELECT COUNT($column) FROM $table ");
   $select ->execute();
  return $select ->fetchColumn();
}

function getLastest($selector,$table,$order ,$limit = 5){
   global $con;
   $get = $con ->prepare("SELECT $selector FROM $table ORDER BY $order DESC LIMIT $limit");
   $get->execute();
   $row = $get->fetchAll();
   return $row;
   
}
function getItem($selector , $table){
  global $con ;
  $get = $con -> prepare("SELECT $selector FROM $table");
  $get ->execute();
  $row = $get ->fetchAll(PDO::FETCH_ASSOC);
  return $row;
}