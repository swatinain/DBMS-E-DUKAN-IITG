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
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="../script.js"></script>
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
    <center> <br><br>Your details are as follows:
        <br><br>
    <?php
    //    echo $_SESSION['userid'];
       $stmt=$conn->query("SELECT * FROM e_dukan.admin B WHERE B.aid='".$_SESSION['userid']."'");
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       echo "<center>";
       echo "<table border='1'>";
           if($row['aid']){
                echo "<tr class='tablerow'><td>AID</td><td>".$row['aid']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>AID</td><td>NULL</td></tr>";
            }
            if($row['email']!=NULL){
                echo "<tr class='tablerow'><td>Webmail</td><td>".$row['email']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>Webmail</td><td>NULL</td></tr>";
            }
            if($row['walletBalance']!=NULL){
                echo "<tr class='tablerow'><td>Wallet Balance</td><td>".$row['walletBalance']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>Wallet Balance</td><td>NULL</td></tr>";
            }
            if($row['aname']!=NULL){
                echo "<tr class='tablerow'><td>Admin name</td><td>".$row['aname']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>Admin name</td><td>NULL</td></tr>";
            }
            
            if($row['contactNo']!=NULL){
                echo "<tr class='tablerow'><td>contactNo</td><td>".$row['contactNo']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>contactNo</td><td>NULL</td></tr>";
            }
        echo "</table>";
       echo "</center>";

    ?>
    <br>
    <br>
    <center>

            Want to update your details ? <br> <br>
            <button id='myBtn' class='btn'>click to update profile</button>

    </center>
    <!-- <h1>update your profile</h1>
    <a href="updateBuyer.php" class="button">update</a> -->
    <br>
    </center>
    <script src="update.js"></script>
      
</body>
</html>