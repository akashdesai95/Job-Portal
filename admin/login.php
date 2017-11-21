<html>
<head>
<title>Admin login</title>
</head>
<body>
<center><h1>Admin login</h1><hr>
<table>
<form action="loginvalidate.php" method="post">
<?php 
if(isset($_GET['msg'])){
	echo $_GET['msg'];
}
?>
<tr><td>Username:</td><td><input type="text" name="username" placeholder="Username:" required>
</td></tr>

<tr><td>Password:</td><td><input type="password" name="password" placeholder="Password:" required></td></tr>
<tr><td><input type="submit" value="login" ></td><td><input type="reset" value="Clear"></td></tr>
</form>
</table>
</center>
</body>
</html>