<?php
   require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
   session_start();
?>
<?php
if(isset($_SESSION['email'])){?>
<?php echo $_SESSION['email']; ?> | <a href="logout.php">Logout</a>

<?php print_r($_SESSION); } ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title class="spacetop spacebottom">Login</title>
<link rel="stylesheet" href="nav.css">
    <script src="script.js"></script>
<style>
   *{
      background-color: rgb(193, 225, 193);
   }
</style>
</head>
<body>
   <center>
<?php
if (!isset($_SESSION['email'])) { ?>
      <br><br><br><br>
    <h1 class="btn">Login</h1>
    <br><br>
    <form method="post" action="">
      <label>UID*</label><br>
      <input type="text" required placeholder="Like roll no." name="userid" /><br>
      <label>IITG Webmail*</label><br>
      <input type="text" required placeholder="Including @iitg.ac.in" name="email" /><br>
      <label>Password*</label><br>
      <input type="password" required name="pass" /><br>
      <label>User type*</label>
      <br>
      <input type="radio" name="user_type" value="buyer" required>
      <span id="buyer">Buyer</span>
      <input type="radio" name="user_type" value="seller" required>
      <span id="seller">Seller</span>
      <input type="radio" name="user_type" value="cc" required>
      <span id="cc">Customer Care</span>
      <input type="radio" name="user_type" value="admin" required>
      <span id="admin">Admin</span>
      <br>
      <br><br>
      <input type="submit" value="Login" class="btn"/>
      <br>
    </form>
    Not registered yet? Click <a href="registration.php">here</a> to register.
    
    <?php 
} 
else if (isset($_SESSION['email'])) { 
   $user_type=$_SESSION['user_type'];
   if($user_type=='admin'){
      header("Location: Admin/adminhome.php");    
   }
   else if($user_type=='cc'){
      header("Location: CC/cchome.php");    
   }
   else if($user_type=='seller'){
      header("Location: Seller/sellerhome.php");    
   }
   else if($user_type=='buyer'){
      header("Location: Buyer/buyerhome.php");    
   }
    //  echo $_SESSION['email']  | <a href="logout.php">Logout</a>     
}
?>
</center>

<?php
// require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
// session_start();
if (isset($_POST['email'])) {
$userid=$_POST['userid'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$user_type=$_POST['user_type'];

if($user_type=='admin'){
    try{
        $sql="SELECT * FROM e_dukan.admin WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count==0){
                echo "<br><br>No such admin exists.<br><br>";
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
                    echo "<br><br>Wrong password (or UID and webmail do not match!) Try again!<br><br>";
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
                echo "<br><br>No such customer care executive exists.<br><br>";
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
                    echo "<br><br>Wrong password (or UID and webmail do not match!) Try again!<br><br>";
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
                echo "<br><br>No such seller exists. Click <a href='registration.php'>here</a> to register.<br><br>";
            }
            if($count==1){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);     
                if($row['sellerID']==$userid AND $row['pass']==md5($_POST['pass'],FALSE)){
                    echo "Logged in successfully!";
                    $_SESSION['userid']=$userid;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type']=$user_type;
                    header("Location: firstfile.php");
                    // Insert link later
                }
                else{
                    echo "<br><br>Wrong password (or UID and webmail do not match!) Try again!<br><br>";
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
                echo "<br><br>No such buyer exists. Click <a href='registration.php'>here</a> to register.<br><br>";
            }
            if($count==1){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);     
                if($row['buyerID']==$userid AND $row['pass']==md5($_POST['pass'],FALSE)){
                    echo "Logged in successfully!";
                    $_SESSION['userid']=$userid;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type']=$user_type;
                    header("Location: firstfile.php");
                    // Insert link later
                }
                else{
                    echo "<br><br>Wrong password (or UID and webmail do not match!) Try again!<br><br>";
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

</body>
</html>