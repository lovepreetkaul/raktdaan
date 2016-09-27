
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raktdaan - Registration</title>


<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>

<script type="text/javascript" src="js/custom.js"></script>

<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

</head>

<body>

<div id="container">
    <header> 
	<div class="width">

    		<h1><a href="index.php"><strong>Rakt</strong>Daan</a></h1>

		<nav>
	
    			<ul class="sf-menu dropdown">

			
        			<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>

            			<li class="selected">

					<a href="register.php">Register</a>
						</li>
						<li>

					<a href="search.php"><i class="fa fa-database"></i> Search Donors</a>
            				
						</li>
            
				<li><a href="contact.html"><i class="fa fa-phone"></i> Contact </a></li>
       			</ul>

			
			<div class="clear"></div>
    		</nav>
       	</div>

	<div class="clear"></div>

       
    </header>
<?php
	//Connect to the database
	$dbc = mysqli_connect('localhost','root','nseries','bloodbank')
	or die('Error connecting to database');

	if(isset($_POST['submit'])){
		//Extract user data
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$blood_id = $_POST['bloodtype'];
		$date_of_birth = $_POST['date'];
		$email = $_POST['email'];
		$city = $_POST['district'];
		$state = $_POST['state'];
		$mobile = $_POST['mobile'];

	    $query = "SELECT state_id FROM `states`".
	    "WHERE state='$state'";
	    $result = mysqli_query($dbc, $query) or die('Error Querying State');
	    $row = mysqli_fetch_array($result);

	    //If state is valid
	    if (!empty($row)) {
	    	$state_id = $row['state_id'];

	    }

	    while(1){

	    $query = "SELECT city_id FROM `states_cities` WHERE city='$city' AND state_id='$state_id' ";
	    $result = mysqli_query($dbc, $query) or die('Error Querying City');
	    $row = mysqli_fetch_array($result);

	    //If city is valid
	    if(!empty($row)){
	      $city_id = $row['city_id'];


	  		//Validate all fields are filled
	  		if(!empty($first_name) && !empty($last_name) && !empty($blood_id) 
	  	    	&& !empty($date_of_birth) && !empty($email) && !empty($city) && !empty($state)
	  	    	&& !empty($mobile)) {

	  			$query = "INSERT INTO donor ".
	  			"(first_name, last_name, blood_id, date_of_birth, city_id, email, mobile) values".
	  			"('$first_name', '$last_name', '$blood_id', '$date_of_birth', $city_id, '$email', '$mobile')";
	  			$result = mysqli_query($dbc, $query) or die('Error querying database');

	  			//Confirm success
	  			echo '<p><h5>Congratulations! You Have Succesfully registered! <br/>You will be redirected to the home page shortly.<br/>If not redirected automatically, click <a href="index.html">here<a></h5></p>';
	  				$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.html';
                    header('refresh:5;'.$url);
	  		}
	  		else{
	  			//Some fields empty(var)
	  			echo '<p><h4>You must fill all the fields and Check all the spellings!</h4></>'; 
	  		}
	    }

	    else{  //City is not valid
	      echo '<p><h4>Please enter a valid city name and state!</h4></p>';

	    }
	    break;
	}
}

	mysqli_close($dbc);
?>



    <h3>Registration Form</h3>
    <section>
    <article>

            <fieldset>
                <legend>Please fill in all the fields to ensure successful registration.</legend>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                	<!--First Name -->
                    <p><label for="firstname">First Name:</label>
                    <input name="firstname" id="firstname" value="<?php if(isset($first_name)){echo $first_name;} ?>" type="text" required/></p>

                    <!--Last Name -->
                    <p><label for="name">Last Name:</label>
                    <input name="lastname" id="lastname" value= "<?php if(isset($last_name)){echo $last_name;} ?>" type="text" required/></p>

                    <!--Blood Group -->
                    <p><label for="bloodtype">Blood Group:</label>
			              <select name="bloodtype" id="bloodtype" value="<?php if(isset($blood_id)){echo $blood_id;} ?>">
			              	<option value=1>A+</option>
			              	<option value=2>A-</option>
			              	<option value=3>B+</option>
			              	<option value=4>B-</option>
			              	<option value=5>AB+</option>
			              	<option value=6>AB-</option>
			              	<option value=7>O+</option>
			              	<option value=8>O-</option>
			              </select>
			        </p>


			        <!--Date of Birth-->
                    <p><label for="date">Date:</label>
                    <input name="date" id="date" placeholder="YYYY-MM-DD" value="<?php if(isset($date_of_birth)){echo $date_of_birth;} ?>" type="date" required/></p>

                    <!--Email-->
                    <p><label for="email">Email:</label>
                    <input name="email" id="email" value="<?php if(isset($email)){echo $email;} ?>" type="email" required/></p>

                    <!-- District-->
                    <p><label for="district">District:</label>
                    <input type="text" name="district" id="district" required /></p>

                    <!-- State-->
                    <p><label for="state">State:</label>
                     <select class="form-control" name="state" value="<?php if(isset($state)){echo $state;} ?>" id="state">
		                <option>Andaman and Nicobar Islands</option>
		                <option>Andhra Pradesh</option>
		                <option>Arunachal Pradesh</option>
		                <option>Assam</option>
		                <option>Bihar</option>
		                <option>Chandigarh</option>
		                <option>Chhattisgarh</option>
		                <option>Dadra and Nagar Haveli</option>
		                <option>Daman and Diu</option>
		                <option>New Delhi</option>
		                <option>Goa</option>
		                <option>Gujarat</option>
		                <option>Haryana</option>
		                <option>Himachal Pradesh</option>
		                <option>Jammu and Kashmir</option>
		                <option>Jharkhand</option>
		                <option>Karnataka</option>
		                <option>Kerala</option>
		                <option>Lakshadweep</option>
		                <option>Madhya Pradesh</option>
		                <option>Maharashtra</option>
		                <option>Manipur</option>
		                <option>Meghalaya</option>
		                <option>Mizoram</option>
		                <option>Nagaland</option>
		                <option>Odisha</option>
		                <option>Puducherry</option>
		                <option>Punjab</option>
		                <option>Rajasthan</option>
		                <option>Sikkim</option>
		                <option>Tamil Nadu</option>
		                <option>Tripura</option>
		                <option>Uttar Pradesh</option>
		                <option>Uttarakhand</option>
		                <option>West Bengal</option>    
		              </select></p>

		         	<!-- Mobile-->
		         	<p><label for="mobile">Mobile:</label>
		         	<input type="text" placeholder="10 digit(Without prefix)" name="mobile" id="mobile" value="<?php if(isset($mobile)){echo $mobile;} ?>" pattern="[0-9]{10}"></p>

                    <p><input name="submit" style="margin-left: 150px;" class="formbutton" value="Submit" type="submit" /></p>
                </form>
            </fieldset>
    </article>
    </section>

    <footer>
        <div class="footer-bottom">
            <p>&copy;Raktdaan.com 2014</p>
         </div>
    </footer>

    </div>
    </body>
</html>