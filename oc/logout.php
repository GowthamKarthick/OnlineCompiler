<?php
session_start(); 
session_destroy(); 
header("location:/oc/index.php");
exit();
?>
