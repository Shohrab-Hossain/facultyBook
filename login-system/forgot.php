<?php  /* Reset your password form, sends reset.php password link */
require '../db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $id = $mysqli->escape_string($_POST['id']);
    $result = $mysqli->query("SELECT * FROM `student_accounts` WHERE students_id='$id'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "User with that ID doesn't exist!";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)
        $user = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
                               . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link';
        $message_body = '
            Hello '.$first_name.',

            You have requested password reset!

            Please click this link to reset your password:

            http://faculty.cuetwebprojects.com/login-system/reset.php?email='.$email.'&hash='.$hash.'';  
            
        mail($to, $subject, $message_body);

        header("location: success.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <div class="form">

        <h1>Reset Your Password</h1>

        <form action="forgot.php" method="post">
            <div class="field-wrap">
                <!-- <label>
                    Email Address<span class="req">*</span>
                </label> -->
                <input type="number"required placeholder="Student's ID" autocomplete="off" name="id"/>
            </div>
            <button class="button button-block"/>Reset</button>
        </form>
    </div>
          
</body>
</html>