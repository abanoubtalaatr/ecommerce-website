<?php
    session_start();
    $pageTitle ='index';
    $NoNavbar=''; //this for check if this page contain navbar or Not
    if(isset($_SESSION['userName'])){
        header('Location: dashbord.php'); 
    }
    include 'connect.php';
    include 'initialize.php';
    // check if the request come from form post
    if($_SERVER['REQUEST_METHOD']=== "POST"){
        $username = $_POST['userName'];
        $password = $_POST['pass'];
        $hashedPassword = ($password);
        
        $satm =$con ->prepare("SELECT UserId, UserName , password FROM users WHERE username = ?  AND password = ? LIMIT 1 ");
        $satm ->execute(array($username,$hashedPassword));
        $row = $satm-> fetch();
        $count  =$satm->rowCount();         
        //check if you is exist in database
        if($count > 0){
            echo 'this person is exist in your data base';
            $_SESSION['userName'] = $username;
            $_SESSION['UserId'] = $row['UserId'];
            header('Location: dashbord.php');
            exit();
        }
        else{
            header('Location:index.php');
        }
      }
?>

<form class="logIn" action="<?php  echo $_SERVER['PHP_SELF']?>" method="POST">
     <h1 class="text_center">Admin log</h1>
     <input class="hide" type="text" name="userName" placeholder="user name ">
     <input class="hide" type="password" name="pass" placeholder="enter you password">
     <input type="submit" value="longIn">
</form>

<script src="theme/js/theme.js"></script>