<?php
    include('database.php');
	if($_SESSION['userid']=="")
	{
		header("location:main.php");
	}
    if(isset($_POST['edit'])){
        header("Location:update_details.php");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Account Details: Cloud Auction System</title>
    <link rel="stylesheet" type="text/css" href="css/register.css"/>
    <link rel="stylesheet" type="text/css" href="css/menu.css"/>
</head>

<body>
<div id='cssmenu'>
    <ul>
        <li><a href='Home.php'><span>Home</span></a></li>
        <li class='active has-sub'><a href='#'><span>Products</span></a>
            <ul>
                <li class='has-sub'><a href='#'><span>Manage Product</span></a></li>
                <li class='has-sub'><a href='upload_product.php'><span>Upload Product</span></a></li>
            </ul>
        </li>
        <li class='active has-sub'><a href='#'><span>Accout</span></a>
            <ul>
                <li class='has-sub'><a href='account_details.php'><span>View Account</span></a></li>
                <li class='has-sub'><a href='update_details.php'><span>Manage Account</span></a></li>
                <li class='has-sub'><a href='logout.php'><span>Logout</span></a></li>
            </ul>
        </li>
        <li class='last'><a href='#'><span>Contact</span></a></li>
    </ul>
</div>

<?php

$userid = $_SESSION['userid'];
$res= "SELECT * FROM customer_details WHERE id=$userid";
$result = $conn->query($res);
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        //echo $row['fname'] . "<br/>";
        $fname = $row['fname'];
        //echo $fname;
        $lname = $row['lname'];
        $email = $row['email'];
        $phone = $row['phone_no'];
        $gender = $row['gender'];
        $date_of_birth = $row['date_of_birth'];
        $street_add = $row['street_add'];
        $city = $row['city'];
        $postal_code = $row['postal_code'];
        $province = $row['province'];
        $country = $row['country'];


?>

<form class="register" method="post">
    <fieldset class="row2">
        <legend>Personal Details
        </legend>
        <p>
            <label>First Name</label>
            <input type="text" name="fname" class="long" readonly value=  '<?php echo  $fname ?>' />
        </p>
        <p>
            <label>Last Name</label>
            <input type="text" name="lname" class="long" readonly value = '<?php echo $lname ?>' />
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email" class="long" readonly value = '<?php echo $email ?>' />
        </p>
        <p>
            <label>Gender</label>
            <input type="text" name="gender" readonly value=  '<?php echo $gender ?>' />
        </p>
        <p>
            <label>Birthdate
            </label>
            <input class="date_birth" name="date_birth" type="text" size="10" maxlength="10" readonly value=  '<?php echo $date_of_birth ?>' />e.g yy/mm/dd
        </p>
        <p>
            <label>Phone</label>
            <input type="text" name="phone_no" maxlength="10" readonly value=  '<?php echo $phone ?>' />
        </p>

        <p>
            <label>Street</label>
            <input type="text" name="street_add" class="long" readonly value=  '<?php echo $street_add ?>' />
        </p>
        <p>
            <label>City</label>
            <input type="text" name="city" class="long" readonly value=  '<?php echo $city ?>' />
        </p>
        <p>
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="long" readonly value=  '<?php echo $postal_code ?>' />
        </p>
        <p>
            <label>Province</label>
            <input type="text" name="province" class="long" readonly value=  '<?php echo $province ?>' />
        </p>
        <p>
            <label>Country</label>
            <input type="text" name="country" class="long" readonly value= '<?php echo $country ?>' /><?php }}?>
        </p>
    </fieldset>

    <div><button name="edit" class="button">Edit Details &raquo;</button></div>

</form>

</body>

</html>
