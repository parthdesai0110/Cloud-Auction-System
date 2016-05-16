<?php
    include('database.php');
?>
<?php

    if(isset($_POST['uname'])){

        $uname = $_POST['uname'];
        $pword = $_POST['password'];
        
        $sql = "SELECT * FROM customer_details WHERE username = '$uname' and password = '$pword' ";
        $result = $conn->query($sql);
            
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($uname == $row["username"] and $pword == $row["password"]) {
                session_start();
                $_SESSION['CurrentUser'] = $uname;
                $_SESSION['userid'] = $row['id'];
                $userid = $row['id'];
                $res= mysqli_query($conn,"UPDATE customer_details SET deactivate='0' WHERE id = $userid") or die("Not Entered");
                header("Location:Home.php");
            }else{
                    $entry = false;
                    header("Location:main.php");
                }
        }
        }else{
            $entry = false;
            header("Location:main.php");
        }
        $conn->close();
    }else{
        $status = false;
        header("Location:main.php");
    }
      
?>

