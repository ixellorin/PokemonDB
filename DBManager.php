<html>
<head>
If you see this, it works (probably)...
// <link rel="stylesheet" type="text/css" href="template.css"/>
</head>

<body>

<?php
// Create connection
	$con=mysqli_connect("localhost","DBManager","pokemon","PokemonDB");

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
// Create database
	$sql="CREATE DATABASE PokemonDB";
	if (mysqli_query($con,$sql)) {
  		echo "Database PokemonDB created successfully";
	} else {
  		echo "Error creating database: " . mysqli_error($con);
	}
	
// Create table
	$sql="CREATE TABLE Trainer(trainer_id INT, TName VARCHAR(30), TGender VARCHAR(6), THometown VARCHAR(30), TWin INT, TLoss INT)";

// Execute query
	if (mysqli_query($con,$sql)) {
  		echo "Table Trainer created successfully";
	} else {
  		echo "Error creating table: " . mysqli_error($con);
	}
?>
</html>
