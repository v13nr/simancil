<?php
// Start the session
session_start(); 
require ("settings.php");
global $settings, $message;
$errorMessage = '';
if (isset($_POST['username']) && isset($_POST['password'])) {

// Check the username and password are correct
if ($_POST['username'] === $settings['username'] && $_POST['password'] === $settings['password']) {

//If the username and password match set the session
$_SESSION['basic_is_logged_in'] = true;

// After a usccessful login, move to the upload page
header('Location: mysql-backup.php');
exit;
} else {
$message = '<div class="errortext">You have entered an incorrect username or password.</div>';
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Easy MySQL Backup Login</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="css/mysql-backup.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class='placeholder'>

<div class="header"><?php echo $settings['headertext'] ?></div>

  <b class='container'>
  <b class='container1'></b>
  <b class='container2'><b></b></b>
  <b class='container3'></b>
  <b class='container4'></b>
  <b class='container5'></b></b>

  <div class='containercontent'>

<form method='post' >
		
<p class="login">Username<input name="username" type="text" id="username" class="logininput"></input></p>
<p class="login">Password <input name="password" type="password" id="password" class="logininput"></input></p>
	<?php echo $message; ?>	
	<div class="logincontainer"><input type="submit" name="Login" value="Login" class="inputbutton"></input></div>		
</form>
<!--This code displays success and error messages when they occur-->

</div>
  
  <b class='container'>
  <b class='container5'></b>
  <b class='container4'></b>
  <b class='container3'></b>
  <b class='container2'><b></b></b>
  <b class='container1'><b></b></b></b>
<div class="footer"><?php echo $settings['footertext'] ?></div>
</div>
</body>
</html>