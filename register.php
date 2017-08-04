<html>
<head><title>Resigter a account</title></head>
<body>
    <form action = "register.php" method = "POST">
        Username       :<input type = "text" name = "username">
        <br/>
        Password:<input type = "password" name = "password"><br/>
        Confirm :<input type = "password" name = "repassword"><br/>
        Email   :<input type = "text" name = "email"><br/>
        <input type = "submit" name = "submit" value = "Resgister"> or <a href = 'login.php'>Login</a>
    </form>   
</body>
</html>

<?php
include_once 'connect.php';
$username = @$_POST['username'];
$password = @$_POST['password'];
$repass = @$_POST['repassword'];
$email = @$_POST['email'];
$date = date("Y-m-d");
$pass_hidden = sha1($password);

if(isset($_POST['submit']))
{
    //$sql = "INSERT INTO users(user_first, user_last, user_email, user_uid, user_pwd)
    //     VALUES('$first', '$last', '$email', '$uid', '$pwd');";
    
    if ($username && $password && $repass && $email) 
    {
        if(strlen($username) >= 5 && strlen($username) < 25 && strlen($password) > 5 )
        {
              if($repass == $password)
              {
                  if($query = mysql_query("INSERT INTO users (user_name,user_pwd,user_email, register_date) 
                    VALUES ('$username', '$pass_hidden', '$email','$date')"))
                  {
                      echo "You have been registered as $username. Click <a href = 'login.php'>here</a> to login.";
                  }
                  else
                  {
                      echo "Fail";
                   } 

              }
              else
              {
                  echo "Password do not match.";
              }  

        }
        else
        {
            if(strlen($username) < 5 || strlen($username) > 25 )
            {
                echo "Username must be between 5 and 25 character";
            }   

            if(strlen($password) < 6)
            {
                echo "Password must be no less than 6 charater";
            }

        } 
                  
    }
    else
    {
         echo "Please fill in the fields";
    }
      
   
}   
?>





