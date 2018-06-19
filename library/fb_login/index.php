<?php
session_start(); 
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Login with Facebook</title>
<link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> 
 </head>
  <body>
  <?php if ($_SESSION['FBID']): 
  $response = $_SESSION['response'];
  var_dump($response);
  ?>      <!--  After user login  -->
<div class="container">
<div class="hero-unit">
  <h1>Hello <?=$_SESSION['USERNAME']; ?></h1>
  <p>Welcome to "facebook login" tutorial</p>
  </div>
<div class="span4">
 <ul class="nav nav-list">
<li class="nav-header">Image</li>
	<li><img src="https://graph.facebook.com/<?=$_SESSION['FBID']; ?>/picture"></li>
<li class="nav-header">Facebook ID</li>
<li><?= $_SESSION['FBID']; ?></li>
<li class="nav-header">Facebook fullname</li>
<li><?=$_SESSION['FULLNAME']; ?></li>
<li class="nav-header">Facebook Email</li>
<li><?=$_SESSION['EMAIL']; ?></li>
<a href="logout.php">Logout</a>
</ul></div></div>
    <?php else: ?>     <!-- Before login --> 
<div class="container">
<h1>Login with Facebook</h1>
           Not Connected
      <a href="fbconfig.php">Login with Facebook</a></div>
    <?php endif ?>
  </body>
</html>
