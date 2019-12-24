<?php include "db.php"; ?>
<?php session_start()  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
</head>
<body>
	<?php 

$errors="";
$result="";


if (isset($_POST['login'])) {
	
    $email=$_POST['email'];
	$password=$_POST['password'];
	$missingemail='<p><strong>please enter your email:-</strong></P>';
	$missingpassword='<p><strong>please enter your password:-</strong></P>';
	$Invalidpassword='<p><strong>please enter your valid password:-</strong></P>';

	if (!$email) {
		$errors .=$missingemail;
	}else{
		$email=filter_var($email,FILTER_VALIDATE_EMAIL);
	}
	if (!$password) {
		$errors .=$missingpassword;
	}else{
		$password=filter_var($password,FILTER_SANITIZE_STRING);
	}
	if (!$password) {
		$errors .=$Invalidpassword;
	}else{
		$password=filter_var($password,FILTER_SANITIZE_STRING);
	}

	if ($errors) {
		$result .=$errors;
		echo $result;
	}else{
		//if no errors
		$email=mysqli_real_escape_string($link,$email);
		$password=mysqli_real_escape_string($link,$password);


	
	    $sql="SELECT * FROM users WHERE Email='{$email}'";
		$select_sql=mysqli_query($link,$sql);
		 if (!$select_sql) {

    	 echo "Please Enter Valid email and password";

    }
      
        while ($row=mysqli_fetch_array($select_sql)) {
    	$db_id = $row['user_id'];
    	$db_firstname= $row['FirstName'];
    	$db_lastname= $row['LastName'];
    	$db_username= $row['UserName'];
    	$db_email= $row['Email'];
    	$db_password= $row['password'];
    
    }
    if ($db_email===$email && $db_password===$password) {
    	 $_SESSION['UserName']=$db_username;
         $_SESSION['FirstName']=$db_firstname;
         $_SESSION['LastName']=$db_lastname;
         $_SESSION['Email']=$db_email;

         header("Location:main.php");
    }else{
    	
    	header("Location:index.php");
    }

}
}


?>
	<div class="main-container">
		<div class="header">
			<h2>Login</h2>
			
		</div>
		<form action="" method="post">
			<div class="md">
				<label>Email:</label></br></br>
				<input type="email" name="email" placeholder="Enter Email"></br></br>
			</div>
			<div class="md">
				<label>Password:</label></br></br>
				<input type="password" name="password" placeholder="Enter Password"></br>
			</div>
             </br>
             <div class="md">
			<input type="submit" name="login" value="Login">
			<a href="register.php">signup</a>

          		</div>	
		</form>
	</div>


</body>
</html>