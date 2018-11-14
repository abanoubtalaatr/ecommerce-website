<?php
  include 'connect.php';
function getCategories(){

        global $con;
        $getCate = $con ->prepare("SELECT * FROM categories");
        $getCate ->execute();
        $StorDate = $getCate->fetchAll();
        return $StorDate;

}
function getItem($id_for_categories){

      global $con;
      $getCate = $con ->prepare("SELECT * FROM item WHERE Cat_id=?");
      $getCate ->execute( array($id_for_categories));
      $StorDate = $getCate->fetchAll(PDO::FETCH_ASSOC);
      return $StorDate;
}