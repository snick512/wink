<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("Location:login.php");
    return;
}

// errors
$directoryerr = "directory does not exist";

  if ( !empty($_POST) ) {
    $dirname = $_POST['dirname'];
    $path = '../media/' . $dirname;



    if(is_dir($path)) {
      $files = glob($path . "/*");
      foreach($files as $file){
        if(is_file($file)){
          unlink($file); //delete file
        }
      }
      rmdir($path);
      // Flash message?
      header("Location: ../index.php");
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Wink - Error</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Photo Gallery">
    <meta name="keywords" content="PHP, Photography">
    <meta name="author" content="Fenimore">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen"/>
</head>
<body>
<a href="../auth/admin.php">Return to Admin</a>
</body>
</html>
