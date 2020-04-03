<html>
<head>
    <title> Welcome ADMIN </title> 
    <link href="admin.css" rel="stylesheet" >
</head>

<body>

    <div class="db">
    <?php
        require 'db.php' ;
        session_start();
    
        $name = $_POST["username"]; 
        $username = $mysqli->query("SELECT * FROM `admin` WHERE SL = 1" );
        
        $u = $username->fetch_assoc();
        print_r($u);
        echo "Hey"."$name" ;
        
    ?>
    </div>
    
</body>
</html>