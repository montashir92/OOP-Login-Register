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
				<h3>Register</h3>
			

			<p class="msg">
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						$username = $_POST['username'];
						$password = $_POST['password'];
						$name = $_POST['name'];
						$email = $_POST['email'];
						$website = $_POST['website'];
						
						if (empty($username) or empty($password) or empty($name) or empty($email) or empty($website)) {
							echo "<span style='color:red'>Error...Field must not be empty</span>";
						}else{
							$password = md5($password);
							$register = $user->registerUser($username,$password,$name,$email,$website);
							if ($register) {
								echo "<span style='green'>Register done <a href='login.php'>Click here</a>for login</span>";
							}else{
								echo "<span style='color:red'>Username or email already exist</span>";
							}
						}
					}

				?>
			</p>
			<div class="login_reg">

				<form action="" method="post">
					<table>
						<tr>
							<td>Username:</td>
							<td><input type="text" name="username" placeholder="Please give your username"></td>
						</tr>

						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" placeholder="Please give your password"></td>
						</tr>

						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" placeholder="Please give your Name"></td>
						</tr>

						<tr>
							<td>Email:</td>
							<td><input type="email" name="email" placeholder="Please enter your email address"></td>
						</tr>

						<tr>
							<td>Website:</td>
							<td><input type="text" name="website" placeholder="Please enter your website address"></td>
						</tr>

						<tr>
							<td colspan="2">
								<span style="float: right;">
								<input type="submit" name="register" value="Register">
								<input type="reset" value="Clear">
								</span>
							</td>
							
						</tr>

					</table>
				</form>
				
			</div>

			<div class="back">
				<a href="login.php"><img src="img/back.png" alt="back"></a>
			</div>
			</div>
			 <div class="footer">
			 	<h3>www.trainingwithliveproject.com</h3>
			 </div>

		</div>
	</body>
</html>