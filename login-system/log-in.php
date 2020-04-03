<?php /* Main page with form: log in */
require '../db.php';
session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
    
}
?>

<!DOCTYPE html>
<html>
    
<head>
    
    <title>Log in</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
</head>
    
<body>
    
    <div class="form">
      
        <ul class="tab-group">
            <li class="tab"><a href="sign-in.php">Sign Up</a></li>
            <li class="tab active"><a href="log-in.php">Log In</a></li>
        </ul>
      
        <div class="tab-content"> 
            
            <div id="login">   
                <?php  
                    if( isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] = 'true' )
                        echo "<h1>You already Logged in.</h1>";
                    elseif( isset($_SESSION['admin_logged_in']) AND $_SESSION['admin_logged_in'] = 'true' )
                        echo "<h1>You already Logged in.</h1>";
                    else
                        echo "<h1>Welcome !</h1>";
                ?>
                
                <form action="log-in.php" method="post" autocomplete="off">
                    <div class="field-wrap">
                        <!--<label>
                            Student's ID<span class="req">*</span>
                        </label> -->
                        <input type="number"required placeholder="Student's ID" autocomplete="off" name="user_id"/>
                    </div>

                    <div class="field-wrap">
                        <!-- <label>
                            Password<span class="req">*</span>
                        </label> -->
                        <input type="password" required placeholder="Password" autocomplete="off" name="password"/>
                    </div>

                    <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>

                    <button class="button button-block" name="login" />Log In</button>
                
                    <h1> <a href="../index.php">Home</a> </h1>
            
                </form>
            </div>
        
        </div><!-- tab-content -->
      
    </div> <!-- /form -->

</body>
</html>