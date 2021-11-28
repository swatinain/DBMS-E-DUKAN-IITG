<?php
require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
session_start();
if (isset($_POST['email'])) {
$userid=$_POST['userid'];
$email = $_POST['email'];
$pass = md5($_POST['pass'],FALSE);
$user_type=$_POST['user_type'];

if($user_type=='admin'){
    try{
        $sql="SELECT * FROM e_dukan.admin WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count==0){
                echo "No such admin exists.";
            }
            if($count==1){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);     
                if($row['aid']==$userid AND $row['pass']==$pass){
                    echo "Logged in successfully!";
                    $_SESSION['userid']=$userid;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type']=$user_type;
                    header("Location: firstfile.php");
                    // Insert link later
                }
                else{
                    echo "Wrong password (or UID and webmail do not match!) Try again!";
                }  
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
}
else if($user_type=='cc'){
    try{
        $sql="SELECT * FROM e_dukan.customercare WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count==0){
                echo "No such customer care executive exists.";
            }
            if($count==1){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);     
                if($row['ccid']==$userid AND $row['pass']==$pass){
                    echo "Logged in successfully!";
                    $_SESSION['userid']=$userid;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type']=$user_type;
                    header("Location: firstfile.php");
                    // Insert link later
                }
                else{
                    echo "Wrong password (or UID and webmail do not match!) Try again!";
                }  
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
}
else if($user_type=='seller'){
    try{
        $sql="SELECT * FROM e_dukan.seller WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count==0){
                echo "No such seller exists. Click <a href='registration.php'>here</a> to register.";
            }
            if($count==1){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);     
                if($row['sellerID']==$userid AND $row['pass']==$pass){
                    echo "Logged in successfully!";
                    $_SESSION['userid']=$userid;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type']=$user_type;
                    header("Location: firstfile.php");
                    // Insert link later
                }
                else{
                    echo "Wrong password (or UID and webmail do not match!) Try again!";
                }  
            }      
        }
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
            if($count==0){
                echo "No such buyer exists. Click <a href='registration.php'>here</a> to register.";
            }
            if($count==1){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);     
                if($row['buyerID']==$userid AND $row['pass']==$pass){
                    echo "Logged in successfully!";
                    $_SESSION['userid']=$userid;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type']=$user_type;
                    header("Location: firstfile.php");
                    // Insert link later
                }
                else{
                    echo "Wrong password (or UID and webmail do not match!) Try again!";
                }  
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
}


// $login = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND pass = '".md5($pass)."'");
// if ($login->num_rows <= 1) {
// $_SESSION['email'] = $email;
// header("Location: firstfile.php");
// } else {
// echo $mysqli->error;
// }
}
?>