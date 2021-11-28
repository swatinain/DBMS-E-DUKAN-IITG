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
    <title>View CC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="../script.js"></script>
</head>
<body>

<div class="topnav" id="myTopnav">   
        <a href="adminhome.php">Home</a>
        <a href="sellers.php" >View Sellers</a>
        <a href="buyers.php">View Buyers</a>
        <a href="cc.php" class="active">View CC</a>
        <a href="transactions.php">View Transaction</a>
        <a href="products.php">View Products</a>
        <a href="adminprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <center>
    <?php
        // echo $_SESSION['userid'];
        $stmt=$conn->query("SELECT * FROM e_dukan.customercare");
        $count=$stmt->rowCount();
        if($count==0){
            echo "<br> <br> All cc exectutives' details will appear here.";
        }
        else{
        echo "<center> <br> <br>";
        echo "<table border='1'><thead class='tablehead'><tr> <td> CCID </td> <td> CC Name <td> email </td><td> contactNo </td></tr></thead>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr class='tablerow'>";
            // print_r($row);
            echo "<td>".$row['ccid']."</td>";
            echo "<td>".$row['ename']."</td>";
            // echo "<td>".$row['walletBalance']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['contactNo']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</center>";
        }
    ?>
    </center>
</body>
</html>