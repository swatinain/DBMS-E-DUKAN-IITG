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
        <?php
            try{ 
                $stmt=$conn->query("SELECT * FROM e_dukan.product WHERE pid='".$_SESSION['pid2']."'");
                // echo"<table border='1'><thead><tr>
                // <td>Order ID</td>
                // <td>Payment date</td>
                // </tr></thead>";
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                $sellerid=$row1['sellerID'];
                $price=$row1['price'];
                $stmt2=$conn->query("SELECT * FROM e_dukan.buyer WHERE buyerid='".$_SESSION['userid']."'");
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                $balance=$row2['walletBalance'];
                if($price>$balance){
                    $req=$price-$balance;
                    echo "<p class='spacetop spacebottom'>Insufficient balance in your wallet. Current balance is Rs.".$balance."  Add Rs.".$req." more to wallet to buy this product.</p>";
                    echo "<button id='myBtn' class='btn'>Add money to wallet</button>";
                }
                else{
                    try{ 
                        //Making transaction from buyer to admin
                        $sql1="INSERT INTO e_dukan.payment (buyerid,pid,aid,paymentamount) VALUES (:buyerid,:pid,:aid,:paymentamount)";
                        $stmt1=$conn->prepare($sql1);
                        $stmt1->execute(array(
                            ':buyerid' =>$_SESSION['userid'],
                            ':pid' =>$_SESSION['pid2'],
                            ':aid' =>'admin',
                            ':paymentamount' =>$price));
                            
                        echo "<br> <br>Order placed for product with pid".$_SESSION['pid2']." for Rs.".$price."";

                        //Updating the wallet balance of admin
                        $sql2="UPDATE e_dukan.admin U SET U.walletBalance=U.walletBalance+'".$price."' WHERE U.aid='admin'";
                        $stmt2=$conn->prepare($sql2);
                        $stmt2->execute();

                        //Updating the wallet balance of user and then buyer
                        $sql5="UPDATE e_dukan.users U SET U.walletBalance=U.walletBalance-'".$price."' WHERE U.userid='".$_SESSION['userid']."'";
                        $stmt5=$conn->prepare($sql5);
                        $stmt5->execute();


                        $sql6="UPDATE e_dukan.buyer U SET U.walletBalance=U.walletBalance-'".$price."' WHERE U.buyerid='".$_SESSION['userid']."'";
                        $stmt6=$conn->prepare($sql6);
                        $stmt6->execute();


                        //Making transaction from admin to seller
                        $sql3="INSERT INTO e_dukan.pays (aid,sellerid,pid,amount) VALUES (:aid,:sellerid,:pid,:amount)";
                        $stmt3=$conn->prepare($sql3);
                        $stmt3->execute(array(
                            ':aid' =>'admin',
                            ':sellerid' =>$sellerid,
                            ':pid' =>$_SESSION['pid2'],
                            ':amount' =>$price*0.95));

                        //Again updating wallet balance of admin
                        $sql4="UPDATE e_dukan.admin U SET U.walletBalance=U.walletBalance-0.95*'".$price."' WHERE U.aid='admin'";
                        $stmt4=$conn->prepare($sql4);
                        $stmt4->execute();


                        //Updating the wallet balance of user and then seller
                        $sql7="UPDATE e_dukan.users U SET U.walletBalance=U.walletBalance+0.95*'".$price."' WHERE U.userid='".$_SESSION['userid']."'";
                        $stmt7=$conn->prepare($sql7);
                        $stmt7->execute();

                        $sql8="UPDATE e_dukan.seller U SET U.walletBalance=U.walletBalance+0.95*'".$price."' WHERE U.sellerid='".$sellerid."'";
                        $stmt8=$conn->prepare($sql8);
                        $stmt8->execute();


                        //updating on portal that product is sold now.
                        $sql9="UPDATE e_dukan.product U SET U.inStock=0 WHERE U.pid='".$_SESSION['pid2']."'";
                        $stmt9=$conn->prepare($sql9);
                        $stmt9->execute();

                        //Paying 0.5% of total price of product sold to each cc
                        $sql10="UPDATE e_dukan.customercare U SET U.walletBalance=U.walletBalance+0.005*'".$price."' WHERE 1";
                        $stmt10=$conn->prepare($sql10);
                        $stmt10->execute();

                        //Again updating wallet balance of admin
                        $sql11="UPDATE e_dukan.admin U SET U.walletBalance=U.walletBalance-0.01*'".$price."' WHERE U.aid='admin'";
                        $stmt11=$conn->prepare($sql11);
                        $stmt11->execute();


                    }catch(PDOExcepion $e){
                        echo "Connection to database failed :".$e->getMessage();
                    }
                }
                
                // unset($_SESSION['pid2']);
                echo "<br> <br>";
                echo '<a style="text-decoration: none;" href="myorders.php" class="btn spacebottom spacetop"> Go to my orders </a>';
                echo "<br> <br>";

                // header("Location:cart.php");
            }catch(PDOExcepion $e){
                echo "Connection to database failed :".$e->getMessage();
            }
        ?>
    </center>  
    <script>
        var btn = document.getElementById('myBtn');
        btn.addEventListener('click', function() {
        document.location.href = 'addmoney.php';
        });
    </script> 
    
</body>
</html>