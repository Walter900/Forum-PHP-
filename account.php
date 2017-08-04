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

	<body>
	<center>
	<p>	
	<?php
		$check = mysql_query("SELECT * FROM users WHERE user_name='".$_SESSION['username']."'");
        $rows = mysql_num_rows($check);
        while($row = mysql_fetch_assoc($check))
        {
        	$username = $row['user_name'];
        	$id = $row['user_id'];
        	$email = $row['user_email'];
        	$date = $row['register_date'];
        	$replies = $row['replies'];
        	$topic = $row['topic'];
        	$score = $row['score'];
        	$prof_pic = $row['users_profile_pic'];
        }
	?>
	<?php echo "<img src='' width='70' height='70'>"; ?><br />
	Username:<?php echo "  ".$username; ?><br />
	ID:<?php echo "  ".$id; ?><br />
	Email:<?php echo "  ".$email; ?><br />
	Date registered:<?php echo "  ".$date; ?><br />
	Replices:<?php echo "  ".$replies; ?><br />
	Score(sor):<?php echo "  ".$score; ?><br />
	Topics:<?php echo "  ".$topic; ?><br /><br />
	<a href = 'account.php?action=cp'>Change password</a> |
	<a href = 'account.php?action=ci'>Change profile image</a>
	</center>
	</body>
</html>

<?php

	
		if(@$_GET['action'] == "logout"){  
			session_destroy();
			header("Location: login.php");
		}

		if(@$_GET['action'] == "cp" )
		{
			echo "<form action = 'account.php?action=cp' method='POST'><center>";
			echo "
			Current password: <input type='text' name='current_password'><br/>
			New password: <input type='password' name='new_password'><br/>
		    Re-type password: <input type='password' name='Re_type_password'><br/><br/>
			<input type = 'submit' name = 'change_pwd' value='submit'><br/>
			";
            $current_password_mid = @$_POST['current_password'];
            $new_password_mid = @$_POST['new_password'];
            $re_type_password_mid = @$_POST['Re_type_password'];
			if(isset($_POST['change_pwd']))
			{
				$check = mysql_query("SELECT * FROM users WHERE user_name='".$_SESSION['username']."'");
				$rows = mysql_num_rows($check);
				while($row = mysql_fetch_assoc($check))
				{
					$get_pass = $row['user_pwd'];
				}
                //the input current password should be corrct password
				if( sha1($current_password_mid) == $get_pass  )
				{
					    //password length must be longer than 6 character
						if(strlen($new_password_mid) > 6 )
						{
							//the new password should match to th re-type password
							if( $new_password_mid == $re_type_password_mid )
							{
								if( $new_password_mid == $current_password_mid  )
								{
									echo "new password is same as current password.<br />";
								}
								//hidden the new password
								$hidden_new_password = sha1($new_password_mid);
								if($query = mysql_query("UPDATE users SET user_pwd = '$hidden_new_password'  WHERE user_name = '".$_SESSION['username']."'"))
								{
									echo "Reset password success.";
								}	
								else
								{
									echo "Reset failed.";
								}   


							}	
							else
							{
								echo "New password is not match to re type password.";
							}	
						}
						else
						{
							echo "New password must be longer than 6 characters.";
						}	

				}
				else
				{
					echo "Password is incorrect.";
				}
				
			}

		}


		if(@$_GET['action'] == "ci")
	    {
	    	echo '<form action = "account.php?action=ci"method="POST" enctype="multipart/form-data">
	    	<center><br />
	    	Available file extension: <b>.PNG .JPG. JPEG</b><br /><br />
	    	<input type="file" name="image"><br />
	    	<input type="submit" name="change_pic" value="Change"><br/>
	    	';
	    	if(isset($_POST['change_pic']))
	    	{
	    		$errors = array();
	    		$allowed_e = array('png','jpg','jpeg');

	    		$file_name = $_FILES['image']['name'];
	    		$file_e = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	    		$file_s = $_FILES['image']['size'];
	    		$file_tmp = $_FILES['image']['tmp_name'];

	    		if(in_array($file_e, $allowed_e)==false)
	    		{
	    			$errors[] = 'This file extention is not allowed.';
	    		}
 
	    		if($file_s > 2097152)
	    		{
	    			$errors[]='File must be under 2mb';
	    		}

	    		if(empty($errors))
	    		{
	    			move_uploaded_file($file_tmp, 'image/' .$file_name);
	    			$image_up = 'image/' .$file_name;
	    			/*
	    			$chech = mysql_query("SELECT * FROM users WHERE user_name ='"
	    				.@$_SESSION['username']."'"); 
	    			$rows = mysql_num_rows($chech);

	    			while($row = mysql_fetch_assoc($chech))
	    			{
	    			 	$db_image = $row('user_profile_pic');
	    			}
	    			*/
	    			if($query = mysql_query("UPDATE users SET user_profile_pic='".$image_up."' WHERE username ='".$_SESSION['username']."'")
	    			{
	    				echo "Your profile image has changed.";
	    			}
	    			
	    		}
	    		else
	    		{
	    			foreach($errors as $error)
	    			{
	    				echo $error, '<br />';
	    			}
	    		}	



	    	}	

	    	echo '</from></center>';
	    }		

		
		
	   // $check= mysql_query("SELECT * FROM users WHERE user_id ='".$_GET['id']."'");  	
		//	$rows = mysql_num_rows($check);	

	}
	else
	{
		echo "You must logged in.";
	}
?>