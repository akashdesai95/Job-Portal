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
        if(!isset($_SESSION['user_id']))
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
        <li><a href="\PHPProject\loginhome.php">Home</a></li>
        <li><a href="\PHPProject\searchbylogin.php">Browse</a></li>
        <li  class="active"><a href="#">Dashboard</a></li>
        <li><a href="\PHPProject\cvupload.php">Apply</a></li>
        <li><a href="\PHPProject\viewcv.php">View</a></li>
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="\PHPProject\profile.php"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Your Applications</h1>
    </div>
    
    <br/><br/><br/>
    
    <div class="container-fluid table-responsive table-bordered table-hover">
    <table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Company Name</th>
        <th>Application Date</th>
        <th>Request Update</th>
        <th>View</th> 
    </tr>
    </thead>
    <tbody>
    <?php
    
            $empid = $_SESSION["user_id"];
            $jobid = "";
            $i=1;
        
            $servername="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="project";
            $conn = "";
            $username = $_SESSION['user_username'];
    
            $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
            if(!$conn)
                die("Connection failed".mysqli_connect_error());
   
        $sql = "SELECT job_id FROM jobapplications WHERE employee_id='$empid'";
        $result = mysqli_query($conn, $sql);
        
        if(!$result)
            echo "no";
        else{
        if(mysqli_num_rows($result) > 0){
            while( $row = mysqli_fetch_assoc($result) ){
                $jobid = $row["job_id"];
                
                $sql1 = "SELECT * from postjob WHERE job_id='$jobid' ";
                $result1 = mysqli_query($conn, $sql1);
        
                if( mysqli_num_rows($result1) > 0 ){
                    while( $row1 = mysqli_fetch_assoc($result1) ){
                        echo '<tr><td>'.$i++.'</td><td>'.$row1["category"].'</td><td>'.$row1["cmpname"].'</td><td>'.$row1["posted_date"].'</td><td>Pending</td><td><a href="\PHPProject\jobprofilelogin.php?jobid='.$row1["job_id"].'">View</a></td></tr>';
                    }
                } else{
                    echo "Error";
                }
            }
        } else{
            echo "0 results";
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