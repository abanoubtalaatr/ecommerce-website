
<?php
// This page for categories
ob_start();
session_start();
if(isset($_SESSION['userName'])){
    include "initialize.php";
    include "connect.php";
    $do = isset($_GET['do'])? $_GET['do']:"categories";
    
    if($do =="categories"){
        global $con;
        $show_details_of_categories = $con->prepare("SELECT * FROM categories");
        $show_details_of_categories ->execute();
        $stor_details_of_categories = $show_details_of_categories ->fetchAll();
        
    ?>
        <div class="container_categories text_center categories">
            <h1>Manage Categories</h1>
            <div class="panel">
                     <div class='panelHead'>
                        <i class="fa fa-magic"></i>
                        <span>Manage Categories</span>
                     </div>
                     <div class='panelBody'>
                       <?php
                       foreach($stor_details_of_categories as $singleRow){
                           echo "<div class='contain_cate'>";
                            echo "<div class='hidden_buttons'>
                                  <a href='categories.php?do=Edit&id=".$singleRow["Id"]."'><i class='fa fa-edit'></i> Edit</a>
                                  <a href='categories.php?do=Delete&id=".$singleRow['Id']."'> <i class= 'fa fa-close'></i>Delete</a>
                              </div>";
                             echo "<h3> {$singleRow['Name']} </h3>";
                            
                             if($singleRow['Description']==""){
                                 echo "<textarea disabled style='color:red'> This Categories Not Have Description </textarea>";
                             }
                             else{
                                echo "<textarea disabled> {$singleRow['Description']} </textarea>";
                               }
                             if($singleRow['Visibility']==1){
                                echo "<span class='hidden_visibility'> Visible </span>";
                             }
                             else{
                                echo "<span class='visible_visibility'> Hidden </span>";
                             }
                             if($singleRow['Allow_comment']==1){
                                echo "<span class='hidden_comment'> Not Allow Comment </span> ";
                                echo "<style>
                                  .categories .panelBody .contain_cate .hidden_ads,
                                  .categories .panelBody .contain_cate .visible_ads{
                                     left:590px;
                                  }
                                </style>";
                             }
                             else{
                                echo "<span class= 'visible_comment'> Allow Comment </span>";
                             }
                             if($singleRow['Allow_ads']==1){
                                echo "<span class='hidden_ads'> Not Allow Ads </span>";
                             }
                             else{
                                echo "<span class='visible_ads'> Allow ads </span>";
                             }
                        
                               echo "<hr>";
                           echo "</div>";
                           
                       }  
?>
                     </div>
               </div>
                <a class="link" href="categories.php?do=Add"> <i class="fa fa-plus"></i>Add New Categories</a>
         </div>
   <?php }
    
    if($do =="Add"){?>
            <div class="container_categories">
                  <div class="form_Add_Cateogry">
                      <form action="categories.php?do=Insert" method='post'> 
                          <table>
                              <caption>Add New Category</caption>
                              
                              <tr>
                                  <td>
                                      <label>Name</label>
                                      <input type="text" placeholder="Enter The Name Of Category" name="name_of_cate">
                                  </td>
                              </tr>
                              
                              <tr>
                                  <td>
                                      <label>Description</label>
                                      <input type="text" placeholder="Write Some thing Describe The Categorey" name="description">
                                  </td>
                              </tr>
                                  
                              <tr>
                                  <td>
                                      <label>Arrange</label>
                                      <input type="text" placeholder="Write The Number of Category" name="arrange">
                                  </td>
                              </tr>
                              
                                <tr>
                                  <td>
                                      <label>Visibility</label>
                                      
                                      <label class="sp" for="yes">Yes </label>
                                      <input id="yes" type="radio" name="vis" value="0">
                                      
                                      <label class="sp sp_s" for="no">No </label>
                                      <input id="no" type="radio" name="vis" value="1">
                                  </td>
          
                              </tr>
                                
                              <tr>
                                  <td>
                                      <label>Allow Comment</label>
                                      
                                      <label class="sp" for="yes">Yes </label>
                                      <input id="yes" type="radio" name="com" value="0">
                                      
                                      <label class="sp sp_s" for="no">No </label>
                                      <input id="no" type="radio" name="com" value="1">
                                  </td>
          
                              </tr>
                              
                              
                               <tr>
                                  <td>
                                      <label>Allow Ads</label>
                                      
                                      <label class="sp" for="yes">Yes </label>
                                      <input id="yes" type="radio" name="ads" value="0">
                                      
                                      <label class="sp sp_s" for="no">No </label>
                                      <input id="no" type="radio" name="ads" value="1">
                                  </td>
          
                              </tr>
                              <tr>
                                  <td>
                                      <button class="submit_a">Insert</button>
                                  </td>
                              </tr>
                              
                          </table>
                      </form>
                      
                  </div>
              </div>  
  <?php }
   elseif($do == "Insert"){
       if($_SERVER['REQUEST_METHOD']=="POST"){
          $name_of_categories =  $_POST['name_of_cate'];
          $description_of_categories = $_POST['description'];
          $arrange_of_cateogries = $_POST['arrange'];
          $visibility = $_POST['vis'];
          $allow_comment = $_POST['com'];
          $allow_ads = $_POST['ads'];
          
          if($name_of_categories ===""){
              echo 'you should not let empty field'; 
          }
          else{
                      $StorStatus = check_if_you_want_this_thing_exist_in_database_or_not('Name','categories',$name_of_categories);
                    if($StorStatus == 1){              
                        echo <<<message
                         <div class="container_categories text_center">
                            <div class="mesage_to_show_what_happen">
                               <i class="fa fa-arrow-left"></i> <h1 class="captialize"> Sorry This categories is aleardy Exsit</h1> <i class="fa fa-arrow-right"></i>
                            </div>
                         </div>
message;
                    }
                else{
                        $insert = $con ->prepare("
                                              INSERT INTO `categories` (`Name`, `Description`, `Ordering`, `Visibility`, `Allow_comment`, `Allow_ads`)
                                              VALUES ('$name_of_categories', '$description_of_categories', '$arrange_of_cateogries', '$visibility', '$allow_comment', '$allow_ads')");
                          $insert ->execute(array($name_of_categories,$description_of_categories,$arrange_of_cateogries,$visibility,$allow_comment,$allow_ads));
                          ?>
                              <div class="container_categories text_center">
                                  <div class="mesage_to_show_what_happen">
                                    <h1 class="captialize"> successufly insert to database</h1>
                                  </div>
                               </div>
                          
                          <?php
                       header("refresh:3 ,url= categories.php");
                    }     
          }
              
    }
    else{
          echo 'you can Enter to this Url across this way';
      } 
}
    elseif($do == "Edit"){
            $cateogryId = isset($_GET['id']) && is_numeric($_GET['id']) ?intval($_GET['id']): 0;
            $select = $con->prepare("SELECT * FROM categories WHERE Id = $cateogryId");
            $select ->execute(array($cateogryId));
            $Row = $select->fetch();
            
           if($select ->rowCount() >0){?>
            
            
            <div class="container_categories">
                  <div class="form_Add_Cateogry">
                      <form action="categories.php?do=Update" method='post'> 
                          <table>
                              <caption>Add New Category</caption>
                              
                              <tr>
                                  <td>
                                      <label>Name</label>
                                      <input type="hidden"  value="<?php echo $Row['Id'] ?>" name="name_id">
                                   
                                      <input type="text" name="new_name_of_categories" value="<?php echo $Row['Name']?>">
                                  </td>
                              </tr>
                              
                              <tr>
                                  <td>
                                      <label>Description</label>
                                      <input type="text" name="new_description" placeholder="Write The Description" value="<?php echo $Row['Description']?>">
                                  </td>
                              </tr>
                                  
                              <tr>
                                  <td>
                                      <label>Arrange</label>
                                      <input type="text" name="new_arrange" value="<?php echo $Row['Ordering'] ?>">
                                  </td>
                              </tr>
                              
                            <tr>
                                  <td>
                                      <label>Visibility</label>
                                      
                                      <label class="sp" for="yes">Yes </label>
                                      <input id="yes" type="radio" name="vis" value="0"  <?php if($Row['Visibility']==0) {echo 'checked';}?>>
                                      
                                      <label class="sp sp_s" for="no">No </label>
                                      <input id="no" type="radio" name="vis" value="1" <?php if($Row['Visibility']==1) {echo 'checked';}?>>
                                  </td>
                              </tr>
                                
                              <tr>
                                  <td>
                                      <label>Allow Comment</label>
                                      
                                      <label class="sp" for="yes">Yes </label>
                                      <input id="yes" type="radio" name="com"  value="0" <?php if($Row['Allow_comment']==0) {echo 'checked';}?>>
                                      
                                      <label class="sp sp_s" for="no">No </label>
                                      <input id="no" type="radio" name="com" value="1" <?php if($Row['Allow_comment']==1) {echo 'checked';}?>>
                                  </td>
          
                              </tr>
                              
                               <tr>
                                  <td>
                                      <label>Allow Ads</label>
                                      
                                      <label class="sp" for="yes">Yes </label>
                                      <input id="yes" type="radio" name="ads" value="0" <?php if($Row['Allow_ads']==0) {echo 'checked';}?>>
                                      
                                      <label class="sp sp_s" for="no">No </label>
                                      <input id="no" type="radio" name="ads" value="1" <?php if($Row['Allow_ads']==1) {echo 'checked';}?>>
                                  </td>
                              </tr>
                               
                              <tr>
                                  <td>
                                      <button class="submit_a">Save</button>
                                  </td>
                              </tr>    
                          </table>
                      </form>
                  </div>
              </div>  
    <?php }        
    }
    
    elseif($do == "Update"){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $update_name      =  $_POST['new_name_of_categories'];
            $new_description  =  $_POST['new_description'];
            $new_arrange      =  $_POST['new_arrange'];
            $vis              =  $_POST['vis'];
            $com              =  $_POST['com'];
            $ads              =  $_POST['ads'];
            $name_id          =  $_POST['name_id'];
            
            $updat = $con ->prepare("UPDATE categories SET Name = ?,Description =?,Ordering = ?,Visibility = ?,Allow_comment = ?,Allow_ads = ? WHERE Id = ?");
            $updat ->execute(array($update_name,$new_description,$new_arrange,$vis,$com,$ads,$name_id));
            ?>
                              <div class="container_categories text_center">
                                  <div class="mesage_to_show_what_happen">
                                      <h1 class="captialize"> successufly update to database</h1> 
                                  </div>
                               </div>
                          
                          <?php
                       header("refresh:2 ,url= categories.php");
         }
         else{
            echo 'you not need you';
         }
        }
        elseif($do =="Delete"){
         // we need to delete this categories using id how to get this id
         $id_for_categories = isset($_GET['id']) && is_numeric($_GET['id']) ?intval($_GET['id']): 0;
         echo $id_for_categories;
         $delete = $con ->prepare("DELETE FROM categories WHERE Id = ?");
         $delete ->execute(array($id_for_categories));
             ?>
                              <div class="container_categories text_center">
                                  <div class="mesage_to_show_what_happen">
                                      <h1 class="captialize"> successufly Delete From database</h1> 
                                  </div>
                               </div>
                          
             <?php
              header("refresh:2 ,url= categories.php");
        }
       
    
    
      include "include/templete/footer.php";
    }

    else{
            header("Location:index.php");
    }
ob_end_flush();