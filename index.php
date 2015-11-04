<?php
session_start();
echo md5(1290*3+'Yevhenia');
?>

<html>
<head>
	<title>Main Page</title>
</head>
<body>
	<center>
		<form action = "scripts/login.php" method = "POST">
			<input name="loginString" type="text" size="15" maxlength="15" placeholder = "Enter login">
			<p>
		    <input name="passwordString" type="text" size="15" maxlength="15" placeholder = "Enter password">
			<p>
		    <input type="submit" name="login" value="Sign in">
			<p>
		    Have not account yet? <a href = "scripts/registration.html">Sign up</a>
		</form>
		<form action="forgot.html" method="post">
		<p>
		Forgot your password?
		<p>
		<input type="submit" name="submit" value="Reset">
	</form>
	</center>

	<form action = "scripts/logout.php" method = "POST">
		<?php 
			if(empty($_SESSION['login']) or empty($_SESSION['password']))
			{
				echo "You are not logged in yet.";
			}

			else {
				echo "Hello, ".$_SESSION['login']."   ";
				echo '<input type="submit" name="logout" value="Log out">';
				echo '<p><a href = "scripts/calendar.php">Calendar</a>';
			}
		 ?>
	</form>
</body>
</html>