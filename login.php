<?php
 
session_start();
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
$username=htmlspecialchars($_POST['username'],ENT_QUOTES,"UTF-8"); 
 
$password=htmlspecialchars($_POST['password'],ENT_QUOTES,"UTF-8");
 
//connect to database
$con=mysqli_connect("localhost","dbmanager", "pokemon", "pokemondb") or die();
  
//execute query
$query ="SELECT username, password from `login` where username='$username' and password='$password'";

$result=mysqli_query($query);
 
while($row = mysqli_fetch_array($result)){
	if($_POST['username']==$row['username'] && $_POST['password']==$row['password'])
	{
		$_SESSION['username']=$username;
		header("Location:DBManager.php");
	}
	else 
	{
		echo "You got credentials wrong";
	}
} 
}
?>
 
<?php
 
session_start();
 
echo "Welcome ". $_SESSION['username'];
 
?>
 
<a href="logout.php">Logout</a>
 
<?php
 
session_destroy();
 
header("Location:login.php");
 
?>