<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="http://172.17.26.86/oc/sources/css/index.css">
</head>
<body>
<form method="post">
	<div class="su">
		<a href="http://172.17.26.86/oc/register.php">Sign Up</a>
	</div>
<center>
	<br>
	<div class="te">
		<input type="text"  id="un" name="uname" placeholder="Username"/>
		<br>
		<div id="uerror" style="display:none" >
			<br>
			<font color="#ff9999">Enter UserName</font>
		</div>
		<br>
		<input type="password"  id="pw" name="pwd" placeholder="Password"/>
		<br>
		<br>
		<div id="perror" style="display:none" >
			<br>
			<font color="#ff9999">Enter Password</font>
		</div>
		<input type="submit" name="sub" value ="Login" onclick="return validate();"/>
		
		<div id="allerror">

<?php

$servername = "localhost";
$username = "root";
$password = "Admin";
$con = new mysqli($servername, $username, $password,"loginusers");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }




if(isset($_POST['sub']))
{

 $usern=$_POST['uname'];
 $passw=$_POST['pwd'];
$fname="Hello";
	
	$sql ="select * from cusers where uname='$usern' and pwd='$passw'";
	$result = mysqli_query($con,$sql);
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    		$fname=  $row[2]; 

	}
	$count = mysqli_num_rows($result);

	if($count>0)
	{
		session_start();
		$_SESSION["uname"] = $usern;
		$_SESSION["fname"] = $fname;
		header("location: workpage.php");
	}
	else
	{
	echo "Incorrect username/password";	
	}


} 

?>
		</div>
	</div>
</form>

</center>
</body>
<script type = "text/javascript" src = "http://172.17.26.86/oc/sources/lib/jquery.min.js"> </script>
<script type = "text/javascript" language = "javascript">
function validate()
{
	var t1 = $('#un').val();
	var t2 = $('#pw').val();
	if((t1=="")||(t2==""))
	{
		document.getElementById('allerror').innerHTML="Fill all Information";
		return false;
	}

}

$('#un').blur(function() {    
   var textBox = $('#un').val();
   if (textBox == "") {
       $("#uerror").show('slow');
   }
   else
   {
	$("#uerror").hide('slow');
    }
});

$('#pw').blur(function() {    
   var textBox = $('#pw').val();
   if (textBox == "") {
       $("#perror").show('slow');
   }
   else
   {
	$("#perror").hide('slow');
    }
});
</script>
</html>


