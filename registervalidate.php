<?php
        
        //Add code to retain values
        
        session_start();
        $username = $password1 = $password2 = $bdate = $email = $number = $type = $cmp = $web = "";
        
        //Use Hashing Function
        
        
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        $username = test_input( $_POST['username'] );
        $password1 = test_input( $_POST['password1'] );
        $password2 = test_input( $_POST['password2'] );
        $number = test_input( $_POST['phone'] );
        $email = test_input( $_POST['email'] );
        $type = test_input( $_POST['type'] );
        }
        
            
        
        
        if( $password1 == $password2 ){
            $password = $password1;
        } else{
            $_SESSION["register_error"] = "Passwords do not match";
            if( $type == "applicant" ){
                header('Location: http://localhost/PHPProject/registerlogin.php');
            } else{
                header('Location: http://localhost/PHPProject/registeremployer.php');
            }
        }
        
        if( !ctype_digit($number) ){
            $_SESSION["register_error"] = "Invalid mobile number";
            
            if( $type == "applicant" ){
                header('Location: http://localhost/PHPProject/registerlogin.php');
            } else{
                header('Location: http://localhost/PHPProject/registeremployer.php');
            }
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

        
        if( $type == "applicant" ){
            
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $bdate = test_input( $_POST['bdate'] );
                
            }
            
             if(strlen($username) > 10 || (!preg_match("/^[a-zA-Z ]*$/",$username)) || ($username == "admin") )
             {
                $_SESSION["register_error"] = "Username Invalid";
                 header('Location: http://localhost/PHPProject/registerlogin.php');
                 
             } 
             else{
       
       
            $sqlvalidate = "SELECT email FROM employees WHERE email='$email'";
            
            $resultvalidate = mysqli_query($conn,$sqlvalidate);
            
            if( mysqli_num_rows($resultvalidate) > 0 ){
                $_SESSION["user_registered"] = "Account already exists!";
                header('Location: http://localhost/PHPProject/login.php');
            } else{
                
            
            $sql1= "INSERT INTO employees (username, password, birthday, email, number) VALUES ('$username','$password', '$bdate','$email','$number')";
            
            if( mysqli_query($conn,$sql1)){
                $_SESSION['user_registered'] = "You have been successfully registered. Please log in";
                header('Location: http://localhost/PHPProject/login.php');
            } else {
                $_SESSION['user_registered'] = "Registration Unsuccessful. Please try again";
                header('Location: http://localhost/PHPProject/login.php');
            }
            }
             }
        } else if( $type == "employer" ){
            
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $company = test_input( $_POST['cmp'] );
                $website = test_input( $_POST['web'] );
            }
            
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                $_SESSION["register_error"] = "Invalid URL";
                header('Location: http://localhost/PHPProject/registeremployer.php');
             } else{
            
             if( (strlen($username) > 10) || (!preg_match("/^[a-zA-Z ]*$/",$username))  || ($username == "admin") )
             {
                $_SESSION["register_error"] = "Username Invalid";
                header('Location: http://localhost/PHPProject/registeremployer.php');
             } else{
       
            
            $sqlvalidate = "SELECT email FROM clients WHERE email='$email'";
            
            $resultvalidate = mysqli_query($conn,$sqlvalidate);
            
            if( mysqli_num_rows($resultvalidate) > 0 ){
                $_SESSION["user_registered"] = "Account already exists!";
                header('Location: http://localhost/PHPProject/login.php');
            } else{
            
            
            $sql1= "INSERT INTO clients (username, password, email, number, company, website) VALUES ('$username', '$password','$email','$number','$company','$website')";
           
            if( mysqli_query($conn,$sql1)){
                $_SESSION['user_registered'] = "You have been successfully registered. Please log in";
                header('Location: http://localhost/PHPProject/login.php');
            } else {
                $_SESSION['user_registered'] = "Registration Unsuccessful. Please try again";
                header('Location: http://localhost/PHPProject/login.php');
            }
            }
             }
           }
        } else {
            $_SESSION["register_error"] = "Please select your identity";
            header('Location: http://localhost/PHPProject/register.php');
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
    