<!DOCTYPE html>
<html lang="en">
<head>
    <title>View </title>
    <meta charset="UTF-8">
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
        <li><a href="\PHPProject\searchbylogin.php">Browse</a></li>
        <li><a href="\PHPProject\dashboard.php">Dashboard</a></li>
        <li><a href="\PHPProject\cvupload.php">Apply</a></li>
        <li class="active"><a href="#">View</a></li>
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="\PHPProject\profile.php"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>View Your Application</h1>
    </div>
    
    <br/><br/>
    
    <div class="container text-center">
    <br/>
    
    <?php
        
            if(isset($_SESSION["user_registered"])){
                echo $_SESSION["user_registered"];
                unset($_SESSION["user_registered"]);
            }
        
    ?>
      
    <br/>
    </div>
    
    
    <div class="container text-center table-responsive">
    <table class="table">
    <tbody>
    <tr>
    
    <?php
    
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project";
        $conn = "";
        $email = $_SESSION['user_email'];
        
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
        $sql = "SELECT * FROM employees WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0)
        {
            while( $row = mysqli_fetch_assoc($result)){
                echo "<td>Full Name : </td><td>".$row["fname"]."</td></tr><tr><td>City : </td><td>".$row["city"]."</td></tr><tr><td>Email Id : </td><td>".$row["email"]."</td></tr><tr><td>Mobile Number : </td><td>".$row["number"]."</td></tr><tr><td>Education : </td><td>".$row["experience"]."</td></tr><tr><td>Qualification : </td><td>".$row["education"]."</td></tr><tr><td>Alma Mater : </td><td>".$row["univ"]."</td></tr><tr><td>Total Experience : </td><td>".$row["year"]."</td></tr>";
                $resume = $row["resume"];
            }
        } else{
            echo "Select profile query error";
        }
        
        
        
    ?>
    
    </tbody>
    </table>
    </div>
    
    <br/><br/>
    
    <div class="container text-center"> 
    <a href="<?= $resume ?>" class="btn btn-default">Download Your Resume</a>
    </div>
    
    
    <br/><br/>
    
    <div class="container text-center">
    <a href="\PHPProject\cvedit.php" class="btn btn-default">Edit Your CV</a>
    </div>
    
    
    <br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>