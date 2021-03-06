<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['visitor']) && !isset($_SESSION['admin'])){
    header("Location:auth/login.php?role=visitor&redirect=../index.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Wink</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Photo Gallery">
    <meta name="keywords" content="PHP, Photography">
    <meta name="author" content="Fenimore">
    <link rel="icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <br>
<?php
// Categories
$spaces = array("-", "_");
$categories = array_filter(glob('media/*'), 'is_dir');
foreach($categories as $category){
  $cat = substr($category, 6);
  $catescaped = urlencode($cat);
  echo  $catescaped; // category header, make h3???
  echo "<br>";
  $galleries = array_filter(glob($category . '/*'), 'is_dir');
  $galleries = new ArrayIterator(array_reverse($galleries));
  // Reverse order so that most recent are on top
  //for each gallery list the gallery
  echo '<ul class="photo-index list-unstyled">';
  foreach($galleries as $gallery){
    $gall = substr($gallery, strlen($category) + 1); // strip path
    $gallescaped = urlencode($gall);
    $gallerytitle = str_replace($spaces, " ", $gall); // - and _ are spaces
    echo '<li>';
    echo '<span class="glyphicon glyphicon-th-large" aria-hidden="true">';
    echo '</span> | <a href=gallery.php?category=' . $catescaped;
    echo '&gallery=' . $gallescaped .' >';
    echo ucfirst($gallerytitle) .' </a></li>'; // Capitalize the Gallery?
  }
  echo '</ul>';
}
// Add another set of gallery

?>
    </div>
  </div>
</div>

<?php include("footer.php");?>

</body>
</html>
