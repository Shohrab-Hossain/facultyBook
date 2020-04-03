<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$id = $mysqli->escape_string($_POST['user_id']);
$result = $mysqli->query("SELECT * FROM `student_accounts` WHERE students_id='$id'");

// Checking ADMIN
$name = $mysqli->escape_string($_POST['user_id']);
$admin = $mysqli->query("SELECT * FROM `admin_info` WHERE username='$name'");

if ( $admin->num_rows > 0 ){ // admin exist
    $user = $admin->fetch_assoc();
    
    if ( ( password_verify($_POST['password'], $user['password']) ) OR ( $_POST['password'] == $user['password'] ) ) {
        
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        
        
        // This is how we'll know the admin is logged in
        $_SESSION['admin_logged_in'] = true;
        header("location: ../admin/admin.php");
    }
    else {
        $_SESSION['message'] = "User with that ID doesn't exist!";
        header("location: ../login-system/error.php ");
    }
}

elseif ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that ID doesn't exist!";
    header("location: ../login-system/error.php ");
}
else { // User exists
    $user = $result->fetch_assoc();
    
    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['student_id'] = $user['students_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: ../login-system/profile.php ");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: ../login-system/error.php");
    }
}
