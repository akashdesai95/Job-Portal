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
        <li class="active"><a href="#">Browse</a></li>
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
        <h1>Browse</h1>
    </div>
    
     
     <br/><br/><br/>
     <div class="container text-center">
    <?php
        
            if(isset($_SESSION["user_registered"])){
                echo $_SESSION["user_registered"];
                unset($_SESSION["user_registered"]);
            }
        
    ?>
    </div> 
    
    <br/><br/>
    
   
    <div class="container">
   <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);   ?>" method="GET" class="form-horizontal" role="form">
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="category">Search : </label>
        <div class="col-sm-10">
        <select class="form-control" name="category" id="category">
            
            <option name='category'>Category</option>
            <option value="cmpname">Company</option>
            <option value="role">Designation</option>
            <option value="location">Location</option>
             
        </select>
        </div>
        </div>
        
        
        
        <div class="form-group">
        <label class="control-label col-sm-2" for="key">Enter Keyword : </label>
        <div class="col-sm-10">
        <input type="text" name="key" class="form-control" id="key" placeholder="Type Keyword"  >
        </div>
        </div>
        
        
        
        <div class="form-group">
        <div class="col-sm-offset-5 col-sm-5">
        <button type="submit" class="btn btn-default">Search</button>
        </div>    
        </div>
     </div>
     
     <br/><br/><br/>
        
    </form>
    
    <hr/>
    
    <div class="container-fluid text-center">
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Accounting">Accounting</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Bank">Bank</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Consultant">Consultant</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Ecommerce">Ecommerce</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Engineering">Engineering</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=FMCG">FMCG</a></div>
    </div>
    <div class="row">
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Insurance">Insurance</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=IT">IT</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Media">Media</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Medical">Medical</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Real Estate">Real Estate</a></div>
        <div class="col-sm-2"><a class="btn btn-default" href="\PHPProject\searchbylogin.php?msg=Others">Others</a></div>
    </div>
    </div>
    
    <hr/>
    
    
    <br/><br/>
    
    <div class="container">
    <div class="panel-group">
    <?php
    
        $msg = "";
        $key="";
       

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project";
        $conn = "";
                
        $datetoday = date("Y/m/d");  
         
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
        
            $datetoday = date("Y/m/d");  
    
             $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(!$conn)
                die("Connection failed".mysqli_connect_error());
            
            if(isset( $_GET['msg'] )){
                $msg = $_GET['msg'];
                if( !empty($msg) )
                    $sql = "SELECT * FROM postjob WHERE category='$msg'";
                else{
                    $sql = "SELECT * FROM postjob";
                }
            } else{
            
            if(isset($_GET['key'])){
                if(!empty($_GET['key'])){
                    $key="%".$_GET['key']."%";
			        $sql="SELECT * FROM `postjob` WHERE `". $_GET['category']."` LIKE '". $key."'";
                    
                    
                } else{
                    $sql = "SELECT * FROM postjob";
                }
            } else{
                $sql = "SELECT * FROM postjob";
            }
            
            }
      
    
            
            $result = mysqli_query($conn, $sql);
       
            
            
         if(mysqli_num_rows($result) > 0){
            while( $row = mysqli_fetch_assoc($result)){
        
               $dateposted = $row["deadline"];
               
               if( strtotime($dateposted) < strtotime($datetoday) ){
                   $row["closejob"] = "blocked";
               } else{
                   $row["closejob"] = "open";
                   }
               
               if($row["closejob"]=="blocked" || $row["closejob"]=="removed")
                  continue;
              
              
               
               echo "<div class=\"panel panel-default\">";
               echo "<div class=\"panel-heading\">";
               echo "<p class=\"panel-title\"><h3>".$row["cmpname"]."</h3>";
               echo "<span><img src=\"\\PHPProject\\logos\\".$row["email"].".".$row["logos"]."\" alt=\"logos\" height=\"70\" width=\"70\"></span></p>";
               echo "<p><h4>".$row["role"]."</h4></p>";
               echo "<p><b>Stipend : </b>".$row["stipend"]."</p>";
               echo "<p><b>Application Deadline : </b>".$row["deadline"]."</p></div>";
               echo "<div class=\"panel-footer text-center\">";
               echo "<form action=\"\PHPProject\\jobprofilelogin.php\" method=\"GET\">";
               echo "<input type=\"hidden\" name=\"jobid\" value=".$row["job_id"].">";
               echo "<input type=\"submit\" value=\"View\"></form>";
               echo "</div></div>";
               
               
            }
       } else{
            echo "<div class=\"text-center\"><br/><br/><br/>0 results found</div>";
        }
        

	
    
  

?>
</div>
 </div>  </div>
   
 <br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>
      
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

