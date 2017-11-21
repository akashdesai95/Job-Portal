<?php 
    
    session_start();
    $jobid = "";
    
    if(isset($_GET['id'])){
        $jobid = $_GET['id'];
    }
    
    
        
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project";
        $conn = "";
                 
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
            
        $datetoday = date("Y/m/d");  
        $sql = "UPDATE postjob SET notification=1,requestdate='$datetoday' WHERE job_id='$jobid'";
        
        
        if(mysqli_query($conn, $sql)){
            $_SESSION['register_error'] = "Delete request sent";
            header('Location: http://localhost/PHPProject/viewpost.php');
        } else{
            $_SESSION['register_error'] = "Delete request not sent";
            header('Location: http://localhost/PHPProject/viewpost.php');
        }
        
    
    
?>