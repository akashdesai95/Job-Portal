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
        <li class="active"><a href="\PHPProject\admin\employer.php" >Employer</a></li>
        <li><a href="\PHPProject\admin\jobs.php">Available Jobs</a></li>
        
    </ul>
        
    <ul class="nav navbar-nav navbar-right" >
        
        <li><a href="\PHPProject\logout.php"><span class="glyphicon glyphicon-user"> </span>&nbsp;Logout</a></li>
    </ul>
    </div>
    </nav>
    
    <img class="img" src="\PHPProject\home_img.jpg.jpg" alt="home_img">
  
    <div class="container-fluid text-center register">
        <h1>Job Details</h1>
    </div>
    
    <br/><br/><br/><br/>
    


<div class="container-fluid table-bordered table-hover text-center">
<table class="table">
<tbody>



<?php

if(!isset($_GET['company_id'])){
	echo "No data!";
	die();
}

if(!isset($_GET['job_id'])){
	echo "No data!";
	die();
}

$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM postjob WHERE company_id=? and job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id'],$_GET['job_id']))){
	echo "error";
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "Invalid input";
	die();
}
$statement="SELECT * FROM postjob WHERE job_id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['job_id']))){
	echo "error";
	die();
}
$row=$query->fetch(PDO::FETCH_OBJ);

echo "<tr><td><b>Job ID</b></td>";
echo "<td>$row->job_id</td></tr>";
echo "<tr><td><b>Post</b></td>";
echo "<td>$row->role</td></tr>";
echo "<tr><td><b>Job description</b></td>";
echo "<td>$row->jobdesc</td></tr>";
echo "<tr><td><b>Company</b></td>";
echo "<td>$row->cmpname</td></tr>";
echo "<tr><td><b>Company Description</b></td>";
echo "<td>$row->cmpdesc</td></tr>";
echo "<tr><td><b>Website</b></td>";
$statement1="SELECT website,closejob FROM clients WHERE id=?";
$query1=$connection->prepare($statement1);
if(!$query1->execute(array($row->company_id))){
	echo "error";
	die();
}
$row1=$query1->fetch(PDO::FETCH_OBJ);
echo "<td>$row1->website</td></tr>";
echo "<tr><td><b>Email</b></td>";
echo "<td>$row->email</td></tr>";
echo "<tr><td><b>Candidate requirement</b></td>";
echo "<td>$row->profile</td></tr>";
echo "<tr><td><b>Posted date (yyyy-mm-dd)</b></td>";
echo "<td>$row->posted_date</td></tr>";
echo "<tr><td><b>Deadline (yyyy-mm-dd)</b></td>";
echo "<td>$row->deadline</td></tr>";
echo "<tr><td><b>Status</b></td>";
$end_date=$row->deadline;
$today="20".date('y/m/d');
if(strtotime($end_date)<strtotime($today)){
	echo "<td>Closed</td></tr>";
}else{
	echo "<td>$row->closejob</td>";
}
echo "</tr></tbody></table></div>";
echo "<br><br>";
if($row1->closejob=="blocked"){
	echo "Account closed";
}else if($row->closejob=="removed"){
	echo "Job is removed";
}
else if($row->closejob=="blocked"){
	echo "<div class=\"container text-center\"><a  class=\"btn btn-default\"  href=\"unblockjob.php?job_id=".$_GET['job_id']."\">Unblock this job</a></div>";
}else{
	echo "<div class=\"container text-center\"><a   class=\"btn btn-default\" href=\"blockjob.php?job_id=".$_GET['job_id']."\">Block this job</a></div>";
}

echo "<br><br><div class=\"container text-center\"><a  class=\"btn btn-default\" href=\"jobapplications.php?company_id=".$_GET['company_id']."&job_id=$row->job_id\">Received applications</a></div>";

?>
</div>

<br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>
