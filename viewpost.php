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
        <li><a href="\PHPProject\Dashboardoption.php">Dashboard</a></li>
        <li><a href="\PHPProject\post.php">Post</a><li> 
        <li class="active"><a href="#">View</a><li> 
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="\PHPProject\profileemployer.php"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Posted Profiles</h1>
    </div>
    
    <br/><br/>
    <div class="container text-center">
    <?php
        
            if(isset($_SESSION["register_error"])){
                echo $_SESSION["register_error"];
                unset($_SESSION["register_error"]);
            }
        
    ?>
    </div> 
    
    <br/><br/>
    
    
    
    <div class="container">
    <div class="panel-group">
    
    <?php
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project";
        $conn = "";
        $username = $_SESSION['user_username'];
        $jobid="";
        
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
        $sql = "SELECT * FROM postjob WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        
        $datetoday = date("Y/m/d");  
        $expire = "valid";
        
        if(mysqli_num_rows($result) > 0)
        {
            while( $row = mysqli_fetch_assoc($result)){
                 $dateposted = $row["deadline"];
                 
                 
               if( $row["closejob"]=="removed" ){
                   continue;
               } else{
               if( strtotime($dateposted) < strtotime($datetoday) ){
                   $row["closejob"] = "blocked";
               } else{
                   $row["closejob"] = "open";
                   }
               
               if($row["closejob"]=="blocked")
                  $expire = "expired";
               }
            
              
               
               echo "<div class=\"panel panel-default\">";
               echo "<div class=\"panel-heading\">";
               echo "<p class=\"panel-title\"><h3>".$row["cmpname"]."</h3></p>";
               echo "<span><img src=\"\\PHPProject\\logos\\".$row["email"].".".$row["logos"]."\" alt=\"logos\" height=\"70\" width=\"70\"></span></p>";
               echo "<p><h4>".$row["role"]."</h4></p>";
               echo "<p><b>Stipend : </b>".$row["stipend"]."</p>";
               echo "<p><b>Validity : </b>".$expire."</p></div>";
               echo "<div class=\"panel-footer text-center\">";
               echo "<form action=\"\PHPProject\\viewpostdelete.php\" method=\"GET\">";
               echo "<input type=\"hidden\" name=\"jobid\" value=".$row["job_id"].">";
               echo "<input type=\"submit\" value=\"view\" class=\"btn btn-default btn-sm\"></form>";
               echo "</div></div>";
               
               $expire = "valid";
              
               
                
            }
        } else{
            echo "<div class=\"text-center\">0 results displayed</div>";
        }  
        $_SESSION['del_job'] = $jobid ;
    ?>
    
   </div>
    </div>
    
    <div class="container text-center">
    <?php
        
            if(isset($_SESSION["user_registered"])){
                echo $_SESSION["user_registered"];
                unset($_SESSION["user_registered"]);
            }
        
    ?>
    </div> 
    
    <br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
       

</body>
</html>