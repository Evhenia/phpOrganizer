<?php
	if (isset($_POST['loginString'])) 
	{ 
		$login = $_POST['loginString']; 
		if ($login == '') 
		{ 
			unset($login);
		} 
	} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	if (isset($_POST['emailString'])) 
	{ 
		$email=$_POST['emailString']; 
        if ($email =='') 
		{ 
			unset($email);
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
    }
    
    if (empty($login) or empty($email) or empty($password) or empty($passwordCheck)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    	exit ("Not all required fields are filled.");
    }

    if($password!= $passwordCheck)
    {
        exit ("Passwords are not equal. Please, try again.");
    }

    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $login = trim($login);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $email = trim($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $password = trim($password);

    $encryptedPassword = md5(1290*3+$password);
    
    include("bd.php");
    $dbLoginCheckResult = mysql_query("SELECT id FROM d_user WHERE login='$login'",$db);
    $dbLoginCheckRow = mysql_fetch_array($dbLoginCheckResult);
    if (!empty($dbLoginCheckRow['id'])) 
    {
    	exit ("Sorry, entered login is already in use.");
    }

    $dbEmailCheckResult = mysql_query("SELECT email FROM d_user WHERE email='$email'",$db);
    $dbEmailCheckRow = mysql_fetch_array($dbEmailCheckResult);
    if (!empty($dbEmailCheckRow['id'])) 
    {
        exit ("Sorry, entered email is already in use.");
    }
    $userRegistration = mysql_query ("INSERT INTO d_user (login,password,email) VALUES('$login','$encryptedPassword', '$email')");
    // Проверяем, есть ли ошибки
    if ($userRegistration=='TRUE')
    {
    	echo "You've completed registration."; 
    }
 	else {
    	echo "Unexpected error.";
    }
    echo '<p><a href = "../index.php">Main page</a>';
?>   