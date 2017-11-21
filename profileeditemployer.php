<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit your Profile</title>
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
        <li><a href="\PHPProject\loginhomeemployer.php">Home</a></li>
        <li  class="active"><a href="#">Dashboard</a></li>
        <li><a href="\PHPProject\post.php">Post</a><li> 
        <li><a href="\PHPProject\viewpost.php">View</a><li> 
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="#"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Edit your Profile</h1>
    </div>
    
    <br/><br/><br/>
    <div class="container">
    <form action="\PHPProject\profilealteremployer.php" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
    
        <div class="form-group">
        <label class="control-label col-sm-2" for="usr">Change Username : </label>
        <div class="col-sm-10">
        <input type="text" name="username" class="form-control" id="usr" placeholder="Type Username" autofocus required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="cmp">Change Company Name : </label>
        <div class="col-sm-10">
        <input type="text" name="cmp" class="form-control" id="cmp" placeholder="Type Company Name" autofocus required >
        </div>
        </div>
        
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Change Password : </label>
        <div class="col-sm-10">
        <input type="password" name="password1" class="form-control" id="pwd" placeholder="Type Password" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd1">Re-Enter Password : </label>
        <div class="col-sm-10">
        <input type="password" name="password2" class="form-control" id="pwd1" placeholder="Re-Type Password" required >
        </div>
        </div>

       <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email Id : </label>
        <div class="col-sm-10">
        <input type="email" name="email" class="form-control" id="email" placeholder="abc@xyz.com" required >
        </div>
        </div>

        <div class="form-group">
        <label class="control-label col-sm-2" for="web">Change Website : </label>
        <div class="col-sm-10">
        <input type="text" name="web" class="form-control" id="web" placeholder="Type website name" autofocus required >
        </div>
        </div>
        

        <div class="form-group">
        <label class="control-label col-sm-2" for="num">Mobile Number : </label>
        <div class="col-sm-10">
        <input type="tel" name="phone" class="form-control" id="num" placeholder="Enter mobile number" required >
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
        <button type="submit" class="btn btn-default">Save</button>
        </div>    
        </div>
        
    </form>
    </div>
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>