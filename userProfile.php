<?php
session_start();
require_once "functions.php";
$user = new LoginRegistration();
$uid = $_SESSION['uid'];
$username = $_SESSION['uname'];

if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}else{
	header("Location: index.php");
	exit();
}

if (!$user->getSession()) {
	header('location: login.php');
	exit();
}
?>


<!DOCTYPE html>
<html lang="en"> 
	<head>
		<meta charset="utf-8">
		<title>User Profile</title>
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
			

			<span class="login_msg">
				
			</span>
			
			<h3>Welcome, <?php echo $username; ?></h3>
			<p class="userlist">Profile of :<?php $user->getUsername($id); ?></p>

			<table class="tbl_one">

				<?php
					$getUsers = $user->getUserById($id);
					foreach ($getUsers as $user) {
						
				 ?>
				<tr>
					<td>Username:</td>
					<td><?php echo $user['username']; ?></td>
				</tr>

				<tr>
					<td>Name:</td>
					<td><?php echo $user['name']; ?></td>
				</tr>

				<tr>
					<td>Email:</td>
					<td><?php echo $user['email']; ?></td>
				</tr>

				<tr>
					<td>Website:</td>
					<td><?php echo $user['website']; ?></td>
				</tr>
				<?php if($user['id'] == $uid){?>

				<tr>
					<td> Update Profile:</td>
					<td><a href="update.php?id=<?php echo $user['id']; ?>">Edit Profile</a></td>
				</tr>

			<?php } } ?>

			</table>
			<div class="back">
				<a href="index.php"><img src="img/back.png" alt="back"></a>
			</div>
			</div>
			 <div class="footer">
			 	<h3>www.trainingwithliveproject.com</h3>
			 </div> 

		</div>
	</body>
</html>