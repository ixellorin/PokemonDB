<html>
<head>
<title>PokemonDB - DBManager</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<div id="login">
	You are logged in.
	<button><a href="logout.php" style="text-decoration: none">Log Out</a></button>
</div>
<a href="dbmanager.php"><img src="PokemonLogo.png"></a>
<?php
session_start();
if (!session_id()) session_start();
if (!$_SESSION['trainer_ID']){ 
    header("Location:/pokemondb");
    die();
}
echo "Welcome ". $_SESSION['trainer_ID'];
// Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "pokemondb");

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>

<form name="search" method="post" action="search.php">
<input type="text" name="find" placeholder="Search Pokemon" />
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>
</html>
