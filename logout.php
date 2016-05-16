<?php
    session_unset();
    session_destroy();
	$_SESSION['userid']="";
    header("Location:main.php");
?>

