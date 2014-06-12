<html>
<head>
// Feel free to change this up... Just basing off what I'm googling
// <link rel="stylesheet" type="text/css" href="template.css"/>
</head>

<body>

<?php
	$success = true;
		$db_conn = OCILogon("ora_d4k8", "a36520120", "ug");
		
		function executePlainSQL($cmdstr) {
			global $db_conn, $success;
			$statement = OCIParse($db_conn, $cmdstr);
		
		if (!$statement) {
			echo "<br>Cannot parse the command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn);
			echo htmlentities($e['message']);
			$success = False;
		}

		$r = OCIExecute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the command: " . $cmdstr . "<br>";
			$e = oci_error($statement);
			echo htmlentities($e['message']);
			$success = False;
		} 

		return $statement;
		}
		
?>

<form method="post" action="DBManager.php?inserttrainer" id ="insert">
Add New Trainer: <br>
<input type="text" name="trainer_id" value="Trainer ID"/>
<input type="text" name="TName" value="Name"/><br>
<input type="text" name="TGender" value="Gender"/><br>
<input type="text" name="THometown" value="Hometown"/><br>
<input type="text" name="TRecord" value="Record"/><br>

<select name="trainerStatus">
<option value="Gym">Gym</option>
</select>
<input type="submit" name="insertSubmit" value="insert"/>
</form>
<?php

?>
</html>