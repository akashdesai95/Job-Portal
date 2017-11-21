<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
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
        <li><a href="\PHPProject\dashboardoption.php">Dashboard</a></li> 
        <li><a  class="active" href="#">Post</a><li> 
        <li><a href="\PHPProject\viewpost.php">View</a><li> 
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li  ><a href="#"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Post Profile</h1>
    </div>
    
    <div class="container">
    
        <div class="col-sm-offset-2 col-sm-10">
            <p><br/>All fields are compulsory</p>
        </div>
    
    
    <form action="\PHPProject\postvalidate.php" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
    
        <div class="form-group">
        <label class="control-label col-sm-2" for="company">Enter Company Name : </label>
        <div class="col-sm-10">
        <input type="text" name="companyname" class="form-control" id="company" placeholder="Type Company Name" autofocus required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email Id : </label>
        <div class="col-sm-10">
        <input type="email" name="email" class="form-control" id="email" placeholder="Company Email ID : abc@xyz.com" required >
        </div>
        </div>
       
        <div class="form-group">
        <label class="control-label col-sm-2" for="cat">Category : </label>
        <div class="col-sm-10">
        <select class="form-control" name="cat" id="cat">
            
            <option>Accounting</option>
            <option>Bank</option>
            <option>Consultant</option>
            <option>Ecommerce</option>
            <option>Engineering</option>
            <option>FMCG</option>
            <option>Insurance</option>
            <option>IT</option>
            <option>Media</option>
            <option>Medical</option>
            <option>Real Estate</option>
            <option>Others</option>
        </select>
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="pos">Enter Designation : </label>
        <div class="col-sm-10">
        <input type="text" name="pos" class="form-control" id="pos" placeholder="Type Candidate Role" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="vac">Enter Vacancy : </label>
        <div class="col-sm-10">
        <input type="text" name="vac" class="form-control" id="vac" placeholder="Type Vacancy" required >
        </div>
        </div>
        
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="amt">Enter Stipend : </label>
        <div class="col-sm-10">
        <input type="text" name="stipend" class="form-control" id="amt" placeholder="Type Stipend (Annual)" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="loc">Enter location : </label>
        <div class="col-sm-10">
        <input type="text" name="loc" class="form-control" id="loc" placeholder="Enter location of workspace" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="dead">Application Deadline : </label>
        <div class="col-sm-10">
        <input type="date" name="dead" class="form-control" id="dead"  required >
        </div>
        </div>
       
        
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="num">Contact Details : </label>
        <div class="col-sm-10">
        <input type="tel" name="phone" class="form-control" id="num" placeholder="Enter mobile number" required >
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="profile">Enter Candidate Profile : </label>
        <div class="col-sm-10">
        <textarea name="profile" class="form-control" id="profile" rows="5" cols="100" placeholder="Enter desired candidate profile here..." ></textarea>
        </div>
        </div>
        
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="jdesc">Job Description : </label>
        <div class="col-sm-10">
        <textarea name="jdesc" class="form-control" id="jdesc" rows="5" cols="100" placeholder="Enter job description here..." ></textarea>
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="cdesc">Company Description : </label>
        <div class="col-sm-10">
        <textarea name="cdesc" class="form-control" id="cdesc" rows="5" cols="100" placeholder="Enter Company Description here..." ></textarea>
        </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="logos">Upload Company logo : </label>
        <div class="col-sm-10">
        <input type="file" name="logos" id="logos" class="form-control" required >
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
        <button type="submit" class="btn btn-default">Post</button>
        </div>    
        </div>
        
    </form>
    </div>
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
</body>
</html>

