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
        <a href="cchome.php">Home</a>
        <a href="transactions.php">Transactions</a>
        <a href="buyers.php">All buyers</a>
        <a href="sellers.php">All sellers</a>
        <a href="cc.php">All CC</a>
        <a href="products.php">All Products</a>
        <a href="ccprofile.php" class="active">Profile</a>
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
            <p> Name <br><input type="text" name="ename" required></p>
            <p>Contact No. <br><input type="number" name="contactNo" placeholder="Enter 10 digit contact no" required></p>
            <br>
            <p> <input type="submit" value="Update deatils" class="btn"></p>
        </form>
    </center>
    <?php

        if ( isset($_POST['ename']) &&  isset($_POST['contactNo'])) {
            $sql="UPDATE e_dukan.customercare U SET U.ename='".$_POST['ename']."',U.contactNo='".$_POST['contactNo']."' WHERE U.ccid='".$_SESSION['userid']."'";
            try{
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                header("location:ccprofile.php");
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
        
    ?>
</body>
</html>