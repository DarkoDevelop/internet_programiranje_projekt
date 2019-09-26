<?php
	if(isset($_POST['subbb'])){

		//echo "gumb je pritisnut";
		$username_from	= $_POST['username'];
		$password_from	= $_POST['password'];
		$password2_from	= $_POST['password2'];
		$email_from		= $_POST['email'];
		$ime_from		= $_POST['ime'];
		$prezime_from	= $_POST['prezime'];
		$dan_from		= $_POST['dan'];
		$month_from		= $_POST['month'];
		$year_from		= $_POST['year'];
		
		$date_from = $year_from."-".$month_from."-".$dan_from;
		$datee = date($date_from);
		
	//	echo "<br>$username_from <br>$password2_from";
		$folder = "profile/pictures/";
		$folder = $folder . basename($_FILES['file']['name']);
		$temp_name = $_FILES['file']['tmp_name'];
		$original_name = $_FILES['file']['name'];
		$part_name = pathinfo($original_name);
		$extension = $part_name['extension'];
	//	echo "$folder <br> $temp_name<br>$original_name<br>$extension"; 
		$first = rand(1,100000);
		$second= rand(1,100000);
		$third = rand(1,100000);
		$random_name = $first ."-" .$second. "-" .$third;
		
		$final_name = $random_name .".". $extension;
				
		$picture_mByta = $_FILES['file']['size'];
		$picture_type = $_FILES['file']['type'];
		$wheretosave = "profile/pictures/".$final_name;
		
		
		$sql=mysqli_query($connection, "SELECT * FROM korisnici WHERE username='$username_from'");
		if($password_from==$password2_from && mysqli_num_rows($sql)<=1){
					if(move_uploaded_file($temp_name, $wheretosave)){
						header('Location: http://127.0.0.1/index.php?option=log_in');
						$first = rand(1,100000);
						$second= rand(1,100000);
						$third = rand(1,100000);
						$code = $first ."-" .$second. "-" .$third;
						mysqli_query($connection,"INSERT INTO korisnici (username,password,email,ime,prezime,datum,slika,code) 
												VALUES ('$username_from','$password_from','$email_from','$ime_from','$prezime_from','$datee','$wheretosave','$code')");
						
						
					}else{
						echo "neuspješno kopirana slika";
					}
			}else{
			echo "<br>Error, diffrent passwords entered, or user allready exists! Please try <a href='index.php?option=registry'>again!</a>";
		}
	}else{
?>
<form action="index.php?option=registry" enctype="multipart/form-data" method="POST" >
	<table>
		<tr>
			<th colspan = "2">REGISTER</th>
		</tr>
		<tr>
			
			<td>Username</td><td><input type="text" name="username" required/></td>
			
		</tr>
		<tr>
			<td>Password</td><td><input type="password" name="password" placeholder = " Enter password here!" required/></td>
		</tr>
		<tr>
			<td>Repeat password</td><td><input type="password" name="password2" required/></td>
		</tr>
		<tr>
			<td>E-mail</td><td><input type="text" name="email" required/></td>
		</tr>
		<tr>
			<td>Name</td><td><input type="text" name="ime" required/></td>
		</tr>
		<tr>
			<td>Surname</td><td><input type="text" name="prezime" required/></td>
		</tr>
		<tr>
			<td>Date of birth</td>
				<td>
				<select name="dan">
					<?php
					for($dan=1;$dan<=31;$dan++){
					?>
					<option value="<?php echo $dan;?>"><?php echo $dan; ?> </option>
					<?php
					}
					?>
	<!--		<td><input type="date" name="datum" /></td>   -->
			</select>
			
			
			<select name="month">
					<?php
					for($month=1;$month<=12;$month++){
					?>
					<option value="<?php echo $month;?>"><?php echo $month; ?> </option>
					<?php
					}
					?>
			</select>
			
			
			<select name="year">
					<?php
					for($year=1920;$year<=2000;$year++){
					?>
					<option value="<?php echo $year;?>"><?php echo $year; ?> </option>
					<?php
					}
					?>
			</select>
			
			</td>
		</tr>
		<tr>
			<td>Picture</td><td><input type="file" accept ="image/*" name="file" required></td>
		</tr>
		<tr>
			<td colspan = "2"><input type="submit" name="subbb" value="Registriraj se"/></td>
		</tr>
	</table>
</form>
<?php
	}
?>
