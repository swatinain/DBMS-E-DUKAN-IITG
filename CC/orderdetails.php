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
        <a href="products.php" class="active">All products</a>
        <a href="ccprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <br>
    <br><br>
    <center>
    <?php
            try{ 
                $stmt=$conn->query("SELECT * FROM e_dukan.payment P, e_dukan.buyer B, e_dukan.pays K,e_dukan.seller S WHERE P.pid='".$_SESSION['pid']."' AND K.pid='".$_SESSION['pid']."' AND P.buyerid=B.buyerid AND K.sellerID=S.sellerID");
                echo "";
                echo "<table border='1'><thead class='tablehead'><tr>
                <td>PID</td>
                <td>BuyerID</td>
                <td>Buyer Name</td>
                <td>SellerID</td>
                <td>Seller Name</td>
                <td>Amount</td>
                <td>PaymentID</td>
                <td>Payment Date and Time</td>
                </tr></thead>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($row);
                    $buyerid=$row['buyerID'];
                    $pid=$row['pid'];
                    $price=$row['paymentamount'];
                    $adminAmount=$price*0.05;
                    $sellerAmount=$price*0.95;
                    $date=$row['paymentDate'];
                    $paymentID=$row['paymentID'];
                    $bname=$row['bname'];
                    $sellerid=$row['sellerID'];
                    $sname=$row['sname'];
                    echo "<tr class='tablerow'>";
                    echo "<td>".$pid."</td>";
                    echo "<td>".$buyerid."</td>";
                    echo "<td>".$bname."</td>";
                    echo "<td>".$sellerid."</td>";
                    echo "<td>".$sname."</td>";
                    echo "<td>".$price."</td>";
                    echo "<td>".$paymentID."</td>";
                    echo "<td>".$date."</td>";
                    echo "</tr>";
                }
                echo "</table>";

            }catch(PDOExcepion $e){
                echo "Connection to database failed :".$e->getMessage();
            }

            echo "<br> <br>";
            echo '<a style="text-decoration: none;" href="products.php" class="btn spacebottom spacetop"> Go back to all Products </a>';
            echo "<br> <br>";
            
        ?>
         

    </center>

    </center>
      
</body>
</html>