<?php
//use \google\appengine\api\mail\Message;
include('database.php');
if($_SESSION['userid']=="")
{
	header("location:main.php");
}
?>
<!doctype html>
<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Upload Product : Cloud Auction System</title>
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
        <li class='active has-sub'><a href='account_details.php'><span>Accout</span></a>
            <ul>
                <li class='has-sub'><a href='account_details.php'><span>View Account</span></a></li>
                <li class='has-sub'><a href='update_details.php'><span>Manage Account</span></a></li>
                <li class='has-sub'><a href='logout.php'><span>Logout</span></a></li>
            </ul>
        </li>
        <li class='last'><a href='#'><span>Contact</span></a></li>
    </ul>
</div>
<form action="upload_product.php" class="register" method="post" enctype="multipart/form-data">
    <h1>Product Registration</h1>
    <?php if($msg != ""){ ?>
        <p style="color:green; text-align: center;"><?php echo $msg; ?></p>
    <?php } ?>
    <fieldset class="row2">
        <legend>Personal Details
        </legend>
        <p>
            <label>Product Name *
            </label>
            <input type="text" name="pname" required/>
        </p>
        <p>
            <label>Product Description *
            </label>
            <textarea name="pdesc"cols="20" rows="4" placeholder="Enter Product Description" style="border-width: 1px;" required></textarea><br />
        </p>
        <p>
            <label>Product Category
            </label>
            <select name="pcategory">
                <option>
                </option>
                <option value="Furniture">Furniture
                <option value="Electronic Devices">Electronic Devices
                <option value="Mobiles">Mobile & Phones
                <option value="Others">Others
                </option>
            </select>
        </p>
        <p>
            <label>Starting Bid Amount*
            </label>
            <input type="text" name="bid_amt" required/>
        </p>
        <p>
            <label>Product Image*
            </label>
            <input type="file" name="fileToUpload" id="fileToUpload" required/>
        </p>
    </fieldset>
    <fieldset class="row3">
        <legend>Confirm
        </legend>
        <div><button name="save" class="button">Save &raquo;</button></div>
    </fieldset>
</form>

</body>
</html>

<?php

    // Check if image file is a actual image or fake image
    $msg = "";
   if(isset($_POST["save"])) {
        
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    
    if ($uploadOk == 0) {
        $msg = "Error on File Upload";
    } else {
        $product_name = $_POST['pname'];
        $prod_description = $_POST['pdesc'];
        $prod_category = $_POST['pcategory'];
        $product_bid_amt = $_POST['bid_amt'];
        $session_id = $_SESSION['userid'];
        $image = file_get_contents($_FILES['fileToUpload']['tmp_name']);
        $temp_image = addslashes($image);
        $image_name = $_FILES['fileToUpload']['name'];
        $created_at = date('Y-m-d h:i:s');

        $currentDate = strtotime($created_at);
        $futureDate = $currentDate;// + (60 * 5);
        $biding_date = date("Y-m-d H:i:s", $futureDate);


        $res = mysqli_query($conn, "insert into product_details(id,product_name,prod_description,prod_category,product_bit_amt,image,temp_image,created_at,biding_date) values ('$session_id','$product_name','$prod_description','$prod_category','$product_bid_amt','$image_name','$temp_image','$created_at','$biding_date')") or die("Insert Operation Failed");

        $msg = "Successfully Uploaded";

        $sql1 = "SELECT * FROM customer_details";
        $result = $conn->query($sql1);

        while ($rows = $result->fetch_assoc()){

            require_once 'google/appengine/api/mail/Message.php';
           // use \google\appengine\api\mail\Message;


            $username = $rows["username"];
            $to = $rows["email"];
            if($rows["id"] != $_SESSION['userid']){

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: Parth Desai<parth8539@gmail.com>' . "\r\n";

                $Email_Subject = "Auction system upload new product";
                $message = 'Hello '.$username . '<br>';
                $message .= 'Please check new product uploaded.'.'<br>' . 'Product Name: ' . $product_name . '<br> Product Descriptiopn: ' . $prod_description . '<br>Product Starting Amount: ' . $product_bid_amt .'<br>';
                $to = $rows["email"];

                $email_flag = mail($to,$Email_Subject,$message,$headers);

            }


        }
      header("Location:Home.php");

    }
   }

?>