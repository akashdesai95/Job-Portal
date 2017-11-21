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
        <h1>Notifications</h1>
    </div>
    
    <br/><br/><br/><br/>
    



<div class="container">
<h1>Request from Employers</h3>


<div class="container-fluid table-bordered table-hover">
<table class="table">
<tbody>

<?php



echo "Request from employers";
echo "<br><br>";
$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM postjob WHERE notification=1 ORDER BY requestdate DESC";
if(!$query=$connection->query($statement)){
	echo "error";
	die();
}
echo "<table border='1' width='100%'>";
while($row=$query->fetch(PDO::FETCH_OBJ)){
	echo "<tr><td>$row->cmpname has requested u to remove its job</td>";
	echo "<td><a href=\"viewjobdetail.php?company_id=$row->company_id&job_id=$row->job_id\">View Detail</a>";
	echo "<td><a href=\"removejob.php?company_id=$row->company_id&job_id=$row->job_id\">Remove job</a>";
}



?>
</tr>
</tbody>
</table>
</div>

<br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>

