<?php

ob_start();
session_start();

if(isset($_SESSION['userName'])){
    include "initialize.php";
    include "connect.php";
    $do = isset($_GET['do'])? $_GET['do']:"item";

    if($do =="item"){// this page to show you how to manage your  members
       ?>
         <div class="container Manage_page">
          <h1 class="text_center">Manage Item</h1>
          <table class="text_center">
            
            <tr class="special_tr">
              <td>#Id</td>
              <td>Name</td>
              <td>Description</td>
              <td>Price</td>
              <td>Date Of Regestried</td>
              <td>County Of Made</td>
              <td>The Name of Categories</td>
              <td>The User Add This Categories</td>
             <td>Control</td>
            </tr>
          
            <?php
           
             $select = $con ->prepare("SELECT 
                                          item.* ,
                                           categories.Name as categoryName,
                                           users.UserName  as person
                                      FROM 
                                          item,
                                          categories,
                                          users 
                                      WHERE 
                                          item.Cat_id = categories.Id  
                                      and item.Member_id = users.UserId");
             $select ->execute();
            $colums = $select ->fetchAll();
            
            foreach($colums as $comlum){
              echo "<tr>";
               echo "<td>" . $comlum['Item_id'] . "</td"."<br>";
               echo "<td>" . $comlum['Name'] . "</td"."<br>";
               echo "<td>" . $comlum['Description'] . "</td"."<br>";
               echo "<td>" . $comlum['Price'] . "</td"."<br>";
               echo "<td>" . $comlum['Add_date']."</td>";
               echo "<td>" . $comlum['County_made'] ."</td" ."<br>";
               echo "<td>" . $comlum['categoryName'] ."</td" ."<br>";
               echo "<td>" . $comlum['person'] ."</td" ."<br>";
               
               echo "<td>"?>
                  <ul class="UnListStyle">
                    <li>
                        
                      <a href='item.php?do=Edit&id=<?php echo $comlum['Item_id']?>'> Edit </a>
                    </li>
                     
                     <li>
                       <a href='item.php?do=Delete&id=<?php echo $comlum['Item_id']?>'> Delete </a>
                     </li>
                    
                  </ul>   
                  <?php
                    if($comlum['approve']==0){
                    echo "<ul class = 'UnListStyle'>";
                    echo "<li>";
                    echo "<a href= 'item.php?do=approve&id=$comlum[Item_id]'>approve</a> ";
                    echo "</li>";
                    echo "</ul>";
                  }
                "</td"; 
               echo "</tr>";
              
              } ?>
               
          </table>
               <a href='item.php?do=Add'><i class="fa fa-plus"></i>add new Item </a>
         
         </div>
         
    <?php  }
    

    if($do =="Add"){?>
        <div class="container text_center">
               <h1 class='text_center h1'>Add New Item</h1>
                 
               <div class="container"> 
                <form class="form_member_page form_insert" action='?do=Insert' method="POST">
                    <div class="contain">
                        <label>Name</label>
                        <input type="text" name="name_item"  placeholder="Enter Name Of Item" required='required'>
                    </div>
                    <div class="contain">
                        <label>Description</label>
                       <input type="text" name="description_item" placeholder="Enter Some Details about Item " required='required'>
                    </div>


                    <div class="contain">
                        <label>Price</label>
                       <input type="text" name="price_item" placeholder="Enter the price of item " required='required'>
                    </div>

                    <div class="contain">
                        <label>Country</label>
                       <input type="text" name="country_of_made" placeholder="Enter Some Details about Item " required='required'>
                    </div>
                    

                    <div class="contain">
                        <label>Status</label>
                         <select name="value_of_status" class="select">
                           <option value="1">new</option>
                           <option value="2">old</option>
                           <option value="3">used before</option>
                           <option value="4">very old</option>
                         </select>
                    </div> 

                     <div class="contain">
                        <label>members</label>
                         <select name="value_of_members" class="select">
                           <option value="0">....</option>
                             <?php
                               $select = $con ->prepare("SELECT * FROM users");
                               $select ->execute();
                               $members = $select ->fetchAll();
                               foreach ($members as $member) {
                                 echo "<option value =" .$member['UserId']."> {$member['UserName']} </option>";
                               }
                           
                            ?>


                             </option>
                          </select>
                    </div>


                    <div class="contain">
                        <label>Categories</label>
                         <select name="value_of_categories" class="select">
                           <option value="0">....</option>
                             <?php
                               $select = $con ->prepare("SELECT * FROM categories");
                               $select ->execute();
                               $members = $select ->fetchAll();
                               foreach ($members as $member) {
                                 echo "<option value= ".$member['Id']."> {$member['Name']} </option>";
                               }
                           
                            ?>


                             </option>
                          </select>
                    </div> 
 
              
                    <div class="contain">
                        
                        <button class="submit newClass" name="submit" value="Insert">submit </button>
                    </div>
             </form>
            </div>
        </div>
   <?php }
   elseif ($do=="Insert") {
     if($_SERVER['REQUEST_METHOD']=== "POST"){

       $name_item         = $_POST['name_item'];
       $description_item  = $_POST['description_item'];
       $price_item        = $_POST['price_item'];
       $country_of_made   = $_POST['country_of_made'];
       $value_of_status   = $_POST['value_of_status'];
       $value_of_categories = $_POST['value_of_categories'];
       $value_of_members  = $_POST['value_of_members'];
       $date = date("y:m:d");
       
       $satm = $con->prepare("
        INSERT INTO `item` 
                (
                `Name`,
                `Description`,
                `Price`,
                `County_made`,
                `Status`,
                `Add_date`,
                `Member_id`,
                `Cat_id`)
         VALUES (
                 '$name_item',
                 '$description_item',
                 '$price_item',
                 '$country_of_made',
                 '$value_of_status',
                 '$date',
                 '$value_of_members',
                 '$value_of_categories'
                )");
       $satm ->execute(array
        (
            $name_item ,
            $description_item ,
            $price_item ,
            $country_of_made ,
            $value_of_status,

            $value_of_members,
            $value_of_categories
         )
      );
       
       ?>  
           <div class=" container text_center successfuly">
             <h1>Yes you Enter one recond to date base succsessfuly </h1>
           </div>

       <?php
     }
     
    else{
      echo 'you can\'t Enter accross the url';
    }
   } 
   elseif ($do=="Edit") {
     $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

      $select = $con ->prepare("SELECT * FROM item  WHERE Item_id = $userid");
      $select ->execute(array($userid));
      $satm = $select ->fetch();
      
    if($select->rowCount()> 0){?>
                <div class="container text_center">
               <h1 class='text_center h1'>Edit  Item</h1>
                 
               <div class="container"> 
                <form class="form_member_page form_insert" action='?do=Update&id=<?php echo $userid?>' method="POST">
                    <div class="contain">
                        <label>Name</label>
                         
                        <input type="text" name="name_item" value="<?php echo $satm['Name']?>" placeholder="Enter The New Name Of Item" required='required'>
                    </div>
                    <div class="contain">
                        <label>Description</label>
                       <input type="text" name="description_item" value="<?php echo $satm['Description']?>" placeholder="Enter Some Details about Item " required='required'>
                    </div>


                    <div class="contain">
                        <label>Price</label>
                       <input type="text" name="price_item" value="<?php echo $satm['Price']?>" placeholder="Enter the price of item " required='required'>
                    </div>

                    <div class="contain">
                        <label>Country</label>
                       <input type="text" name="country_of_made" value="<?php echo $satm['County_made']?>" placeholder="Enter Some Details about Item " required='required'>
                    </div>
                    

                    <div class="contain">
                        <label>Status</label>
                         <select name="value_of_status" class="select">
                           <option value="1">new</option>
                           <option value="2">old</option>
                           <option value="3">used before</option>
                           <option value="4">very old</option>
                         </select>
                    </div> 

                     <div class="contain">
                        <label>members</label>
                         <select name="value_of_members" class="select">
                           <option value="0">....</option>
                             <?php
                               $select = $con ->prepare("SELECT * FROM users");
                               $select ->execute();
                               $members = $select ->fetchAll();
                               foreach ($members as $member) {
                                 echo "<option value =" .$member['UserId']."> {$member['UserName']} </option>";
                               }
                           
                            ?>


                             </option>
                          </select>
                    </div>


                    <div class="contain">
                        <label>Categories</label>
                         <select name="value_of_categories" class="select">
                           <option value="0">....</option>
                             <?php
                               $select = $con ->prepare("SELECT * FROM categories");
                               $select ->execute();
                               $members = $select ->fetchAll();
                               foreach ($members as $member) {
                                 echo "<option value= ".$member['Id']."> {$member['Name']} </option>";
                               }
                           
                            ?>


                             </option>
                          </select>
                    </div> 
 
              
                    <div class="contain">
                        
                        <button class="submit newClass" name="submit" value="Insert">submit </button>
                    </div>
             </form>
            </div>
        </div>
        ?>
         <div class="container Manage_page">
          <h1 class="text_center">Manage <?php echo $satm['Name']?> Comments</h1>
          <table class="text_center">
            
            <tr class="special_tr">
              <td>Id</td>
              <td>comment</td>
              <td>Status</td>
              <td>date of comment</td>
              <td>User who add comment</td>
             <td>Control</td>
            </tr>
          
            <?php
           
             $select = $con ->prepare("SELECT 
                                          comments.*,
                                          users.UserName as user_name ,
                                          users.UserId

                                      FROM 
                                         comments,
                                         users   
                                      WHERE 
                                        
                                      comments.user_id = users.UserId
                                      and 
                                      comments.Item_id =?
                                       
                                      ");
             $select ->execute(array($userid));
            $colums = $select ->fetchAll();

            foreach($colums as $comlum){
              echo "<tr>";
                 echo "<td>" . $comlum['comment_id'] . "</td"."<br>";
                 echo "<td>" . $comlum['comment'] . "</td"."<br>";
                 echo "<td>" . $comlum['status'] . "</td"."<br>";
                 echo "<td>" . $comlum['comment_date'] . "</td"."<br>";
                 echo "<td>" . $comlum['user_name'] ."</td" ."<br>";
               echo "<td>"?>
                  <ul class="UnListStyle">
                    <li>
                        
                      <a href='comments.php?do=Edit&id=<?php echo $comlum['comment_id']?>'> Edit </a>
                    </li>
                     
                     <li>
                       <a href='comments.php?do=Delete&id=<?php echo $comlum['comment_id']?>'> Delete </a>
                     </li>
                    
                  </ul>   
                  <?php
                    if($comlum['status']==0){
                    echo "<ul class = 'UnListStyle'>";
                    echo "<li>";
                    echo "<a href= 'comments.php?do=approve&id=$comlum[comment_id]'>accept</a> ";
                    echo "</li>";
                    echo "</ul>";
                  }
                "</td"; 
               echo "</tr>";
              
              } ?>
          </table>
         </div>
         
    <?php
        }
     }
       
     elseif($do == "Update"){
        if($_SERVER['REQUEST_METHOD']=="POST"){
                
            $userid = $_GET['id'];
            $update_name      =  $_POST['name_item'];
            $new_description  =  $_POST['description_item'];
            $new_price      =  $_POST['price_item'];
            $County_made              =  $_POST['country_of_made'];
            $value_of_status              =  $_POST['value_of_status'];
            $value_of_members              =  $_POST['value_of_members'];
            $value_of_categories          =  $_POST['value_of_categories'];
            echo $userid;
            $updat = $con ->prepare("UPDATE item SET Name = ?,Description =?,Price = ?,County_made = ?,Status = ?,Member_id = ?,Cat_id=? WHERE Item_id = ?");
            $updat ->execute(array(
              $update_name,
              $new_description,
              $new_price,
              $County_made,
              $value_of_status,
              $value_of_members,
              $value_of_categories,
              $userid));
            ?>
                              <div class="container_categories text_center">
                                  <div class="mesage_to_show_what_happen">
                                      <h1 class="captialize"> successufly update to database</h1> 
                                  </div>
                               </div>
                          
                          <?php
                     
         }
         else{
            echo 'you not need you';
         }
  }
  elseif ($do=="Delete") {
     // we need to delete this categories using id how to get this id
         $id_for_item = isset($_GET['id']) && is_numeric($_GET['id']) ?intval($_GET['id']): 0;
         
         $delete = $con ->prepare("DELETE FROM item WHERE Item_id = ?");
         $delete ->execute(array($id_for_item));
             ?>
                              <div class="container_categories text_center">
                                  <div class="mesage_to_show_what_happen">
                                      <h1 class="captialize"> successufly Delete From database</h1> 
                                  </div>
                               </div>
                          
             <?php
              header("refresh:2 ,url= categories.php");
  }
  elseif ($do=="approve") {
    $Item_id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]):0;
          $satm = $con ->prepare("UPDATE item SET approve = 1 WHERE Item_id = ?");
          $satm ->execute(array($Item_id));
          echo 'successed';
  }

 include "include/templete/footer.php";
}
?>