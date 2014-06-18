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

<a href="index.php"><img src="PokemonLogo.png"></a>

<?php 
    }
    else
    {
?>

<div id="login">
	You are logged in.
	<button><a href="logout.php" style="text-decoration: none">Log Out</a></button>
</div>

<a href="index.php"><img src="PokemonLogo.png"></a>
<p><button><a href="dbmanager.php" style="text-decoration: none">Admin</a></button>

<?php
	}
?>

<?php
echo "<br>";
?>

<form name="search" method="post" action="search.php">
<input type="text" name="find" placeholder="Search Pokemon" />
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
<p> Search by:
<select name = "category">
	<option value="PSpecies"> Species</option>
	<option value="Pokemon_ID"> Pokemon ID</option>
	<option value="PName"> Pokemon Name</option>
	<option value="PTID"> Trainer ID</option>
	<option value="aName"> Area</option>
	<option value="Ptype"> Type</option>
</select>
<br>
<br>
Show:


<table>
<td><input type="checkbox" name="img" checked="yes"  value="img">Pokemon Image</td>
<td><input type="checkbox" name="id" checked="yes"  value="id">Pokemon ID</td>
<td><td><input type="checkbox" name="name" checked="yes"  value="name">Pokemon Name</td>
<td><input type="checkbox" name="trainer" checked="yes" value="trainer">Trainer ID</td>
<td><input type="checkbox" name="timg" checked="yes" value="timg">Trainer Image</td>
<td><input type="checkbox" name="area" checked="yes" value="area">Area</td>
<td><input type="checkbox" name="ptype" checked="yes" value="ptype">Type</td>
<td><input type="checkbox" name="species" checked="yes" value="species">Species</td>
</table>
</form>


<form name="search" method="post" action="matchups.php"> 
<p> Show Type matchups sorted by:
<select name = "matchup_category">
	<option value="attack_type_name"> Attacking Type</option>
	<option value="defend_type_name"> Defending Type</option>
	<option value="Attack_Strong"> Strong Attacks</option>
	<option value="Defend_Strong"> Strong Defends</option>
</select>
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>


<form name="show" method="post" action="types.php">
<p> Show the types 
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

<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="Search" />
</form>

<form name="show" method="post" action="theverybest.php">
<p> Show me "The Very Best that No One Ever Was" (the trainer who has all the pokemon)
<input type="hidden" name="searching" value="yes" />
<input type="submit" name="search" value="The Very Best that No One Ever Was" />
</form>

<?php

 $searching = $_POST['searching'];
 $find = $_POST['find'];
 $category = $_POST['category'];

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
 if (isset($_POST['img']) && 
 		isset($_POST['id']) && 
 		isset($_POST['name']) && 
 		isset($_POST['trainer']) && 
 		isset($_POST['timg']) && 
 		isset($_POST['area']) && 
 		isset($_POST['ptype']) && 
 		isset($_POST['species'])) 
 $query = "SELECT * FROM Pokemon WHERE $category LIKE'%$find%'";
 
 else {
 	$query = NULL;
 	if (isset($_POST['id'])) {
 	$query = "Pokemon_ID";
 	}
 	if (isset($_POST['name'])) {
 		if ($query == NULL) {
		$query = "PName";
		} 
		else {
		$query = $query . ", PName";
 		}
 	}
 	if (isset($_POST['trainer'])) {
 		if ($query == NULL) {
		$query = "PTID";
		} 
		else {
		$query = $query . ", PTID";
 		}
 	}
 	if (isset($_POST['area'])) {
 		if ($query == NULL) {
		$query = "aName";
		} 
		else {
		$query = $query . ", aName";
 		}
 	}
 	if (isset($_POST['ptype'])) {
 		if ($query == NULL) {
		$query = "Ptype";
		} 
		else {
		$query = $query . ", Ptype";
 		}
 	}
 	if (isset($_POST['species'])) {
 		if ($query == NULL) {
		$query = "PSpecies";
		} 
		else {
		$query = $query . ", PSpecies";
 		}
 	}
 	if (isset($_POST['img'])) {
 		if ($query == NULL) {
		$query = "PImg";
		} 
		else {
		$query = $query . ", PImg";
 		}
 	}
 	if (isset($_POST['timg'])) {
 		if ($query == NULL) {
		$query = "TImg";
		} 
		else {
		$query = $query . ", TImg";
 		}
 	}
 
 
  $query = "select " . $query . " FROM Pokemon WHERE $category LIKE'%$find%'";
 }
 
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
 
 echo "<table border='1'><tr>";


if (isset($_POST['img'])) {
echo "<th>Image</th>";}

if (isset($_POST['id'])) {
echo "<th>Pokemon ID</th>";}

if (isset($_POST['name'])) {
echo "<th>Pokemon Name</th>";}

if (isset($_POST['trainer'])) {
echo "<th>Trainer ID</th>";}

if (isset($_POST['timg'])) {
echo "<th>Trainer Image</th>";}

if (isset($_POST['area'])) {
echo "<th>Area Name</th>";}

if (isset($_POST['ptype'])) {
echo "<th>Type</th>";}

if (isset($_POST['species'])) {
echo "<th>Species</th>";}

echo "</tr>";


 //And we display the results 
 while($row = mysqli_fetch_array( $result )) 
 { 
 echo "<tr>";

 if (isset($_POST['img'])) {
 	if ($row['PImg'] != NULL) {
 	echo '<td><img src="' . $row['PImg'] . '"</td>'; 
 	}
 	else {
 	echo '<td></td>';
 	}
}

if (isset($_POST['id'])) {
echo "<td>" . $row['Pokemon_ID'] . "</td>"; 
}

if (isset($_POST['name'])) {
echo "<td>" . $row['PName'] . "</td>"; 
}

if (isset($_POST['trainer'])) {
 echo "<td>" . $row['PTID'] . "</td>"; }
 
 if (isset($_POST['timg'])) {
 	if ($row['TImg'] != NULL) {
 	echo '<td><img src="' . $row['TImg'] . '"</td>'; 
 	}
 	else {
 	echo '<td></td>';
 	}
}

if (isset($_POST['area'])) {
 echo "<td>" . $row['aName'] . "</td>"; }

if (isset($_POST['ptype'])) {
 echo "<td>" . $row['Ptype'] . "</td>"; }

if (isset($_POST['species'])) {
 echo "<td>" . $row['PSpecies'] . "</td>"; }

 echo "</tr>";
 } 
 
echo "</table>";
}
 ?>
 </center>
 </html>
