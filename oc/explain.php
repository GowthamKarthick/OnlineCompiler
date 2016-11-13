<?php
		session_start();
		$uname = $_SESSION["uname"];		
$servername = "localhost";
$username = "root";
$password = "Admin";


$con = new mysqli($servername, $username, $password,"loginusers");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

	$sql ="select qno from userlevel where uname='$uname'";
	$result = mysqli_query($con,$sql);
	
	$row=mysqli_fetch_assoc($result);

       	$qno=$row["qno"];

	if(!($fp=fopen("/var/www/oc/questions/".$qno."/explain.txt","r")))
			exit("Question under construction");
			while(!feof($fp))
			{
			$myline=fgets($fp);
			echo "<font size=4>$myline</font>";
			}
			fclose($fp);
?>
