<?php
   session_start();
   
    if(isset($_SESSION['userName'])){
       $pageTitle ='dashbord';
        include 'initialize.php';
        ?>
        
        <div class="dashbord">
            <div class="container s">
               <h1>Dashbord</h1>
               <div class="item">
                  <h3>Total Members </h3> 
                  <span> <a href="member.php" target="_self">  <?php echo countitem("UserId","users")?></a> </span>
               </div>
               
               <div class="item">
                  <h3>Pending Members </h3> 
                  <span><a href="member.php?do=Manage&page=pending"><?php echo check_if_you_want_this_thing_exist_in_database_or_not('RegStauts','users',0)?></a></span>
               </div>
               
               <div class="item">
                  <h3>Total Members </h3> 
                  <span>span</span>
               </div>
               
               <div class="item">
                  <h3>Total Members </h3> 
                  <span>span</span>
               </div>
           </div>
            <div class="container">
               
               <div class="panel">
                  <div class='panelHead'>
                     <i class="fa fa-users "></i>
                     <span>Latest Regestred users</span>
                  </div>
                  <div class='panelBody'>
                     <span>
                        <?php
                         $lastest = getLastest('*','users','UserId',4);
                         echo "<ul class=UnListStyle>";
                          foreach($lastest as $col){   
                           echo "<li>" . $col['UserName'] .
                           "<a href='member.php?do=Edit&id= $col[UserId]'>".
                           "<span style='float:right'> <i class= 'fa fa-edit'></i> Edit</span>" ."</li>".
                           "</a>";
                          }
                          echo "</ul>";
                        
                        ?>
                     </span>
                  </div>
               </div>
               
               <div class="panel">
                  <div class='panelHead'>
                     <i class="fa fa-users "></i>
                     <span>Latest items</span>
                  </div>
                  <div class='panelBody'>
                     <?php 
                      
                      $lastest = getLastest('*','item','Item_id',4);
                         echo "<ul class=UnListStyle>";
                          foreach($lastest as $col){   
                           echo "<li>" . $col['Name'] .
                           "<a href='item.php?do=Edit&id= $col[Item_id]'>".
                           "<span style='float:right'> <i class= 'fa fa-edit'></i> Edit</span>" ."</li>".
                           "</a>";
                          }
                          echo "</ul>";


                     ?>
                  </div>
               </div>
            </div>
        
        </div>
        
        
        
        <?php
    }
    else{
      header('Location: index.php');
      exit();
    }
   


?>