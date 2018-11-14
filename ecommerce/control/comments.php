<?php

ob_start();
session_start();

if(isset($_SESSION['userName'])){
    include "initialize.php";
    include "connect.php";
    $do = isset($_GET['do'])? $_GET['do']:"comments";

    if($do =="comments"){// this page to show you how to manage your  members
       ?>
         <div class="container Manage_page">
          <h1 class="text_center">Manage Comments</h1>
          <table class="text_center">
            
            <tr class="special_tr">
              <td>Id</td>
              <td>comment</td>
              <td>Status</td>
              <td>date of comment</td>
              <td>Item Name</td>
              <td>User who add comment</td>
             <td>Control</td>
            </tr>
          
            <?php
           
             $select = $con ->prepare("SELECT 
                                          comments.*,
                                          item.Name  as item_name,
                                          item.Item_id,
                                          users.UserName as user_name ,
                                          users.UserId

                                      FROM 
                                         comments,
                                         item,
                                         users   
                                      WHERE 
                                          comments.item_id = item.Item_id
                                      and comments.user_id = users.UserId");
             $select ->execute();
            $colums = $select ->fetchAll();

            foreach($colums as $comlum){
              echo "<tr>";
                 echo "<td>" . $comlum['comment_id'] . "</td"."<br>";
                 echo "<td>" . $comlum['comment'] . "</td"."<br>";
                 echo "<td>" . $comlum['status'] . "</td"."<br>";
                 echo "<td>" . $comlum['comment_date'] . "</td"."<br>";
                 echo "<td>" . $comlum['item_name']."</td>";
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
         
    <?php  }

   elseif ($do=="Edit") {
     $comment_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;

      $select = $con ->prepare("SELECT * FROM comments  WHERE comment_id = ?");
      $select ->execute(array($comment_id));
      $satm = $select ->fetch();    
      
    if($select->rowCount()> 0){?>
          <div class="container text_center">
               <h1 class='text_center h1'>Edit  Comment</h1>
                 
               <div class="container"> 
                <form class="form_member_page form_insert" action='?do=Update&id=<?php echo $comment_id?>' method="POST">
                   
                    <div class="contain">
                        <label>Comment</label>
                        <textarea style="
                                  float: left; 
                                  height: 50px;
                                  resize: none; 
                                  width: 46%;
                                  text-transform:capitalize;
                                  background: aliceblue;
                                  overflow-x: hidden;" 
                                  name="comment">
                                  <?php echo $satm['comment']; ?>
                                    
                                  </textarea>

                    </div>
                    

              

                    <div class="contain">
                        
                        <button class="submit newClass" name="submit" value="Insert">submit </button>
                    </div>
             </form>
            </div>
        </div>
        <?php }
  
     }
       
     elseif($do == "Update"){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $comment_id = isset($_GET['id']) && is_numeric($_GET['id'])? intval($_GET['id']):0;
            $comment = $_POST['comment'];
            $updat = $con ->prepare("UPDATE comments SET comment = ?  WHERE comment_id = ?");
            $updat ->execute(array($comment,$comment_id));
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
         $id_for_comment = isset($_GET['id']) && is_numeric($_GET['id']) ?intval($_GET['id']): 0;
         
         $delete = $con ->prepare("DELETE FROM comments WHERE comment_id = ?");
         $delete ->execute(array($id_for_comment));
             ?>
                              <div class="container_categories text_center">
                                  <div class="mesage_to_show_what_happen">
                                      <h1 class="captialize"> successufly Delete From database</h1> 
                                  </div>
                               </div>
                          
             <?php
              header("refresh:2 ,url= comments.php");
  }
  elseif ($do=="approve") {
    $comment_id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]):0;
          $satm = $con ->prepare("UPDATE comments SET status = 1 WHERE comment_id = ?");
          $satm ->execute(array($comment_id));
          echo 'successed';
  }

 include "include/templete/footer.php";
}
?>