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
        </li>
        
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
    
    <div class="container">
    
        <div class="col-sm-offset-2 col-sm-10">
            <p><br/>All fields are compulsory</p>
        </div>
    
    
    <form action="\PHPProject\registervalidate.php" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
    
        <div class="form-group">
        <label class="control-label col-sm-2" for="usr">Enter Username : </label>
        <div class="col-sm-10">
        <input type="text" name="username" class="form-control" id="usr" placeholder="Type Username (max length : 10 chars and only letters and white spaces allowed)" autofocus required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Enter Password : </label>
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
        <label class="control-label col-sm-2" for="cmp"> Company Name : </label>
        <div class="col-sm-10">
        <input type="text" name="cmp" class="form-control" id="cmp" placeholder="Enter Company Name" autofocus required >
        </div>
        </div>
        

       <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email Id : </label>
        <div class="col-sm-10">
        <input type="email" name="email" class="form-control" id="email" placeholder="abc@xyz.com" required >
        </div>
        </div>
       
        <div class="form-group">
        <label class="control-label col-sm-2" for="web">Enter Website : </label>
        <div class="col-sm-10">
        <input type="text" name="web" class="form-control" id="web" placeholder="Enter website URL" autofocus required >
        </div>
        </div>
        

        <div class="form-group">
        <label class="control-label col-sm-2" for="num">Mobile Number : </label>
        <div class="col-sm-10">
        <input type="tel" name="phone" class="form-control" id="num" placeholder="Enter mobile number" required >
        </div>
        </div>
       
       <input type="hidden" name="type" value="employer" > 
        
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
        <button type="submit" class="btn btn-default">Register</button>
        </div>    
        </div>
        
    </form>
    </div>
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
</body>
</html>
