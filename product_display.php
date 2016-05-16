<?php
include('database.php');
if($_SESSION['userid']=="")
{
	header("location:main.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Product Details: Cloud Auction System</title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <script src="js/jquery.min.js"></script>
    <link href="css/product.css" rel='stylesheet' type='text/css' />
    <link href="css/etalage.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/product_display.css"/>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>
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
$id = $_GET['id'];
$_SESSION['prd_id'] = $id;

$sql = "SELECT * FROM product_details WHERE product_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $product_name = $row['product_name'];
        $prod_description = $row['prod_description'];
        $prod_category = $row['prod_category'];
        $product_bit_amt = $row['product_bit_amt'];
        $prod = $row['temp_image'];
        $created_at = $row['created_at'];

    }

}
//echo $created_at;
echo $current_date = date('Y-m-d h:i:s');
?>

<div class="details-left">
    <div class="details-left-slider">
        <ul id="etalage" class="etalage" style="display: block; width: 314px; height: 552px;">
            <?php
            echo '<img style="width:250px; height:250px" src=' ."data:image/jpeg;base64,".base64_encode( $prod ). " /> ";
            ?>

        </ul>
    </div>

    <div class="details-left-info">
        <div class="details-right-head">
            <h1><?php echo $product_name ?></h1>
            <p class="product-detail-info"><?php echo $prod_description ?></p>
            <div class="product-more-details">
                <ul class="price-avl">
                    <li class="price"><label>Starting Bid Price: <?php echo "$" . $product_bit_amt  ?></label></li>

                </ul>
            </div>
        </div>
    </div>

    <form action="product_bid.php?id=<?php echo $id; ?>" method="post">
        
        <div><button name="start_bid" class="button">Start Bidding &raquo;</button></div>
    </form>
</div>
</body>
</html>

