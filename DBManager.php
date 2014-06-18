<html>
<head>
<title>PokemonDB - DBManager</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<center>
<?php
	ob_start();
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
<p><button><a href="dbmanager.php" style="text-decoration: none">Admin</a></button>

<?php
echo "<br>";
if (!session_id()) session_start();
if (!$_SESSION['trainer_ID']){ 
    header("Location:/pokemondb");
    die();
}

echo "Welcome ". $_SESSION['trainer_ID'].". You are accessing the administrator page.";
// Create connection
	$con=mysqli_connect("localhost","dbmanager", "pokemon", "pokemondb");

// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>

<form name="gymleaders" method="post" action="DBManager.php">
Trainer Manager: <br>
<form name="search" method="post" action="DBManager.php">
<table>
<td><input type="radio" name="tlist" value="all">All Trainers</td>
<td><input type="radio" name="tlist" value="gymLeader">Gym Leaders Only</td>
</table>
<input type="submit" name="search" value="Search" />
</form>
<form name="addtrainers" method="post" action="DBManager.php">
Insert Trainer: <br>
Trainer Name: <input type="text" name="TName" placeholder="Trainer Name"><br>
Gender: <select name="TGender">
	<option value="Male">Male</option>
	<option value="Female">Female</option>
	</select><br>
Hometown: <select name="THometown">
		<option value=""> Select</option>
<?php	
	$list = mysqli_query($con, "SELECT * FROM Area ORDER BY name");
	while ($row_list = mysqli_fetch_array($list)) {
?> 
	<option value="<?php echo $row_list['name']; ?>">
	<?php echo $row_list['name'];?> </option>
<?php
	}
?>
	</select><br>
<input type="hidden" name="operation" value="inserting" />
<input type="hidden" name="updating" value="yes" />
<input type="submit" name="Trainers" value="Update" />
</form>

<form name="removetrainers" method="post" action="DBManager.php" >
Remove Trainer: <br>
ID of the Trainer to be removed:
<input type="text" name="TrainerID" placeholder="Trainer ID"><br>
<input type="hidden" name="operation" value="removing" />
<input type="hidden" name="updating" value="yes" />
<input type="submit" name="Trainers" value="Update" />
</form>

<form name="winloss" method="post" action="DBManager.php" >
Update Record of Trainer <select name="trainer">
		<option value=""> Select</option>
<?php	
	$list = mysqli_query($con, "SELECT * FROM Trainer ORDER BY trainer_ID");
	while ($row_list = mysqli_fetch_array($list)) {
?> 
	<option value="<?php echo $row_list['trainer_ID']; ?>">
	<?php echo $row_list['trainer_ID'];?> </option>
<?php
	}
?>
	</select>
Wins: <input type="number" name="TWin" min="0"/>
Losses: <input type="number" name="TLoss" min="0"/>
<input type="hidden" name="operation" value="winloss" />
<input type="hidden" name="updating" value="yes" />
<input type="submit" name="Trainers" value="Update" />
</form>

