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
    <a href="adminhome.php">Home</a>
        <a href="sellers.php" >View Sellers</a>
        <a href="buyers.php">View Buyers</a>
        <a href="cc.php">View CC</a>
        <a href="transactions.php">View Transaction</a>
        <a href="products.php">View Products</a>
        <a href="adminprofile.php" class="active">Profile</a>
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
            <p> Name* <br><input type="text" name="aname" required><br></p>
            <p>Contact No* <br>
                <input type="number" name="contactNo" required ></p>
                <br>
                <br>
            <p> <input type="submit" value="Update deatils" class="btn"></p>
        </form>
    </center>
    <?php

        if ( isset($_POST['aname']) &&  isset($_POST['contactNo'])) {
            $sql="UPDATE e_dukan.admin U SET U.aname='".$_POST['aname']."',U.contactNo='".$_POST['contactNo']."' WHERE U.aid='".$_SESSION['userid']."'";
            try{
                $stmt=$conn->prepare($sql);
                $stmt->execute();
                echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                header("Location:adminprofile.php");
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            
        }
        
    ?>
</body>
</html>