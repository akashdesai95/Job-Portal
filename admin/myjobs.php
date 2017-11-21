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
        <li class="active"><a href="\PHPProject\admin\employee.php">Applicant</a></li>
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
        <h1>Job List</h1>
    </div>
    
    <br/><br/><br/><br/>


<div class="container text-center">

<?php 

if(!isset($_GET['company_id'])){
	echo "Something went wrong";
	die();
}
$connection=new PDO('mysql:host=localhost;dbname=project','root','');
$statement="SELECT * FROM clients WHERE id=?";
$query=$connection->prepare($statement);
if(!$query->execute(array($_GET['company_id']))){
	echo "error";
	die();
}

if(!$row=$query->fetch(PDO::FETCH_OBJ)){
	echo "Employer detail not available!<br>";
	die();
}

$accountclosed=$row->closejob;

?>


<form class="form-horizontal" role="form">

<div class="form-group">
<label class="control-label col-sm-2" for="category">Search : </label>
<div class="col-sm-10">


<select class="form-control" name='category' id="cat">
<option value="id">ID</option>
<option value="username">Username</option>
<option value="email">Email</option>
<option value="company">Company Name</option>

<option value="website">Website</option>
<option value="closejob">Job status</option>
<option value="number">Mobile number</option>
</select>
</div>
</div>


<div class="form-group">
<input type="text" class="form-control" name="key" id="k" placeholder="Keyword">
<?php 
$company_id=$_GET['company_id'];
echo "<input type='hidden' name='company_id' value=\"$company_id\">";
?>
<input type="submit" value="Search" class="btn btn-default" >
</div>
</form>
</div>


<?php
if(isset($_GET['msg'])){
	echo $_GET['msg'];

}

if(isset($_GET['key'])){
	$key="%".$_GET['key']."%";
	$statement="SELECT * FROM `postjob` WHERE company_id=$company_id and `". $_GET['category']."` LIKE '". $key."'";
	$query=$connection->query($statement);
}
else{

	$statement="SELECT * FROM postjob WHERE company_id=$company_id";
	$query=$connection->query($statement);
}
$rowCount=$query->rowCount();
echo "<div class=\"container text-center\"><p>No of matched data:$rowCount</p></div>";




echo "<div class=\"container-fluid table-bordered table-hover\"><table class=\"table\"><thead><tr><tr><th>Job ID<th>";
echo "<th>Email</th>";
echo "<th>category</th>";
echo "<th>Designation</th>";
echo "<th>Company Discription</th>";
echo "<th>Posted date</th>";
echo "<th>Deadline</th>";
echo "<th>Contact no</th>";
echo "<th>Job status</th></thead><tbody>";


while($row=$query->fetch(PDO::FETCH_OBJ)){
		echo "<tr><td>$row->job_id</td>";
		echo "<td>$row->email</td>";
		echo "<td>$row->category</td>";
		echo "<td>$row->role</td>";
		echo "<td>$row->cmpdesc</td>";
		echo "<td>$row->posted_date</td>";
		echo "<td>$row->deadline</td>";
		echo "<td>$row->contact</td>";
		$end_date=$row->deadline;
		$today="20".date('y/m/d');
		
		
		if(strtotime($end_date)<strtotime($today)){
			echo "<td>Closed</td></tr>";
		}else{
			echo "<td>$row->closejob</td>";
		}
		echo "<td><a href=\"viewjobdetail.php?company_id=".$_GET['company_id']."&job_id=$row->job_id\">View details</a></td>";
		echo "<td><a href=\"jobapplications.php?company_id=".$_GET['company_id']."&job_id=$row->job_id\">Received applications</a></td>";
		if($accountclosed=="blocked"){
			echo "<td>Account closed</td>";
		}else if($row->closejob=="removed"){
			echo "<td>Job is removed</td>";
		}
		else if($row->closejob=="blocked"){
			echo "<td><a href=\"unblockjob.php?job_id=$row->job_id\">Unblock this job</a></td>";
		}else{
			echo "<td><a href=\"blockjob.php?job_id=$row->job_id\">Block this job</a></td>";
		}
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
