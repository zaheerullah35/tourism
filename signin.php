<!DOCTYPE HTML>
<head>
    
    </head>
<body>
<center>
<head><h1><b>Welcome to touring website</b></h1></head><br>
<head><h2><b>Welcome to SignUp page</b></h2></head><br>
	<form method="post">
		
   	<input type="text"  name="email" placeholder="Enter email" required><br>

   	<input type="password"  name="password" placeholder="Enter Password" required><br>
  	 <input name="submit" type="submit"  value="login"><br>

		<p>New User? <a href="signup.php">Register Here</a></p></center>

</form>
</body>
</html>
<?php
session_start();
include_once("tourismdatabase.php");
extract($_POST);
if(isset($submit))
{
	$query = "SELECT id FROM user WHERE `email` = ? AND `password` = ?";
	$statement = $conn->prepare($query);
	$statement->bindValue(1, $email);
	$statement->bindValue(2, $password);
	if(!$statement->execute()){
		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	$result = $statement->fetch(PDO::FETCH_COLUMN);
	if(!$result){ ?>
		<center><p class="w3-center w3-text-red">Invalid user name or password please try again</p><center>
	<?php 
	return;
	}

		$_SESSION["UserId"] = $result;
	header("Location: login.php");

	
}			
?>

