<?php
require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
if (isset($_POST['submit'])) {
$userid=$_POST['userid'];
$email = $_POST['email'];
$pass = md5($_POST['pass'],FALSE);
$user_type=$_POST['user_type'];
if($user_type=='seller'){
    try{
        $sql="SELECT * FROM e_dukan.seller WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count>0){
                echo "Seller already registered. Click <a href='firstfile.php'>here</a> to login.";
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
    try{
        // $sql="INSERT INTO e_dukan.users (userid,email, pass) VALUES (:userid,:email, :pass)";
        // $stmt=$conn->prepare($sql);
        // $stmt->execute(array(
        //     ':userid' =>$_POST['userid'],
        //     ':email' =>$_POST['email'],
        //     ':pass' =>$_POST['pass']));

        $sql2="INSERT INTO e_dukan.seller (sellerid,sname,email,pass,occupation,address,contactNo) VALUES (:sellerid,:sname,:email,:pass,:occupation,:address,:contactNo)";
        $stmt2=$conn->prepare($sql2);
        $stmt2->execute(array(
            ':sellerid' =>$_POST['userid'],
            ':sname' =>$_POST['name'],
            ':email' =>$_POST['email'],
            ':pass' =>$_POST['pass'],
            ':occupation' =>$_POST['occupation'],
            ':address' =>$_POST['address'],
            ':contactNo' =>$_POST['contactNo']
        ));
        header("Location: registration.php?register_action=success");       
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
    
}
else if($user_type=='buyer'){
    try{
        $sql="SELECT * FROM e_dukan.buyer WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count>0){
                echo "Buyer already registered. Click <a href='firstfile.php'>here</a> to login.";
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
    try{
        // $sql="INSERT INTO e_dukan.users (userid,email, pass) VALUES (:userid,:email, :pass)";
        // $stmt=$conn->prepare($sql);
        // $stmt->execute(array(
        //     ':userid' =>$_POST['userid'],
        //     ':email' =>$_POST['email'],
        //     ':pass' =>$_POST['pass']));

        $sql2="INSERT INTO e_dukan.buyer (buyerid,bname,email,pass,occupation,address,contactNo) VALUES (:buyerid,:bname,:email,:pass,:occupation,:address,:contactNo)";
        $stmt2=$conn->prepare($sql2);
        $stmt2->execute(array(
            ':buyerid' =>$_POST['userid'],
            ':bname' =>$_POST['name'],
            ':email' =>$_POST['email'],
            ':pass' =>$_POST['pass'],
            ':occupation' =>$_POST['occupation'],
            ':address' =>$_POST['address'],
            ':contactNo' =>$_POST['contactNo']
        ));
        $sql3="INSERT INTO e_dukan.cart (buyerid) VALUES (:buyerid)";
        $stmt3=$conn->prepare($sql3);
        $stmt3->execute(array(
            ':buyerid' =>$_POST['userid']));
        header("Location: registration.php?register_action=success");       
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    } 
}

// $register = $mysqli->query("INSERT INTO users (email, pass, full_name) VALUES ('$email', '". md5($pass)."', '$name')");
// if ($register) {
// header("Location: registration.php?register_action=success");
// } else {
// echo $mysqli->error;
// }
}
?>