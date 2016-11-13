<?php
		session_start();
		$uname = $_SESSION["uname"];		
$servername = "localhost";
$username = "root";
$password = "Admin";
$_SESSION["tresult"]=666;
$con = new mysqli($servername, $username, $password,"loginusers");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

	$sql ="select qno from userlevel where uname='$uname'";
	$result = mysqli_query($con,$sql);
	
	$row=mysqli_fetch_assoc($result);

       	$qno=$row["qno"];
	$_SESSION["qno"]=$qno;

	if(!($fp=fopen("/var/www/oc/questions/".$qno."/q.txt","r")))
	{
			header("location:/oc/comingsoon.html");	
	}
	else
	{
			while(!feof($fp))
			{
			$myline=fgets($fp);
			echo "<font size=4>$myline</font>";
			}
	}
			fclose($fp);
?>
