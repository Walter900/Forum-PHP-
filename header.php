<?php

	if(@$_SESSION['username']){
?>


<center><a href= "index.php">Home page</a> |
        <a href = "account.php">My accout</a> |
        <a href = "member.php">Members</a> | 
        <?php   
        $check = mysql_query("SELECT * FROM users WHERE user_name='".$_SESSION['username']."'");
        $rows = mysql_num_rows($check);
        while($row = mysql_fetch_assoc($check))
        {
        	$id = $row['user_id'];
        }

        echo "Logged in as <a href='profile.php?id=$id'>" ; 
        echo @$_SESSION['username']." </a> |";
        ?> 
        <a href = "index.php?action=logout">Logout</a></center>

<?php

	}
	else
	{
		header("Location: login.php");
	}	
?>