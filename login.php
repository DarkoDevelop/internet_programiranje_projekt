<?php
if(isset($_POST['logg'])){
	$username_log	= $_POST['username_login'];
	$password_log	= $_POST['password_login'];
	$userr = mysqli_query($connection, "
			SELECT * FROM korisnici WHERE username = '$username_log' AND password = '$password_log'
	");
	if(mysqli_num_rows($userr)>=1){
		session_start();
		$_SESSION['name'] = $username_log;
		header('Location: http://127.0.0.1/index.php');
	}else{
		echo "Incorrect username or password or user doesn't exists! Please try <a href='index.php?option=log_in'>again!</a><br>";
	}
}
else{
?>
<form action="index.php?option=log_in" enctype="multipart/form-data" method="POST" >
	<table>
		<tr>
			<th colspan = "2">LOG IN</th>
		</tr>
		<tr>
			<td>Username</td><td><input type="text" name="username_login" placeholder = " Enter username here!" required/></td>
		</tr>
		<tr>
			<td>Password</td><td><input type="password" name="password_login" placeholder = " Enter password here!" required/></td>
		</tr>
		<tr>
			<td colspan = "2"><input type="submit" name="logg" value="Log in!"  /></td>
		</tr>
	</table>
</form>
<?php
	}
?>