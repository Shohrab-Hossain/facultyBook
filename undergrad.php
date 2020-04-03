<?php
    session_start();
    require 'db.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title> Undergraduation </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style_undergrad_n.css" />
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
    
    <!-- container -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['select']) ){
                $c = $_POST['select'];
                $_SESSION['db'] = $_POST['select'];
                $qu = $mysqli->query("SELECT * FROM `online_sub` WHERE link_name='$c'");
                $res = $qu->fetch_assoc();
                                
                $_SESSION['notice'] = "Link Name : ' $res[link_name] '  and  About Link : ' $res[about_link] ' selected ";
            }
                    
            if (isset($_POST['submit_online'])){
                if ((isset($_SESSION['logged_in'])) AND $_SESSION['logged_in'] = 'true') {
                    if(isset($_SESSION['db'])){
                        $d = $_SESSION['db'] ;
                        $sql = $mysqli->query("SELECT * FROM `online_sub` WHERE link_name = '$d' ");
                        $result = $sql->fetch_assoc();
                        
                        $rf = "$result[roll_from]";
                        $rt = "$result[roll_to]";
                        
                        $id = $_SESSION['student_id'];
                        
                        if( $id >= $rf and $id <= $rt ){
                            require 'upload.php';
                            unset($_SESSION['db']);
                            unset($_SESSION['notice']);
                            unset($_POST['select']);
                        }
                        else
                            $_SESSION['notice'] = "You are not eligible for this link !!! ";
                        
                    }
                    else{
                        $_SESSION['notice'] = "Please , select a link before submit !!!";
                    }      
                }
                else{
                    $_SESSION['notice'] = "You must log in to submit online !!";
                    
                }
            }
        }
                
    ?>
    
    <!-- online submission -->
    <div class="form">
        <form action="undergrad.php" method="post">
                <h1> Submit Online </h1>
                <ul>
                    <li> <a href=" "> <div > View Links </div> </a>   <!-- View Link Box -->
                        <div class="create_link  view">
                            <h1> View Links </h1>
                            <div class="link_table">
                            <table>
                                <thead>
                                    <tr>
                                        <th> Link Name </th>
                                        <th> About Link </th>
                                        <th> Click </th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                                    <form action="undergrad.php" method="post"> 
                                        <?php
                                            for($i=1 ; $i<1000 ; $i++)
                                            {
                                                $sql = $mysqli->query("SELECT * FROM `online_sub` WHERE id='$i'");

                                                if ( $sql->num_rows > 0 ){
                                                $result = $sql->fetch_assoc();
                                                echo "<tr>
                                                        <td> $result[link_name]  </td>
                                                        <td> $result[about_link] </td>
                                                        <td> <button class='view_button' name='select' value='$result[link_name]'> select </button> </td>
                                                      </tr>" ;    
                                                }
                                            }
                                        ?>
                                    </form>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </li>
                </ul>
                <form action="undergrad.php" method="post" enctype="multipart/form-data">
                    <h4><?php
                        if(isset($_SESSION['notice']) and !empty($_SESSION['notice']) ){
                            echo $_SESSION['notice'];
                        }
                    ?></h4>
                    <div class="field-wrap"> <input type="file" name="file"/> </div>
                    <button class="button button-block" name="submit_online"> submit </button>
                </form>
            </div> 
        </form>
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