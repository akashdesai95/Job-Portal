<?php
        
        //Add code to retain values
        
        session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
     
        
        //Use Hashing Function
        
        
       
        $fname = $city =  $exp = $qual = $univ = $username = $year = "";       
      
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $fname = test_input( $_POST['fname'] );
            $city = test_input( $_POST['city'] );
            $exp = test_input( $_POST['exp'] );
            $qual = test_input( $_POST['qual'] );
            $univ = test_input( $_POST['univ'] );
            $year = test_input( $_POST['year'] );
        }
        if(isset($_SESSION["user_username"])){
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
            
            
            
        //File 
            
        $target_dir = "PHPProject/uploads/";
        $target_file = $_SERVER['DOCUMENT_ROOT'].$target_dir.basename($_FILES["resume"]["name"]);
        $uploadOk = 1;
        $ext = pathinfo($target_file,PATHINFO_EXTENSION);
        $original = $_SERVER["DOCUMENT_ROOT"].$target_dir.$email.".".$ext;
        
        if( !strcmp($ext, "doc") && !strcmp($ext, "docx") && !strcmp($ext, "pdf") ){
            $_SESSION["register_error"] = "File must be of type .doc, ,docx or .pdf";
            header('Location: http://localhost/PHPProject/cvedit.php');
        }


        $fileSize=$_FILES['resume']['size'];
        
        if($fileSize > 500000){
            $_SESSION["register_error"] = "File size must be less than 500KB";
            header("Location: http://localhost/PHPProject/cvedit.php");
        }

        if(!file_exists('C:\wamp\www\PHPProject\uploads')){
            mkdir('C:\wamp\www\PHPProject\uploads',777,true);
        }
        
        if(file_exists($original)){
            if(!unlink($original)){
                $_SESSION['register_error'] = "CV could not be replaced";
                header("Location: http://localhost/PHPProject/cvedit.php");       
            }
        }
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                
                $new = $_SERVER["DOCUMENT_ROOT"].$target_dir.$email.".".$ext;
                rename($target_file,$new);
                $_SESSION['user_registered'] = "Your application has been successfully changed";
                header('Location: http://localhost/PHPProject/viewcv.php');
            } else {
                $_SESSION["register_error"] = "Sorry, there was an error uploading your file.";
                 header('Location: http://localhost/PHPProject/cvedit.php');
            }
        } 
        
        $sql = "UPDATE employees SET fname='$fname',city='$city',experience='$exp',education='$qual',univ='$univ',resume='$new',year='$year' WHERE email='$email'";
            
            if( !mysqli_query($conn,$sql) ){
                $_SESSION['register_error'] = "Couldn't edit CV. Please try again";
                header('Location: http://localhost/PHPProject/cvedit.php');
            }
            
        
        function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        
    
    ?>
    