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

	<?php include("header.php"); ?>
	<form action= "post.php" method = "POST">
	<center>
		<br />
		Topic name:<br /><input type="text" name="topic_name" style ="width: 400px;" ><br />	
		Content: <br />
		<textarea style="resize: none; width: 400px; height: 300px" name="con">
		</textarea>
		<br /><br />
		<input type="submit" name="submit" value="Post" style="width: 100px">	
	</center>
    </form>
	<body>
		
	</body>


		
</html>
<?php

	$topic_name = @$_POST['topic_name'];
	$content = @$_POST['con'];
	$date = date("Y-m-d");

    echo  $_SESSION["username"],'</ br>';
	echo "$topic_name",'<br />';
	echo "$content",'<br />';
	echo "$date",'<br />';;

	if(isset($_POST['submit']))
	{
		if($topic_name && $content)
		{
			if(strlen($topic_name) >= 10 && strlen($topic_name) <= 70)
			{
				if($query = mysql_query("INSERT INTO topics(topic_id,topic_name,topic_content,topic_creator,post_date) VALUES ('','".$topic_name."','".$content."','".$_SESSION["username"]."','".$date."')"))
				{
					echo "Success.";
				}
				else
				{
					echo "Failure.";
				}	
			}	
			else
			{
				echo "Topic length must be between 10 to 70 characters long.";
			}	
		}
		else
		{
			echo "Please fill in the blank filed";
		}	
	}	


	
	if(@$_GET['action'] == "logout"){  

		session_destroy();
		header("Location: login.php");
	}

	}
	else
	{
		echo "You must logged in.";
	}
?>