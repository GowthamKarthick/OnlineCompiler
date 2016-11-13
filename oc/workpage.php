<html>
<title>Online Compiler</title>
<head>
<link href="http://172.17.26.86/oc/sources/css/jquery.numberedtextarea.css" rel="stylesheet" type="text/css">
<link href="http://172.17.26.86/oc/sources/css/workpage.css" rel="stylesheet" type="text/css">
</head>
<body> 
<?php
		session_start();
		$uname = $_SESSION["uname"];
		if($uname=='')
		{
		header("location:/oc/index.php");
		}

?>


		<form method = "post">
		<div class="mainnn">
		<div class="mainn">
			<div class="logo" >
			<img src="http://172.17.26.86/oc/sources/images/clogo.png" height="70" width="90"></img>
			</div><br>
			<div class="cc" ><br>
			<label onclick="drop_down()" class="dropbtn"><?php echo $_SESSION["fname"];?></label><br>
				  <div id="myDropdown" class="dropdown-content">
				    <a href="http://172.17.26.86/oc/logout.php">Sign Out</a>
				  </div>
			</div>
		</div> 
<br>
		</div>
		<div class="fontcolo">
			<div class="mc">
			<h3>Question</h3>
			<div id="ques"></div>
			<h3>Sample Input</h3>
			<div id="sinput"></div>
			<h3>Sample Output</h3>
			<div id="soutput"></div>
			<div id="explain"></div>
		</div>
		<script type = "text/javascript" 
			 src = "http://172.17.26.86/oc/sources/lib/jquery.min.js"></script>
		
		      <script type = "text/javascript" language = "javascript">
			 
			$(document).ready(function() {

			    $("#driver").click(function(event){
			       var name = $("#name").val();
			       $("#outputarea").load('twoactions.php', {"name":name} );
				var ts=$_SESSION["tresult"];
			
			    });
			    

				$(window).bind("load",function(){ $("#ques").load('quesload.php',{})
				});

				$(window).bind("load",function(){ $("#sinput").load('sinput.php')
				});

				$(window).bind("load",function(){ $("#soutput").load('soutput.php')
				});
				$(window).bind("load",function(){ $("#explain").load('explain.php')
				});
				$(window).bind("load",function(){ $("#name").load('scodeload.php')
				});
	
					       
		});






function drop_down() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
		      </script>
		   </head>
	
		   <body>
		<br>





		<h2>Be The First To Solve It!</h2>

		      <textarea onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}" id="name" rows="20" cols="50" class="form-control" spellcheck="false"></textarea>
<script src="http://172.17.26.86/oc/sources/lib/jquery.min.js"></script>
<script src="http://172.17.26.86/oc/sources/lib/jquery.numberedtextarea.js"></script>
<script>
$('textarea').numberedtextarea();
</script>




<br>
		      <div id = "outputarea">
		      </div>		

</div>
      <input class="rc" type = "button" id = "driver" value = "Run Program" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form action="workpage.php" method = "post">
	<input class="rc" type="submit" name="fsubmit" value = "Submit Code"/>
</form>

<?php

if(isset($_POST['fsubmit']))
{
	session_start();
		$servername = "localhost";
		$username = "root";
		$password = "Admin";


		$con = new mysqli($servername, $username, $password,"loginusers");
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

	$tresultt=$_SESSION["tresult"];
	$pathh=$_SESSION["uname"];
	if($tresultt==555)
	{
		
		$sql ="update userlevel set qno=qno+1 where uname='$pathh'";
		mysqli_query($con,$sql);
		$_SESSION["tresult"]=666;


	}
	else
	{
		echo "<h2>You Have to pass All Test Cases</h2 >";

	}
$sql ="select qno from userlevel where uname='$uname'";
	$result = mysqli_query($con,$sql);
	
	$row=mysqli_fetch_assoc($result);

       	$qno=$row["qno"];

	if(!($fp=fopen("/var/www/oc/questions/".$qno."/q.txt","r")))
	{
			header("location:/oc/comingsoon.html");	
	}
}

?>
</body>
</html>

