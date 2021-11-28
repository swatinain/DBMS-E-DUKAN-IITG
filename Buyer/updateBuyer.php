<?php
    require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
    session_start();
?>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="buyerhome.php" >Home</a>
        <a href="myorders.php" >My orders</a>
        <a href="cart.php">My cart</a>
        <a href="buyercontactcc.php">Contact CC</a>
        <a href="buyerprofile.php"  class="active">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <form action="POST"></form>
    <br>
    <br>
    <br>
    <div>
    </div>
    <center>
        
        <form method="POST">
            <p> Name <br> <input type="text" name="bname" ></p>
            <p> Add money to wallet <br> <input type="number" name="walletBalance"> </p>
            <p>Occupation <br><input type="text" name="occupation"></p>
            <p>Address <br><input type="text" name="address"></p>
            <p>Contact No. <br><input type="number" name="contactNo" ></p>
            <br>
            <p> <input type="submit" value="Update deatils" class="btn"></p>
        </form>
    </center>
    <?php

        if ( isset($_POST['bname']) && isset($_POST['walletBalance']) && isset($_POST['occupation']) && isset($_POST['address']) && isset($_POST['contactNo'])) {
            try{
                $sql="UPDATE e_dukan.users U SET U.uname='".$_POST['bname']."',U.walletBalance='".$_POST['walletBalance']."'+U.walletBalance,
        U.occupation='".$_POST['occupation']."',U.address='".$_POST['address']."',U.contactNo='".$_POST['contactNo']."' WHERE U.userid='".$_SESSION['userid']."'";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            $sql2="UPDATE e_dukan.buyer U SET U.bname='".$_POST['bname']."',U.walletBalance='".$_POST['walletBalance']."'+U.walletBalance,
            U.occupation='".$_POST['occupation']."',U.address='".$_POST['address']."',U.contactNo='".$_POST['contactNo']."' WHERE U.buyerid='".$_SESSION['userid']."'";
            try{
                $stmt2=$conn->prepare($sql2);
                $stmt2->execute();
                echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                header("location:buyerprofile.php");
                
            }
            catch(PDOException $e) {
                echo $sql2 . "<br>" . $e->getMessage();
            }
        }
        
    ?>
</body>
</html>