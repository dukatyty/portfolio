<?php
	setcookie('user',$user['name'],time()-30000,"/");
	header('location: login.php');
?>