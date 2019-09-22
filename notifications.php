<?php
	session_start();
	if(isset($_SESSION['publish'])){
 		echo "<script>alert('Blogpost submmitted for moderation.');</script>";
		unset($_SESSION['publish']);
 	}
	if(!isset($_SESSION['logged']))
	{
		header("location:index.php");
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
	<div class="header"><h3> Blog Home<span style="float:right; margin: 5px;"><a href="notifications.php"><img src="notif.png" alt="Notification" height="40px" width="40px"></a></span></h3>
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
  		<li><a href="profile.php">My Profile</a></li>
  		<li><a href="writeBlog.php?publish=0">Write Blogpost</a></li>
  		<li><a href="viewBlog.php">My Blogposts</a></li>
		<li><a href="networkBlog.php">Netwok Blogposts</a></li>
 	    <li><a href="contactUs.php">Contact Us</a></li>
 		<li><a href="logout.php">Logout</a></li>
		</ul>
		<ul>
			<li><a href = "markNotifs.php">Mark all as read</a></li>
			<li><a href = "allNotifs.php">All notifications</a></li>
		</ul>
	</div>
	<div class="posts">
		<?php
			include 'authorize.php';
			$sql = "SELECT * FROM notifications where userID like '".$_SESSION['logged']."' AND status=0 order by time desc;";
			$res = $conn->query($sql);
			if($res->num_rows>0){
				while($row=$res->fetch_assoc())
					echo "<div class = notif><h2>".$row['descript']."</h2><h5>Time:".$row['time']."</h5></div>";
			}
			else {
				echo "<h1><p><center>No new Notifiactions";
			}
		?>
	</div>
</body>
</html>
