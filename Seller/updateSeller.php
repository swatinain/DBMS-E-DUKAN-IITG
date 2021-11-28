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
    <title>Seller Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="sellerhome.php">Home</a>
        <a href="addproduct.php">Add new product</a>
        <a href="myproducts.php">My products</a>
        <a href="contactcc.php">Contact CC</a>
        <a href="sellerprofile.php" class="active">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <br>
    <br> <br>
    <center>
        
        <form method="POST">
            <p> Name <br><input type="text" name="sname"><br></p>
            <p> Add money to wallet <br> <input type="number" name="walletBalance"placeholder="Add amount to be added"><br> </p>
            <p>Occupation <br>
                <input type="text" name="occupation"><br></p>
            <p>Address <br><input type="text" name="address"><br></p>
            <p>Contact No <br><input type="number" name="contactNo" placeholder="Enter 10 digit contact no"><br></p>
            <br>
            <p> <input type="submit" value="Update details" class="btn"></p>
            <br>
            <br>
        </form>
    </center>
    <?php

        if ( isset($_POST['sname']) && isset($_POST['walletBalance']) && isset($_POST['occupation']) && isset($_POST['address']) && isset($_POST['contactNo'])) {
            $sql="UPDATE e_dukan.users U SET U.uname='".$_POST['sname']."',U.walletBalance='".$_POST['walletBalance']."'+U.walletBalance,
            U.occupation='".$_POST['occupation']."',U.address='".$_POST['address']."',U.contactNo='".$_POST['contactNo']."' WHERE U.userid='".$_SESSION['userid']."'";
            try{
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            $sql2="UPDATE e_dukan.seller U SET U.sname='".$_POST['sname']."',U.walletBalance='".$_POST['walletBalance']."'+U.walletBalance,
            U.occupation='".$_POST['occupation']."',U.address='".$_POST['address']."',U.contactNo='".$_POST['contactNo']."' WHERE U.sellerid='".$_SESSION['userid']."'";
            try{
                $stmt2=$conn->prepare($sql2);
                $stmt2->execute();
                echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                header("location:sellerprofile.php");
            }
            catch(PDOException $e) {
                echo $sql2 . "<br>" . $e->getMessage();
            }
        }
        
    ?>
</body>
</html>