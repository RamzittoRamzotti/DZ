<?php

	$login=filter_var(trim($_POST['login']),
	FILTER_SANITIZE_STRING);

	
	$password=filter_var(trim($_POST['password']),
	FILTER_SANITIZE_STRING);
	
	$password=md5($password);
		

	$mysql = mysqli_connect('localhost','root','','site');
	if (mysqli_connect_errno()){
		echo "Неудалось подключиться к MySQL " . mysqli_connect_error();
	}
	$result = $mysql->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`= '$password'");
	$user=$result->fetch_assoc();
	if(count($user)==0){
		header('Location:/relog.php');
		exit();

	}
	setcookie('admin', $user['admin'],time()+3600,"/");
	setcookie('user',$user['login'],time()+3600,"/");
	
	
	$mysql->close();
	header('Location:/main.php');
?>
