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
        <li><a href="\PHPProject\admin\home.php">Home</a></li>
        <li ><a href="\PHPProject\admin\employee.php">Applicant</a></li>
        <li><a href="\PHPProject\admin\employer.php" >Employer</a></li>
        <li><a href="\PHPProject\admin\jobs.php">Available Jobs</a></li>
        
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Employee Profile</h1>
    </div>
    
    <br/><br/><br/><br/>
    

<div class="container-fluid table-bordered table-hover text-center">
<table class="table">
<tbody>


<?php


if(!isset($_GET['id'])){
	echo "Something went wrong";
	die();
}
$connecion=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM employees WHERE id=?";
$query=$connecion->prepare($statement);
if(!$query->execute(array($_GET['id']))){
	echo "error";
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "not available employee details<br>";
	echo "<a href=".$_SERVER['HTTP_REFERER'].">Go Back</a>";
	die();
}


echo "<tr><td><b>Unique id</b></td>";
echo "<td>$row->id</td></tr>";
echo "<tr><td><b>Username</b></td>";
echo "<td>$row->username</td></tr>";
echo "<td><b>Email</b></td>";
echo "<td>$row->email</td></tr>";
echo "<tr><td><b>Name</b></td>";
echo "<td>$row->fname</td></tr>";
echo "<tr><td><b>Birthday</b></td>";
echo "<td>$row->birthday</td></tr>";;
echo "<tr><td><b>City</b></td>";
echo "<td>$row->city</td></tr>";
echo "<tr><td><b>Mobile number<b></td>";
echo "<td>$row->number</td></tr>";
echo "<tr><td><b>Under Graduate/Post Graduate</b></td>";
echo "<td>$row->experience</td>";
echo "<tr><td><b>education</b></td>";
echo "<td>$row->education</td></tr>";
echo "<tr><td><b>Experience</b></td>";
echo "<td>$row->year</td></tr>";	
echo "<tr><td><b>Resume</b></td>";
if($row->resume==null){
	echo "<td>Not uploaded resume yet</td></tr>";
}else{
	echo "<td><a href=\"$row->resume\">Download</a>";
}
echo "<tr><td><b>University<b></td>";
echo "<td>$row->univ</td></tr>";
echo "<tr><td><b>Account status</b></td>";
echo "<td>$row->closejob</td></tr>";
echo "</tr></tbody></table></div>";
echo "<br><br>";

if($row->closejob=="open"){
    
	echo "<div class=\"btn btn-default\"><a href=\"blockaccount.php?id=".$_GET['id']."\">Block account</a></div>";
}else{
	echo "<div class=\"btn btn-default\"><a href=\"unblockaccount.php?id=".$_GET['id']."\">Unblock account</a></div>";
}

?>

</div>

<br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>
