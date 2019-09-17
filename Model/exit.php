<?php 
require ("conf.php");
	session_unset();
	session_destroy();

	echo "<script>setTimeout(function(){location.replace('../login.php')},1);</script>";

 ?>