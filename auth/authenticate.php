<?php
// authenticate.php -- compared to access.php
if ( !empty($_POST) ) {
    $error=array();// TODO: I should use this?

    $ini = parse_ini_file('../wink.ini');

    extract($_POST); // but why?
    $password = $_POST['password'];
    $redirect = $_POST['redirect'];
    $role = $_POST['role'];

    switch ($role) {
    case "admin":
        $target_password = $ini["admin_pass"];
        break;
    case "visitor":
        $target_password = $ini["visitor_pass"];
        break;
    }

    // Admin access
    if( sha1($password) == $target_password){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$role] = true;
        header('Location: ' . $redirect);
        die();
    } else {
        header('Location: ' . $redirect);
        die();
    }
}
?>
