<?php 
	if (isset($_POST['loginString'])) 
	{ 
		$login = $_POST['loginString']; 
		if ($login == '') 
		{ 
			unset($login);
		} 
	} 

	if (empty($login))
    {
    	exit ("Not all required fields are filled.");
    }

    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $login = trim($login);

    include("bd.php");
    $queryResult = mysql_query("SELECT * FROM d_user WHERE login='$login'",$db);
    $queryResultArray = mysql_fetch_array($queryResult);
    echo $login;
	if (empty($queryResultArray['id'])) 
    {
    	exit ("Sorry, entered login is incorrect.111");
    }

    $encrypt = md5(1290*3+$queryResultArray['login']);
	$message = "Your password reset link send to your e-mail address.";
	$to=$queryResultArray['email'];
	$subject="Forget Password";
	$from = 'gilnuom@gmail.com';
	$body='Hi, <br/> <br/>Your Membership ID is '.$queryResultArray['id'].' <br><br>Click here to reset your password http://localhost:8888/taskplanner/reset.php?login=$login&encrypt='.$encrypt.'&action=reset';
	$headers = "From: " . strip_tags($from) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($to,$subject,$body,$headers);

 ?>