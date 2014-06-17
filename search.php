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
<p> Search by:
<select name = "category">
	<option value="Pokemon_ID"> Pokemon ID</option>
	<option value="PName"> Pokemon Name</option>
	<option value="PTID"> Trainer ID</option>
	<option value="aName"> Area</option>
	<option value="Ptype"> Type</option>
	<option value="PSpecies"> Species</option>
</select>


<p> Sort matchups by:
<select name = "matchup_category">
	<option value="attack_type_name"> Attacking Type</option>
	<option value="defend_type_name"> Defending Type</option>
	<option value="Attack_Strong"> Strong Attacks</option>
	<option value="Defend_Strong"> Strong Defends</option>
</select>


<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>




<?php
session_start();

 $searching = $_POST['searching'];
 $find = $_POST['find'];
 $category = $_POST['category'];
 $matchup_category = $_POST['matchup_category'];
 
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
 
  if(preg_match('/^MATCHUP(S)?/', $find)){
  if (preg_match('/^Attack_Strong/', $matchup_category)){
	$query = "SELECT * FROM Matchups Where attack_type_name like '%(S)%' and defend_type_name like '%(W)%' Order by attack_type_name";
	}
  if (preg_match('/^Defend_Strong/', $matchup_category)){
	$query = "SELECT * FROM Matchups Where attack_type_name like '%(W)%' and defend_type_name like '%(S)%' Order by defend_type_name";
	}
	else{
	$query = "SELECT * FROM Matchups ORDER BY $matchup_category";
	}	
	$result = mysqli_query($con, $query);

echo "<table border='1'>
Note: (S) denotes the stronger type, (W) denotes the weaker type
<tr>
<th>Atacking Type</th>
<th>Defending Type</th>
</tr>";

while($row = mysqli_fetch_array( $result )) 
 { 
 echo "<tr>";
 echo "<td>" . $row['attack_type_name'] . "</td>"; 
 echo "<td>" . $row['defend_type_name'] . "</td>"; 
 echo "</tr>";
 } 
echo "</table>
<br>
<br>
<br>";

 $anymatches=mysqli_num_rows($result); 
 if ($anymatches == 0) 
 { 
 echo "No results<br><br>"; 
 } 
}
 
 
 $query = "SELECT * FROM Pokemon WHERE $category LIKE'%$find%'"; 
 $result = mysqli_query($con, $query);
 
 if ($result === FALSE) {
	echo "Error, can't find user data from DBManager.";
	die(mysql_error());
}

echo "<table border='1'>
<tr>
<th>Pokemon_ID</th>
<th>Pokemon Name</th>
<th>Trainer ID</th>
<th>Area Name</th>
<th>Type</th>
<th>Species</th>
</tr>";


 //And we display the results 
 while($row = mysqli_fetch_array( $result )) 
 { 
 echo "<tr>";
 echo "<td>" . $row['Pokemon_ID'] . "</td>"; 
 echo "<td>" . $row['PName'] . "</td>"; 
 echo "<td>" . $row['PTID'] . "</td>"; 
 echo "<td>" . $row['aName'] . "</td>"; 
 echo "<td>" . $row['Ptype'] . "</td>"; 
 echo "<td>" . $row['PSpecies'] . "</td>"; 
 echo "</tr>";
 } 
 
echo "</table>";
 
 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysqli_num_rows($result); 
 if ($anymatches == 0) 
 { 
 echo "No results<br><br>"; 
 } 

 ?> 
 </html>
