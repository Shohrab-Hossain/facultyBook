<?php /* Main page with form: log in */
require 'db.php';
session_start();

unset($_SESSION['message']);

if (isset($_SESSION['admin_logged_in']) AND $_SESSION['admin_logged_in'] = 'true') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (isset($_POST['create'])) { //updating link

            // Escape all $_POST variables to protect against SQL injections
            $link_name = $mysqli->escape_string($_POST['link_name']);
            $about_link = $mysqli->escape_string($_POST['about_link']);
            $roll_from = $mysqli->escape_string($_POST['roll_from']);
            $roll_to = $mysqli->escape_string($_POST['roll_to']);
            $dead_line = $mysqli->escape_string($_POST['dead_line']);
            $radio = $mysqli->escape_string($_POST['radio']);
            
            // Check if user with same link_name already exists
            $result = $mysqli->query("SELECT * FROM `online_sub` WHERE link_name='$link_name'") or die($mysqli->error());

            // We know user email exists if the rows returned are more than 0
            if ( $result->num_rows > 0 ) {
    
                $_SESSION['message'] = 'Link Name already exists!';
                
    
            }
            else { // Email doesn't already exist in a database, proceed...

                $sql = "INSERT INTO `online_sub` (link_name, about_link, roll_from, roll_to, dead_line, radio) " 
                     . "VALUES ( '$link_name', '$about_link', '$roll_from', '$roll_to', '$dead_line' , '$radio')";

                // Add user to the database
                $mysqli->query($sql);
                
                // Initializing new database for new link
                $sql_n = "CREATE TABLE `shohrab`.`$link_name` ( 
                    `id` INT(11) NOT NULL AUTO_INCREMENT , 
                    `students_id` INT(11) NOT NULL , 
                    `date_time` DATETIME(6) NOT NULL , 
                    `file` MEDIUMBLOB NOT NULL ,
                    `file_name` varchar(100) NOT NULL,
                    `file_type` varchar(30) NOT NULL,
                    `file_size` int(11) NOT NULL,
                    PRIMARY KEY (`id`) ) ENGINE = InnoDB";
                
                // creating new database for new link
                $mysqli->query($sql_n);
            }
        }
    
    }
}
else{
    $_SESSION['message'] = "You must log in before viewing this page !!";
    header("location: error.php");
}

?>

<!DOCTYPE html>
<html>
    
<head>
    <title > Online Submission </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="hor_nav.css" />
    <link rel="stylesheet" type="text/css" href="ver_nav.css" />
    <link rel="stylesheet" type="text/css" href="chart.css" />
</head>
    
<body>  
    <!-- Horizontal Naigation Bar -->
    <div class="hor_nav">
        <ul>
            <li > <a href="admin.php"> <div> ADMIN Homepage </div> </a> </li>
            <li> <a href="online_sub.php"> <div class="active"> Online Submission </div> </a> </li>
            <li> <a href="students_info.php"> <div> Students' Info </div> </a> </li>
            <li > <a href=" "> <div> ADMIN Profile </div> </a>
                <ul>
                    <li> <a href="..//index.php"> <div> Website Homepage </div> </a> </li>
                    <li> <a href="logout.php"> <div> Log Out </div> </a> </li>
                </ul>
            </li>
        </ul>
    </div>
    
    <!-- Container -->
    <!-- Vertical Naigation Bar -->
    <div class="ver_nav" >
        <ul>
            <li> <a> <div class="error">
              <?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?> 
            </div> </a> </li>
                
            <li> <a href=" "> <div>  </div> </a> </li>
            
            <li> <a href=" "> <div> Create Link </div>  </a>   <!-- Creat Link Box -->
                <div class="create_link form">
                <h1> Create Link </h1>
                <form action="online_sub.php" method="post" >
                    <div class="field-wrap"> <input type="text" required name="link_name" placeholder="Enter Link Name"> </br> </div>
                    <div class="field-wrap"> <input type="text" name="about_link" placeholder="About Link"> </br> </div>
                        
                    <div class="field-wrap"> <input type="number" required name="roll_from" placeholder="ID from : "> </br> </div>
                    <div class="field-wrap"> <input type="number" required name="roll_to" placeholder="ID to :"> </br> </div>
                        
                    <h4>Dead Line :</h4>
                    <div class="field-wrap"> <input type="datetime-local" name="dead_line" placeholder="Dead Line"> </br> </div>
                        
                    <div class="radio">
                        <div class="field-wrap"> <input type="radio" name="radio" value="Assignment" checked> Assignment </div>
                        <div class="field-wrap "> <input type="radio" name="radio" value="Lab_Report"> Lab Report </br> </div>
                    </div>
                        
                    <button class="button button-block" name="create" /> create </button>
                </form>
                </div>
            </li>
    
            <li> <a href=" "><div> </div> </a> </li>
            <li> <a href=" "> <div> View Links </div> </a>   <!-- View Link Box -->
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
                          <form action="online_sub.php" method="post"> 
                          <?php
                            for($i=1 ; $i<1000 ; $i++)
                            {
                              $sql = $mysqli->query("SELECT * FROM `online_sub` WHERE id='$i'");

                              if ( $sql->num_rows > 0 ){
                                $result = $sql->fetch_assoc();
                                echo "<tr>
                                        <td> $result[link_name]  </td>
                                        <td> $result[about_link] </td>
                                        <td> <button class='view_button' name='view' value='$result[link_name]'> View </button> </td>
                                      </tr>" ;    
                               }
                             }
                           ?>
                           </form>
                        </tbody>
                    </table>
                </div>
            </li>

            <li> <a href=" "> <div>  </div> </a> </li>
            
        </ul>
    </div>
    
    <!-- chart -->
    <div class="chart">
        <h2>Link Details</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                if (isset($_POST['view']))
                {
                    $c = $_POST['view'];
            
                    $qu = $mysqli->query("SELECT * FROM `online_sub` WHERE link_name='$c'");
                    $res = $qu->fetch_assoc();
                    echo "<h3> Link Name : ' $res[link_name] '  and  About Link : ' $res[about_link] ' </h3>" ;
              
                    echo "
                        <table>
                            <thead>
                                <tr>
                                    <th> SL </th>
                                    <th> Student's ID </th>
                                    <th> Submission Time </th>
                                    <th> File </th>
                                </tr>
                            </thead>
                
                            <tbody>";
                
                            for($j=0 , $i=1 ; $i<1000 ; $i++)
                            {
                        
                                $sql = $mysqli->query("SELECT * FROM $c WHERE id='$i'");

                                if ( $sql->num_rows > 0 )
                                {
                                    $result = $sql->fetch_assoc();
                                    ?><tr>
                                            <td class="sl"> <?php echo $result['id'] ?> </td>
                                            <td class="st_id"> <?php echo $result['students_id'] ?> </td>
                                            <td class="sb_time"> <?php echo $result['date_time']  ?> </td>
                                            <td class="file"> <a href="..//uploads/<?php echo $result['file_name'] ?> " target="_blank" > <?php echo $result['file_type'] ?> </a> </td>
                                          </tr> <?php
                                    $j = $j + 1 ;
                                }
                            }
                            if($j==0)
                                echo "<h3> No one submitted yet . </h3>";
                            else
                                echo "<h3> $j student(s) submitted yet . </h3>" ; 
                            "</tbody>
                    </table>";
                }
            }
            else{
                    echo "<h3> Select Link to preview . </h3>";
                }
        ?>
    </div>

</body>
</html>