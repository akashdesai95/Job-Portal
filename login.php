<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
       
        if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['checked']) && isset($_COOKIE['log']) ){
            $c_uname = $_COOKIE['username'];
            $c_pwd = $_COOKIE['password'];
            $c_type = $_COOKIE['checked'];
            $c_log = $_COOKIE['log'];
        } else{
            $c_uname = $c_pwd = $c_type = $c_log = "";
        }
        
        if(count($_COOKIE) > 0){
            $c_set = "true";
        } else{
            $c_set = "false";
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
        <li  class="active"><a href="#"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Login</a></li>
        <li><a href="\PHPProject\register.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Register</a></li>
    </ul>
    </div>
    </nav>
    
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    
    <div class="container-fluid text-center register">
        <h1>Login</h1>
    </div>
    
    <div class="container">
    
    <form name="login" action="\PHPProject\loginvalidate.php" method="POST" class="form-horizontal" role="form">
    
        <br/>
        
        <div class="text-center">
        <p>
        <?php
        
            if(isset($_SESSION["user_registered"])){
                echo $_SESSION["user_registered"];
                unset($_SESSION["user_registered"]);
            }
        
        ?>
        </p>
        </div>
        
        <br/><br/>
    
        <div class="form-group">
        <label class="control-label col-sm-2" for="usr">Username : </label>
        <div class="col-sm-10">
        <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?=$c_uname?>" autofocus required />
        </div>
        </div>
        
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password : </label>
        <div class="col-sm-10">
        <input type="password" name="password" class="form-control"   placeholder="Enter Password" value="<?=$c_pwd?>" required />
        </div>
        </div>
        
        
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <div class="radio-inline">
        <label><input type="radio" name="type" value="applicant" <?php if( $c_type == "applicant" ){ echo "checked"; } ?> >Applicant</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="type" value="employer" <?php if( $c_type == "employer" ){ echo "checked"; } ?>  >Employer</label>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
        <label><input type="checkbox" name="log" value="yes"  <?php if( $c_log == "checked" ){ echo $c_log; } ?>   >Remember me</label>
        </div>
        </div>
        </div>
        
        <div class="form-group">
        <div class="col-sm-offset-5 col-sm-7">
        <button type="submit" class="btn btn-default">Login</button>
        </div>    
        </div>
        
        <br/>
        <div class="text-center">
        <p>
        <?php
        
            $msg="";
            if(isset($_GET['msg']))
                $msg = $_GET['msg'];
            
            echo $msg;
        
            if(isset($_SESSION['user_error'])){
                echo $_SESSION['user_error']; 
                unset($_SESSION['user_error']);                    
            }
            
        ?>
        </p>
        </div>
        
    </form>  
    </div>
    
    <div class="container text-center">
        <a href="\PHPProject\register.php" >Not registered yet? Click here to register</a>
    </div>
    
    <br/><br/><br/>
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>