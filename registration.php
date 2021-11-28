<?php
require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration</title>
</head>
<link rel="stylesheet" href="nav.css">
    <script src="script.js"></script>
<style>
   *{
      background-color: rgb(193, 225, 193);
   }
</style>
<body>
<center>
<?php
if (!isset($_SESSION['email'])) { ?>
<h2 class="btn ">Registration</h2>
<?php
if (isset($_GET['register_action'])) {
if ($_GET['register_action'] == "success") { ?>
Successfully Registered! Click <a href="firstfile.php">here</a> to login.
<?php }
}
?>

<form method="post" action="">
<label>UID*</label><br>
<input type="text" name="userid" placeholder="Like roll no." required /><br>
<label>Name*</label><br>
<input type="text" name="name" placeholder="As in college record" required /><br>
<label>IITG Webmail*</label><br>
<input type="text" name="email" placeholder="Including @iitg.ac.in" required /><br>
<label>Set Password*</label><br>
<input type="password" name="pass" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!@#$%^&*+`~|<>/]).{8,}" title="Must contain at least one integer and one lowerrcase and uppercase letter,one special character and at least 8 or more characters"  required/><br>
<label>Occupation*</label><br>
<input type="text" name="occupation" placeholder="Student/Staff/etc." required /><br>
<label>Address*</label><br>
<input type="text" name="address" placeholder="Hostel IITG/Flat No." required /><br>
<label>Contact No*</label><br>
<input type="number" name="contactNo" placeholder="Enter 10 digit contact no." required /><br>
<label>User type*</label>
<br>
<input type="radio" name="user_type" value="buyer" required>
<span id="buyer">Buyer</span>
<input type="radio" name="user_type" value="seller" required>
<span id="seller">Seller</span>
<br>

<br>
<br>
<input type="submit" name="submit" class="btn" value="Register" />
</form>
<br>
<br>
Already registered? Click <a href="firstfile.php">here</a> to login. <br><br><br>
<?php } else { ?>
You are already logged in. Click <a href="../logout.php">here</a> to logout.
<?php }
?>
</center>

<?php
// require_once 'C:\MAMP\htdocs\DBMS_Lab\Project\conn.php';
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
                echo "<br><br> Seller already registered. Click <a href='firstfile.php'>here</a> to login.";
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
    try{
        $sql="INSERT INTO e_dukan.users (userid,email, pass) VALUES (:userid,:email, :pass)";
        $stmt=$conn->prepare($sql);
        $stmt->execute(array(
            ':userid' =>$_POST['userid'],
            ':email' =>$_POST['email'],
            ':pass' =>$pass));

        $sql2="INSERT INTO e_dukan.seller (sellerid,sname,email,pass,occupation,address,contactNo) VALUES (:sellerid,:sname,:email,:pass,:occupation,:address,:contactNo)";
        $stmt2=$conn->prepare($sql2);
        $stmt2->execute(array(
            ':sellerid' =>$_POST['userid'],
            ':sname' =>$_POST['name'],
            ':email' =>$_POST['email'],
            ':pass' =>$pass,
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
    echo "$pass";
    try{
        $sql="SELECT * FROM e_dukan.buyer WHERE email = '".$email."'";
        $stmt=$conn->prepare($sql);
        if ($stmt->execute()){
            $count=$stmt->rowCount();
            if($count>0){
                echo "<br><br>Buyer already registered. Click <a href='firstfile.php'>here</a> to login.";
            }      
        }
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
    try{
        $sql="INSERT INTO e_dukan.users (userid,email, pass) VALUES (:userid,:email, :pass)";
        $stmt=$conn->prepare($sql);
        $stmt->execute(array(
            ':userid' =>$_POST['userid'],
            ':email' =>$_POST['email'],
            ':pass' =>$pass));

        $sql2="INSERT INTO e_dukan.buyer (buyerid,bname,email,pass,occupation,address,contactNo) VALUES (:buyerid,:bname,:email,:pass,:occupation,:address,:contactNo)";
        $stmt2=$conn->prepare($sql2);
        $stmt2->execute(array(
            ':buyerid' =>$_POST['userid'],
            ':bname' =>$_POST['name'],
            ':email' =>$_POST['email'],
            ':pass' =>$pass,
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

</body>
</html>