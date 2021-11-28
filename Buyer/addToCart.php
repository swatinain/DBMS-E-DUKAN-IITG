<?php
    require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
    session_start();
?>
<?php
if(isset($_SESSION['email'])){?>
<?php echo $_SESSION['email']; ?> | <a href="../logout.php">Logout</a>

<?php print_r($_SESSION); } ?>

<?php
    try{
        $sql="INSERT INTO e_dukan.addedTo (pid,buyerid) VALUES (:pid,:buyerid)";
        $stmt=$conn->prepare($sql);
        $stmt->execute(array(
            ':pid'=>$_SESSION['pid'],
            ':buyerid'=>$_SESSION['userid']));
            unset($_SESSION['pid']);
            header("Location: cart.php");    
            // echo "Product with PID=".$_POST['pid']." added to cart successfully.";  
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
?>