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
        <h1>Job Applications</h1>
    </div>
    
    <br/><br/><br/><br/>

<div class="container text-center">
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
	
	echo"not available employee details";
	
	//echo "<a href=".$_SERVER['HTTP_REFERER'].">Go Back</a>";
	die();
}


echo "<h3>Job applications:-</h3>";
echo "<hr>";	
echo "Username:-$row->username";
echo "<br>Name:- $row->fname";
echo "<br>email:- $row->email";
echo "<br>Mobile number:- $row->number";

?>
</div>

<br><br>

<div class="container text-center">
<form class="form-horizontal" role="form">
<div class="form-group">
<label class="control-label col-sm-2" for="category">Search : </label>
<div class="col-sm-10">

<select class="form-control" name='category' id="cat">
<option value="job_id">Job ID</option>
<option value="cmpname">Company name</option>
<option value="role">Designation</option>
<option value="posted_Date">Start date</option>
<option value="deadline">End date</option>
</select>


<?php 
$id=$_GET['id'];
echo "<input type='hidden' name='id' value=\"$id\">";
?>
<input type="text" name="key" id="k" placeholder="Keyword">
<input type="submit" class="btn btn-default" value="Search" >
</form>


<div class="container-fluid table-bordered table-hover">
<table class="table">
<thead>
<tr>

<?php

if(isset($_GET['msg'])){
	echo $_GET['msg']."<br>";
	
}
$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$flag=0;
if(isset($_GET['key'])){
				$flag=1;		
				$key="%".$_GET['key']."%";
				$statement1="SELECT * FROM jobapplications WHERE employee_id=?";
				$query1=$connection->prepare($statement1);
				if(!$query1->execute(array($_GET['id']))){
					echo "error";
					die();
				}
				
}else{
	$flag=0;
	$statement1="SELECT * FROM jobapplications WHERE employee_id=?";
	$query1=$connection->prepare($statement1);
	if(!$query1->execute(array($_GET['id']))){
		echo "error";
		die();
	}
} 



echo "<th>Job id</th>";
echo "<th>Company name</th>";
echo "<th>Post</th>";
echo "<th>Job description</th>";
echo "<th>Start Date</th>";
echo "<th>Closing date</th>";
echo "<th>Applied date</th>";
echo "<th>Job Status</th>";
echo "<th>Application Status</th></tr></thead><tbody>";
while($jobapplicationrow=$query1->fetch(PDO::FETCH_OBJ)){
	if($flag==1){
		$statement2="SELECT * FROM `postjob` WHERE `job_id`=$jobapplicationrow->job_id and `". $_GET['category']."` LIKE '". $key."'";
	}else{
		$statement2="SELECT * FROM postjob WHERE job_id=".$jobapplicationrow->job_id;
	}
	
	if(!$query2=$connection->query($statement2)){
		echo "error";
		die();
	}
	if(!$jobrow=$query2->fetch(PDO::FETCH_OBJ)){
		//echo "jbj";
		continue;
		//die();
	}
	echo "<tr><td>$jobrow->job_id</td>";
	echo "<td>$jobrow->cmpname</td>";
	echo "<td>$jobrow->role</td>";
	echo "<td>$jobrow->jobdesc</td>";
	echo "<td>$jobrow->posted_date</td>";
	echo "<td>$jobrow->deadline</td>";
	echo "<td>$jobapplicationrow->applied_date</td>";
	$end_date=$jobrow->deadline;
	$today="20".date('y/m/d');
	
	
	if(strtotime($end_date)<strtotime($today)){
		echo "<td>Closed</td></tr>";
	}else{
		echo "<td>$jobrow->closejob</td>";
	}
	
	
	if($row->closejob=="blocked"){
		echo "<td>$row->closejob</td>";
		echo "<td><a href=\"viewjobdetails.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">View Details</a>";
		echo "<td>Account is inactive</td>";
		
	}else if($jobrow->closejob=="removed"){
		echo "<td>$jobrow->closejob</td>";
		echo "<td><a href=\"viewjobdetails.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">View Details</a>";
		echo "<td>Job is removed</td>";
	}
	else if($jobrow->closejob=="blocked"){
		echo "<td>$jobrow->closejob</td>";
		echo "<td><a href=\"viewjobdetails.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">View Details</a>";
		echo "<td>Job is blocked</td>";
	}else if($jobapplicationrow->closejob=="open"){
		echo "<td>$jobapplicationrow->closejob</td>";
		echo "<td><a href=\"viewjobdetails.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">View Details</a>";
		echo "<td><a href=\"blockapplication.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">Block application</a>";
	}else{
		echo "<td>$jobapplicationrow->closejob</td>";
		echo "<td><a href=\"viewjobdetails.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">View Details</a>";
		echo "<td><a href=\"unblockapplication.php?employee_id=".$_GET['id']."&job_id=".$jobapplicationrow->job_id."\">Unblock application</a>";
	}
}


?>

</tr>
</tbody>
</table>
</div>
</div>

<br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>
    
    
    
</body>
</html>
