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
        if( isset( $_SESSION["user_username"]) ){
            unset( $_SESSION["user_username"] );
        }
        
        
       
    ?>
    

    
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Recruiters'</a>
    </div>
    
    <ul class="nav navbar-nav">
        <li><a href="\PHPProject\home.php">Home</a></li>
        <li><a href="\PHPProject\searchby.php">Browse</a></li>
        <li><a href="\PHPProject\home.php">About</a></li>
        <li><a href="\PHPProject\home.php">Contact Us</a></li>
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="\PHPProject\login.php"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Login</a></li>
        <li class="active"><a href="#"><span class="glyphicon glyphicon-user"> </span>&nbsp;Register</a></li>
    </ul>
    </div>
    </nav>
    
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    
    <div class="container-fluid text-center register">
        <h1>Register</h1>
    </div>

    
    
    <br/><br/><br/><br/>
    
    <div class="container text-center">
        <a href="\PHPProject\registerlogin.php" class="btn btn-default btn-lg">Register as Applicant</a><br/><br/><br/>
        <hr/><br/><br/><br/>
        <a href="\PHPProject\registeremployer.php" class="btn btn-default btn-lg">Register as Employer</a>
    </div>
    
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
</body>
</html>
