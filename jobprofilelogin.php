<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recruiters'</title>
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
        <li><a href="\PHPProject\loginhome.php">Home</a></li>
        <li class="active"><a href="\PHPProject\searchbylogin.php">Browse</a></li>
        <li><a href="\PHPProject\dashboard.php">Dashboard</a></li>
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
        <h1>View</h1>
    </div>
    
    <br/><br/><br/>

    <div class="container text-center table-responsive">
    <table class="table">
    <tbody>
    
    
    
    <?php 
    
        $jobid = "";
        if( $_SERVER["REQUEST_METHOD"] == "GET" )
            if(isset( $_GET['jobid'] ))
                $jobid = $_GET['jobid'];
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project";
        $conn = "";
                
        $datetoday = date("Y/m/d");  
         
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
            
        
        $sql = "SELECT * FROM postjob WHERE job_id='$jobid'";
              
        
        
        $result = mysqli_query($conn, $sql);
        
        $i=0;
        
        if( mysqli_num_rows($result) > 0)
        {
            while( $row = mysqli_fetch_assoc($result)){
                
               $dateposted = $row["deadline"];
               
               if( strtotime($dateposted) < strtotime($datetoday) ){
                   $row["closejob"] = "blocked";
               } else{
                   $row["closejob"] = "open";
                   }
               
               if($row["closejob"]=="blocked" || $row["closejob"]=="removed")
                  continue;
              
              
                 echo "<tr><form action=\"\PHPProject\submitapplication.php\"><input type=\"hidden\" name=\"id\" value=".$row["job_id"]."><button type=\"submit\" name=\"action\" value=\"apply\" class=\"btn btn-default btn-lg\">Apply</button><button type=\"submit\" name=\"action\" value=\"cancel\" class=\"btn btn-default btn-lg\">Cancel</button></form><br/><br/></tr><tr><img src=\"\\PHPProject\\logos\\".$row["email"].".".$row["logos"]."\" alt=\"logos\" height=\"150\" width=\"150\"></tr><tr><br/><br/><br/></tr><tr><td>Company Name : </td><td>".$row["cmpname"]."</td></tr><tr><td>Designation : </td><td>".$row["role"]."</td></tr><tr><td>Stipend : </td><td>".$row["stipend"]."</td></tr><tr><td>Category : </td><td>".$row["category"]."</td></tr><tr><td>Deadline : </td><td>".$row["deadline"]."</td></tr><tr><td>Vacancy : </td><td>".$row["vacancy"]."</td></tr><tr><td>Location : </td><td>".$row["location"].
                 "</td></tr><tr><td>Candidate Requirements : </td><td>".$row["profile"].
                 "</td></tr><tr><td>Job Description : </td><td>".$row["jobdesc"].
                 "</td></tr><tr><td>Company Description : </td><td>".$row["cmpdesc"].
                 "</td></tr><tr><td>Email : </td><td>".$row["email"].
                 "</td></tr><tr><td>Contact Number : </td><td>".$row["contact"]."</td></tr>";
               
              
            }
        } else{
            echo "0 results displayed";
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
    
    
    
    
