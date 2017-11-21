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
        <h1>Applicant Details</h1>
    </div>
    
    <br/><br/><br/><br/>
    

<div class="container text-center">
<h3>List of employees</h3>


<div class="container text-center">
<form class="form-horizontal" role="form">

<div class="form-group">
<label class="control-label col-sm-2" for="category">Search : </label>
<div class="col-sm-10">


<select class="form-control" name='category' id="cat">
<option value="id">ID</option>
<option value="username">Username</option>
<option value="email">Email</option>
<option value="fname">First name</option>
<option value="city">City</option>
<option value="number">Mobile number</option>
<option value="education">Education</option>
<option value="univ">University</option>
<option value="minexperience">Min Experience</option>
<option value="maxexperience">Max Experience</option>
</select>
</div>
</div>
        

<div class="form-group">
<input type="text" class="form-control" name="key" id="k" placeholder="Keyword">
</div>
<div class="form-group">
<input type="submit" value="Search" class="btn btn-default">
</div>
</form>
</div>



<?php
if(isset($_GET['msg'])){
	echo $_GET['msg']."<br>";
	
}

$connection=new PDO('mysql:host=localhost;dbname=project','root','');
if(isset($_GET['key'])){
		if($_GET['category']=="minexperience"){
				if(!ctype_digit($_GET['key'])){
					header("Location:employee.php?msg=Please enter valid number");
					die();
				}
				$statement="SELECT * FROM employees WHERE year>=?";
				$query=$connection->prepare($statement);
				if(!$query->execute(array($_GET['key']))){
					echo "error";
					die();
				}
		}else if($_GET['category']=="maxexperience"){
				if(!ctype_digit($_GET['key'])){
					header("Location:employee.php?msg=Please enter valid number");
					die();
				}
				$statement="SELECT * FROM employees WHERE year<=?";
				$query=$connection->prepare($statement);
				if(!$query->execute(array($_GET['key']))){
					echo "error";
					die();
				}
		}else{
				$key="%".$_GET['key']."%";
				$statement="SELECT * FROM `employees` WHERE `". $_GET['category']."` LIKE '". $key."'";
				if(!$query=$connection->query($statement)){
						echo "Something went wrong!";
					echo "<a href=\"".$_SERVER['HTTP_REFERER']."\">Go back</a>";
					die();
				}
			
		}
}else{

	$statement="SELECT * FROM employees";
	$query=$connection->query($statement);
} 
$rowCount=$query->rowCount();
echo "<div class=\"container text-center\"><p>No of matched data:$rowCount</p></div></div>";

echo "<div class=\"container-fluid table-bordered table-hover\"><table class=\"table\"><thead><tr>";

echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Username</th>";
echo "<th>Email</th>";
echo "<th>City</th>";
echo "<th>Mobile no</th>";
echo "<th>Education</th>";
echo "<th>University</th>";
echo "<th>Experience</th>";
echo "<th>Account Status</th></thead><tbody>";

while($row=$query->fetch(PDO::FETCH_OBJ)){
	echo "<tr><td>$row->id</td>";
	echo "<td>$row->fname</td>";
	echo "<td>$row->username</td>";
	echo "<td>$row->email</td>";
	echo "<td>$row->city</td>";
	echo "<td>$row->number</td>";
	echo "<td>$row->education</td>";
	echo "<td>$row->univ</td>";
	echo "<td>$row->year</td>";
	echo "<td>$row->closejob</td>";
	echo "<td><a href=\"viewemployeeprofile.php?id=$row->id\">view Profile</a></td>";
	echo "<td><a href=\"applications.php?id=$row->id\">Employees Application</a></td>";
	if($row->closejob=="removed"){
		echo "<td>Removed</td>";
	}else if($row->closejob=="open"){
		echo "<td><a href=\"blockaccount.php?id=$row->id\">Block account</a></td>";
	}else{
		echo "<td><a href=\"unblockaccount.php?id=$row->id\">Unblock account</a></td>";
	}
}
?>

</table>
</div>
</div>


<br/><br/><br/><br/><br/><br/>
    <footer class="container-fluid text-center copyright">
        <p>&copy; Recruiters' 2016</p>
    </footer>

    </body>
    </html>