<?php
	 $query = "SELECT * FROM Trainer"; 
	 $result = mysqli_query($con, $query);
	 
	 $query2 = "SELECT * FROM Trainer T, GymLeader G WHERE T.trainer_ID = G.trainer_ID";
	 $result2 = mysqli_query($con, $query2);
	 
	 if ($result === FALSE) {
		echo "Error, can't find trainer data from DBManager.";
		die(mysql_error());
	}
	
	 if ($result2 === FALSE) {
		echo "Error, can't find trainer data from DBManager.";
		die(mysql_error());
	}
	
 if ($_POST['tlist'] == 'all'){
	echo "Trainer Listing:<br>
	<table border='1'>
	<tr>
	<th>Trainer Image</th>
	<th>Trainer ID</th>
	<th>Name</th>
	<th>Gender</th>
	<th>Hometown</th>
	<th>Wins</th></th>
	<th>Losses</th>
	</tr>";
	}
	else {
	echo "Gym Leader Listing:<br>
	<table border='1'>
	<tr>
	<th>Trainer Image</th>
	<th>Trainer ID</th>
	<th>Name</th>
	<th>Gender</th>
	<th>Hometown</th>
	<th>Gym</th>
	<th>Badge</th>
	<th>Wins</th></th>
	<th>Losses</th>
	</tr>";
	}


	 //And we display the results 
 if ($_POST['tlist'] == 'all'){
	 while($row = mysqli_fetch_array( $result )) 
	 { 
	 echo "<tr>";
	if ( $row['trainer_ID'] != NULL) {
	 echo '<td><img src="img/' . $row['trainer_ID'] . '.png"</td>';}
	 else { echo "<td>"; }
	 echo "<td>" . $row['trainer_ID'] . "</td>"; 
	 echo "<td>" . $row['TName'] . "</td>"; 
	 echo "<td>" . $row['TGender'] . "</td>"; 
	 echo "<td>" . $row['THometown'] . "</td>";
	 echo "<td>" . $row['TWin'] . "</td>"; 
	 echo "<td>" . $row['TLoss'] . "</td>"; 
	 echo "</tr>";
	 }
	}
	else {
	while($row = mysqli_fetch_array( $result2 )) 
	 { 
	 echo "<tr>";
	if ( $row['trainer_ID'] != NULL) {
	 echo '<td><img src="img/' . $row['trainer_ID'] . '.png"</td>';}
	 else { echo "<td>"; }
	 echo "<td>" . $row['trainer_ID'] . "</td>"; 
	 echo "<td>" . $row['TName'] . "</td>"; 
	 echo "<td>" . $row['TGender'] . "</td>"; 
	 echo "<td>" . $row['THometown'] . "</td>";
	 echo "<td>" . $row['gymName'] . "</td>";
	 echo "<td>" . $row['badge'] . "</td>";
	 echo "<td>" . $row['TWin'] . "</td>"; 
	 echo "<td>" . $row['TLoss'] . "</td>"; 
	 echo "</tr>";
	 }
	}
		 	 
	 echo "</table>";
	if (!isset($_POST['updating'])){
		$updating = 'no';
	} else {
		$updating = $_POST['updating'];
	}
	if ($updating == 'yes') {
		$action = $_POST['operation'];
		if ($action == NULL) {
		} else if ($action == 'inserting') {
			$TName = $_POST['TName'];
			$TGender = $_POST['TGender'];
			$THometown = $_POST['THometown'];
//			echo "INSERT INTO Trainer (TName, TGender, THometown, TWin, TLoss, Img)
//				VALUES ('$TName', '$TGender', '$THometown', 0, 0, NULL)";
			$query = "INSERT INTO Trainer (TName, TGender, THometown, TWin, TLoss, Img)
				VALUES ('$TName', '$TGender', '$THometown', 0, 0, NULL)";
			mysqli_query($con, $query);
			if (!mysqli_commit($con)) {
				print("Transaction commit failed\n");
				exit();
			}
		} else if ($action == 'removing') {
			$TID = $_POST['TrainerID'];
			$query = "DELETE FROM Trainer WHERE Trainer_ID = '$TID'";
			mysqli_query($con, $query);
			if (!mysqli_commit($con)) {
				print("Transaction commit failed\n");
				exit();
			}
		} else if ($action == 'winloss') {
			$Wins = $_POST['TWin'];
			$Losses = $_POST['TLoss'];
			$TID = $_POST['trainer'];
			if (!($Wins == NULL)) {
				$query = "UPDATE trainer SET TWin = '$Wins' WHERE trainer_ID = '$TID'";
				mysqli_query($con, $query);
				if (!mysqli_commit($con)) {
				print("Transaction commit failed\n");
				exit();
				}
			}
			if (!($Losses == NULL)) {
				$query = "UPDATE trainer SET TLoss = '$Losses' WHERE trainer_ID = '$TID'";
				mysqli_query($con, $query);
				if (!mysqli_commit($con)) {
				print("Transaction commit failed\n");
				exit();
				}
			}
		}

		header("Location:DBManager.php");
	} 
	ob_flush();
?>
</center>
</body>
</html>
