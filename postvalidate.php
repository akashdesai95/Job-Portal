<?php

        session_start();
        
        $cmpname = $email = $category = $role = $vacancy = $stipend = $location = $contact = $profile = $jobdesc = $cmpdesc = $deadline = "";       
      
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $cmpname = test_input( $_POST['companyname'] );
            $email = test_input( $_POST['email'] );
            $category = test_input( $_POST['cat'] );
            $role = test_input( $_POST['pos'] );
            $vacancy = test_input( $_POST['vac'] );
            $stipend = test_input( $_POST['stipend'] );
            $location = test_input( $_POST['loc'] );
            $contact = test_input( $_POST['phone'] );
            $profile = test_input( $_POST['profile'] );
            $jobdesc = test_input( $_POST['jdesc'] );
            $cmpdesc = test_input( $_POST['cdesc'] );
            $deadline = test_input( $_POST['dead'] );
        }
       $dateposted = date("Y/m/d");
       
        if( !ctype_digit($contact) || !ctype_digit($vacancy) || !ctype_digit($stipend)){
            $_SESSION["register_error"] = "Invalid Inputs";
            
                header('Location: http://localhost/PHPProject/post.php');
            
        } else{
        
       
        
        if(isset($_SESSION["user_username"]) && isset($_SESSION["user_id"])){
            $username = $_SESSION["user_username"];
            $companyid = $_SESSION["user_id"];
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
            

            $sqlvalidate = "SELECT email FROM postjob WHERE email='$email'";
            
            $resultvalidate = mysqli_query($conn,$sqlvalidate);
            
            if( mysqli_num_rows($resultvalidate) > 0 ){
                $_SESSION["register_error"] = "Cannot post with the same email id again";
                header('Location: http://localhost/PHPProject/viewpost.php');
            } else{
            
           
        
        
        //Logo Upload 
        
        $target_dir = "PHPProject/logos/";
        $target_file = $_SERVER['DOCUMENT_ROOT'].$target_dir.basename($_FILES["logos"]["name"]);
        $uploadOk = 1;
        $ext = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if( !strcmp($ext, "jpg") && !strcmp($ext, "png") ){
            $_SESSION["register_error"] = "Image must be of type .jpg, or .png";
            header('Location: http://localhost/PHPProject/post.php');
        }


        $fileSize=$_FILES['logos']['size'];
        
        if($fileSize > 350000){
            $_SESSION["register_error"] = "Image size must be less than 350KB";
            header("Location: http://localhost/PHPProject/post.php");
        } else{

        if(!file_exists('C:\wamp\www\PHPProject\logos')){
            mkdir('C:\wamp\www\PHPProject\logos',777,true);
        }
       $new = $_SERVER["DOCUMENT_ROOT"].$target_dir.$email.".".$ext;
       $addr = "\\PHPProject\\logos\\".$email.".".$ext;
       
        if ($uploadOk == 0) {
            echo "Sorry, your Image was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["logos"]["tmp_name"], $target_file)) {
                
                
                rename($target_file,$new);
                $_SESSION['register_error'] = "Your application has been successfully posted";
                
            } else {
                $_SESSION["register_error"] = "Sorry, there was an error uploading your profile.";
                 header('Location: http://localhost/PHPProject/viewpost.php');
            }
        }
        
         $sql1= "INSERT INTO postjob (username, cmpname, category, email, role, jobdesc, stipend, location, vacancy, profile, posted_date, contact, cmpdesc, deadline, company_id, logos) VALUES ('$username','$cmpname','$category','$email','$role','$jobdesc','$stipend','$location','$vacancy','$profile','$dateposted','$contact','$cmpdesc','$deadline', '$companyid', '$ext')";
            
            if( !mysqli_query($conn,$sql1)){
                $_SESSION['register_error'] = "Application Unsuccessful. Please try again";
                header('Location: http://localhost/PHPProject/post.php');
            } else{
                $_SESSION['register_error'] = "Application Successful";
                header('Location: http://localhost/PHPProject/viewpost.php');
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
    