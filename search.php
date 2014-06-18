<html>
<head>
<title>PokemonDB - Search Results</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<center>
<?php
    session_start();
    if(!isset($_SESSION['trainer_ID']))
    {
?>

<div id="login">
  <form method="POST" action="index.php">
    User: <input type="text" name="username" size="14" maxlength="30" placeholder="Trainer ID" />
    Password: <input type="password" name="password" size="14" maxlength="30" />
    <input type="submit" value="Log In" name="loginButton" />
  </form>
</div>

<?php 
    }
    else
    {
?>

<div id="login">
	You are logged in.
	<button><a href="logout.php" style="text-decoration: none">Log Out</a></button>
</div>

<?php
	}
?>

<a href="index.php"><img src="PokemonLogo.png"></a>

<?php
echo "<br>";
?>

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


<p> Show me the types 
<select name = "type">
	<option value="Normal">Normal</option>
	<option value="Fighting">Fighting</option>
	<option value="Flying">Flying</option>
	<option value="Poison">Poison</option>
	<option value="Ground">Ground</option>
	<option value="Rock">Rock</option>
	<option value="Bug">Bug</option>
	<option value="Ghost">Ghost</option>
	<option value="Fire">Fire</option>
	<option value="Water">Water</option>
	<option value="Grass">Grass</option>
	<option value="Electric">Electric</option>
	<option value="Psychic">Psychic</option>
	<option value="Ice">Ice</option>
	<option value="Dragon">Dragon</option>	
</select>	
	is 
<select name = "weak_or_strong">
	<option value="(S)">strong</option>
	<option value="(W)">weak</option>
</select>
	against when 
<select name = "attack_or_defend">
	<option value="attacking">attacking</option>
	<option value="defending">defending</option>
</select>

<?php

 $searching = $_POST['searching'];
 $find = $_POST['find'];
 $category = $_POST['category'];
 $matchup_category = $_POST['matchup_category'];
 

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


}
 
 
 $query = "SELECT * FROM Pokemon WHERE $category LIKE'%$find%'"; 
 $result = mysqli_query($con, $query);
 
 if ($result === FALSE) {
	echo "Error, can't find user data from DBManager.";
	die(mysql_error());
}

$totalquery = "SELECT Count(*) as total FROM Pokemon WHERE $category LIKE'%$find%'"; 
$totalresult = mysqli_query($con, $totalquery);
 while($totalrow = mysqli_fetch_array( $totalresult )) 
 { 
 echo '<h2>Search Results: ' . $totalrow['total'] . ' Pokemon Found</h2>' ; 
 }

 //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
 $anymatches=mysqli_num_rows($result); 
 if ($anymatches == 0) 
 { 
 echo "No Pokemon match those characteristics.<br><br>"; 
 } 
 else {
echo "<table border='1'>
<tr>
<th>Image</th>
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
 echo '<td><img src="img/' . $row['PSpecies'] . '.png"</td>'; 
 echo "<td>" . $row['Pokemon_ID'] . "</td>"; 
 echo "<td>" . $row['PName'] . "</td>"; 
 echo "<td>" . $row['PTID'] . "</td>"; 
 echo "<td>" . $row['aName'] . "</td>"; 
 echo "<td>" . $row['Ptype'] . "</td>"; 
 echo "<td>" . $row['PSpecies'] . "</td>"; 
 echo "</tr>";
 } 
 
echo "</table>";
 
}

 ?>
 </center>
 </html>
