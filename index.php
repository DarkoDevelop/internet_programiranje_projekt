<html lang="hr">
<head>
<style>
#ajax {
	position: relative;
	right:    0;
	bottom:   0;
}
#ajaxbutton {
	position: absolute;
	right:    0;
	bottom:   0;
}
</style>
<title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script>
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"
src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
function showInfo() {
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("ajax").innerHTML =
                      this.responseText;
                    }
                  };
                  xhttp.open("GET", "ajaxinfo.txt", true);
                  xhttp.send();
                }
</script>
</head>
<body>
<?php 
	$file_for_connection = "config/connection.php";
	if(file_exists($file_for_connection)){
		include_once($file_for_connection);
	}else{
		echo "File for connection unable to start";
	}
?>
<?php
session_start();
if(isset($_GET['option'])){
	$option = mysqli_real_escape_string($connection, $_GET['option']);
	$file = $option. "/index.php";
	if(file_exists($file)){
		include_once($file);
	}
	else if($option == "log_out"){
		session_start();
		session_destroy();
		header('Location: index.php');
		exit;
	}
	else{
		echo "ERROR!!";
	}
}/*else{
	echo "Početna stranica";
}*/

//TODO: dodavanje objava u slucaju logina
	//tablica (int pk id, string user, string naslov, string tekst, datetime vrijeme_objave, )
	if(isset($_SESSION["name"])){
		echo "<h3>Pozdrav, " . $_SESSION['name'] . "</h3>";
		echo ' | <a href = "index.php">Početna stranica</a> |
		<a href = "index.php?option=log_out">Log out</a> 
		<hr>';
		//ako si ulogiran
		?>
		<form id="submit_post" action="index.php" method="post">
			<input type="text" name="naslov" required />
			<input type="text" name="tekst" required />
			<input type="submit" name="kreni" />
		</form>
		<?php
			if(isset($_POST['naslov']) && isset($_POST['tekst'])){
				$naslov_from	= $_POST['naslov'];
				$tekst_from		=	 $_POST['tekst'];	
				$name = $_SESSION["name"];
			}
			if(isset($_POST["kreni"])){
			mysqli_query($connection,"INSERT INTO objave (user, naslov, tekst) VALUES('$name', '$naslov_from','$tekst_from')");
		}
	}
	else{
		echo '<a href = "index.php">Početna stranica</a> |
		<a href = "index.php?option=log_in">Log in</a> |
		<a href = "index.php?option=registry">Register</a> 
		<hr>';
	}
	$homepage = "/index.php";
	$currentpage = $_SERVER['REQUEST_URI'];
	$lol = (!isset($option));
	
	 if($lol){
		 ?>
		 <div class="container id="objave">
		 
		 <?php
		$sve_objave = mysqli_query($connection, "SELECT * FROM objave");
		$sqli = 'SELECT user, naslov, tekst, vrijeme_objave FROM objave ORDER BY id DESC';
		mysqli_select_db($connection, 'objave');
		$retval = mysqli_query( $connection, $sqli );
	   
		if(! $retval ) {
			die('Could not get data: ' . mysqli_error());
		}
		while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
			$datee = date("D, d M y H:i:s O",strtotime($row['vrijeme_objave']));
			echo "<br>USER:{$row['user']}  <br> ".
				"TITLE : {$row['naslov']} <br> ".
				"TEXT : {$row['tekst']} <br> ".
				"TEXT : {$datee} <br> ".
				"<hr>";
			}
			?>
		<div class="col-xs-4 col-sm-4 col-md-4 kontakt" id="ajax">
        <button class="button" type="button" id="ajaxbutton" onClick="showInfo()">Dodatne informacije o developeru!</button>
        </div>
		</div>
		
<?php		
		} 	
?>


</body>
</html>