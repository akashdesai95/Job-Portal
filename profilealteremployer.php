<?php
        
        //Add code to retain values
        
        session_start();
        if(!isset($_SESSION['user_email']))
            header('Location: http://localhost/PHPProject/login.php');
      
        $username = $password1 = $password2  = $email = $number = $company = $website = "";
        
        //Use Hashing Function
        
        
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        $username = test_input( $_POST['username'] );
        $password1 = test_input( $_POST['password1'] );
        $password2 = test_input( $_POST['password2'] );
        $company = test_input( $_POST['cmp'] );
        $email = test_input( $_POST['email'] );
        $number = test_input( $_POST['phone'] );
        $website = test_input( $_POST['web'] );
        }
        
        $originalemail = $_SESSION['user_email'];
        
        if( $password1 == $password2 ){
            $password = $password1;
        } else{
            $_SESSION["register_error"] = "Passwords do not match";
            header('Location: http://localhost/PHPProject/profileeditemployer.php');
        }
        
        if( (strlen($username) > 10) || (!preg_match("/^[a-zA-Z ]*$/",$username))  || ($username == "admin") )
             {
                $_SESSION["register_error"] = "Username Invalid";
                header('Location: http://localhost/PHPProject/profileeditemployer.php');
             } else{
        
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                $_SESSION["register_error"] = "Invalid URL";
                header('Location: http://localhost/PHPProject/profileeditemployer.php');
             } else{
        
        
        if( !ctype_digit($number) ){
            $_SESSION["register_error"] = "Invalid mobile number";
            
                header('Location: http://localhost/PHPProject/profileeditemployer.php');
            
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
            
            $sqlId = "select id from clients where email='$originalemail'";
            $result = mysqli_query($conn,$sqlId);
            
            if(mysqli_num_rows($result) > 0){
                while( $row = mysqli_fetch_assoc($result) ){
                    $id = $row["id"];
                }
            }
                
        
            $sql1 = "UPDATE clients SET username='$username',company='$company',email='$email',number='$number',password='$password',website='$website' WHERE id='$id'";
            
            if( mysqli_query($conn,$sql1) ){
                $_SESSION['user_registered'] = "Your changes have been successfully set.";
                $_SESSION['user_username'] = $username;
                $_SESSION['user_email'] = $email;
                
                header('Location: http://localhost/PHPProject/profileemployer.php');
            } else {
                $_SESSION['user_registered'] = "Couldn't edit profile. Please try again";
                header('Location: http://localhost/PHPProject/profileemployer.php');
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
    