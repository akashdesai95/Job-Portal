<?php
        
        //Add code to retain values
        
        session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
      
        $username = $password1 = $password2 = $bdate = $email = $number = "";
        
        //Use Hashing Function
        
        
        
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        $username = test_input( $_POST['username'] );
        $password1 = test_input( $_POST['password1'] );
        $password2 = test_input( $_POST['password2'] );
        $bdate = test_input( $_POST['bdate'] );
        $email = test_input( $_POST['email'] );
        $number = test_input( $_POST['phone'] );
        }
        
        $originalemail = $_SESSION['user_email'];
        
        if( $password1 == $password2 ){
            $password = $password1;
        } else{
            $_SESSION["register_error"] = "Passwords do not match";
            header('Location: http://localhost/PHPProject/profileedit.php');
        }
        
        if( (strlen($username) > 10) || (!preg_match("/^[a-zA-Z ]*$/",$username))  || ($username == "admin") )
             {
                $_SESSION["register_error"] = "Username Invalid";
                header('Location: http://localhost/PHPProject/profileedit.php');
             } else{
        
        
        if( !ctype_digit($number) ){
            $_SESSION["register_error"] = "Invalid mobile number";
            
                header('Location: http://localhost/PHPProject/profileedit.php');
            
        } else{
        
        
        
        if(isset($password)){
    
        
            $servername="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="project";
            $conn = "";
    
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
            if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
            $sqlId = "select id from employees where email='$originalemail'";
            $result = mysqli_query($conn,$sqlId);
            
            if(mysqli_num_rows($result) > 0){
                while( $row = mysqli_fetch_assoc($result) ){
                    $id = $row["id"];
                }
            }
                
                
        //Profile Pic upload    
                
        $target_dir = "PHPProject/propic/";
        $target_file = $_SERVER['DOCUMENT_ROOT'].$target_dir.basename($_FILES["logos"]["name"]);
        $uploadOk = 1;
        $ext = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if( !strcmp($ext, "jpg") && !strcmp($ext, "png") ){
            $_SESSION["register_error"] = "Image must be of type .jpg, or .png";
            header('Location: http://localhost/PHPProject/post.php');
        }


        $fileSize=$_FILES['logos']['size'];
        
        if($fileSize > 950000){
            $_SESSION["register_error"] = "Image size must be less than 350KB";
            header("Location: http://localhost/PHPProject/profileedit.php");
        } else{

        if(!file_exists('C:\wamp\www\PHPProject\propic')){
            mkdir('C:\wamp\www\PHPProject\propic',777,true);
        }
       $new = $_SERVER["DOCUMENT_ROOT"].$target_dir.$email.".".$ext;
       $addr = "\\PHPProject\\propic\\".$email.".".$ext;
       
        if ($uploadOk == 0) {
            echo "Sorry, your Image was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["logos"]["tmp_name"], $target_file)) {
                
                
                rename($target_file,$new);
                $_SESSION['register_error'] = "Your application has been successfully posted";
                
            } else {
                $_SESSION["register_error"] = "Sorry, there was an error uploading your profile.";
                 header('Location: http://localhost/PHPProject/profile.php');
            }
        }
        
        
            $sql1 = "UPDATE employees SET username='$username',birthday='$bdate',email='$email',number='$number',password='$password',propic='$ext' WHERE id='$id'";
            
            if( mysqli_query($conn,$sql1)){
                $_SESSION['user_registered'] = "Your changes have been successfully set.";
                $_SESSION['user_username'] = $username;
                $_SESSION['user_email'] = $email;
                header('Location: http://localhost/PHPProject/profile.php');
            } else {
                $_SESSION['user_registered'] = "Couldn't edit profile. Please try again";
                header('Location: http://localhost/PHPProject/profile.php');
            }
        }
             }
             }
             }
             
        
        
        
        function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        
    
    ?>
    