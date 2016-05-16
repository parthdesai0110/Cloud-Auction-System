<?php
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
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>
    <title>Home: Cloud Auction System</title>
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

</body>
</html>

<?php

    $sql = "SELECT * FROM product_details";
    $result = $conn->query($sql);
    echo '<p style="color:white;font-size:24px;">' . "Products For Auctions" . '</p>';
    echo '<ul>';
    echo '<hr>';
    while ($rows = $result->fetch_assoc()){
		
		if($rows["is_bid_over"] == "0"){

        echo '<li style="display: inline-block; padding: 25px"> '.
            '<img style="width:250px; height:250px" src=' ."data:image/jpeg;base64,".base64_encode( $rows["temp_image"] ). " /> "

            . '<br> . <center> ' . $rows["product_name"]  . '<br>' . '<a href=' . "product_display.php?id=" .$rows["product_id"].'>' . '<p style=' . "color:white; font-size:24px;" . '>' ."View Details" . '</p>' . '</a>' . '</center> . </li>';
		}/*else{
			echo '<li style="display: inline-block; padding: 25px"> '.
            '<img style="width:250px; height:250px" src=' ."data:image/jpeg;base64,".base64_encode( $rows["temp_image"] ). " /> "

            . '<br> . <center> ' . $rows["product_name"]  . '<br>' . 'Winner Name :: '.$rows["winner_name"].'<br>Winner Price :: '.$rows["winner_price"].'</center> </li>';
		}*/
		
    }
    echo '</ul>';

?>
<?php
echo '<hr>';
$sql = "SELECT * FROM product_details";
$result = $conn->query($sql);
echo '<p style="color:white;font-size:24px;">' . "Biding Over Products" . '</p>';
echo '<ul>';
while ($rows = $result->fetch_assoc()){

    if($rows["is_bid_over"] == "1"){

        echo '<li style="display: inline-block; padding: 25px"> '.
            '<img style="width:250px; height:250px" src=' ."data:image/jpeg;base64,".base64_encode( $rows["temp_image"] ). " /> "

            . '<br> . <center> ' . $rows["product_name"]  . '<br>' . '<a href=' . "product_display.php?id=" .$rows["product_id"].'>' . '<p style=' . "color:white; font-size:24px;" . '>' ."View Details" . '</p>' . '</a>' . '</center>' .
            '<br>' . 'Winner Name :: '.$rows["winner_name"].'<br>Winner Price :: '.$rows["winner_price"]. '</center> </li>';
    }/*else{
        echo '<li style="display: inline-block; padding: 25px"> '.
            '<img style="width:250px; height:250px" src=' ."data:image/jpeg;base64,".base64_encode( $rows["temp_image"] ). " /> "

            . '<br> . <center> ' . $rows["product_name"]  . '<br>' . 'Winner Name :: '.$rows["winner_name"].'<br>Winner Price :: '.$rows["winner_price"].'</center> </li>';
    }*/

}
echo '</ul>';

?>
