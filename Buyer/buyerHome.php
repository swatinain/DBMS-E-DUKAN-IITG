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
    <script src="../script.js"></script>
    
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="buyerhome.php"  class="active">Home</a>
        <a href="myorders.php">My orders</a>
        <a href="cart.php">My cart</a>
        <a href="buyercontactcc.php">Contact CC</a>
        <a href="buyerprofile.php">Profile</a>
        <!-- <a href="buyerhomeRequired.php">Filters</a> -->

        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
</div>
    <center>
    <br><br>
    <!-- Login for the first time? Update all your details here: <br><br>
        <a style="text-decoration: none;" href="buyerprofile.php" class="btn"> Enter details </a> -->
    We have the following products for you:
        <?php
            try{
                $stmt=$conn->query("SELECT * FROM e_dukan.product P, e_dukan.productImages I  WHERE P.pid=I.pid AND P.inStock=1");
                // var_dump($stmt);

                ?>
                <table border="1">
                <thead class='tablehead'><tr>
                <td>PID</td><td>Product Name</td><td>Price</td><td>Category</td><td>Description</td><td> </td><td>Image</td></tr></thead>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    // var_dump($row);
                    $pid=$row['pid'];
                    echo "<br><br>";
                    
                    echo "<tr class='tablerow'>";

                    echo "<td>";
                    echo $pid;
                    echo "</td>";

                    echo "<td>";
                    echo $row['pname'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['price'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['category'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['description'];
                    echo "</td>";

                    echo "<td>";
                    if($row['inStock']){
                        // echo "Available";
                        
                        echo '<form action="" method="POST">';
                            echo '<input type="hidden" name="pid" value="'.$pid.'" required>';
                            echo '<input type="submit" name="submit" value="Add to cart" class="btn">';

                        echo '</form>';
                        if(isset($_POST['submit'])){
                            $_SESSION['pid']=$_POST['pid'];
                            header("Location:addToCart.php");
                        }  
                    }
                    else{
                        echo "Sold";
                    }
                    echo "</td>";

                    echo "<td>";
                    $loc=$row['imageLocation'];
                    echo "<img src='".$loc."' width='20%' >";
                    // echo "<a href='C:\MAMP\htdocs\DBMS_Lab\Project\Seller\".$loc." ">View Image</a>";

                    echo "</td>";
                    echo "</tr>";
                }

                ?>
                </table>
                <?php
            }catch(PDOExcepion $e){
                echo "Connection to database failed :".$e->getMessage();
            }

        ?>
        

    </center>
    <script>
        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
        document.location.href = 'addToCart.php';
});
    </script>
      
</body>
</html>