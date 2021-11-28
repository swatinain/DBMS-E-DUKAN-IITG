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
    <title>View transactions</title>
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
        <a href="transactions.php" class="active">View Transaction</a>
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
        $stmt=$conn->query("SELECT * FROM e_dukan.payment Y, e_dukan.pays P where Y.pid=P.pid");
        $count=$stmt->rowCount();
        if($count==0){
            echo "<br> <br> All transactions will appear here.<br><br>";
        }
        else{
        echo "<center>";
        echo "<br> <br>";
        echo "<table border='1'><thead class='tablehead'><tr> <td> PID </td> <td> Seller ID </td> <td> BuyerID </td>
         <td>Amount </td><td> Payment ID </td>
         <td> Payment date and time </td></tr></thead>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // print_r($row);
            $buyerid=$row['buyerID'];
            $pid=$row['pid'];
            $price=$row['paymentamount'];
            $adminAmount=$price*0.05;
            $sellerAmount=$price*0.95;
            $paymentDate=$row['paymentDate'];
            $paymentID=$row['paymentID'];
            $sellerid=$row['sellerID'];
            

            echo "<tr class='tablerow'>";
            echo "<td>".$pid."</td>";
            echo "<td>".$sellerid."</td>";
            echo "<td>".$buyerid."</td>";
            echo "<td>".$price."-".$adminAmount."=".$sellerAmount."</td>";
            echo "<td>".$paymentID."</td>";
            echo "<td>".$paymentDate."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</center>";

        }
    ?>
    </center>
</body>
</html>