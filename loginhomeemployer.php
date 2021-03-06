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
        <li class="active"><a href="#">Home</a></li>
        <li><a href="\PHPProject\dashboardoption.php">Dashboard</a></li>
        <li><a href="\PHPProject\post.php">Post</a><li> 
        <li><a href="\PHPProject\viewpost.php">View</a><li> 
        
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact Us</a></li>
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        <li><a href="\PHPProject\profileemployer.php"><span class="glyphicon glyphicon-log-in"> </span>&nbsp;Profile</a></li>
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    
    <div class="container-fluid text-center plunge">
       <h5> Take the plunge! Browse and Apply to get a call from the best companies in the world</h5>
    </div>
    
    <div class="container-fluid text-center top">
    
        <h2>Top Recruiters</h2>
        <hr/>
        
        <div class="row">
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\flipkart.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\premier.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\accenture.jpg" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\benchmarker.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\ethos.jpg" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\fundr.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\finolex.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\makemytrip.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\steria.png" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\afd-55407.jpg" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\careerbright.jpg" alt="company">
                </div>
            </div>
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img src="\PHPProject\recruiters\accenture.jpg" alt="company">
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="container-fluid text-center team" id="about">
        <h2>Team Members</h2>
        <hr/>
        
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                <h5>Karan Daudiya</h5>
                <p>CE - 19</p>
            </div>
            <div class="col-sm-2">
                <h5>Meet Dave </h5>
                <p>CE - 20</p>
            </div>
            <div class="col-sm-2">
                <h5>Riya Delhiwala</h5>
                <p>CE - 21</p>
            </div>
            <div class="col-sm-2">
                <h5>Akash Desai</h5>
                <p>CE - 22</p>
            </div>
            <div class="col-sm-2">
                <h5>Hetvi Desai</h5>
                <p>CE - 23</p>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-2">
                <h5>Khushboo Desai</h5>
                <p>CE - 24</p>
            </div>
            <div class="col-sm-2">
                <h5>Khushi Desai</h5>
                <p>CE - 25</p>
            </div>
            <div class="col-sm-2">
                <h5>Vraj Desai</h5>
                <p>CE - 26</p>
            </div>
            <div class="col-sm-2">
                <h5>Yatrik Desai</h5>
                <p>CE - 27</p>
            </div>
            <div class="col-sm-2"></div>
        </div>
  
    </div>
   
    <div class="container-fluid contact text-center" id="contact">
        <h2>Contact Us</h2>
        <p>Computer Engineering Department</p>
        <p><span class="glyphicon glyphicon-map-marker"></span>&nbsp;Dharamsinh Desai University, Nadiad</p>
        <p><span class="glyphicon glyphicon-phone"></span>&nbsp;www.ddu.ac.in</p>
        <p><span class="glyphicon glyphicon-envelope"></span>&nbsp;Email : enquiry@ddu.ac.in</p>
        
    </div>
    
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
</body>
</html>
 