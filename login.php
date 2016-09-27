<?php
    //Start the session
    session_start();
    echo $_SESSION['username'];
    echo $_SESSION['user_id'];
    //Clear the error message
    $error_msg = "";

    //If the admin is not logged in, try to log them in
    if(!isset($_SESSION['user_id'])){
        if(isset($_POST['login'])){

            //Connect to the database
            $dbc = mysqli_connect('localhost','root','nseries','bloodbank')
            or die('Error connecting to database');

            //Grab user-entered log-in data
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if(!empty($user_username) && !empty($user_password)) {
                //Look up the username and password in the database
                $query = "SELECT user_id,username from login where username = '$user_username' AND password = SHA1('$user_password')";
                $data = mysqli_query($dbc, $query) or die('Error in login query!');

                if(mysqli_num_rows($data) == 1) {
                    //The log in is OK, set cookies, and redirect to home page
                    $row = mysqli_fetch_array($data);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin.php';
                    header('Location: '.$url);
                }
                else{
                    //Username and password wrong, set error message
                    $error_msg = 'Invalid password or username!';
                }
            }
            else{
                //Username and password not entered
                $error_msg = 'Enter username and password to log in';
            }
        }
?>



<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raktdaan - Admin Log In</title>


<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

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

			
        			<li class="selected"><a href="index.html"><i class="fa fa-home"></i> Home</a></li>

            			<li>

					<a href="register.php">Register</a>

					<a href="search.php"><i class="fa fa-database"></i> Search Donors</a>
            				
						</li>
            
				<li><a href="contact.html"><i class="fa fa-phone"></i> Contact </a></li>
       			</ul>

			
			<div class="clear"></div>
    		</nav>
       	</div>

	<div class="clear"></div>

       
    </header>

		<div class="login-card">
		    <h1>Log-in</h1><br>
		  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
		    <input type="text" name="username" placeholder="Username" required>
		    <input type="password" name="password" placeholder="Password" required >
		    <input type="submit" name="login" class="formbutton" value="Login">
		  </form>
		</div>
		<?php
   	}
    else {
        //Confirm the successful log-in 
        echo '<p>You are logged in as '.$_SESSION['username'].'</p>';
    }
?>
		
	</div>


</body>
</html>