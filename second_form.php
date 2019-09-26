<?php 
	$id_url = $_GET ['id'];
	$id_codeurl = $_GET ['code'];
	
	echo $id_url. " ".$id_codeurl;
	
	$userr = mysqli_query($connection, "
			SELECT * FROM korisnici WHERE id = '$id_url' AND code = '$id_codeurl'
	");
	
	$dada = mysqli_query($connection, "SELECT * from korisnici");
	//echo "<br>$dada";
	$brojac = mysqli_num_rows($userr);
	echo "<br>$brojac";
	if($brojac == 1){
		
		$active_user = mysqli_query($connection, "
			SELECT * FROM korisnici WHERE id = '$id_url' AND code = '$id_codeurl' AND aktivan = '1'
	");
	$counter_active = mysqli_num_rows($active_user);
		if ($counter_active == 0) {
		mysqli_query($connection, "UPDATE korisnici SET aktivan = '1' WHERE id = '$id_url' AND code = '$id_codeurl' ");
		echo "Uspješno aktivirano!";
	}
	
	else{
		echo "User is allready active!";
	}}
	else{
		echo "Korisnik ne postoji u bazi!!";
	}
?>