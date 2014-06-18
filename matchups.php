<html>
<head>
<title>PokemonDB</title>
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
echo "Welcome to the PokemonDB, trainer.";
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
Show:

<br>
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
<p> Sort the matchups sorted by:
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

<?php
 $matchup_category = $_POST['matchup_category'];
 

 // Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "pokemondb") or die;

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

if ($matchup_category == "Attack_Strong"){
	$query = "SELECT * FROM Matchups Where attack_type_name like '%(S)%' and defend_type_name like '%(W)%' Order by attack_type_name";
	echo "Sorted by Strong Attacks";
	}
  if ($matchup_category == "Defend_Strong"){
	$query = "SELECT * FROM Matchups Where attack_type_name like '%(W)%' and defend_type_name like '%(S)%' Order by defend_type_name";
	echo "Sorted by Strong Defends";
	}
if($matchup_category == ("attack_type_name")){
	$query = "SELECT * FROM Matchups ORDER BY $matchup_category";
	echo "Sorted by attacking type name";
	}	

if($matchup_category == ("defend_type_name")){
	$query = "SELECT * FROM Matchups ORDER BY $matchup_category";
	echo "Sorted by defending type name";
	}
	$result = mysqli_query($con, $query);
	
echo "<br>";
echo "<table border='1'>
Note: (S) denotes the stronger type, (W) denotes the weaker type.
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

?>


</form>
</center>
</html>
