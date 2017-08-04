<html>

<head><title>Login with your account</title></head>

<body>
	<form action = 'login.php' method = 'POST'>
		Username:<input type = "text" name = "username"><br />
		Password:<input type = "password" name = "password"><br />
		<input type = "submit" value = "Login" name = "submit">
	</form>
</body>
</html>

<?php
session_start();
include_once 'connect.php';
$username = @$_POST['username'];
$password = @$_POST['password'];

if(isset($_POST['submit']))
{
	if($username && $password)
	{
		$check = mysql_query("SELECT * FROM users WHERE user_name = '$username'");  

		if(mysql_num_rows($check) != 0)
		{
			while($row = mysql_fetch_assoc($check))
			{ 
				$db_username = $row['user_name'];
				$db_password = $row['user_pwd'];
			}

			if($username == $db_username && sha1($password) == $db_password)
			{
				@$_SESSION["username"] = $username; 
				header("Location: index.php");
				echo "Logged in.";
			}
			else
			{
				echo "Your password is wrong.";
			}	
		}
		else
		{
			die("Couldn't find the username.");
		}	

	}
	else
	{
		echo "Please fill in blank";
	}	
}


?>		