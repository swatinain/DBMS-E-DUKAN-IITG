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
    <title>My products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="sellerhome.php">Home</a>
        <a href="addproduct.php">Add new product</a>
        <a href="myproducts.php" class="active">My products</a>
        <a href="contactcc.php">Contact CC</a>
        <a href="sellerprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <br>
    <br><br>
    <div>
        <?php
            try{
            $stmt=$conn->query("SELECT * FROM e_dukan.product P, e_dukan.productImages I  WHERE P.pid=I.pid AND  P.sellerID='".$_SESSION['userid']."'");
            $count=$stmt->rowCount();
            if($count==0){
                echo "<br><br> The products you uplaod to the portal will appear here.";
            }
            else{
            echo "<center>";
            echo"<table border='1'> <thead class='tablehead'><tr><td>PID</td><td>Product Name</td><td>Price</td><td>Category</td><td>Description</td><td>Sold/Unsold</td><td>Product Image</td></tr></thead>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                echo " <tr class='tablerow'>";
                $pid=$row['pid'];
                echo "<td>".$row['pid']."</td>";
                echo "<td>".$row['pname']."</td>";
                echo "<td>".$row['price']."</td>";
                echo "<td>".$row['category']."</td>";
                echo "<td>".$row['description']."</td>";
                if($row['inStock']){
                    echo "<td> Not sold yet </td>";
                }
                else{
                    echo "<td>";
                    echo "Sold";
                    echo "<br>";
                    echo '<form action="" method="POST">';
                    echo '<input type="hidden" name="pid" value="'.$pid.'" required>';
                    echo '<input type="submit" name="submit" value="View order details" class="btn">';
                    echo '</form>';
                    if(isset($_POST['submit'])){
                        $_SESSION['pid']=$_POST['pid'];
                        header("Location:orderdetails.php");
                    }
                    echo "<br>";
                    echo "</td>";

                    echo "<td>";
                    $loc=$row['imageLocation'];
                    echo "<img src='".$loc."' width='20%' >";

                    // $loc="C:\MAMP\htdocs\DBMS_Lab\Project\Images".$row['imageLocation'];
                    // echo "<a href='".$loc."' target='_blank'></a>";

                    echo "</td>";
                    echo "</tr>";
                }
                
                echo "</tr>";

            }

            echo "</table>";
            echo "<br><br>";
            echo "Want to remove any prodcut from the portal? <br> <br>
            <button id='myBtn' class='btn'>If YES, click me</button>";
            echo "</center>";
            }

        }catch(PDOExcepion $e){
            echo "Connection to database failed :".$e->getMessage();
        }
        ?> 
    </div>
    <br>
    <br>
    <div>
        
            
        
        <!-- <a href="http://"></a> -->
    </div>
    <script src="remove.js"></script>
      
</body>
</html>