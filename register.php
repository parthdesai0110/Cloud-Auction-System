<?php
include('database.php');
$msg = "";
if(isset($_POST['save'])) {

    $sql = "SELECT * FROM customer_details WHERE username = '".$_POST['uname']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    $msg = "Username already exits.";
    }else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['uname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone_no = $_POST['phone_no'];
        $street_add = $_POST['street_add'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $province = $_POST['province'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $date = $year . "-" . $month . "-" . $day;

        $res = mysqli_query($conn, "insert into customer_details(username,email,password,fname,lname,phone_no,gender,date_of_birth,street_add,city,postal_code,province,country) values ('$username','$email','$password','$fname','$lname','$phone_no','$gender','$date','$street_add','$city','$postal_code','$province','$country')") or die("Insert Operation Failed");
        header("Location:main.php");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Auction System Registration Form</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/register.css"/>
    </head>
    <body>
        <?php if($msg != ""){ ?>
            <p style="color:red; text-align: center;"><?php echo $msg; ?></p>
        <?php } ?>
        <form action="register.php" class="register" method="post">
            <h1>Registration</h1>
            <fieldset class="row1">
                <legend>Account Details
                </legend>
                <p>
                    <label>Email *
                    </label>
                    <input type="text" name="email" required/>
                    <label>Username *
                    </label>
                    <input type="text" name="uname" required/>
                </p>
                <p>
                    <label>Password*
                    </label>
                    <input type="text" name="password" required/>
                    <label>Repeat Password*
                    </label>
                    <input type="text" name="re_password" required/>
                    <label class="obinfo">* obligatory fields
                    </label>
                </p>
            </fieldset>
            <fieldset class="row2">
                <legend>Personal Details
                </legend>
                <p>
                    <label>First Name *
                    </label>
                    <input type="text" name="fname" class="long" required/>
                </p>
                <p>
                    <label>Last Name *
                    </label>
                    <input type="text" name="lname" class="long" required/>
                </p>
                <p>
                    <label>Phone *
                    </label>
                    <input type="text" name="phone_no" maxlength="10" required/>
                </p>
                <p>
                    <label class="optional">Street
                    </label>
                    <input type="text" name="street_add" class="long" required/>
                </p>
                <p>
                    <label>City *
                    </label>
                    <input type="text" name="city" class="long" required/>
                </p>
                <p>
                    <label>Postal Code *
                    </label>
                    <input type="text" name="postal_code" class="long" required/>
                </p>
                <p>
                    <label>Province *
                    </label>
                    <input type="text" name="province" class="long" required/>
                </p>
                <p>
                    <label>Country *
                    </label>
                    <select name="country" >
                        <option>
                        </option>
                        <option value="US">United States
                        <option value="CA">Canada
                        <option value="IN">India
                        </option>
                    </select>
                </p>
            </fieldset>
            <fieldset class="row3">
                <legend>Further Information
                </legend>
                <p>
                    <label>Gender *</label>
                    <input type="radio" name="gender" value="Male"/>
                    <label class="gender">Male</label>
                    <input type="radio" name="gender"value="Female"/>
                    <label class="gender">Female</label>
                </p>
                <p>
                    <label>Birthdate *
                    </label>
                    <select class="date" name="day">
                        <option value="1">01
                        </option>
                        <option value="2">02
                        </option>
                        <option value="3">03
                        </option>
                        <option value="4">04
                        </option>
                        <option value="5">05
                        </option>
                        <option value="6">06
                        </option>
                        <option value="7">07
                        </option>
                        <option value="8">08
                        </option>
                        <option value="9">09
                        </option>
                        <option value="10">10
                        </option>
                        <option value="11">11
                        </option>
                        <option value="12">12
                        </option>
                        <option value="13">13
                        </option>
                        <option value="14">14
                        </option>
                        <option value="15">15
                        </option>
                        <option value="16">16
                        </option>
                        <option value="17">17
                        </option>
                        <option value="18">18
                        </option>
                        <option value="19">19
                        </option>
                        <option value="20">20
                        </option>
                        <option value="21">21
                        </option>
                        <option value="22">22
                        </option>
                        <option value="23">23
                        </option>
                        <option value="24">24
                        </option>
                        <option value="25">25
                        </option>
                        <option value="26">26
                        </option>
                        <option value="27">27
                        </option>
                        <option value="28">28
                        </option>
                        <option value="29">29
                        </option>
                        <option value="30">30
                        </option>
                        <option value="31">31
                        </option>
                    </select>
                    <select name="month">
                        <option value="1">January
                        </option>
                        <option value="2">February
                        </option>
                        <option value="3">March
                        </option>
                        <option value="4">April
                        </option>
                        <option value="5">May
                        </option>
                        <option value="6">June
                        </option>
                        <option value="7">July
                        </option>
                        <option value="8">August
                        </option>
                        <option value="9">September
                        </option>
                        <option value="10">October
                        </option>
                        <option value="11">November
                        </option>
                        <option value="12">December
                        </option>
                    </select>
                    <input class="year" name="year" type="text" size="4" maxlength="4"/>e.g 1976
                </p>
            </fieldset>
            <fieldset class="row3">
                <legend>Confirm
                </legend>
            <div><button name="save" class="button">Register &raquo;</button></div>
            </fieldset>
        </form>

    </body>
</html>




