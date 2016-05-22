<?php
	error_reporting(E_ALL);
	require 'DataBase.php';
	require 'library.php';
	require 'safe.php';
	$configArr = Array('host'=>'121.199.77.83','port'=>3306,'user'=>'root','password'=>'yzbt123','dbname'=>'yzbt_db');
	$mysql = new DataBase($configArr);
?>