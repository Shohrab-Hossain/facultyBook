<?php /* Main page with form: log in */
require 'db.php';
session_start();

if (isset($_SESSION['admin_logged_in']) AND $_SESSION['admin_logged_in'] = 'true') {
    
}
else{
    $_SESSION['message'] = "You must log in before viewing this page !!";
    header("location: error.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['update_notice'])){
        $o = $_POST['notice'];
        $mysqli->query("UPDATE `admin_info` SET notice_home='$o' WHERE active='1'") or die($mysqli->error);
    }
}
?>

<!DOCTYPE html>
<html>
    
<head>
    <title > Welcome ADMIN </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="admin.css" />
    <link rel="stylesheet" type="text/css" href="hor_nav.css" />
</head>
    
<body>  
    <!-- Horizontal Naigation Bar -->
    <div class="hor_nav">
        <ul>
            <li > <a href=" "> <div class="active"> ADMIN Homepage </div> </a> </li>
            <li> <a href="online_sub.php"> <div> Online Submission </div> </a> </li>
            <li> <a href="students_info.php"> <div> Students' Info </div> </a> </li>
            <li > <a href=" "> <div> ADMIN Profile </div> </a>
                <ul>
                    <li> <a href="..//index.php"> <div> Website Homepage </div> </a> </li>
                    <li> <a href="logout.php"> <div> Log Out </div> </a> </li>
                </ul>
            </li>
        </ul>
    </div>
    
    <div class="form">
        <form action="admin.php" method="post">
            
            <div class="field-wrap"> <textarea rows="16" cols="25" name="notice" placeholder="New Notice" ></textarea>  </div>
            
            
            <div class="field-wrap"><button name="update_notice" class='button button-block' name='view'>UPDATE Notice</button></div>
        </form>
    </div>
    
    <div class="formm">
        <div class="tab-content"> 
                <h1> Update Profile </h1>
                <form action="sign-in.php" method="post" autocomplete="off">
                        <div class="field-wrapp">
                            <input type="text" required placeholder="First Name" autocomplete="off" name='firstname' />
                        </div>

                        <div class="field-wrapp">
                            <input type="text"required placeholder="Last Name" autocomplete="off" name='lastname' />
                        </div>

                    <div class="field-wrapp">
                        <input type="email"required placeholder="Email Address" autocomplete="off" name='email' />
                    </div>
                    
                    <div class="field-wrapp">
                        <input type="password"required placeholder="Set Password" autocomplete="off" name='password'/>
                    </div>
                    
                    <div class="field-wrapp">
                        <input type="password"required placeholder="Confirm Password" autocomplete="off" name='confirm_password'/>
                    </div>
          
          
                    <button type="submit" class="button button-block" name="register" />update profile</button>
          
                </form>

            </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    
</body>
</html>