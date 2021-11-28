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
    <title>Add money</title>
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

    <form method="POST">
            <p> Enter amount to add to your wallet <br> <input type="number" name="walletBalance" required> </p>
            <br>
            <p> <input type="submit" name="submit" value="Add money" class="btn"></p>
        </form>
        <?php
            if ( isset($_POST['submit'])) {
                try{
                    $sql="UPDATE e_dukan.users U SET U.walletBalance='".$_POST['walletBalance']."'+U.walletBalance WHERE U.userid='".$_SESSION['userid']."'";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute();
                    // echo "<br>"."<h2>"."profile updated successsfully"."</h2>";
                    
                } catch(PDOException $e) {
                    echo $sql . " Error is <br>" . $e->getMessage();
                }
                $sql2="UPDATE e_dukan.buyer U SET U.walletBalance=".$_POST['walletBalance']."+U.walletBalance WHERE U.buyerid='".$_SESSION['userid']."'";
                try{
                    $stmt2=$conn->prepare($sql2);
                    $stmt2->execute();
                    echo "<br> <br>";
                    echo "<br>"."<h2>"."Money added successsfully"."</h2>";  
                }
                catch(PDOException $e){
                    echo $sql2 . "Error is <br>" . $e->getMessage();
                }
            }
        ?>
        
        <?php
            echo "<br> <br>";
            echo '<a style="text-decoration: none;" href="cart.php" class="btn spacebottom spacetop"> Go back to cart </a>';
            echo "<br> <br>";
        ?>

    </center>  
   
    
</body>
</html>