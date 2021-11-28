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
    <title>Add new product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../nav.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">   
        <a href="sellerhome.php">Home</a>
        <a href="addproduct.php" class="active">Add new product</a>
        <a href="myproducts.php">My products</a>
        <a href="contactcc.php">Contact CC</a>
        <a href="sellerprofile.php">Profile</a>
        <a class="right" href="../logout.php">Logout</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <br>
    <div>
        <center>
        <h2>Add product</h2>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Your UID* <br>
            <input type="text" name="userid" placeholder="Like Roll no."  required>
            <br> --> 
            <!-- We will get userid from session(userid) -->
            Product ID* <br>
            <input type="text" name="pid" placeholder="Manuf. no./serial no."  required>
            <br>
            Product name* <br>
            <input type="text" name="pname" required>
            <br>
            
            Upload an image*
            <p>
                <input type="file" name="image1" required>  
                <br>
            </p>
            <!-- Upload Image2
            <p>
                <input type="file" name="image2" multiple>  
                <br>
            </p>
            Upload Image3
            <p>
                <input type="file" name="image3" multiple>  
                <br>
            </p> -->
            Price*(in Rs.) <br>
            <span style="color:red;"> <b>IMPORTANT</b>  You will get 95% of it in your wallet when the product gets sold!</span><br>
            <input type="number" name="price" required>
            <br>
            <label for="category">Category</label>
            <br>
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
            <br>
            <br>
            Description*(in under 20 words) <br>
            <textarea name="description" id="description" cols="30" rows="5" ></textarea>
            <br>
            <br>
            <br>
            <input type="submit" class="btn" value="Upload to website">
            <input type="reset" value="Reset" class="btn">
        </form>
        </center>

        <?php
            // print_r($_POST);
            if(isset($_POST['pid']))
            $pid=$_POST['pid'];
            if(isset($_POST['pid']) && isset($_POST['pname']) && isset($_POST['price']) && isset($_POST['category']) && isset($_POST['description'])){
                try{
                    $sql="INSERT INTO e_dukan.product (sellerid,pid,pname,price,category,description) VALUES (:sellerid,:pid,:pname,:price,:category,:description)";
            $stmt=$conn->prepare($sql);
            $stmt->execute(array(
                ':sellerid'=>$_SESSION['userid'],
                ':pid' =>$_POST['pid'],
                ':pname' =>$_POST['pname'],
                ':price' =>$_POST['price'],
                ':category' =>$_POST['category'],
                ':description' =>$_POST['description'])
            );
                }catch(PDOExcepion $e){
                    echo "Connection to database failed :".$e->getMessage();
                }
            }
            // print_r($_FILES);
            if(isset($_FILES) && isset($_POST['pid'])){              
                $imageNo=1;
                $upload_dir = 'uploads'.DIRECTORY_SEPARATOR;
                $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
                // $maxsize = 2 * 1024 * 1024;
                $file_tmpname = $_FILES['image1']['tmp_name'];
                $file_name = $_FILES['image1']['name'];
                $file_size = $_FILES['image1']['size'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $filepath = $upload_dir.$file_name;
                if(in_array(strtolower($file_ext), $allowed_types)){
                    // if ($file_size > $maxsize){
                    //     echo "Error: File size is larger than the allowed limit.";
                    // }
                    if(file_exists($filepath)) {    
                        $file_name=time().$file_name;
                        $filepath =$upload_dir.$file_name;	
                    }
                    if(move_uploaded_file($file_tmpname, $filepath)){
                        echo "Image uploaded successfully. <br>";
                    }
                    else{
                        echo "Error uploading {$file_name}. ";      
                    }
                }
                else{
                    echo "Error uploading {$file_name}".$file_ext." is not allowed.";      
                }

                try{
                    $sql="INSERT INTO e_dukan.productImages (sellerid,pid,imageNo,imageLocation) VALUES (:sellerid,:pid,:imageNo,:imageLocation)";
            $stmt=$conn->prepare($sql);
            $stmt->execute(array(
                ':sellerid'=>$_SESSION['userid'],
                ':pid' =>$_POST['pid'],
                ':imageNo' =>$imageNo,
                ':imageLocation' =>$filepath)
            );
            echo "Product added successfully!";
                }
                catch(PDOExcepion $e){
                    echo "Connection to database failed :".$e->getMessage();
                } 
            }
        ?>
    </div>    
</body>
</html>