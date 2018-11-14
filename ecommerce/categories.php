<?php 
 include 'initialize.php';
 if(isset($_GET['pageName'])&& isset($_GET['id'])){
 	 $Stor2 = getItem($_GET['id']);
 	 
    echo "<div class = 'container'>";
    echo "<h1 class='text_center'>$_GET[pageName]</h1>";
        echo "<div class='row'>";
		   foreach ($Stor2 as $key) {
    
		    	echo "<div class='itemBox'>
                       <div class='contain_image'>
                         <img class = 'img_responsive'src = 'http://localhost/ecommerce/images/s7.jpg'>
                       </div>

                       <div class='Name'>
                         $key[Name]
		             	</div>

                       <div class='description'>
                         $key[Description]
		             	</div>

		               
		    	</div>";
		    	

	 	
		    }
		echo "</div>";	   
    echo "</div>";
 }
?>
