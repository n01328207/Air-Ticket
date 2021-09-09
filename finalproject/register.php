<!DOCTYPE html>
<html>
<head>
<title>registration page</title>
<link rel="stylesheet" href="register_style.css">
<body>
<?php
	//define variables and set to empty values
	 $nameErr = "";
	 $name = "";

	 $email="";
	 $emailErr="";

	 $fname = $fnameErr="";
	 $fname = $fnameErr="";
		
	 $lname = $lnameErr="";
	 $lname = $lnameErr="";

	 $password ="";
	 $passwordErr= "";

         $cpassword ="";
	 $cpasswordErr = "";


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if($_POST['password']==$_POST['cpassword']){
		 
		 if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		  } else {
			$name = test_input($_POST["name"]);  
			
		  }
                 if (empty($_POST["fname"])) {
			$fnameErr = "first Name is required";
		  } else {
			$fname = test_input($_POST["fname"]);  
			
		  }
		 if (empty($_POST["lname"])) {
			$lnameErr = "last Name is required";
		  } else {
			$lname = test_input($_POST["lname"]);  
			
		  }

		 if (empty($_POST["email"])) {
			$emailErr = "email is required";
		  } else {
			$email = test_input($_POST["email"]);  
		  }

		  if (empty($_POST["password"])) {
			$passwordErr = "Password is required";
		  } else {
			$password = test_input($_POST["password"]); 
		  }
	          if (empty($_POST["cpassword"])) {
  			$cpasswordErr = "Confirm password is required";
			} else {
			$cpassword = test_input($_POST["cpassword"]); 
			}
	
	          
		//continues to target page if all validation is passed
		if ( $emailErr ==""&& $passErr ==$cpasswordErr && $nameErr == "" && $fnameErr=="" && $lnameErr==""){
			// check if exists in database
			$dbc=mysqli_connect('localhost','testuser','password','addressbook')
			or die("Could not Connect!\n");
			$sql="SELECT * from profiles WHERE name ='$name';";
			$result =mysqli_Query($dbc,$sql) or die (" Error querying database");
			$a=mysqli_num_rows($result);

			if ($a>0){
				$nameErr="Username already exists".$a;
			}else{  
				$hashpass=hash('sha256',$password);
				$sql="INSERT INTO profiles VALUES(NULL,'$name','$fname','$lname','$email','$hashpass');";
				$result =mysqli_Query($dbc,$sql) or die (" Error querying database");
				mysqli_close();
				header('Location: /finalproject/login.php');
			}
	       }  
	    }
              else{
		 echo "Please enter Password Check and ensure they are matched";}
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



<form  id="REG" class="input-section" method="POST" 
 action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >


<button type="submit" class="sub-bttn">Register</button>
<a href="login.php"><span> Have an account? Sign In<span></a>

<!--name: -->
<input type="text"  name="name" class="inputfields" placeholder="Username" id="name" value="<?php echo $name; ?>" >
<label for="name" class="error">  <?php echo $nameErr; ?> </label>
 
<input type="text" name="fname" class="inputfields" placeholder="First name" id="fname" value="<?php echo $fname; ?>">
<label for="fname" class="error"> <?php echo $fnameErr; ?> </label>
 
<input type="text" name="lname" class="inputfields" placeholder="Last name" id="lname" value="<?php echo $lname; ?>">
<label for="lname" class="error"> <?php echo $lnameErr; ?> </label>

<!-- Email: -->
<input type="email"  name="email" class="inputfields" placeholder="Email" id="Email" value="<?php echo $email; ?>" >
<label for="Email" class ="error">  <?php echo $emailErr; ?></label>

<!-- Password and Conf Password: -->
<input type="password" name="password" class="inputfields" placeholder="Password" id = "passw" value="<?php echo $password; ?>" /> 
<label for="passw" class ="error"  >   <?php echo $passwordErr;?>  </label>
<input type="password" name="cpassword" class="inputfields" placeholder="Password Check" id = "passwCHECK" value="<?php echo $cpassword;?>" autocomplete="new-password"/>
<label for="passw" class ="error"  >   <?php echo $passwordErr;?>  </label>
<br/>




<!--Terms and Cond(bttn): -->
<input type="checkbox" class="checkbox"> <span> I agree to the terms & conditions </span> 


</form>


</div>
</div>
</body>
</html>
