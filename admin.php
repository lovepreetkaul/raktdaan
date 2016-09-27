<?php
 
    session_start();
     if (!isset($_SESSION['user_id'])) {
        echo '<h4><p>Please <a href="login.php">Log in</a> to access this page.</p></4>';
        exit();
    }
    else{
        echo '<h5>You are logged in as '.$_SESSION['username'].'</h5> <a href=logout.php><i>Log out</i>';

        //Connect to the database
        $dbc = mysqli_connect('localhost', 'root', 'nseries', 'bloodbank') or die('Error Connecting to Database');

        $query = "SELECT blood_id,status from donor";
        $result = mysqli_query($dbc, $query) or die('Error Querying');
        $total = mysqli_num_rows($result);
        $count = array(0,0,0,0,0,0,0,0,0);
        $units = 0;
        while($row = mysqli_fetch_array($result)){
            if($row['status']){
                $units = $units + 1;
                $temp = $row['blood_id'];
                $count[$temp] = $count[$temp] + 1;
            }
            
        }

?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raktdaan - Admin Panel</title>


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
<?php

    echo '<p><h5>Available Donors: '.$units.'</h5></p>';
    echo '<p><h5>Total Donors:     '.$total.'</h5></p>';
    echo' 
    <table cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Blood Group</th>
        <th>Available Units</th>
    </tr>
    <tr>
        <td>1</td>
        <td>A+</td>
        <td>'.$count[1].'</td>
    </tr>
    <tr>
        <td>2</td>
        <td>A-</td>
        <td>'.$count[2].'</td>
    </tr>
    <tr>
        <td>3</td>
        <td>B+</td>
        <td>'.$count[3].'</td>
    </tr>
    <tr>
        <td>4</td>
        <td>B-</td>
        <td>'.$count[4].'</td>
    </tr>
    <tr>
        <td>5</td>
        <td>AB+</td>
        <td>'.$count[5].'</td>
    </tr>
    <tr>
        <td>6</td>
        <td>AB-</td>
        <td>'.$count[6].'</td>
    </tr>
    <tr>
        <td>7</td>
        <td>O+</td>
        <td>'.$count[7].'</td>
    </tr>
    <tr>
        <td>8</td>
        <td>O-</td>
        <td>'.$count[8].'</td>
    </tr>
    </table>';
?>

    <br />
    <br />
    <br />
    <p><h4>Search Donors</h4></p>
    <form method="post" class="searchform" action="<?php echo $_SERVER['PHP_SELF'];?>" >
             <!-- Email-->
            <p>
                <label for="email">Email:</label>
                <input type="text" size="32" name="email" id="email" required/>
                
            </p>

            <p><input name="submit" style="margin-left: 150px;" class="formbutton" value="Get User Data" type="submit" /></p>
          </fieldset>
    </form>
<?php
    
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $query = "SELECT donor_id,first_name,last_name,mobile,status FROM donor where email='$email'";
            $result = mysqli_query($dbc, $query) or die('Error Querying2');
            while($row = mysqli_fetch_array($result)){
                $var = $row['donor_id'];
            echo'
                <table cellspacing="0">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>'.$row['donor_id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['status'].'</td>
                <td>'.$row['mobile'].'</td>';
                $status = 1 - $row['status'];
                echo'
                <td><a href="disable.php?id='.$var.'&status='.$status.'">';
                if($row['status'] == 0){
                    echo 'Enable';
                    $status = 1;
                }
                else{
                    echo 'Disable';
                    $status = 0;            }
                echo'</a></td>
                <td><a href="remove.php?id='.$var.'">Delete</a></td>
            </tr>';

            }
        }
    echo'</article>';

        mysqli_close($dbc);
    }

?>




