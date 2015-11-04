<?php
session_start();
	include("bd.php");
	$login = $_GET['login'];
	if(isset($_GET['action']))
	{
		if($_GET['action']=="reset")
		{
			$encrypt = $_GET['encrypt'];
			$encryptedLogin = md5(1290*3+$login);
			echo $login."\n";
			echo $encryptedLogin."\n";
			$_SESSION['login']=$login;
	        $result = mysql_query("SELECT * FROM d_user WHERE login='$login'",$db);
	        $resultArray = mysql_fetch_array($result);
			echo $resultArray['login'];
	        if(count($resultArray)>=1)
	        {
	        	if($encryptedLogin == md5(1290*3+$resultArray['login']))
	        	{
	        		echo '<form action="reset.php" method="post">
						<input name="passwordString" type="password" size="15" maxlength="15" placeholder = "Enter password">
						<p>
						<input name="passwordCheckString" type="password" size="15" maxlength="15" placeholder = "Repeat password">
						<p>
						<input type="submit" name="submit" value="Reset">
						<input name = "login" type = "hidden">
					</form>';
	        	}
	        }
	        else
	        {
	            exit ('Invalid key please try again.');
			}
	    }
	}

	if (isset($_POST['passwordString'])) 
    { 
        $password=$_POST['passwordString']; 
        if ($password =='') 
        { 
            unset($password);
        } 
    }

    if (isset($_POST['passwordCheckString'])) 
    { 
        $passwordCheck=$_POST['passwordCheckString']; 
        if ($passwordCheck =='') 
        { 
            unset($passwordCheck);
        } 
    
    
    if (empty($password) or empty($passwordCheck)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    	exit ("Not all required fields are filled.");
    }

    if($password!= $passwordCheck)
    {
        exit ("Passwords are not equal. Please, try again.");
    }

    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $password = trim($password);
    $encryptedPassword = md5(1290*3+$password);
   	$result = mysql_query("SELECT * FROM d_user WHERE login='".$_SESSION['login']."'",$db);
	$resultArray = mysql_fetch_array($result);
	$userID = $resultArray['id'];
    $updateQuery = mysql_query("UPDATE d_user set password='$encryptedPassword' WHERE id='$userID'",$db);
    if ($updateQuery=='TRUE')
    {
    	echo "You've changed your password succesfully."; 
    }
    else
    {
    	exit("Unexpected error");
    }
}

 ?>

