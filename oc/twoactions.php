<?php
session_start();
$_SESSION["tresult"]=666;
$txt = $_REQUEST['name'];
$ar  = $_REQUEST['argu'];
$my_file = $_SESSION["qno"].".c";
$pathh=$_SESSION["uname"];
$qno=$_SESSION["qno"];
$oldmask = umask(0);
file_put_contents($pathh."/".$my_file, $txt);
exec("gcc -o ".$pathh."/"."Output ".$pathh."/"."$my_file 2>".$pathh."/"."cresult.txt");
$ress=$pathh."/cresult.txt";
if (filesize($ress) == 0)
{
		$varr1="timelimit -t 2 ".$pathh."/./Output <  /var/www/oc/questions/".$qno."/sin.txt >".$pathh."/Output.txt";
		exec($varr1);		
		$checkk=filesize($pathh."/Output.txt");		
		if($checkk==0)
		{
			exit("There is no output");
		}		

			exec("cmp /var/www/oc/questions/".$qno."/sout.txt ".$pathh."/Output.txt > ".$pathh."/cmpresult.txt");
			$cmpres=filesize($pathh."/cmpresult.txt");
			
			if ($cmpres == 0)
			{
				if(!($fp=fopen($pathh."/Output.txt","r")))
				exit("Unable to open Output.txt");
				while(!feof($fp))
				{
				$myline=fgets($fp);
				//echo "<h3>$myline</h3>";
				echo "Successfully completed";
				}
				fclose($fp);
		
				$varr1=$pathh."/./Output <  /var/www/oc/questions/".$qno."/t1in.txt >".$pathh."/Output.txt";
				exec($varr1);
				exec("cmp /var/www/oc/questions/".$qno."/t1out.txt ".$pathh."/Output.txt > ".$pathh."/t1cmpresult.txt");
				$t1res=filesize($pathh."/t1cmpresult.txt");
				
				if($t1res==0)
				{
					echo "<br><h3>Testcase 1 Success";
				}
				else
				{
					echo "<br><h3>Testcase 1 Failed";
				}


				$varr1=$pathh."/./Output <  /var/www/oc/questions/".$qno."/t2in.txt >".$pathh."/Output.txt";
				exec($varr1);
				exec("r /var/www/oc/questions/".$qno."/t2out.txt ".$pathh."/Output.txt > ".$pathh."/t2cmpresult.txt");
				$t2res=filesize($pathh."/t2cmpresult.txt");

				if($t2res==0)
				{
					echo "<br><h3>Testcase 2 Success</h3>";
				}
				else
				{
					echo "<br><h3>Testcase 2 Failed</h3>";
				}

				$varr1=$pathh."/./Output <  /var/www/oc/questions/".$qno."/t3in.txt >".$pathh."/Output.txt";
				exec($varr1);
				exec("cmp /var/www/oc/questions/".$qno."/t3out.txt ".$pathh."/Output.txt > ".$pathh."/t3cmpresult.txt");
				$t3res=filesize($pathh."/t3cmpresult.txt");

				if($t3res==0)
				{
					echo "<h3>Testcase 3 Success</h3>";
				}
				else
				{
					echo "<h3>Testcase 3 Failed</h3>";		
				}			
				if(($t1res==0)&&($t2res==0)&&($t3res==0))
				{
					$_SESSION["tresult"]=555;
				}
				else
				{
					$_SESSION["tresult"]=666;
				}
			}
			else
			{
				if(!($fp=fopen($pathh."/"."Output.txt","r")))
				exit("Unable to open file");
				while(!feof($fp))
				{
				$myline=fgets($fp);
				echo "<h3>$myline</h3>";
				}
				fclose($fp);
					$_SESSION["tresult"]=666;

			}
}
else
{
		if(!($fp=fopen($pathh."/"."cresult.txt","r")))
			exit("Unable to open file");
			while(!feof($fp))
			{
			$myline=fgets($fp);
			echo "<h3>$myline</h3>";
			}
			fclose($fp);
			$_SESSION["tresult"]=666;
}
umask($oldmask);
?> 
