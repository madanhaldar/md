<?php include "db.php";?>


<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h2>Registration</h2>

<?php
$errors="";
$result="";
if (isset($_POST['signup'])) {

	 $firstname=$_POST['firstname'];
	 $lastname=$_POST['lastname'];
	 $username=$_POST['username'];
	 $email=$_POST['email'];
	 $password=$_POST['password'];


	 //errors message
	 $missingfirstname='<p><strong>please enter your firstname:-</strong></P>';
	 $missinglastname='<p><strong>please enter your lastname:-</strong></P>';
	 $missingusername='<p><strong>please enter your username:-</strong></P>';
	 $missingemail='<p><strong>please enter your email:-</strong></P>';
	 $missingpassword='<p><strong>please enter your password:-</strong></P>';

	 if (!$firstname) {
	 	$errors .=$missingfirstname;
	 }else{
	 	$firstname=filter_var($firstname,FILTER_SANITIZE_STRING);
	 }
	 if (!$lastname) {
	 	$errors .=$missinglastname;
	 }else{
	 	$lastname=filter_var($lastname,FILTER_SANITIZE_STRING);
	 }
	 if (!$username) {
	 	$errors .=$missingusername;
	 }else{
	 	$username=filter_var($username,FILTER_SANITIZE_STRING);
	 }
	 if (!$email) {
	 	$errors .=$missingemail;
	 }else{
	 	$email=filter_var($email,FILTER_VALIDATE_EMAIL);
	 }
	 if (!$password) {
	 	$errors .=$missingpassword;
	 }else{
	 	$password=filter_var($password,FILTER_SANITIZE_STRING);
	 }if ($errors) {
	 	 $result .=$errors;
	 	 echo $result;
	 }else{
         // no errors
	 	//if email already in database

		$sql="SELECT * FROM users WHERE Email='{$email}'";
		$result=mysqli_query($link,$sql);
		if (mysqli_num_rows($result)>0) {
			echo "Sorry Email Already taken";
		}else{
          $sql="INSERT INTO users(FirstName,LastName,UserName,Email,password)";
           $sql .="VALUES('{$firstname}', '{$lastname}','{$username}','{$email}','{$password}') ";

    
         $user_sql=mysqli_query($link,$sql);
         if (!$user_sql) {
          	echo "Unable to running Query";
          	header("Location:register.php");
          }else{
          	echo "Data Stored successfully";
          	header("Location:main.php");
          }
	 }

}
}



?>


<div class="main">

	<form action="" method="post">
	
	<div class="md">
		<label for="firstname">FirstName</label></br></br>
		<input type="text" name="firstname" placeholder="Enter your firstname">
	</div>
</br>	
	<div class="md">
		<label for="lastname">LastName</label></br></br>
		<input type="text" name="lastname" placeholder="Enter your LastName">
	</div>
	
</br>

	<div class="md">
		<label for="username">UserName</label></br></br>
		<input type="text" name="username" placeholder="Enter your UserName">
	</div>
</br>	
	<div class="md">
		<label for="email">Email</label></br></br>
		<input type="email" name="email" placeholder="Enter your Email">
	</div>
</br>	
	<div class="md">
		<label for="password">Password</label></br></br>
		<input type="password" name="password" placeholder="Enter your Password">
	</div>
</br>
	<div class="md">
		<input class="button" type="submit" name="signup" value="signup">
		<p style="text-align: center;">Already rgister<a href="index.php"> login</a></p>
	</div>

</form>
</div>
</body>
</html>