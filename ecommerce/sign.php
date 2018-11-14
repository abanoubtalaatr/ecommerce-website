<?php

?>

<?php

session_start();
if(isset($_SESSION['user'])){
	header("Location:index.php");
}
include 'initialize.php';
if(isset($_POST['logIn'])){
	if(isset($_POST['logIn'])){
         echo 'yes you suppose you log in to our website';
		$UserName = $_POST['UserName'];
		$password = $_POST['password'];
	    $checkuser = $con ->prepare("SELECT * FROM users WHERE UserName = ? AND Password = ?");
	    $checkuser ->execute(array($UserName,$password));
	    if($checkuser->rowCount() >0){
	    	$_SESSION['user'] = $UserName;
      }
	}
	

	
}
elseif (isset($_POST['signUp'])) {
		
		$User = $_POST['User'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$Email = $_POST['Email'];

      $EnterToDate = $con ->prepare("INSERT INTO users SET UserName = ?,Password = ?,Email=?");
      $EnterToDate ->execute(array($User,$pass1,$Email));
		 echo 'yes but some times no bue sl iote';
      header("Location:profile.php");
	}

$stor='';
if(isset($_GET['typeOfButton'])){
	$stor = "{$_GET['typeOfButton']}";
}
if($stor==="logIn"){?>

         

         <div class='container'>

            <div class='logIn'>
                <div class='overlay'></div>
                <div class='contain-form'>
                        <div class='a'>A</div>
                    
                      <form  action="<?php  echo $_SERVER['PHP_SELF']?>" method="POST">
	                       <input type='text' name='UserName' placeholder='Enter your user name'>
	                       <input type='password' name='password' placeholder='Enter your password'>
	                       <input type='submit' name='logIn' value='Log in' class='special'>
                     </form>
                
               </div>
               
            </div>
        </div>

<?php

	}



if($stor==="signUp"){?>

        
 		 <div class='container'>

            <div class='signUp'>
                <div class='overlay'></div>
                <div class='contain-form'>
                        <div class='a'>
                         A
                        </div>
                    
                      <form  action="<?php  echo $_SERVER['PHP_SELF']?>" method="POST">
                       <input type='text' name='User' placeholder='Enter your user name'>
                       <input type='password' name='pass1' placeholder='Enter your password'>
                       <input type='password' name='pass2' placeholder='Enter your password again'>
                       <input type='email' name='Email' placeholder='Enter vaild Email'>
                       <input type='submit' name='signUp' value='sign up' class='special'>
                     </form>
                
               </div>
               
            </div

<?php

}


        


