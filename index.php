<?php
 	session_start();
 	if(isset($_SESSION['reg'])){
 		unset($_SESSION['reg']);
 		echo "<script>alert('Registeration successful. Please check your E-mail')</script>";
 	}
 	if(isset($_SESSION['logged'])){
 		if($_SESSION['type']=='A')
 		header("location:adminHome.php");
 		else
 		header("location:bloggerHome.php");
 		exit();
 	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog | Aishwarya</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header"><h3>Blog Home</h3>
			<h5>Let's Talk About You</h5>
	</div>
  <div class="search">
		<form action="search.php" method="post">
			<input type = "text" placeholder = "john" name ="key">
			<input type="radio" name="srch" value="user" checked="1">User
			<input type="radio" name="srch" value="blog">Blog
			<button type="submit">Search</button>
		</form>
	</div>
	<div class = "menu">
		<ul>
  		<li><a href="index.php">Home</a></li>
  		<?php
  			if(isset($_SESSION['logged'])){
  				echo "<li><a href='profile.php'>My Profile</a></li>";
  			}
  		?>
 	    <li><a href="contactUs.php">Contact Us</a></li>
 		<li><a href="login.php?count=0">Login</a></li>
		</ul>
	</div>
	<div class="posts">
	<?php
		include 'loadPosts.php';
	?>
	</div>
</body>
</html>
