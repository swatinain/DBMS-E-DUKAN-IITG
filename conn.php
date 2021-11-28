<?php
    $servername='localhost';
    $port_no=3306;
    $username="swati";
    $password="nain";
    $myDB="e_dukan";
    try{
        $conn=new PDO("mysql:host=$servername;port=$port_no,dbname=$myDB",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "Connected to database successfully!<br>";
    }catch(PDOExcepion $e){
        echo "Connection to database failed :".$e->getMessage();
    }
?>