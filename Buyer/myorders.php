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
    <title>My orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="../script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="buyerhome.php" >Home</a>
        <a href="myorders.php"  class="active">My orders</a>
        <a href="cart.php">My cart</a>
        <a href="buyercontactcc.php">Contact CC</a>
        <a href="buyerprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <center> <br><br>
        <?php
            try{ 
                $stmt=$conn->query("SELECT * FROM e_dukan.payment M, e_dukan.product P WHERE M.buyerID='".$_SESSION['userid']."' AND M.pid=P.pid");
                $count=$stmt->rowCount();
                if($count==0){
                    echo "Your orders will appear here.";
                }
                else{
                echo"<table border='1'><thead class='tablehead'><tr>
                <td>PID</td><td>Payment date and time</td><td>Payment ID</td><td>Product name</td><td>Price(in Rs.)</td></tr></thead>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($row);
                    echo "<tr class='tablerow'>";
                    echo "<td>".$row['pid']."</td>";
                    echo "<td>".$row['paymentDate']."</td>";
                    echo "<td>".$row['paymentID']."</td>";
                    echo "<td>".$row['pname']."</td>";
                    echo "<td>".$row['price']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            }catch(PDOExcepion $e){
                echo "Connection to database failed :".$e->getMessage();
            }
            
        ?>
    
    </center>
</body>
</html>