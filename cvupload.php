<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
        <li><a href="\PHPProject\Dashboard.php">Dashboard</a></li>
        <li  class="active"><a href="#">Apply</a></li>
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
        <h1>Apply</h1>
    </div>
    
    <br/><br/><br/>
    
    <div class="container">
    
        <div class="col-sm-offset-2 col-sm-10">
            <p><br/>All fields are compulsory</p>
        </div>
    
    
    <form action="\PHPProject\cvvalidate.php" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
    
        <div class="form-group">
        <label class="control-label col-sm-2" for="fname">Enter Full Name : </label>
        <div class="col-sm-10">
        <input type="text" name="fname" class="form-control" id="fname" placeholder="Type Full name" autofocus required >
        </div>
        </div>
                       
        <div class="form-group">
        <label class="control-label col-sm-2" for="city">City : </label>
        <div class="col-sm-10">
        <input type="text" name="city" class="form-control" id="city" placeholder="Type Your City" required >
        </div>
        </div>

        
        <div class="form-group">
        <label class="control-label col-sm-2" for="exp">Education : </label>
        <div class="col-sm-10">
        <select class="form-control" name="exp" id="exp">
            <option value="Post-Graduate">Post-Graduate</option>
            <option value="Undergraduate">Undergraduate</option>
            <option value="High School">High School</option>
            <option value="Sophomore">Sophomore</option>
        </select>
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="year">Current Experience : </label>
        <div class="col-sm-10">
        <input type="text" name="year" class="form-control" id="year" placeholder="Type total years of experience" required >
        </div>
        </div>
       
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="qual">Enter Qualification : </label>
        <div class="col-sm-10">
        <input type="text" name="qual" class="form-control" id="qual" placeholder="Type your Qualification" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="univ">Alma Mater : </label>
        <div class="col-sm-10">
        <input type="text" name="univ" class="form-control" id="univ" placeholder="Type Name of graduating institute" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="cv">Upload your CV : </label>
        <div class="col-sm-10">
        <input type="file" name="resume" id="cv" class="form-control" required >
        </div>
        </div>
        
        <br/>
        <div class="text-center">
        <p>
        <?php
        
            if(isset($_SESSION["register_error"])){
                echo $_SESSION["register_error"];
                unset($_SESSION["register_error"]);
            }
        
        ?>
        </p>
        </div>
        
       
        
        <div class="form-group">
        <div class="col-sm-offset-5 col-sm-5">
        <button type="submit" class="btn btn-default">Apply</button>
        </div>    
        </div>
        
    </form>
    </div>
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
</body>
</html>
