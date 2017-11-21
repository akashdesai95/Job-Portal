

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

<form>
Search :<br>
<select name='category' id="cat">
<option value="category">Category</option>
<option value="cmpname">company</option>
<option value="role">Designation</option>
</select>
<input type="text" name="key" id="k" placeholder="Keyword">
<input type="submit" value="Search" onclick="myfunction()">
</form>
</body>
</html>

<?php
if(isset($_GET['msg'])){
	echo $_GET['msg'];

}
$connection=new PDO('mysql:host=localhost;dbname=php','root','');
if(isset($_GET['key'])){
	if(!empty($_GET['key']) ){
			$key="%".$_GET['key']."%";
			$statement="SELECT * FROM `postjob` WHERE `". $_GET['category']."` LIKE '". $key."'";
			$query=$connection->query($statement);

		}


	else{

		$statement="SELECT * FROM postjob";
		$query=$connection->query($statement);
	}
}else{

	$statement="SELECT * FROM postjob";
	$query=$connection->query($statement);
}



echo "<table border='1' width='100%'>";
echo "<tr><td><b>Company</b></td>";
echo "<td><b>Category</b></td>";
echo "<td><b>Designation</b></td>";
echo "<td><b>Email</b></td>";
echo "<td><b>Location</b></td>";
echo "<td><b>Stipend</b></td>";
echo "<td>Vacancy<b></b></td>";
echo "<td><b>Job Description</b></td>";
echo "<td><b>Company description</b></td>";
echo "<td><b>Mobile number</b></td>";
echo "<td><b>Posted Job</b></td>";
echo "<td><b>Deadline</b></td></tr>";


while($row=$query->fetch(PDO::FETCH_OBJ)){
	echo "<tr><td>$row->cmpname</td>";
	echo "<td>$row->category</td>";
	echo "<td>$row->role</td>";
	echo "<td>$row->email</td>";
	echo "<td>$row->location</td>";
	echo "<td>$row->stipend</td>";
	echo "<td>$row->vacancy</td>";
	echo "<td>$row->jobdesc</td>";
	echo "<td>$row->cmpdesc</td>";
	echo "<td>$row->contact</td>";
	echo "<td>$row->posted_date</td>";
	echo "<td>$row->deadline</td></tr>";


}
?>