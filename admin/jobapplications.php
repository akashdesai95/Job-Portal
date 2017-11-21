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
        <h1>Employer Details</h1>
    </div>
    
    <br/><br/><br/><br/>
    


<div class="container text-center">
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
$jobclosed=$row->closejob;
echo "<hr>";
echo "Company:-$row->cmpname";
echo "<br>Designation:-$row->role";
echo "<br>Job description:-$row->jobdesc";

?>

<div class="container text-center">
<br><br>
<form class="form-horizontal">


<div class="form-group">
<label class="control-label col-sm-2" for="category">Search : </label>
<div class="col-sm-10">

    

<select class="form-control" name='category' id="cat">
<option value="id">Employee ID</option>
<option value="username">Username</option>
<option value="email">Email</option>
<option value="city">City</option>
<option value="number">Mobile number</option>
<option value="education">Education</option>
<option value="univ">University</option>
<option value="minexperience">Min Experience</option>
<option value="maxexperience">Max Experience</option>
</select>
</div>
</div>


<?php 
$company_id=$_GET['company_id'];
$job_id=$_GET['job_id'];
echo "<input type='hidden' name='company_id' value=\"$company_id\">";
echo "<input type='hidden' name='job_id' value=\"$job_id\">";
?>


<div class="form-group">
<input type="text" class="form-control" name="key" id="k" placeholder="Keyword">
<input type="submit" class="btn btn-default" value="Search">
</div>
</form>
</br/></br/><br/>

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
	
				$key="%".$_GET['key']."%";
				$statement="SELECT * FROM jobapplications WHERE company_id=? AND job_id=?";
				$query=$connection->prepare($statement);
				if(!$query->execute(array($_GET['company_id'],$_GET['job_id']))){
					echo "error";
					die();
				}	
				$flag=1;		
				
}else{
		$flag=0;
		$statement="SELECT * FROM jobapplications WHERE company_id=? AND job_id=?";
		$query=$connection->prepare($statement);
		if(!$query->execute(array($_GET['company_id'],$_GET['job_id']))){
			echo "error";
			die();
		}		

} 





echo "<th>ID<th>";
echo "<th>Name<th>";
echo "<th>Username<th>";
echo "<th>Email<th>";
echo "<th>City<th>";
echo "<th>Mobile no<th>";
echo "<th>Education<th>";
echo "<th>University<th>";
echo "<th>Experience<th>";
echo "<th>application status<th></tr></thead><tbody>";


while($jobapplicationrow=$query->fetch(PDO::FETCH_OBJ)){
	if($flag==1){
		if($_GET['category']=="minexperience"){
			if(!ctype_digit($_GET['key'])){
				header("Location:employee.php?msg=Please enter valid number");
				die();
			}
			$statement1="SELECT * FROM employees WHERE id=$jobapplicationrow->employee_id AND year>=?";
			$query1=$connection->prepare($statement1);
			if(!$query1->execute(array($_GET['key']))){
				echo "error";
				die();
			}
		}else if($_GET['category']=="maxexperience"){
			if(!ctype_digit($_GET['key'])){
				header("Location:employee.php?msg=Please enter valid number");
				die();
			}
			$statement1="SELECT * FROM employees WHERE id=$jobapplicationrow->employee_id AND year<=?";
			$query1=$connection->prepare($statement1);
			if(!$query1->execute(array($_GET['key']))){
				echo "error";
				die();
			}
		}else{
			$statement1="SELECT * FROM `employees` WHERE id=$jobapplicationrow->employee_id AND `". $_GET['category']."` LIKE '". $key."'";
		
		if(!$query1=$connection->query($statement1)){
			echo "Something went wrong!";
			echo "<a href=\"".$_SERVER['HTTP_REFERER']."\">Go back</a>";
			die();
		}
		}
	}else{
		$statement1="SELECT * FROM employees WHERE id=$jobapplicationrow->employee_id";		
		if(!$query1=$connection->query($statement1)){
			echo "Something went wrong!";
			echo "<a href=\"".$_SERVER['HTTP_REFERER']."\">Go back</a>";
			die();
		}
	}
	
	if(!$employeerow=$query1->fetch(PDO::FETCH_OBJ)){
		continue;
	}
	
	echo "<tr><td>$employeerow->id</td>";
	echo "<td>$employeerow->fname</td>";
	echo "<td>$employeerow->username</td>";
	echo "<td>$employeerow->email</td>";
	echo "<td>$employeerow->city</td>";
	echo "<td>$employeerow->number</td>";
	echo "<td>$employeerow->education</td>";
	echo "<td>$employeerow->univ</td>";
	echo "<td>$employeerow->year</td>";
	echo "<td>$jobapplicationrow->closejob</td>";
	echo "<td><a href=\"viewemployeeprofile.php?id=$employeerow->id\">view Profile</a>";
	$statement2="SELECT closejob FROM clients WHERE id=?";
	$query2=$connection->prepare($statement2);
	if(!$query2->execute(array($_GET['company_id']))){
		echo "error";
		die();
	}
	$row1=$query2->fetch(PDO::FETCH_OBJ);
	if($row1->closejob=="blocked"){
		echo "<td>Company Account blocked</td>";
	}else if($employeerow->closejob=="blocked"){
		echo "<td>Employee account blocked</td>";
	}else if($jobclosed=="blocked"){
		echo "<td>Job closed</td>";
	}else if($jobapplicationrow->closejob=="removed"){
		echo "<td>Job is removed</td>";
	}else if($jobapplicationrow->closejob=="open"){
		echo "<td><a href=\"blockapplication.php?employee_id=$employeerow->id&job_id=".$jobapplicationrow->job_id."\">Block application</a>";
	}else{
		echo "<td><a href=\"unblockapplication.php?employee_id=$employeerow->id&job_id=".$jobapplicationrow->job_id."\">Unblock application</a>";
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