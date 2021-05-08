<head>
 </head>
 <body>
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";
$namee=$_POST["username"];
$passw=$_POST["password"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$s= "select*from user where username='$namee'";
$result=mysqli_query($conn,$s);
$num=mysqli_num_rows($result);
if($num==1)
{
	echo "username already exist";
}
else {


$sql = "INSERT INTO user ( username, password)
VALUES ('$namee', '$passw')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

mysqli_close($conn);
?>