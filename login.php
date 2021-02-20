<?php
session_start();
require_once "functions.php";
$user = new LoginRegistration();
if ($user->getSession()) {
	header('location: index.php');
	exit();
}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Registration page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>


	<body>
		<div class="wrapper">
			<div class="header">
				<h3>PHP OOP Login-Register System</h3>
			</div>

			<div class="mainmenu">
				<ul>
					<?php
					if ($user->getSession()) {
					
					?>

					<li><a href="index.php">Home</a></li>
					<li><a href="profile.php">Show Profile</a></li>
					<li><a href="changePassword.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>

					<?php }else{ ?>

					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
					
					<?php } ?>
				</ul>
			</div>

			<div class="content">
				<h3>Login</h3>
			

			<p class="msg">
				<span class="login_msg">
					<?php
					if (isset($_GET['response'])) {
						if ($_GET['response'] == '1') {
							echo "Logout successfull..";
						}
					}

					?>
				</span>
				<?php
					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						$email = $_POST['email'];
						$password = $_POST['password'];

						if (empty($email) or empty($password)) {
						echo "<span style='color:red'>Field must not be empty</span>";
					    }else{
					    	$password = md5($password);
					    	$login = $user->loginUser($email, $password);
					    	if ($login) {
					    		header('location: index.php');
					    	}else{
					    		echo "<span style='color:red'>Error... Email or Password not Match</span>";
					    	}
					    }
					}

					


				?>
			</p>
			<div class="login_reg">

				<form action="" method="post">
					<table>
						
						<tr>
							<td>Email:</td>
							<td><input type="email" name="email" placeholder="Please enter your email address"></td>
						</tr>

						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" placeholder="Please give your password"></td>
						</tr>

						
						<tr>
							<td colspan="2">
								<span style="float: right;">
								<input type="submit" name="login" value="Login">
								<input type="reset" value="Clear">
								</span>
							</td>
							
						</tr>

					</table>
				</form>
				
			</div>

			<div class="back">
				<a href="register.php"><img src="img/back.png" alt="back"></a>
			</div>
			</div>
			 <div class="footer">
			 	<h3>www.trainingwithliveproject.com</h3>
			 </div>

		</div>
	</body>
</html>