<html>
<head>
<title>PokemonDB - Search Results</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<div id="login">
  <form method="POST" action="index.php">
        User: <input type="text" name="username" size="14" maxlength="30" placeholder="Trainer ID" />
    Password: <input type="password" name="password" size="14" maxlength="30" />
    <input type="submit" value="Log In" name="loginButton" />
  </form>
</div>

<a href="index.php"><img src="PokemonLogo.png"></a>

<form name="search" method="post" action="search.php">
<input type="text" name="find" placeholder="Search Pokemon" />
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>

<?php
session_start();

 //This is only displayed if they have submitted the form 
 if ($searching =="yes") 
 { 
 echo "<h2>Search Results</h2><p>"; 
  
 // Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "PokemonDB") or die;

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
 
 // We preform a bit of filtering 
 $find = strtoupper($find); 
 $find = strip_tags($find); 
 $find = trim ($find); 
 
 //Now we search for our search term, in the field the user specified 
 $data = "SELECT * FROM Pokemon WHERE upper($field) LIKE'%$find%'"; 
 
 //And we display the results 
 while($result = mysqli_fetch_array( $data )) 
 { 
 echo $result['Pokemon_ID']; 
 echo " "; 
 echo $result['PName']; 
 echo "<br>"; 
 echo $result['PTID']; 
 echo "<br>";
 echo $result['aName']; 
 echo "<br>";
 echo $result['Ptype']; 
 echo "<br>";
 echo $result['PSpecies']; 
 echo "<br>";  
 echo "<br>"; 
 } 
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysqli_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo "No results<br><br>"; 
 } 
 } 
 ?> 
 </html>