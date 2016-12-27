<?php
include_once('header.php');
?>

<?php 	

 	if(isset($_SESSION['user']) ) {

 			$a = $_SESSION['user'];
 			echo "Salut, $a ";
 		}
 		else
 			Print '<script>window.location.assign("login.php");</script>';
 	
 	$email = $_SESSION['user'];
 	$idClientAdresa = $_SESSION['idClientAdresa']; //bine doar dupa register


    mysql_connect("localhost", "root", "") or die (mysql_error()); 
    mysql_select_db("Curierat") or die ("Eroare DB"); 

    $query = mysql_query("Select * from client WHERE Email='$email'"); 

    while($row = mysql_fetch_assoc($query)) // afisez toate campurile
       {
          $nume = $row['Nume']; 
          $prenume = $row['Prenume']; 
          $telefon = $row['Telefon'];
          $email = $row['Email'];
          $contact = $row['PersoanaContact'];
          $idclient = $row['IdClient'];
       }


    $query = mysql_query("Select * from clientadresa WHERE IdClient='$idclient' AND AdresaPrincipala = 1");
    while($row = mysql_fetch_assoc($query))
       	  $idadresa = $row['IdAdresa'];

    $query = mysql_query("Select * from adresa WHERE IdAdresa='$idadresa'");

    while($row = mysql_fetch_assoc($query)) 
       {
          $judet = $row['Judet']; 
          $localitate = $row['Localitate']; 
          $strada = $row['Strada'];
          $numar = $row['Numar'];
       }

 ?>
<html>
	<head>
		<title>Cuerierar</title>
	</head>
	<br/><br/><b>Datele tale sunt : </b><br/><br/>

	Nume : <?php echo "$nume"; ?> <br/>
	Prenume : <?php echo "$prenume"; ?> <br/>
	Telefon : <?php echo "$telefon"; ?> <br/>
	Email : <?php echo "$email"; ?> <br/>
	Contact : <?php echo "$contact"; ?> <br/><br/><br/>

	Judet : <?php echo "$judet"; ?> <br/>
	Localitate : <?php echo "$localitate"; ?> <br/>
	Strada : <?php echo "$strada"; ?> <br/>
	Numar : <?php echo "$numar"; ?> <br/><br/>

    <form method="GET" action="infopersonal.php">
    	<input type="hidden" name="idClientAdresa" value="<?php echo $idClientAdresa; ?>">
    	Modifici datele? 
    	<input type="submit" value="Da">
	</form>

	<form method="POST" action="comenzilemele.php">
    	<input type="hidden" name="idClient" value="<?php echo $idclient; ?>">
    	Comenzile mele?	
    	<input type="submit" value="Da">
	</form>


	</html>
