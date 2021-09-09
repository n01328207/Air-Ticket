<?php
  // Create database connection
  $db = mysqli_connect("localhost", "testuser", "password", "addressbook");

 
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
	$name = $_POST['product'];
	$price = $_POST['price'];
	$describe = $_POST['description'];  	
	// Get image name
  	$image = $_FILES['image']['name'];

  	// image file directory
  	$target = "/finalproject/".basename($image);
	$dbc=mysqli_connect('localhost','testuser','password','addressbook')
			or die("Could not Connect!\n");
	$sql="SELECT * from products WHERE image='$image';";
        $result =mysqli_Query($dbc,$sql) or die (" Error querying database");
        $a=mysqli_num_rows($result);
	if ($a>0){
	echo "Item already exists"; 
	}else{
  	$sql = "INSERT INTO products (id,product, price, image,description) VALUES (null,'$name','$price','$image','$describe')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
	}
  }
  $result = mysqli_query($db, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin page</title>
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
<a href="login.php" color="black"><span>Log out<span></a></br>
<a href="ViewProduct.php" color="black"><span>Customer View<span></a>
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='/finalproject/".$row['image']."' >";
      	echo "<p>".$row['product']."</p>";
	echo "<p>".$row['price']."$</p>";
	echo "<p>".$row['description']."</p>";
      echo "</div>";
    }
  ?>
  <form method="POST" action="AddProduct.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
	<div>Ticket name:
	<input type="text" name="product" >
	</div>
  	<div>Price(in USD):
  	  <input type="number" name="price" min="1">$ 
  	</div>
	<div>Description:
	<textarea name="description" rows="4" cols="50"> </textarea>
	</div>
  	<div>
  		<button type="submit" name="upload">Upload</button>
  	</div>
  </form>
</div>
</div>
</body>
</html>
