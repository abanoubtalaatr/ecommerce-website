<?php
  session_start();
  if($_SESSION['userName']){
    
      $pageTitle = "Members";
      
      include 'initialize.php';
      include 'connect.php';
      
      $do = isset($_GET['do']) ? $_GET['do'] :'Manage';
       
      if($do =="Manage"){// this page to show you how to manage your  members
        $query = '';
        if(isset($_GET['page']) && $_GET['page'] == 'pending'){
          $query = "AND RegStauts = 0";
        }
        $satm = $con->prepare("SELECT * FROM users WHERE UserId != 1 $query");
        $satm ->execute();
        $colums =$satm->fetchAll();
       
       
        ?>
         <div class="container Manage_page">
          <h1 class="text_center">Manage Members</h1>
          <table class="text_center">
            
            <tr class="special_tr">
              <td>#id</td>
              <td>user name</td>
              <td>email</td>
              <td>full name</td>
              <td>regestred date</td>
              <td>control</td>
            </tr>
          
            <?php
            foreach($colums as $comlum){
              echo "<tr>";
               echo "<td>" . $comlum['UserId'] . "</td"."<br>";
               echo "<td>" . $comlum['UserName'] . "</td"."<br>";
               echo "<td>" . $comlum['Email'] . "</td"."<br>";
               echo "<td>" . $comlum['FullName'] ."</td" ."<br>";
               echo "<td>$comlum[Date]</td>";
               echo "<td>"?>
                  <ul class="UnListStyle">
                    <li>
                      <a href='member.php?do=Edit&id= <?php echo $comlum["UserId"]?>'> Edit </a>
                    </li>
                     
                     <li>
                       <a href='member.php?do=Delete&id="$comlum[UserId]"'>Delete </a>
                     </li>
                    
                  </ul>   
                  <?php
                  if($comlum['RegStauts']==0){
                    echo "<ul class = 'UnListStyle'>";
                    echo "<li>";
                    echo "<a href= 'member.php?do=accept&id=$comlum[UserId]'>accept</a> ";
                    echo "</li>";
                    echo "</ul>";
                  }
                "</td"; 
               echo "</tr>";
              
              } ?>
               
          </table>
               <a href='member.php?do=Add'><i class="fa fa-plus"></i>add new member </a>
         
         </div>
         
    <?php  }
    
     // this page for Edit your profile 
     elseif($do =='Edit'){
     
        $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']):0;  
        $satm =$con ->prepare("SELECT * FROM users WHERE UserId = :userid");
        $satm ->execute(array(':userid'=>$userid));
        $row =$satm-> fetch();
       
        //check if you is exist in database
        if($satm->rowCount()> 0){?>
               <!--this form to Edit your data-->
                  <h1 class='text_center h1'>Edit Your Data</h1>
                  <div class="container">
    
                    <form class="form_member_page" action='?do=Update' method="POST">
                      
                        <div class="contain">
                            <input type='text' name="userid"  value= '<?php echo $userid?>'hidden >
                            <label>User Name</label>
                            <input type="text" name="UserName" value="<?php echo $row['UserName']?>" placeholder="Enter your New Name" required='required'>
                        </div>
                        
                        <div class="contain">
                           <label>Password</label>
                           <input type="hidden" name="oldPassword" value="<?php echo $row['Password']?>">
                           <input type="password" name="Password" placeholder="Enter your New Password ">
                        </div>
                        
                        <div class="contain">
                           <label>Email</label>
                           <input type="email" name="email" value='<?php echo $row['Email']?>' placeholder="Enter your New Email " autocomplete='new-password'>
                        </div>
                        
                         <div class="contain">
                           <label>full name </label>
                           <input type="text" name="fullName" value='<?php echo $row['FullName']?>' placeholder="Enter your Full Name " autocomplete='new-password'>
                        </div>
                         
                        <div class="submit">
                          <input type="submit" value="Update">
                        </div>
                        
                   </form>
               </div>
        <?php }
     
     
      }
    
     elseif($do =='Update'){
           $pageTitle = 'Update';
           echo "<h1 class='text_center'> Update Your data" ."<br>";
          if($_SERVER['REQUEST_METHOD']=='POST'){
            
              $userid = $_POST['userid'];
              $username =$_POST['UserName'];
              $email = $_POST['email'];
              $fullName = $_POST['fullName'];
              $password = $_POST['Password'];
              
              if(!empty($password)){
                  $satm = $con->prepare("UPDATE users SET UserName =? , Email =?, FullName =?,Password=? WHERE UserId =?");
                  $satm ->execute(array($username,$email,$fullName,$password,$userid));
                  echo $satm ->rowCount(); 
              }
              
            else{
                $oldPassword = $_POST['oldPassword'];
                $satm = $con ->prepare("UPDATE users SET  userName =? ,Email=? , FullName =? , Password =? WHERE UserId =?");
                $satm ->execute(array($username,$email,$fullName,$oldPassword,$userid));
                
            }
          }
        }
        
         elseif($do =="Add"){?>
            
              <div class='container text_center'>
               <h1 class='text_center h1'>Add New Member</h1>
                 
               <div class="container"> 
                <form class="form_member_page form_insert" action='?do=Insert' method="POST">
                  <div class="contain">
                    
                      <label>User Name</label>
                      <input type="text" name="UserName"  placeholder="Enter your New Name" required='required'>
                  </div>
                  <div class="contain">
                      <label>Password</label>
                     
                     <input type="password" name="Password" placeholder="Enter your New Password " required='required'>
                  </div>
                  <div class="contain">
                     <label>Email</label>
                     <input type="email" name="email"  placeholder="Enter your New Email " autocomplete='new-password'>
                  </div>
                  
                   <div class="contain">
                     <label>full name </label>
                     <input type="text" name="fullName"  placeholder="Enter your Full Name " autocomplete='new-password'>
                  </div>
                  <div class="submit">
                    <input type="submit" value="Add Member">
                  </div>
                </form>
               </div>
  
    <?php  }
    
    elseif($do =="Insert"){
          $pageTitle = 'Insert Date';
          
          if($_SERVER['REQUEST_METHOD']=='POST'){
              echo "<h1 class='text_center'> Update Your data" ."<br>";
                
              $username =$_POST['UserName'];
              $email = $_POST['email'];
              $fullName = $_POST['fullName'];
              $password = $_POST['Password'];
              $register =date("Y-m-d h:i:s");
              $one = 1;
             
              
              if(check_if_you_want_this_thing_exist_in_database_or_not('UserName','users',$username) > 0){
                  echo 'Not Allow To You Use This User Name';
                }
                else{
                  $satm = $con->prepare("INSERT INTO `users` (`UserName`, `Password`, `Email`, `FullName`,`RegStauts`,`Date`) VALUES ('$username', '$password', '$email', '$fullName','$one','$register')");
                  $satm ->execute(array($username,$password,$email,$fullName,$register));
                  echo 'Successfully Add Member You Will Do Go Page Manage After You Just Read This Tip';
                  header("refresh:3 ,url= member.php");
                }
             
          }
          else{
            echo "sorry not allowed to you to add new number";
          }
        }
        
        elseif($do == "Delete"){
           $userid = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]):0; // this is differnt about in the video  
          
           $satm =$con ->prepare("SELECT * FROM users  WHERE UserId = ?");
           $satm ->execute(array($userid));
          
           //check if you is exist in database
           if($satm->rowCount()> 0){
            echo 'one record is delete ';
               $satm = $con ->prepare("DELETE FROM users WHERE UserId = :userid ");
               //$satm ->bindParam(':id',$userid);
               $satm ->execute(array(':userid' =>$userid));
               
          }
        }
       elseif($do == 'accept'){
          $userid = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]):0;
          $satm = $con ->prepare("UPDATE users SET RegStauts = 1 WHERE UserId = ?");
          $satm ->execute(array($userid));
          echo 'successed';
          
        }
        }
         
    
    
    
     else{
        header('Locataion:index.php');
        exit();
     }
    
  
?>