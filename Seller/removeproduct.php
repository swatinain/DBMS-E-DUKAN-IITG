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
    <br>
    <br>
    <center>
    <div>
        
        <form action="" method="POST">
            <br><br>
            Enter PID to remove the product* <br>
            <input type="text" name='pid' required>
            <br><br>
            <input type="submit" class='btn' value="Remove">
        </form>
       
        <?php
            if(isset($_POST['pid'])){
                try{
                    $sql="DELETE FROM e_dukan.product where pid='".$_POST['pid']."'";
                    $stmt=$conn->prepare($sql);
                    // if ($stmt->execute()){
                    //     $count=$stmt->rowCount();
                    //     echo "$count";
                    //     echo " product removed from the portal.";
                    // }
                    $stmt->execute();
                    $count=$stmt->rowCount();
                    if($count==0){
                        echo "<br> <br>";
                        echo "No product is uploaded with this pid.";
                        
                    }
                    else{
                        echo "Product removed from portal successfully.";
                    }
                 
                }catch(PDOExcepion $e){
                    echo "Connection to database failed :".$e->getMessage();
                } 
                
            }
            echo "<br> <br>";
                        echo '<a style="text-decoration: none;" href="myproducts.php" class="btn spacebottom spacetop"> Go back to My Products </a>';
                        echo "<br> <br>";
        ?>
        

    </div>
    </center>
    
      
</body>
</html>