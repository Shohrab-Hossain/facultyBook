<?php /* Displays all error messages */
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
  <title>Error</title>
  <link rel="stylesheet" href="style.css">
</head>
    
<body>
    <div class="form">
        <h1>Error</h1>
        <p>
        <?php 
            if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
                echo $_SESSION['message'];
                unset( $_SESSION['message'] );
            else:
                header( "location: log-in.php" );
            endif;
        ?>
        </p>     
            <a href="log-in.php"><button class="button button-block">Try again</button></a>
    </div>
</body>
</html>
