   <?php 
   session_start();
   include 'initialize.php';?>
 <?php 

   if(isset($_SESSION['user'])){
  
      $getUserInfo = $con->prepare("SELECT * FROM users WHERE UserName = ?");
      $getUserInfo ->execute(array($_SESSION['user']));
      $StorRow = $getUserInfo ->fetchAll();
     
  ?>
  <style type="text/css">
  	.chat{
	 float: right;
     background: green;
     position: absolute;
     right: 20px;
     bottom: 8px;
     font-size: 20px;
     padding: 10px;
  	}
  	.contain p{
  		padding:10px 0px;
  		margin:20px 0px;
  		background: white;
  		text-indent: 4px;
  		text-transform: capitalize;
  	}
  </style>
 

    <div class="My_information">
     	<h1 class="text-center" style="text-align: center;">My Information</h1>

	   	<div class="container">
	        	<div class="panel">
	                  <div class='panelHead'>
	                     <span>My information</span>
	                  </div>
	                  <div class='panelBody'>
	                    <?php
                         foreach ($StorRow as $rows) {
                         	echo "Name : " . $rows['UserName'] ."<br>" ; 

                         	echo "Email : " .$rows["Email"] . "<br>";

                         	echo "Full Name  : " .$rows["FullName"] . "<br>";

                         }

	                     ?>
	                  </div>
	               </div>
	        </div>
      </div>

    <div class="My_ads">
	   	<div class="container">
	        	<div class="panel">
	                  <div class='panelHead'>
	                     
	                     <span>My Item was added by me</span>
	                  </div>
	                  <div class='panelBody'>
	                  <?php 
                          
                       $fetchItem = $con ->prepare("SELECT * FROM item  WHERE  Member_id = ?");
                       $fetchItem ->execute(array($rows['UserId']));
                       $items =  $fetchItem ->fetchAll();

                       if($fetchItem ->fetchAll() >0 ){
                         foreach ($items as $item) {
                             echo "<div class='itemBox'>
                                   <div class='contain_image'>
                                     <img class = 'img_responsive'src = 'front_end/images/abanoub.jpg'>
                                   </div>

                                   <div class='Name'>
                                     $item[Name]
                                   </div>
                                  </div>";
                             }
                         }
                      else{
                         echo ' yes but some times no ';
                     }
                      

	                  ?>
	                  </div>
	               </div>
	        </div>
   </div>
        
   <div class="My_comment">
	   	<div class="container">
	        	<div class="panel">
	                  <div class='panelHead'>
	                     <span>The comment added by me </span>
	                  </div>
	                  <div class='panelBody'>
	                      <?php 
	                      $fetchComment = $con ->prepare("SELECT * FROM comments WHERE user_id = ?");
	                      $fetchComment ->execute(array($rows['UserId']));
	                      $StorComment = $fetchComment ->fetchAll();
                      

                            foreach ($StorComment as $comment) {
                            	echo "<div>
                                 <div class='itemBox'>
                                     <div class='contain_image'>
                                       <img class = 'img_responsive' scr ='front_end/images/girl.jpg'>
                                     </div>
                                     <div class='comment'> $comment[comment]</div> 
                                  </div>

                            	</div>";
                            }



	                      ?>
	                  </div>
	               </div>
	        </div>
   </div>

<?php
} else{
	header("Location:index.php");
}

   ?>