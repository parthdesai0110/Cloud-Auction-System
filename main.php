<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">-
        <title>Cloud Computing:Web Based Auction System</title>
        <link href="css/style.css" rel='stylesheet' type='text/css' />

    </head>
    <body>
    <!-----start-main---->
    <div class="login-form">
        <div class="head">
            <img src="images/mem2.jpg" alt=""/>
        </div>
        <form method="post" action="login.php">
        <li>
            <input type="text" Placeholder="Username" name="uname" ><div class=" icon user"></div>
        </li>
        <li>
            <input type="password" Placeholder="Password"  name="password" ><div class=" icon lock"></div>
        </li>
        <div class="p-container">
            <label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Remember Me</label>
            <input type="submit" value="SIGN IN" >
            
        <div class="clear"> </div>
        </div>
        <div class="p-container">
            <p style="margin-top: 50px; margin-left: 90px;"><a href=register.php style="color: grey"><b>Create an Account</b></a></p>
        <div class="clear"> </div>
        </div>
    </form>

    <?php
     if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
        echo "Invalid Username / Password";
        }
    ?>
    </div>
    </body>
</html>
