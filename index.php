<html>
<head>
<title>PokemonDB</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<div id="login">
  <form method="POST" action="<?php htmlspecialchars("PHP_SELF", ENT_QUOTES,"UTF-8"); ?>">
    User: <input type="text" name="username" size="14" maxlength="30" />
    Password: <input type="password" name="password" size="14" maxlength="30" />
    <input type="submit" value="Log In" name="loginButton" />
  </form>
</div>

<?php
echo "Welcome to the PokemonDB";
echo "<br>";
	
session_start();
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$username=htmlspecialchars($_POST['username'],ENT_QUOTES,"UTF-8"); 
	$password=htmlspecialchars($_POST['password'],ENT_QUOTES,"UTF-8");
 
// Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "PokemonDB") or die;

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
  
// Execute query
	$query ="SELECT trainer_ID, db_password FROM DBManager WHERE trainer_ID='$username' and db_password='$password'";
	$result = mysqli_query($con, $query);
	
	// Error checking
	if ($result === FALSE) {
		echo "Error, can't find user data from DBManager.";
		die(mysql_error());
	}

	while($row = mysqli_fetch_array($result)){
		if($_POST['username']==$row['trainer_ID'] && $_POST['password']==$row['db_password']){
			$_SESSION['trainer_ID']=$username;
			header("Location:DBManager.php");
		}
		else {
			echo "Incorrect user or password.";
		}
	} 
}
?>

<form name="search" method="post" action="<?=$PHP_SELF?>">
Seach: <input type="text" name="find" />
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>
</html>