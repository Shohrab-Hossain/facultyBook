<?php /* Main page with form: log in */
require 'db.php';
session_start();

unset($_SESSION['message']);

if (isset($_SESSION['admin_logged_in']) AND $_SESSION['admin_logged_in'] = 'true') {

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
    <link rel="stylesheet" type="text/css" href="ver_nav_st_info.css" />
</head>
    
<body>  
    <!-- Horizontal Naigation Bar -->
    <div class="hor_nav">
        <ul>
            <li > <a href="admin.php"> <div> ADMIN Homepage </div> </a> </li>
            <li> <a href="online_sub.php"> <div> Online Submission </div> </a> </li>
            <li> <a href="students_info.php" class="active"> <div> Students' Info </div> </a> </li>
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
        <div class="nav_table">
            <ul>
                <table>
                    <form action="students_info.php" method="post"> 
                        <?php
                            for($i=12 ; $i<19 ; $i++) {
                                echo "<tr>
                                        <td>
                                            <li> <div> <a> <button class='view_button ' name='batch' value='$i'> $i batch </button> </a> </div> </li>
                                        </td>
                                      </tr>" ;
                            }

                        ?>
                    </form> 
                </table>
            </ul>
        </div>
    
    <!-- chart -->
    <div class="chart">
        <h2>Students' Info</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                if (isset($_POST['batch']))
                {
                    $c = $_POST['batch'];
                    $roll_from = ( $c * 100000 ) + 8001 ;
                    $roll_to = $roll_from + 61 ;
              
                    echo "
                        <table>
                            <thead>
                                <tr>
                                    <th> Student's ID </th>
                                    <th> First Name </th>
                                    <th> Last Name </th>
                                    <th> Email adress </th>
                                    <th> Cell Number </th>
                                </tr>
                            </thead>
                
                            <tbody>";
                
                            for($j=0 , $i=$roll_from ; $i<$roll_to ; $i++)
                            {
                        
                                $sql = $mysqli->query("SELECT * FROM `student_accounts` where students_id ='$i'");

                                if ( $sql->num_rows > 0 )
                                {
                                    $result = $sql->fetch_assoc();
                                    echo "<tr>
                                            <td> $result[students_id]  </td>
                                            <td> $result[first_name] </td>
                                            <td> $result[last_name]  </td>
                                            <td> $result[email] </td>
                                            <td> $result[cell_number] </td>
                                          </tr>" ;
                                    $j = $j + 1 ;
                                }
                            }
                            if($j==0)
                                echo "<h3> No registered student in this batch . </h3>";
                            else
                                echo "<h3> $j registered student(s) in this batch . </h3>" ; 
                            "</tbody>
                    </table>";
                }
            }
            else{
                    echo "<h3> Select Batch to preview . </h3>";
                }
        ?>
    </div>

</body>
</html>