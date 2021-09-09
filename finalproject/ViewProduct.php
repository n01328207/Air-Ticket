<!DOCTYPE html>
<html>
<head>
<title>Customer page</title>
<style type="text/css">
   .back{
	height: 100%;
	width: 100%;
	background-image: linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.4)),url(banner.jpg);
	background-position: center;
	background-size: cover;
	position: absolute;
	}	

   #content{
   	width: 50%;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
	background-color: rgb(204, 255, 255);
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
	background-color: white;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 300px;
   	height: 140px;
   }
</style>
</head>
<body>
<div class="back">
<div id="content">
<h1>Here are our tickets:</h1>
  <?php
	$dbc=mysqli_connect('localhost','testuser','password','addressbook')
	 or die ("Could not Connect! \n");

	$sql="SELECT * from products;";
	
 	
	
	$result=mysqli_query($dbc,$sql) or die ("Error Querying Database");
	while ($row = mysqli_fetch_array($result)) {
        echo "<div id='img_div'>";
      	echo "<img src='/finalproject/".$row['image']."' >";
      	echo "<p>".$row['product']."</p>";
	echo "<p>".$row['price']."$</p>";
	echo "<p>".$row['description']."</p>";
        echo "</div>";
        }
        mysqli_close();
  ?>
<p><a href="login.php" color="black"><span>Log out<span></a></p>
</div>
</div>
</body>
</html>
