<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raktdaan - Search Donors</title>


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

    		<h1><a href="index.html"><strong>Rakt</strong>Daan</a></h1>

		<nav>
	
    			<ul class="sf-menu dropdown">

			
        			<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>

            			<li>

					<a href="register.php">Register</a>
						</li>

						<li class="selected">

					<a href="search.php"><i class="fa fa-database"></i> Search Donors</a>
            				
						</li>
            
				<li><a href="contact.html"><i class="fa fa-phone"></i> Contact </a></li>
       			</ul>

			
			<div class="clear"></div>
    		</nav>
       	</div>

	<div class="clear"></div>

       
    </header>

    <h4>Search Donors</h4>
          <form method="post" class="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <fieldset>

                	 <!-- Blood Group-->
                	<p>
                		<label for="bloodtype">Blood Group:</label>
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
                	
                	<!-- District-->
                    <p>
                    	<label for="district">District:</label>
                        <input type="text" size="32" name="district" id="district" value="<?php if(isset($city)){echo $city;} ?>" required/>
                        
                    </p>

                    <p><input name="search" style="margin-left: 150px;" class="formbutton" value="Search" type="submit" /></p>
                  </fieldset>
         </form>	

<?php
    //Connect to the database
    $dbc = mysqli_connect('localhost', 'root', 'nseries', 'bloodbank')
    or die('Error connecting to database!');

    if(isset($_POST['search'])) {
        //Extract user input
        $blood_id = $_POST['bloodtype'];
        $city = $_POST['district'];

        $query = "SELECT `city_id` FROM states_cities WHERE city='$city'";
        $result = mysqli_query($dbc, $query) or die('Error City Query!');
        $temp = mysqli_fetch_array($result);
       if(!empty($temp)){
            $city_id  = $temp['city_id'];

            //Query the database
            $query = "SELECT donor_id,first_name,last_name,email,mobile FROM donor WHERE blood_id = '$blood_id' AND city_id = '$city_id' AND status = 1";
            $result = mysqli_query($dbc, $query) or 
            die('Error Querying the database !');
            //View the results
            echo '

            <table cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                </tr>';
            if(mysqli_num_rows($result) > 0){
	            while ($row = mysqli_fetch_array($result)){
	            	echo'		
	                <tr>
	                    <td>'.$row['donor_id'].'</td>
	                    <td>'.$row['first_name'].'</td>
	                    <td>'.$row['last_name'].'</td>
	                    <td>'.$row['email'].'</td>
	                    <td>'.$row['mobile'].'</td>
	                </tr>';
	                 
	            }
	            echo'</table>';
	        }
	        else{
	        	echo '<h3>No Donors Found!</h3>';
	        }
        }
        else{
        	echo '<h3>Incorrect District!</h3>';
        }

    }

?>


</div>
</body>
</html>