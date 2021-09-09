<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="login_style.css">
</head>
<body>
<?php
	//define variables and set to empty values
	 $unameErr= $passErr = "";
	 $uname = $password = "";
	 $loginErr="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {


		 if (empty($_POST["uname"])) {
			$unameErr = "User name is required";
		  } else {
			$uname = test_input($_POST["uname"]);  
		  }

		  if (empty($_POST["password"])) {
			$passErr = "Password is required";
		  } else {
			$password = test_input($_POST["password"]); 
		  }




		//continues to target page if all validation is passed
		if ( $unameErr ==""&& $passErr ==""){
			// check if exists in database
			$dbc=mysqli_connect('localhost','testuser','password','addressbook')
			or die("Could not Connect!\n");
			$hashpass=hash('sha256',$password);
			$sql="SELECT * from profiles WHERE name ='$uname'AND password='$hashpass';";
			$result =mysqli_Query($dbc,$sql) or die (" Error querying database");
			$a=mysqli_num_rows($result);
			
			if ($a==1){
			    $admin = mysqli_fetch_assoc($result);
			    if ($admin['name'] == 'admin') {
				header('Location: /finalproject/AddProduct.php');
				}
			    else{ 
				header('Location: /finalproject/ViewProduct.php');
			        }
			}else{
			     $loginErr="Invalid username or password";
			    }
		}
	}

       // clears spaces etc to prep data for testing
	function test_input($data){
		$data=trim ($data); // gets rid of extra spaces befor and after
		$data=stripslashes($data); //gets rid of any slashes
		$data=htmlspecialchars($data); //converts any symbols usch as < and > to special characters
		return $data;
	}

?>



<div class="back">
<div class="box">
<div class="button-box">



<form  id="LOG" class="input-section" method="POST" 
 action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
<button type="submit" class="sub-bttn">LOG IN</button>
<a href="register.php"><span> Dont have an account? Sign up<span></a>
<input type="text"  name="uname" class="inputfields" placeholder="User name" id="user_name" value="<?php echo $username; ?>" >
<label for="user_name" class="error">  <?php echo $unameErr; ?> </label>

<input type="password" name="password" class="inputfields" placeholder="Password" id = "passw" value="" >
<label for="passw" class ="error"  >   <?php echo $passErr; ?> </label>
<label for="passw" class="error"> <?php echo $loginErr;?></label>
</form>


</div>
</div>
</div>
</body>
</html>
