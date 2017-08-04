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


	<body>
		<?php include("header.php"); ?>
	</body>

	<center>
	<br />
		<a href="post.php"><button>Post topic</button></a>
	<br />
	<br />
	<?php
			if($_GET["id"])
			{
				$check = mysql_query("SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");
				//echo $topic_creator;
				if(mysql_num_rows($check))
				{
					while($row = mysql_fetch_assoc($check))
					{
						$check_u = mysql_query("SELECT * FROM users WHERE user_name ='".$row['topic_creator']."'");
						while($row_u = mysql_fetch_assoc($check_u))
						{
							$get_user_id = $row_u['user_id'];
						}
						echo "<h2>".$row['topic_name']."</h2>";
						echo "<h5>By <a href='profile.php?id=$get_user_id'>".$row['topic_creator'].'</a>',"</h5>";
						echo "<h5>Date: ".$row['post_date']."<h5>",'<br />';
						echo "<h4>".$row['topic_content']."<h4>",'<br />';
						
					}
				}
				else
				{
					echo "topic not found";
				}
				
			}
			else
			{
				header("Location: index.php");
				echo "not found.";
				
			}	

	?>
	<body>
	</body>
		
		
</html>
<?php


	}
	else
	{
		echo "You must logged in.";
	}
?>