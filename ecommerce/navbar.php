
<div class="sign_or_login">
    <div class="container">
        <div class="contian">
           <?php 
              if(isset($_SESSION['user'])){
                
                echo "<a href='profile.php'>My Profile</a>
                 <button> <a href='logout.php'>log out </a></button>";
              }
              else{
                echo "
                    <button> <a href='sign.php?typeOfButton=logIn'>logIn</a></button>
                    <button> <a href='sign.php?typeOfButton=signUp'>Sign up </a></button>
                   

                    ";

              }



          ?>

        </div>
        
    </div>
    
</div>
<div class="navbar" style="margin-top: 0px;">
    <div class="container">
         <div class="brand"> 
            <a href="index.php">Home Page</a>
         </div>
        <div class="all_links">
            <ul class="UnListStyle">
                <?php 

                  $Stor = getCategories();

                  foreach ($Stor  as $row) {
                      echo "<li>
                            <a href='categories.php?id=$row[Id]&pageName=$row[Name]'> $row[Name] </a>
                          </li> ";
                  }

                 ?>
            </ul>
        </div>
    </div>
</div>

<script src="front_end/js/front.js"></script>
