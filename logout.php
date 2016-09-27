<?php
	session_start();
	session_destroy();
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.html';
	echo '<h3>You have logged out succesfully and will be redirected to the home page shortly.
	If not redirected automatically, click <a href="index.php">here</a>';
    header('refresh:5;'.$url);
    ?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raktdaan - Removing Entry</title>


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
    <article>
    <p><h4>Logged Out Successfully. Redirecting...</h4></p>
    </article>
    </div>
    </body>
    </html>