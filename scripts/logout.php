<?php
session_start();
if(empty($_SESSION['login']) or empty($_SESSION['password']))
{
	echo "You are not logged in. <p><a href=../index.php>Home</a>";
}
else
{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	//echo "You succesfully leaved the account. <a href=index.php>Home</a>";
	header('Refresh: 0; URL=../index.php'); //redirect с задержкой 
	echo 'Good bye!';
}

?>