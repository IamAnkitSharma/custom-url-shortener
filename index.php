<?php 
	include('dbconnect.php');
	$surl="";
	if(isset($_POST['submit'])){



		$url=$_POST['url'];
		$custom=$_POST['custom'];
		
		$fetchurlquery="SELECT * from shortener where custom='$custom'";
		$fetchurl=mysqli_query($connect,$fetchurlquery);
		
		$a=explode(':/',$url);
		
		$cmp=$a[0];
		
		
		if(strlen($url)==0){
			echo '<script> alert("Enter url"); </script>';
		}
		else if(strlen($custom)==0){
			echo '<script> alert("Enter custom name"); </script>';
		}
		else if(mysqli_num_rows($fetchurl)>0){
			echo '<script> alert("Choose different custom name"); </script>';
		}
		else if($cmp=="http" or $cmp=="https") {

		$surl="http://localhost/customurlshortener/index.php?u=".$custom;
		$query="INSERT INTO shortener(id,original,short,custom) values('NULL','$url','$surl','$custom') ";
		$add=mysqli_query($connect,$query);
	}else{
		$surl="Cant shorten url ";
	}
}
	if(isset($_GET['u'])){

		$myurl=$_GET['u'];
		
		$fetchquery="SELECT * from shortener WHERE custom='$myurl'";
		$run=mysqli_query($connect,$fetchquery);
		$fetch=mysqli_fetch_assoc($run);
		
		$redirect=$fetch['original'];
		echo $redirect;
		header("location:$redirect");
	}
 ?>








<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" sc="script.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Custom URL Shortener</title>
</head>
<body>
		<div class="title">
		<h1>Custom URL Shortener</h1>
		</div>

		<div class="shortener">
			<form action="index.php" method="POST">
			<div class="text">
				<input type="text" name="url" placeholder="Enter your link with HTTP">
				<br><br>
				<input type="text" name="custom" placeholder="Custom name">
			</div>		
			<div class="btn"><input type="submit" name="submit" value="Shorten it"></div>	
			</form>
			<h2 class="shortened"><?php echo $surl; ?></h2>
		</div>

		

		

</body>
</html>