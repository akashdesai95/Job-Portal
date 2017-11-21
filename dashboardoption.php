<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="\PHPProject\main.css">

</head>
<body>

    <?php 
    
        session_start();
        if(!isset($_SESSION['user_username']))
            header('Location: http://localhost/PHPProject/login.php');
        
        $timeout = 15*60; // Number of seconds until it times out.

        if(isset($_SESSION['timeout'])) {
            $duration = time() - (int)$_SESSION['timeout'];
                if($duration > $timeout) {
                    session_destroy();
                    header('Location: http://localhost/PHPProject/login.php?msg=Session+Expired.+Please+login+again');
                }
        }

        $_SESSION['timeout'] = time();
      
    ?>

    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Recruiters'</a>
    </div>
    
    <ul class="nav navbar-nav">
        <li><a href="\PHPProject\loginhomeemployer.php">Home</a></li>
        <li  class="active"><a href="#">Dashboard</a></li>
        <li><a href="\PHPProject\post.php">Post</a><li> 
        <li><a href="\PHPProject\viewpost.php">View</a><li> 
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="\PHPProject/profileemployer.php"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Recieved Applications</h1>
    </div>
    
    <div class="container-fluid table-bordered table-hover">
    <table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Applied For</th>
        <th>Email</th>
        <th>Number</th>
        <th>Experience</th>
        <th>Qualification</th>
        <th>University</th>
        <th>Exp Years</th>
        <th>Posted Date</th>
        <th>Resume</th>
    </tr>
    </thead>
    <tbody>
    
    
    <?php
    
            $empid = "";
            $dateposted="";
            $i=1;
            
            $companyid = $_SESSION['user_id'];        
            $servername="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="project";
            $conn = "";
            $username = $_SESSION['user_username'];
    
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
            if(!$conn)
                die("Connection failed".mysqli_connect_error());
   
        $sql = "SELECT * FROM jobapplications WHERE company_id='$companyid'";
        $result = mysqli_query($conn, $sql);
        
        if(!$result)
            echo "no";
        else{
            if(mysqli_num_rows($result) > 0){
            while( $row = mysqli_fetch_assoc($result) ){
                $empid = $row["employee_id"];
                $dateposted = $row["applied_date"];
                $jobid = $row["job_id"];
               
               $sql1 = "SELECT * from employees WHERE id = '$empid'";
               $sql2 = "SELECT cmpname from postjob WHERE job_id = '$jobid'";
                
                $result1 = mysqli_query($conn, $sql1);
                $result2 = mysqli_query($conn, $sql2);
                
                if(!$result1 && !$result2)
                    echo "not result1";
                else{
                    if(mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 ){
                    while( ($row1 = mysqli_fetch_assoc($result1)) && ($row2 = mysqli_fetch_assoc($result2)) ){
                        
                        
                    
                    echo '<tr><td>'.$i++.'</td><td>'.$row1["fname"].'</td><td>'.$row2["cmpname"].'</td><td>'.$row1["email"].'</td><td>'.$row1["number"].'</td><td>'.$row1["experience"].'</td><td>'.$row1["education"].'</td><td>'.$row1["univ"].'</td><td>'.$row1["year"].'</td><td>'.$dateposted.'</td><td><a href='.$row1["resume"].'>Download</a></td></tr>';
                
                    
                    }
                }
            }
            } 
            }else{
                echo "error";
            }
        } 
        
        
        
    ?>
     </tbody>
    </table>
    </div>
   
    <br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    

</body>
</html>