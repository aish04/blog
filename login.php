 <?php
 	session_start();
 	if(isset($_SESSION['logged'])){
 		if($_SESSION['type']=='A')
 		header("location:adminHome.php");
 		else
 		header("location:bloggerHome.php");
 		exit();
 	}
 	if(isset($_SESSION['verified'])){
 		unset($_SESSION['verified']);
 		echo "<script>alert('E-mail Verification Completed. Please Login.')</script>";
 	}
 	if($_GET['count']==1){
 	$user = $_POST['userID'];
 	$pswd = $_POST['pswd'];
 	$servername = "localhost";
	$username = "root";
	$password = '';
	$dbname = "blog";
	$conn = new mysqli($servername, $username, $password,$dbname);
	if ($conn->connect_error) {
		header("location:error.php");
		exit();
		}
	$sql = "SELECT * from users where verified = 1 and userID like '".$user."' and password like  '".$pswd."';";
	$res = $conn->query($sql);
	if($res->num_rows==1){
      $row = $res->fetch_assoc();
      $_SESSION['logged']=$user;
      $_SESSION['type']=$row['type'];
      header("location:index.php");
	}
	$conn->close();
   }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 	<div class="header" align="center"><h3> Blog Home</h3>
			<h5>Let's Talk About You</h5>
	</div>
	<div class = "menu">
		<ul>
  		<li><a href="index.php">Home</a></li>
 	    <li><a href="contactUs.php">Contact Us</a></li>
		</ul>
	</div>
 	<?php
 		$count = $_GET['count'];
		if($count==1)
			echo "<p style='margin-left:35%;'>User not registered<p>";
 	?>
 	<form action="login.php?count=1" method="post" class="login" onsubmit="return check()">
 		<label>USERNAME:</label><input type="text" name="userID" id ="userID"><p>
 		<label>PASSWORD:</label><input type="password" name="pswd" id="pswd"><p>
 		<button type = "submit">LOGIN</button><p>
 		NEW USER?<a href="register.php?reg=0" style="text-align: center;"> REGISTER HERE</a>
 	</form>
 	<script type="text/javascript">
 		function check() {
 			var user = document.getElementById('userID').value;
 			var pswd = document.getElementById('pswd').value;
 			if(user=='' || pswd == ''){
 				alert("Invalid username/password");
 			 	return false;
 			 }
 			return true;
 		}
 	</script>
 	
 </body>
 </html>
