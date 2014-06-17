<html>
<head>
<title>PokemonDB - Logging Out</title>
<link rel="stylesheet" type="text/css" href="template.css"/>
</head>
<body>
<div id="login">
</div>
<center>
<?php
session_start();
session_destroy();
echo "You have logged out. Returning you to homepage.";
echo "<script>setTimeout(\"location.href = '/pokemondb';\",1500);</script>";
die();
?>
</center>
</html>