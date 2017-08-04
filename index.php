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
	<?php echo '<table border="1px;">'; ?>
		<tr>
			<td width="80px;" style = "text-align: center;">
			<span>ID</span>
			</td>
			<td width="400px;" style = "text-align: center;">
			Name
			</td>
			<td width="80px;" style = "text-align: center;">
			Views
			</td> 
			<td width="100px;" style = "text-align; center;">
			Creator
			</td>		
			<td width="90px;" style = "text-align; center;">
			Date	
			</td>	
		</tr>	
	
		
		
</html>
<?php


    $check = mysql_query("SELECT * FROM topics");

    if(!@$_GET['date'])
    {	
	    if(mysql_num_rows($check)!=0)
	    {
	    	while($row = mysql_fetch_assoc($check))
	    	{
	    		$id = $row['topic_id'];
	    		echo "<td>".$row['topic_id']."</td>";
	    		echo "<td style = 'text-align: center'><a href='topic.php?id=$id'>".$row['topic_name']."</td>";
	    		echo "<td>".$row['topic_id']."</td>";
	    		$check_u=mysql_query("SELECT * FROM users 
	    			WHERE user_name ='".$row['topic_creator']."'");
	    		while($row_u = mysql_fetch_assoc($check_u))
	    		{
	    			$user_id = $row_u['user_id'];
	    		}	
	    		echo "<td><a href='profile.php?id=$user_id'>".$row['topic_creator']."</a></td>";
	    		$get_post_date = $row['post_date'];
	    		echo "<td><a href='index.php?date=$get_post_date'>".$row['post_date']."</a></td>";
	    		//echo "<td>".$row['post_date']."</td>";
	    	}	

	    }
	    else
	    {
	    	echo "No topic found.";
	    }
	}    	

	    

    if(@$_GET['date'])
    {
    	$check_d = mysql_query("SELECT * FROM topics WHERE post_date='".$_GET['date']."'");

    	while($row_d = mysql_fetch_assoc($check_d))
    	{
    		$id = $row_d['topic_id'];
    		echo "<td>".$row_d['topic_id']."</td>";
	    	echo "<td style = 'text-align: center'><a href='topic.php?id=$id'>".$row_d['topic_name']."</td>";
	    	echo "<td>".$row_d['topic_id']."</td>";
	    	$check_u=mysql_query("SELECT * FROM users 
	    			WHERE user_name ='".$row_d['topic_creator']."'");
	    	while($row_u = mysql_fetch_assoc($check_u))
	    	{
	    		$user_id = $row_u['user_id'];
	    	}	
	    	echo "<td><a href='profile.php?id=$user_id'>".$row_d['topic_creator']."</a></td>";
	    	$get_post_date = $row_d['post_date'];
	    	echo "<td><a href='index.php?date=$get_post_date'>".$row_d['post_date']."</a></td>";
    	}
    }
    echo "</table>";	
	
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