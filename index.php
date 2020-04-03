<?php
    session_start();
    require 'db.php';
?>

<!DOCTYPE html>
<html>
    
<head>
    <title > Homepage </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style_index.css" />
    <link rel="stylesheet" type="text/css" href="hor_nav_&_footer.css" />
    <link rel="stylesheet" type="text/css" href="ver_nav.css" />
</head>
    
<body>
    <!-- Header -->
    <header>
        <img src="Images/130163_orig.jpg" width="1335" height="340px" >
        <img src="Images/profile%20pic.jpg" />
        <h2> Mr. Nursadul Mamun </h2>
    </header>
        
    <!-- Horizontal Naigation Bar -->
    <div class="hor_nav">
        <ul>
            <li > <a href="index.php"> <div class="active"> Home </div> </a> 
                <?php    // to show link for admin homepage while admin is logged in
                    if (isset($_SESSION['admin_logged_in']) AND $_SESSION['admin_logged_in'] = 'true') {
                        echo " <ul> <li > <a href='admin/admin.php'> <div> ADMIN Homapage </div> </a> </li> </ul> ";
                    }
                ?>
            </li>
            <li > <a href=" "> <div> Teaching </div> </a>
                <ul>
                    <li> <a href="graduation.php"> <div> Graduation </div> </a> </li>
                    <li> <a href="undergrad.php"> <div> Undergraduation </div> </a> </li>
                </ul>
            </li>
            <li> <a href="reasearch.php"> <div> Research </div> </a> </li>
            <li> <a href="publication.php"> <div> Publications </div> </a> </li>
        </ul>
    </div>
    
    <div class="middle">
        <!-- Vertical Naigation Bar -->
        <div id="ver_nav_id" class="ver_nav" >
            <ul>
                <li> <a target="_blank" href="http://cuet.ac.bd"> <div> CUET </div>  </a> </li>
                <li> <a href="login-system/log-in.php"> <div> Log in </div> </a> </li>
                <li> <a href="login-system/sign-in.php"> <div> Sign up </div> </a> </li>
                <li> <a href=" "> <div> About ME </div> </a> </li>
                <li> <a href="mailto:nursad49@gmail.com ">
                        <abbr title="Direct Mail to ADMIN"> <div> Contact </div> </abbr>  
                </a> </li>
                <li> <a href="https://google.com" target="_blank"> <div> Search </div> </a> </li>
            </ul>
        </div>

        <!-- Slideshow -->
        <div class="slideshow">
            <video width="650px" height="370px" autoplay loop>
                <source src="Video/vdo.mp4" type="video/mp4"> 
            </video>

        </div>

        <!-- Noticeboard -->
        <div class="noticeboard">
            <h2> Noticeboard </h2> 
            <div class="textarea"> 
                <?php
                    $sql = $mysqli->query("SELECT notice_home FROM `admin_info` WHERE active=1");
                    if($sql->num_rows > 0 ){
                        $result = $sql->fetch_assoc();
                        echo "<p> $result[notice_home] </p>";
                    }
                    else
                        echo "<p> No notice . </p>";
                ?>
            </div>
        </div>
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