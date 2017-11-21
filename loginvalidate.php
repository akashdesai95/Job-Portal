<?php
    
        session_start();
        
        //Use Hashing Function
        
        $username = $password = $type = "";
        
         if( $_SERVER["REQUEST_METHOD"] == "POST" ){
            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);
            $type = test_input($_POST['type']);
         }
         
         if(isset($_POST['log']) && $_POST['log']=="yes"){
            setcookie("username", $username, time()+(86400*30), "/");    
            setcookie("password", $password, time()+(86400*30), "/");   
            setcookie("checked", $type, time()+(86400*30), "/");    
            setcookie("log", "checked", time()+(86400*30), "/");
         } else{
            setcookie("username", $username, time()-1, "/");    
            setcookie("username", $username, time()-1, "/"); 
            setcookie("checked", $type, time()-1, "/");       
            setcookie("log", "checked", time()-1, "/");
         }
         
         
         
         if( $username == "admin" && $password == "admin" ){
            $_SESSION["user_username"] = "admin";
            header('Location: http://localhost/PHPProject/admin/home.php');
         } else{
            
         
            
            $servername="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="project";
            $conn = "";
    
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
            if(!$conn)
                die("Connection failed".mysqli_connect_error());

            $_SESSION['user_username'] = "";
            $_SESSION['user_email'] = "";
            
        if( $type == "applicant" ){
            $sql = "SELECT id,username,password,email,closejob FROM employees WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
         
            if( mysqli_num_rows($result) > 0 ){
                while( $row = mysqli_fetch_assoc($result) ){
                    if( ($row["username"] == $username) && ($row["closejob"] != "blocked") && ($row["password"] == $password)){
                        $_SESSION["user_username"] = $username;
                        $_SESSION["user_email"] = $row["email"];
                        $_SESSION["user_id"] = $row["id"];
                        header('Location: http://localhost/PHPProject/dashboard.php');
                    } else{
                        $_SESSION["user_error"] = "Username or Password incorrect";
                        header('Location: http://localhost/PHPProject/login.php');
                    }
                        
                }
            } else {
                $_SESSION["user_error"] = "Username or Password incorrect";
                header('Location: http://localhost/PHPProject/login.php');
            }
        } else if( $type == "employer" ){
            $sql = "SELECT username,password,email,id,closejob FROM clients WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
         
            if( mysqli_num_rows($result) > 0 ){
                 while( $row = mysqli_fetch_assoc($result) ){
                    if( ($row["username"] == $username) && ($row["closejob"] != "blocked") && ($row["password"] == $password) ){
                        $_SESSION["user_username"] = $username;   
                        $_SESSION["user_email"] = $row["email"];
                        $_SESSION["user_id"] = $row["id"];
                        header('Location: http://localhost/PHPProject/dashboardoption.php');
                    } else{
                        $_SESSION["user_error"] = "Username or Password incorrect";
                        header('Location: http://localhost/PHPProject/login.php');
                    }
                 }
            } else {
                $_SESSION["user_error"] = "Username or Password incorrect";
                header('Location: http://localhost/PHPProject/login.php');
            }
        } else {
            $_SESSION["user_error"] = "Please select your Identity";
            header('Location: http://localhost/PHPProject/login.php');
        }
         }
     
     
        function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   
    ?>
    