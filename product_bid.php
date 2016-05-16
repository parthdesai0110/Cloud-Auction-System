<?php

include('database.php');
if($_SESSION['userid']=="")
{
	header("location:main.php");
}

$userid = $_SESSION['userid'];
$id = $_GET['id'];
$prod_id = $id;
$url1=$_SERVER['REQUEST_URI'];

$sql = "SELECT * FROM product_details WHERE product_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product_name = $row['product_name'];
        $prod_description = $row['prod_description'];
        $prod_category = $row['prod_category'];
        $product_bit_amt = $row['product_bit_amt'];
        $prod = $row['temp_image'];
        $created_at = $row['biding_date'];
        $is_bid_over = $row['is_bid_over'];
    }
}

$current_date = date('Y-m-d h:i:s');

$to_time = strtotime($created_at);
$from_time = strtotime($current_date);
$total_minute = round(abs($to_time - $from_time) / 60,2). " minute";

if($total_minute > 5){
	$refresh = "0";
}else{
	$refresh = "1";
}

if($created_at > $current_date){
    $diff = strtotime($created_at) - strtotime($current_date);
    $time = date('i:s', $diff);
    $time_flag = "0";

}else{

    $diff = strtotime($current_date) - strtotime($created_at);
    $time = date('i:s', $diff);
    $time_flag = "1";
}

$id = $_GET['id'];
$last_bid_amount = $product_bit_amt;
$prd_id = $_SESSION['prd_id'];

$res_amt = "SELECT * FROM product_bid WHERE product_id='$id' ORDER BY product_bid_amount DESC LIMIT 1";
$last_result = $conn->query($res_amt);
if ($last_result->num_rows > 0) {
    while ($row = $last_result->fetch_assoc()) {
        $last_bid_amount = $row['product_bid_amount'];
        $last_username = $row['username'];
        $last_email = $row['email'];
    }
}

if($refresh == "0"){
	if($is_bid_over == '0'){
		$res= mysqli_query($conn,"UPDATE product_details SET is_bid_over='1', winner_name='$last_username' , 	winner_price='$last_bid_amount' WHERE product_id = $id") or die("Not Entered");

        require_once 'google/appengine/api/mail/Message.php';

        $username = $last_username;
        $amount = $last_bid_amount;
        $to = $last_email;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Parth Desai<parth8539@gmail.com>' . "\r\n";

        $Email_Subject = "You Win the Bid";
        $message = 'Hello '.$last_username . '<br>';
        $message .= 'Please check Win product on Google Cloud.'.'<br>' . 'Product Amount: ' . $last_bid_amount . '<br>';
        $to = $last_email;

        $email_flag = mail($to,$Email_Subject,$message,$headers);

	}
}
?>
<?php
$fname = '';
$useremailid = '';
$bid_amount ='';
$status = '';
if(isset($_POST['bid_amount'])){

    $minimum_amt = $_POST['bid_amt'];

    if($last_bid_amount < $minimum_amt){

        $bid_amount = $_POST['bid_amt'];
        $sql = "SELECT * FROM customer_details WHERE id = $userid";
        $result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
                $product_id = $prod_id;
                $user_name = $row['username'];
                $email_bid = $row['email'];
                $product_bid_amount = $_POST['bid_amt'];

                $res=mysqli_query($conn,"insert into product_bid(product_id,username,email,product_bid_amount) values ('$product_id','$user_name','$email_bid','$product_bid_amount')") or die("Insert Operation Failed");
                $_SESSION['product_ids'] = $product_id;
				header('Location: '.$url1);
                $status = '0';
            }
        }

    }else{
        $status = '1';
		$url2 = $url1."&status=1";
		header('Location: '.$url2);
    }
}

if($_GET['status'] == '1'){
	$status = '1';
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
    <link href="css/product.css" rel='stylesheet' type='text/css' />
    <link href="css/etalage.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/product_display.css"/>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	
	<script type="application/x-javascript">
	$(document).ready(function(){
		<?php if($refresh){ ?>
		setTimeout(function() {
			window.location.reload();
		}, 10000);
		<?php } ?>
	});
	</script>
	
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
                <li class="price"><label>Starting Bid Price: <?php echo "$" . $product_bit_amt; ?></label></li>
            </ul>
        </div>
    </div>
</div>

<div class="details-left-info">
    <div class="details-right-head">
		<div class="product-more-details">
            <ul class="price-avl">
                <?php if($time_flag) {?>
                    <?php if($refresh){ ?>
                        <li class="price"><label>Time Remaining For Auction: <?php echo $time; ?></label></li>
                    <?php }else{ ?>
                        <li class="price"><label>Biding Time Over...</label></li>
                    <?php } ?>
                <?php }else{ ?>
                    <li class="price"><label>Biding starting within: <?php echo $time; ?> min.</label></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<form action="product_bid.php?id=<?php echo $prod_id; ?>" method="post">
    <fieldset class="row2">
        <table width="600">
            <tr>
                
                <th bgcolor="silver">Username</th>
                <th bgcolor="silver">EMail</th>
                <th bgcolor="silver">Bid Amount</th>
            </tr>

			
            <?php
			if($refresh){
				$product_bid_tbl = "SELECT * FROM product_bid where product_id=".$id;
				$results = $conn->query($product_bid_tbl);

				if ($results->num_rows > 0) {
					while ($row_bid = $results->fetch_assoc()) {

						$bid_username =$row_bid['username'];
						$bid_email = $row_bid['email'];
						$bid_amout =$row_bid['product_bid_amount'];
						echo '<tr>';
						echo '<td>' . $bid_username .'</td>';
						echo '<td>' . $bid_email . '</td>';
						echo '<td>' . $bid_amout . '</td>';
						echo '</tr>';

					}
				}
			}else{
				$product_bid_tbl = "SELECT * FROM product_bid WHERE product_id='$id' ORDER BY product_bid_amount DESC LIMIT 1";
				$results = $conn->query($product_bid_tbl);

				if ($results->num_rows > 0) {
					while ($row_bid = $results->fetch_assoc()) {

						$bid_username =$row_bid['username'];
						$bid_email = $row_bid['email'];
						$bid_amout =$row_bid['product_bid_amount'];
						echo '<tr>';
						
						echo '<td>' . $bid_username .'</td>';
						echo '<td>' . $bid_email . '</td>';
						echo '<td>' . $bid_amout . '</td>';
						echo '</tr>';

					}
				}
			}

            ?>
        </table>

        <?php if($time_flag) {?>
        <?php if($refresh){ ?>
        <p>
            <label>Enter Bid Amount*
            </label>
            <input type="text" placeholder="Enter Amount" name="bid_amt"/>
            <?php
            if($status == '1'){
                echo '<br>';
                echo '<p style="color:red;">Please Increase your Bid Amount';
                }
            }
            ?>
        </p>
        <div>
			<button name="bid_amount" class="button">Submit Bid Amount &raquo;</button>
        </div>
		<?php } ?>
    </fieldset>

</form>
</div>
</body>
</html>
