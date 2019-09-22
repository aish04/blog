<head>
	<title>Blog | Aishwarya</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header"><h3> Blog Home</h3>
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
 	    <li><a href="contactUs.php">Contact Us</a></li>
		</ul>
	</div>
	<div class="posts">
	<?php
	session_start();
	if(isset($_SESSION['del'])){
		unset($_SESSION['del']);
		echo "<script>alert('Blogpost deleted')</script>";
	}
	 $key = $_POST['key'];
   echo "<div style='background-color:#001433;color:white;padding-left:20px;padding-top:5px;'>Search results for : ".$key."</div>";
	 $servername = "localhost";
		$username = "root";
		$password = '';
		$dbname = "blog";
		$conn = new mysqli($servername, $username, $password,$dbname);
		if ($conn->connect_error) {
			header("location:error.php");
			exit();
		}
    if($_POST['srch']=='user'){
		$sql = "SELECT * from users where userID like '%".$key."%';";
    $res = $conn->query($sql);
    if($res->num_rows>0){
        while($row=$res->fetch_assoc()){
          echo "<div class = 'post'><h1>".$row['name']."</h1><h2>".$row['userID']."</h2><h5><a href ='loadProfile.php?userID=".$row['userID']."'>View Profile</a></h5></div>";
        }
    }
    else{
      echo "<h1> NO USER PROFILES WITH GIVEN KEYWORD</h1>";
    }
    }
    else {
      $sql = "SELECT * FROM blogpost where status = 1 and (title like '%".$key."%' OR descript like '%".$key."%' or post like '%".$key."%');";
      $res = $conn->query($sql);
  		if($res->num_rows>0){
      	  while($row=$res->fetch_assoc()){
      	  	echo "<div class = 'post'><h1>".$row['title']."</h1><h2>".$row['descript']."</h2><h4><a href=openBlog.php?id=".$row['id'].">Read More</a></h4><h5> written by:".$row['blogger']." Time:".$row['date']."</h5></div>";
      	  }
  		}
  		else{
  			echo "<h3> NO BLOGPOSTS TO SHOW</h3>";
  		}
    }
	$conn->close();
?>
	</div>
</body>
</html>
