<?php

$folderinstall = 'install';

if(is_dir($folderinstall))
{
    header('location: ./install/index.php');
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Sima: Sistem Informasi Usaha </title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- stylesheets -->
		<link rel="stylesheet" type="text/css" href="resources/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="resources/css/style.css" media="screen" />
		<link id="color" rel="stylesheet" type="text/css" href="resources/css/colors/blue.css" />
		<!-- scripts (jquery) -->
		<script src="resources/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
		<script src="resources/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<script src="resources/scripts/smooth.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				style_path = "resources/css/colors";

				$("input.focus").focus(function () {
					if (this.value == this.defaultValue) {
						this.value = "";
					}
					else {
						this.select();
					}
				});

				$("input.focus").blur(function () {
					if ($.trim(this.value) == "") {
						this.value = (this.defaultValue ? this.defaultValue : "");
					}
				});

				$("input:submit, input:reset").button();
			});
		</script>
		<link rel="shortcut icon" href="logo.gif" />
	</head>
	<body>
		<div id="login">
			<!-- login -->
			<div class="title">
				<h5>SIMA: Sistem Informasi Usaha</h5>
				<div class="corner tl"></div>
				<div class="corner tr"></div>
			</div>
		  <div class="messages">
		  <?php  if($_GET["err"] <> "") {
		  
		  ?>
				<div id="message-error" class="message message-error">
					<div class="image">
						<img src="resources/images/icons/error.png" alt="Error" height="32" />
					</div>
					<div class="text">
						<h6>Error Message</h6>
						<span>Invalid User Name or Password.</span>
					</div>
					<div class="dismiss">
						<a href="#message-error"></a>
					</div>
				</div>
				<?php  } ?>
			</div>
			<div class="inner">
				<form action="sb_login.php" method="post">
				<div class="form">
					<!-- fields -->
					<div class="fields">
						<div class="field">
							<div class="label">
								<label for="username">Username:</label>
							</div>
							<div class="input">
								<input type="text" id="username" name="user_name" size="40" value="" class="focus" />
							</div>
						</div>
						<div class="field">
							<div class="label">
								<label for="password">Password:</label>
							</div>
							<div class="input">
								<input type="password" id="password" name="passwd" size="40" value="" class="focus" />
							</div>
						</div>
						<div class="field">
							<div class="checkbox">
								<input type="checkbox" id="remember" name="remember" />
								<label for="remember">Remember me</label>
							</div>
						</div>
						<div class="buttons">
							<input type="submit" value="Sign In" />
						</div>
					</div>
					<!-- end fields -->
					<!-- links -->
					<div class="links">
						<a href="http://www.jogjaide.web.id"></a>		2015 - 2021			</div>
					<!-- end links -->
				</div>
				</form>
			</div>
			<!-- end login -->
			<div id="colors-switcher" class="color">
				<a href="" class="blue" title="Blue"></a>
				<a href="" class="green" title="Green"></a>
				<a href="" class="brown" title="Brown"></a>
				<a href="" class="purple" title="Purple"></a>
				<a href="" class="red" title="Red"></a>
				<a href="" class="greyblue" title="GreyBlue"></a>
			</div>
		</div>
	</body>
</html>