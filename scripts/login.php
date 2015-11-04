<?php
session_start();
	if(isset($_POST['loginString'])) 
	{
		$login=$_POST['loginString'];
		if ($login=='') 
			{ 
				unset($login);
			}
	}

	if(isset($_POST['passwordString'])) 
	{
		$password=$_POST['passwordString'];
		if ($password=='') 
			{ 
				unset($password);
			}
	}
	

	if(empty($login) or empty($password))
	{
    	exit ("Not all required fields are filled.");
	}

	$login = stripslashes($login);
    $login = htmlspecialchars($login);
    $login = trim($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
    $password = trim($password);

    $encryptedPassword = md5(1290*3+$password);

    include ("bd.php");
    $loginCheckResult = mysql_query("SELECT * FROM d_user WHERE login='$login'", $db);
    $loginCheckRow = mysql_fetch_array($loginCheckResult);
    if(empty($loginCheckRow['password']) && !empty($loginCheckRow['login']))
    {
    	exit ("Incorrect password.");
    }
    else
    {
    	if($loginCheckRow['password']==$encryptedPassword)
    	{
    		$_SESSION['login']=$loginCheckRow['login'];
    		$_SESSION['password']=$loginCheckRow['password'];
    		header( 'Refresh: 0; url=../index.php' );
			echo "Login success.";
    	}
    	else
    	{
    		exit("Login or password are incorrect.");
    	}
    }
?>