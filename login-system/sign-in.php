<?php /* Main page with form: log in */
require '../db.php';
session_start();

$pass_error = null ;
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Make sure the two passwords match
    if ( $_POST['password'] == $_POST['confirm_password'] ) 
    { 

        $result = $mysqli->query("SELECT `key` FROM `admin_info` WHERE ID='admin'");
        $key = $result->fetch_assoc();
        
        if($_POST['key'] == $key['key'] )
        {
            if (isset($_POST['register']))
            { //user registering
                $pass_error = null ;
                require 'register.php';
            }    
    
        }
        else
            $pass_error = 'key' ;
        
    }
    else  
        $pass_error = 'pass' ;
    
}
?>

<!DOCTYPE html>
<html>
    
<head>
    
    <title>Sign in</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
</head>
    
<body>
    
    <div class="form">
      
        <ul class="tab-group">
            <li class="tab active"><a href="sign-in.php">Sign Up</a></li>
            <li class="tab"><a href="log-in.php">Log In</a></li>
        </ul>
      
        <div class="tab-content"> 
    
            <div id="signup">   
                <?php  
                    if( $pass_error == null )
                        echo "<h1>Sign Up for Free</h1>";
                    elseif( $pass_error == 'pass' )
                        echo '<p><div class="info">Password dont match.<br> Please enter same password</div></p>' ;
                    elseif( $pass_error == 'key' )
                        echo '<p><div class="info">KEY dont match.<br> Please enter an authorised KEY*</div></p>' ;
                ?>

                <form action="sign-in.php" method="post" autocomplete="off">

                    <div class="top-row">
                        <div class="field-wrap">
                            <input type="text" required placeholder="First Name*" autocomplete="off" name='firstname' />
                        </div>

                        <div class="field-wrap">
                            <input type="text"required placeholder="Last Name*" autocomplete="off" name='lastname' />
                        </div>
                    </div>

                    <div class="field-wrap">
                        <input type="email"required placeholder="Email Address*" autocomplete="off" name='email' />
                    </div>
                    
                    <div class="field-wrap">
                        <input type="number" required placeholder="Mobile number*" autocomplete="off" name='cell_number' />
                    </div>
                    
                    <div class="top-row">
                        <div class="field-wrap">
                            <input type="number" required placeholder="Student's ID*" autocomplete="off" name='student_id' />
                        </div>

                        <div class="field-wrap">
                            <input type="text"required placeholder="Key*" autocomplete="off" name='key' />
                        </div>
                    </div>
          
                    <div class="field-wrap">
                        <input type="password"required placeholder="Set Password*" autocomplete="off" name='password'/>
                    </div>
                    
                    <div class="field-wrap">
                        <input type="password"required placeholder="Confirm Password*" autocomplete="off" name='confirm_password'/>
                    </div>
          
          
                    <button type="submit" class="button button-block" name="register" />Register</button>
                
                    <h1> <a href="../index.php">Home</a> </h1>
          
                </form>

            </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
 
</body>
</html>