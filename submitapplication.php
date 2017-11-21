<?php 

    session_start();

    if(!isset($_SESSION["user_username"])){
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

    
    
    $id = $action = "";
    
    $empid = $_SESSION["user_id"];
    
    
    
    
    if( $_SERVER["REQUEST_METHOD"] == "GET" ){
        $id = test_input( $_GET['id'] );
        $action = test_input( $_GET['action'] );
    }
    
    $companyid = "";
    
    if( $action == "apply" ){
        
        $sqlcmp ="SELECT company_id FROM postjob WHERE job_id='$id'";
        $result = mysqli_query($conn, $sqlcmp); 
        $dateposted = date("Y/m/d");
        if(!result){
            $_SESSION["user_registered"] = "oops";
            header('Location: http://localhost/PHPProject/searchbylogin.php');
        } else{
        if( mysqli_num_rows($result) > 0 ){
            while( $row = mysqli_fetch_assoc($result) ){
                $companyid = $row["company_id"];
            }
        } else{
            $_SESSION["user_registered"] = "uh-oh";
            header('Location: http://localhost/PHPProject/searchbylogin.php');
        }
        }
    
        $sqlcheck = "SELECT * FROM jobapplications WHERE job_id='$id' and employee_id='$empid'";
        $result = mysqli_query($conn, $sqlcheck);
        
        if( mysqli_num_rows($result) > 0 ){
            $_SESSION["user_registered"] = "Have already applied";
            header('Location: http://localhost/PHPProject/searchbylogin.php');
        } else {
        $sql = "INSERT INTO jobapplications (job_id, employee_id, applied_date, company_id) VALUES ('$id', '$empid', '$dateposted', '$companyid')"; 
        }
    
    } else if( $action == "cancel" ){
        
        $sqlcheck = "SELECT * FROM jobapplications WHERE job_id='$id' and employee_id='$empid'";
        $result = mysqli_query($conn, $sqlcheck);
        
        if( mysqli_num_rows($result) > 0 ){
           $sql = "DELETE FROM jobapplications WHERE job_id='$id' and employee_id='$empid'";
        } else{
            $_SESSION["user_registered"] = "Have not applied yet";
            header('Location: http://localhost/PHPProject/searchbylogin.php');
        }
        
    } else{
            $_SESSION["user_registered"] = "Error";
            header('Location: http://localhost/PHPProject/searchbylogin.php');
    }
    
    if( isset($sql) ){
        if(mysqli_query($conn, $sql)){
            $_SESSION["user_registered"] = "Action Successful";
            header('Location: http://localhost/PHPProject/searchbylogin.php');
        } else{
            $_SESSION["user_registered"] = "Could not apply";
            header('Location: http://localhost/PHPProject/');
        }
    }
    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        

?>