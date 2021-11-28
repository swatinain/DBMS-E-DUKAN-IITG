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
    <title>Filter products</title>
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
    <br>
    <br> <br>
    <center>Your details are as follows:
        <br><br>
    <?php
    //    echo $_SESSION['userid'];
       $stmt=$conn->query("SELECT * FROM e_dukan.customercare B WHERE B.ccid='".$_SESSION['userid']."'");
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
       echo "<center>";
       echo "<table border='1'>";
           if($row['ccid']){
                echo "<tr class='tablerow'><td>CC ID</td><td>".$row['ccid']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>CC ID</td><td>NULL</td></tr>";
            }
            if($row['ename']!=NULL){
                echo "<tr class='tablerow'><td>CC name</td><td>".$row['ename']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>CC name</td><td>NULL</td></tr>";
            }
            if($row['walletBalance']!=NULL){
                echo "<tr class='tablerow'><td>BALANCE</td><td>".$row['walletBalance']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>BALANCE</td><td>NULL</td></tr>";
            }
            if($row['email']!=NULL){
                echo "<tr class='tablerow'><td>Webmail</td><td>".$row['email']."</td></tr>";
            }
            else{
                echo "<tr class='tablerow'><td>Webmail</td><td>NULL</td></tr>";
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