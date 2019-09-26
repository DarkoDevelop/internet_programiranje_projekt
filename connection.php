<?php

	$server = "localhost";
	$username_server = "root";
	$password_server = "";
	$baza = "baza_podataka";
	
	$connection = mysqli_connect($server, $username_server, $password_server,$baza);
	if($connection)
	{
		//echo "Uspješno! <br>";
		 $selekcija = mysqli_select_db($connection, $baza);
		 
		 if($selekcija){
		//	 echo "selekcija baze podataka je uspjela<br>"; 
		 }
		 else{
		//	 echo "selekcija baze podataka nije uspjela<br>";
		 }
		 
	}
	else 
	{
	//	echo "Nije uspjelo";
	}

?>