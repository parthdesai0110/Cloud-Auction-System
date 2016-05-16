<?php
include('database.php');
if($_SESSION['userid']=="")
{
	header("location:main.php");
}
$flag = " ";

if(isset($_POST["deactivate"])) {
    $flag = "0";
    $userid = $_SESSION["userid"];
    $sql_st = "SELECT * FROM product_details WHERE id = '$userid' and is_bid_over = ' ' ";
    $result_chk = $conn->query($sql_st);
    if ($result_chk->num_rows > 0) {
        $flag = '1';
    }

    $username = $_SESSION['CurrentUser'];
    $temp_productid =  $_SESSION['product_ids'];
    $rest = "SELECT * FROM product_bid WHERE product_id='$temp_productid' ORDER BY product_bid_amount DESC LIMIT 1";
    $chk_result = $conn->query($rest);
    if ($chk_result->num_rows > 0) {
        while ($row_chk = $chk_result->fetch_assoc()) {
            $chk_userid = $row_chk['username'];
            echo 'Username :' . $chk_userid;
            if ($username == $chk_userid) {
                $flag = '2';
            }
        }

    }

    if($flag == '0'){
        $res= mysqli_query($conn,"UPDATE customer_details SET deactivate='1' WHERE id = $userid") or die("Not Entered");
        //$url1 = test-data-temp-003.appspot.com/logout.php
        //header('Location: '.$url1);
        header("Location:logout.php");
    }
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
    $res= "SELECT * FROM customer_details where id=$userid";
    $result = $conn->query($res);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $phone_no = $row['phone_no'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
            $street_add = $row['street_add'];
            $city = $row['city'];
            $postal_code = $row['postal_code'];
            $province = $row['province'];
            $country = $row['country'];
        }
    }
?>
<?php if($flag == "1"){ ?>
    <p style="color:red; text-align: center;"><?php echo "You are not able to Deactivate your Account : Product in Auction" ?></p>
<?php } ?>
<?php if($flag == "2"){ ?>
    <p style="color:red; text-align: center;"><?php echo "Your Account is Deactivated: You are Highest on Bid" ?></p>
<?php } ?>
<?php if($flag == "0"){ ?>
    <p style="color:red; text-align: center;"><a href="logout.php"> <?php echo "Your Account is Deactivated" ?></a></p>

<?php }
header("Location:logout.php");
?>
<form action="update_details.php" class="register" method="post">
    <fieldset class="row2">
        <legend>Personal Details
        </legend>
        <p>
            <label>First Name</label>
            <input type="text" name="fname" class="long" value=  '<?php echo $fname ?>' />
        </p>
        <p>
            <label>Last Name</label>
            <input type="text" name="lname" class="long" value = '<?php echo $lname ?>' />
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email" class="long" value = '<?php echo $email ?>' />
        </p>
        <p>
            <label>Gender</label>
            <input type="text" name="gender" value=  '<?php echo $gender ?>' />
        </p>
        <p>
            <label>Birthdate
            </label>
            <input class="date_birth" name="date_birth" type="text" size="10" maxlength="10" value=  '<?php echo $date_of_birth ?>' />e.g yy/mm/dd
        </p>
        <p>
            <label>Phone</label>
            <input type="text" name="phone_no" maxlength="10" value=  '<?php echo $phone_no ?>' />
        </p>

        <p>
            <label>Street</label>
            <input type="text" name="street_add" class="long" value=  '<?php echo $street_add ?>' />
        </p>
        <p>
            <label>City</label>
            <input type="text" name="city" class="long" value=  '<?php echo $city ?>' />
        </p>
        <p>
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="long" value=  '<?php echo $postal_code ?>' />
        </p>
        <p>
            <label>Province</label>
            <input type="text" name="province" class="long" value=  '<?php echo $province ?>' />
        </p>
        <p>
            <label>Country</label>
            <input type="text" name="country" class="long" value=  '<?php echo $country ?>' />
        </p>
    </fieldset>
    <fieldset class="row5">
        <div><button name="update_details" class="button">Save Details &raquo;</button></div>
        <div><button name="deactivate" class="button">Deactivate Account &raquo;</button></div>
    </fieldset>
</form>

</body>

</html>

<?php


    if(isset($_POST['update_details'])){

        $email = $_POST['email'];
        $fname =  $_POST['fname'];
        $lname = $_POST['lname'];
        $phone_no = $_POST['phone_no'];

        $street_add = $_POST['street_add'];
        $city = $_POST['city'];
        $postal_code= $_POST['postal_code'];
        $province = $_POST['province'];
        $country = $_POST['country'];
        $gender= $_POST['gender'];
        $date_of_birth  = $_POST['date_birth'];

        $userid = $_SESSION['userid'];
        
		$res= mysqli_query($conn,"UPDATE customer_details SET email='$email', fname='$fname' , lname='$lname', phone_no='$phone_no', gender='$gender', date_of_birth='$date_of_birth', street_add='$street_add',city='$city',postal_code='$postal_code',province='$province',country='$country' WHERE id=$userid") or die("Not Entered");
       
		header("Location:update_details.php");

    }

?>