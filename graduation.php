<?php
    session_start();
    require 'db.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title> Graduation </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style_graduation.css" >
    <link rel="stylesheet" type="text/css" href="hor_nav_&_footer.css" />
</head>

<body>
    
    <!-- Horizontal Naigation Bar -->
    <div class="hor_nav">
        <ul>
            <li > <a href="index.php"> <div> Home </div> </a> 
                <?php    // to show link for admin homepage while admin is logged in
                    if (isset($_SESSION['admin_logged_in']) AND $_SESSION['admin_logged_in'] = 'true') {
                        echo " <ul> <li > <a href='admin/admin.php'> <div> ADMIN Homapage </div> </a> </li> </ul> ";
                    }
                ?>
            </li>
            <li > <a href=" "> <div class="active" > Teaching </div> </a>
                <ul>
                    <li> <a href="graduation.php"> <div> Graduation </div> </a> </li>
                    <li> <a href="undergrad.php"> <div> Undergraduation </div> </a> </li>
                </ul>
            </li>
            <li> <a href="reasearch.php"> <div> Research </div> </a> </li>
            <li> <a href="publication.php"> <div> Publications </div> </a> </li>
        </ul>
    </div>
    
   <!-- Footer -->
    <footer>
        <div> 
            <h4>
                <> by &copy; 
                <a href="mailto:shohrab003@gmail.com"> <span> Shohrab Hossain [1408003] </span> </a> and 
                <a href="mailto:afnanaksh@gmail.com"> <span> Afnan Ahmed Akash [1408004] </span> </a> </br>
                
                <p> supervised by 
                    <a href="mailto: "> <span> Md. Sabir Hossain </span> </a> and 
                    <a href="mailto: "> <span> Md. Shafiul Alam </span> </a> 
                </p>
            </h4>
        </div>
    </footer>
    
</body>
</html>