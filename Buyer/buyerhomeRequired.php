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
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <br>
    <br>
    <h1>Search Products using filters:</h1>
    <br>
    <div>
    </div>
    <div>
        <form action="" method="POST">
            <label for="product">Filter products by*: </label>
            <select name="product" id="product" required>
                <option value="categ">Category</option>
                <option value="pid">Product ID</option>
                <option value="sellerid">Seller ID</option>
            </select>
            <br>
            <input type="submit" name="submit" value="Apply filter" class="btn"><br>
        </form>
        <?php
            if(isset($_POST['product'])){
                $filter=$_POST['product'];
                if($filter=='categ'){ ?>
                <form action="" method="POST"></form>
                    <select name="category" id="category">
                        <option value="mobile">Mobile</option>
                        <option value="laptop">Laptop</option>
                        <option value="book">Book</option>
                        <option value="electronic">Electronic Devices</option>
                        <option value="bathroom">Bathroom Essentials</option>
                        <option value="bedroom">Bedroom Stuff</option>
                        <option value="decoration">Decoration Stuff</option>
                        <option value="cycle">Cycle</option>
                        <option value="other">Other</option>
                    </select>
                    <br><br>
                    <input type="submit" name="submitCat" value="Filter" class='btn'>
                </form>
                <?php
                    if(isset($_POST['category']) && isset($_POST['submitCat'])){
                        try{
                            $category=$_POST['category'];
                            $stmt=$conn->query("SELECT * from e_dukan.product WHERE category='".$category."'");
                            echo "<center>";
                            echo "Products of category=".$category."<br>";
                            echo"<table border='1'> <thead class='tablehead'><tr>
                            <td>Seller ID</td><td>PID</td><td>Product Name</td><td>Price</td><td>Description</td><td>Sold/Unsold</td></tr></thead>";

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo " <tr class='tablerow'>";
                                echo "<td>".$row['sellerid']."</td>";
                                $pid=$row['pid'];
                                echo "<td>".$row['pid']."</td>";
                                echo "<td>".$row['pname']."</td>";
                                echo "<td>".$row['price']."</td>";
                                echo "<td>".$row['description']."</td>";
                                if($row['inStock']){
                                    echo "<td> Not sold yet </td>";  
                                }
                                else{
                                    echo "<td>Sold</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</center>";
                        }catch(PDOExcepion $e){
                            echo "Connection to database failed :".$e->getMessage();
                        }
                    }
                ?>
        <?php
                }
                else if($filter=='pid'){
                    ?>
                    <form action="" method="POST">
                        Enter product ID* <br>
                        <input type="text" name="pid" required>
                        <input type="submit" value="Filter by PID">
                    </form>
                    <?php
                        if(isset($_POST['pid'])){
                            try{
                                $pid=$_POST['pid'];
                                $stmt=$conn->query("SELECT * from e_dukan.product WHERE pid='".$pid."'");
                                echo "<center>";
                                echo "Product details with PID=".$pid."<br>";
                                echo"<table border='1'> <thead class='tablehead'><tr>
                                <td>Seller ID</td><td>Product Name</td><td>Price</td><td>Category</td><td>Description</td><td>Sold/Unsold</td></tr></thead>";
    
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    
                                    echo " <tr class='tablerow'>";
                                    echo "<td>".$row['sellerid']."</td>";
                                    $pid=$row['pid'];
                                    
                                    echo "<td>".$row['pname']."</td>";
                                    echo "<td>".$row['price']."</td>";
                                    echo "<td>".$row['category']."</td>";
                                    echo "<td>".$row['description']."</td>";
                                    if($row['inStock']){
                                        echo "<td> Not sold yet </td>";  
                                    }
                                    else{
                                        echo "<td>Sold</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo "</center>";
                            }catch(PDOExcepion $e){
                                echo "Connection to database failed :".$e->getMessage();
                            }
                        }
                    
                    
                    ?>


        <?php
                }
                else if($filter=='sellerid'){
                    ?>
                    <form action="" method="POST">

                        Enter seller ID* <br>
                        <input type="text" name="sellerid" required>
                        <input type="submit" value="Filter by Seller ID">
                    </form>
                    <?php
                        if(isset($_POST['sellerid'])){
                            try{
                                $sellerid=$_POST['sellerid'];
                                $stmt=$conn->query("SELECT * from e_dukan.product WHERE sellerid='".$sellerid."'");
                                echo "<center>";
                                echo "Product sold by seller with Seller ID=".$sellerid."<br>";
                                echo"<table border='1'> <thead class='tablehead'><tr>
                                <td>PID</td><td>Product Name</td><td>Price</td><td>Category</td><td>Description</td><td>Sold/Unsold</td></tr></thead>";
    
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    
                                    echo " <tr class='tablerow'>";
                                    echo "<td>".$row['piid']."</td>";
                                    echo "<td>".$row['pname']."</td>";
                                    echo "<td>".$row['price']."</td>";
                                    echo "<td>".$row['category']."</td>";
                                    echo "<td>".$row['description']."</td>";
                                    if($row['inStock']){
                                        echo "<td> Not sold yet </td>";  
                                    }
                                    else{
                                        echo "<td>Sold</td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo "</center>";
                            }catch(PDOExcepion $e){
                                echo "Connection to database failed :".$e->getMessage();
                            }
                        }
                }
            }
        ?>

    </div>
      
</body>
</html>