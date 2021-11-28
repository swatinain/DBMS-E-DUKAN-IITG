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
    <title>My cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="../script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="buyerhome.php" >Home</a>
        <a href="myorders.php">My orders</a>
        <a href="cart.php" class="active">My cart</a>
        <a href="buyercontactcc.php">Contact CC</a>
        <a href="buyerprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <center>
    <br><br>
   
    <br><br>
    <?php
    try{
        $stmt=$conn->query("SELECT * FROM  e_dukan.product P , e_dukan.addedTo A WHERE A.buyerID='".$_SESSION['userid']."' AND A.pid=P.pid AND P.inStock=1");
        
        $count=$stmt->rowCount();
        if($count==0){
            echo "<br> <br>";
            echo "Your cart is empty :(";
        }
        else{
            echo '<br><br>';
            echo 'You have following items in your cart:';
            echo '<br><br>';
        echo"<table border='1'><thead class='tablehead'><tr>
        <td>Seller ID</td><td>PID</td>
        <td>Product Name</td><td>Price</td><td> Remove </td><td>Order</td>
        </tr></thead>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // print_r($row);
            echo "<tr class='tablerow'>";
            echo "<td>".$row['sellerID']."</td>";
            $pid=$row['pid'];
            echo "<td>".$row['pid']."</td>";
            echo "<td>".$row['pname']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>";
            $stock=$row['inStock'];
            if($stock){
                // echo "Available";
                echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="pid" value="'.$pid.'" required>';
                    echo '<input type="submit" name="submit" value="Remove from cart" class="btn">';
                echo '</form>';
                if(isset($_POST['submit'])){
                    $_SESSION['pid']=$_POST['pid'];
                    header("Location:removeFromCart.php");
                }
            }
            else{
                echo "Already Sold";
            }
            echo "</td>";

            echo "<td>";
            if($stock){
                echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="pid2" value="'.$pid.'" required>';
                    echo '<input type="submit" name="submit2" value="Place order" class="btn">';

                echo '</form>';
                
                if(isset($_POST['submit2'])){
                    $_SESSION['pid2']=$_POST['pid2'];
                    header("Location:placeorder.php");
                }
            }
            else{
                echo "Already Sold";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
      
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
?>


    </center>
    <script>
        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
        document.location.href = 'placeorder.php';
        });
    </script>
      
</body>
</html>