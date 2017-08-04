<?php
	session_start();
	require('connect.php');

	if(@$_SESSION["username"])
	{
		
?>

<html>

<head>
	<title>Home page</title>
	</head>
	<center>
	<?php include("header.php");
	if(@$_GET['id'])
	{
		$check= mysql_query("SELECT * FROM users WHERE user_id ='".$_GET['id']."'");  	
		$rows = mysql_num_rows($check);

		if(mysql_num_rows($check) != 0)
		{
			while($row = mysql_fetch_assoc($check))
			{
				echo "<h1>" .$row['user_name']."</h1><img src ='".$row['users_profile_pic']."'width='50' height='50'><br />" ;
				echo "<b>Date registered: </b>".$row['register_date']."<br />";
				echo "<b>Email : </b>".$row['user_email']."<br />";
				echo "<b>Replies : </b>".$row['replies']."<br />";
				echo "<b>topic : </b>".$row['topic']."<br />";
				echo "<b>Score : </b>".$row['score']."<br />";
			}
		}
		else
		{
			echo "ID not found.";
		}	
	 }
	 else
	 {
	    header("Location: index.php");
	  }
	
	?>

	<body>
	</body> 	
</html>
<?php
	
	if(@$_GET['action'] == "logout"){  

		echo "logout";
	}

	}
	else
	{
		echo "You must logged in.";
	}
?>