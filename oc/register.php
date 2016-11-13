<html>

<head>
<link href="http://172.17.26.86/oc/sources/css/register.css" rel="stylesheet" type="text/css">
<title>Registration</title>
<script type = "text/javascript" src = "http://172.17.26.86/oc/sources/lib/jquery.min.js"> </script>

</script>


</head>
<body>
<form method="post">
<br>
<div class="te">
<center>
<input type="text" size="20"  id="fn" name="fname" placeholder="First name" style="text-align:center">
<input type="text" size="20"  id="ln" name="lname"  placeholder="Last name" style="text-align:center">
<div id="ferror" style="display:none">
<br>
<font color="#ff9999">Enter First Name</font>
</div>
<div id="lerror" style="display:none">
<br>
<font color="#ff9999">Enter Last Name</font>
</div>
<br>
<br>

<input type="text" id="mid" size="47" name="use" placeholder="Mail id /User Name">

<div id="eerror" style="display:none">
<br>
<font color="#ff9999">Enter Email id</font>
</div>


<br>
<br>
<input type="password" id="np" size="47" name="npwd" placeholder="New Password"/>


<div id="nerror" style="display:none">
<font color="#ff9999">Enter New pasword</font>
</div>


<br>
<br>
<input type="password" id="cp" size="47" name="pas" placeholder="Confirm Password"/>

<div id="cerror" style="display:none" >
<font color="#ff9999">Enter Confirm password</font>
</div>


<br>
<br>
<input type="submit" id="reg" name="reg" value ="Register" onclick="return validate();"/>
<div id="allerror">
<br>
</div>

</div>
</form>
<script type = "text/javascript" language = "javascript">
function validate()
{
	var t1 = $('#fn').val();
	var t2 = $('#ln').val();
	var t3 = $('#mid').val();
	var t4 = $('#np').val();
	var t5 = $('#cp').val();
	if((t1=="")||(t3=="")||(t4=="")||(t5=="")||(t2==""))
	{
		document.getElementById('allerror').innerHTML="Fill all Information";
		return false;
	}
	if(t4!=t5)
	{
		document.getElementById('allerror').innerHTML="New password does not match Confirm password.";
		return false;
	}

}


$('#fn').blur(function() {    
   var textBox = $('#fn').val();
   if (textBox == "") {
       $("#ferror").show('slow');
   }
   else
   {
	$("#ferror").hide('slow');
    }
});

$('#ln').blur(function() {    
   var textBox = $('#ln').val();
   if (textBox == "") {
       $("#lerror").show('slow');
   }
   else
   {
	$("#lerror").hide('slow');
    }
});

$('#mid').blur(function() {    
   var textBox = $('#mid').val();
   if (textBox == "") {
       $("#eerror").show('slow');
   }
   else
   {
	$("#eerror").hide('slow');
    }
});

$('#np').blur(function() {    
   var textBox = $('#np').val();
   if (textBox == "") {
       $("#nerror").show('slow');
   }
   else
   {
	$("#nerror").hide('slow');
    }
});

$('#cp').blur(function() {    
   var textBox = $('#cp').val();
   if (textBox == "") {
       $("#cerror").show('slow');
   }
   else
   {
	$("#cerror").hide('slow');
    }
});


</script>

<?php
$servername = "localhost";
$username = "root";
$password = "Admin";
$con = new mysqli($servername, $username, $password,"loginusers");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


if(isset($_POST['reg']))
{

 $usern=$_POST['use'];
 $passw=$_POST['pas'];
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];
	

	$sql ="select * from cusers where uname='$usern' and pwd='$passw'";
	$result = mysqli_query($con,$sql);
	$sql="INSERT INTO cusers VALUES ('".$usern."','".$passw."','".$fname."','".$lname."')";
	
		if($con->query($sql)==TRUE)
		{

			session_start();
			$_SESSION["uname"] = $usern;
			$_SESSION["fname"] = $fname;
			header("location: workpage.php");
			$oldmask = umask(0);
			mkdir($usern,0777,true);
			umask($oldmask);		
			echo "Succesfully registerted";
		}
		else
		{
			echo "<center><font color= #f9999>Username Already Exists Try with Someother</font></center>";
		}

}

?>
</body>
</html>


