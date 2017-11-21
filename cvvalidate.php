<?php

        session_start();
        $fname = $city = $exp = $qual = $univ = $username = "";       
      
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $fname = test_input( $_POST['fname'] );
            $city = test_input( $_POST['city'] );
            $exp = test_input( $_POST['exp'] );
            $year = test_input( $_POST['year'] );
            $qual = test_input( $_POST['qual'] );
            $univ = test_input( $_POST['univ'] );
        }
        if(isset($_SESSION["user_email"])){
            $username = $_SESSION["user_username"];
            $email = $_SESSION["user_email"];
        } else{
             header('Location: http://localhost/PHPProject/login.php');
        }
        
            $servername="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="project";
            $conn = "";
    
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
            if(!$conn)
                die("Connection failed".mysqli_connect_error());

       
            
        //File Upload
        
        $target_dir = "PHPProject/uploads/";
        $target_file = $_SERVER['DOCUMENT_ROOT'].$target_dir.basename($_FILES["resume"]["name"]);
        $uploadOk = 1;
        $ext = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if( !strcmp($ext, "doc") && !strcmp($ext, "docx") && !strcmp($ext, "pdf") ){
            $_SESSION["register_error"] = "File must be of type .doc, ,docx or .pdf";
            header('Location: http://localhost/PHPProject/cvupload.php');
        }


        $fileSize=$_FILES['resume']['size'];
        
        if($fileSize > 500000){
            $_SESSION["register_error"] = "File size must be less than 500KB";
            header("Location: http://localhost/PHPProject/cvupload.php");
        } else{

        if(!file_exists('C:\wamp\www\PHPProject\uploads')){
            mkdir('C:\wamp\www\PHPProject\uploads',777,true);
        }
       $new = $_SERVER["DOCUMENT_ROOT"].$target_dir.$email.".".$ext;
       
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                
                
                rename($target_file,$new);
                $_SESSION['user_registered'] = "Your application has been successfully posted";
                
            } else {
                $_SESSION["register_error"] = "Sorry, there was an error uploading your file.";
                 header('Location: http://localhost/PHPProject/cvupload.php');
            }
        }

        
        $sql1= "UPDATE employees SET username='$username',fname='$fname',city='$city',experience='$exp',education='$qual',resume='$new',univ='$univ',year='$year' WHERE email='$email'";
            
            if( !mysqli_query($conn,$sql1)){
                $_SESSION['register_error'] = "Application Unsuccessful. Please try again";
                header('Location: http://localhost/PHPProject/cvupload.php');
            } else{
                header('Location: http://localhost/PHPProject/viewcv.php');
            }
        }
            
        function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        
    
    ?>
    