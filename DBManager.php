<html>
<head>
<title>PokemonDB - DBManager</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<div id="login">
<input type="submit" value="Log out" name="logoutButton" />
</div>
<?php
session_start();
echo "Welcome ". $_SESSION['trainer_ID'];
// Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "pokemondb");

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>
</html>
