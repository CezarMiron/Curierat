<?php
  include_once('header.php'); 
  if(isset($_SESSION['user']) ){
  mysql_connect("localhost", "root", "") or die (mysql_error());
  mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

  if($_SERVER["REQUEST_METHOD"] == "POST") {

  		$idClientE = mysql_real_escape_string($_POST['idClient']);
	}

	else
	{
		$currentUser = $_SESSION['user'];
		$query = mysql_query("
			SELECT  IdClient FROM client 
			WHERE Email LIKE '$currentUser'
			");
		if (!$query) { // add this check.
    		die('Invalid query: ' . mysql_error());
	}
		while ($row = mysql_fetch_array($query))
    		$idClientE = $row['IdClient'];

	}

   $query = mysql_query("
   			SELECT
			C.Nume,
			C.Prenume,
			C.Telefon,
			A.Judet,
			A.Localitate,
			A.Strada,
			A.Numar,
			D.Continut,
			D.Suma,
			E.Data,
			E.Status
			FROM expediere AS E
			INNER JOIN Client AS C
			ON E.IdClientD=C.IdClient
			INNER JOIN Adresa AS A 
			ON E.IdAdresaD=A.IdAdresa
			INNER JOIN detalii AS D 
			ON D.IdDetalii=E.IdDetalii
			WHERE E.IdClientE='$idClientE'
   	");

   $date = array();

   while ($row = mysql_fetch_array($query))
   {
   		$Nume = $row['Nume'];
   		$Prenume = $row['Prenume'] ;
   		$Telefon = $row['Telefon'] ;
   		$Judet = $row['Judet'] ;
   		$Localitate = $row['Localitate'] ;
   		$Strada = $row['Strada'] ;
   		$Numar = $row['Numar'] ;
   		$Continut = $row['Continut'] ;
   		$Suma = $row['Suma'];
   		$Data = $row['Data'] ;
   		$Status = $row['Status'];

   		$aux = array(
					            "Nume" => $Nume,
								"Prenume" => $Prenume,
								"Telefon" => $Telefon,
								"Judet" => $Judet,
								"Localitate" => $Localitate,
								"Strada" => $Strada,
								"Numar" => $Numar,
								"Continut" => $Continut,
								"Suma" => $Suma,
								"Data" => $Data,
								"Status" => $Status
								
   		 							);

   		array_push($date, $aux);
}
}
else
{
	 Print '<script>alert("Trebuie sa te loghezi mai intai!");</script>'; // Prompts the user
     Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
}

?>

<html>
<table>
    <thead>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Telefon</th>
            <th>Judet</th>
            <th>Localitate</th>
            <th>Strada</th>
            <th>Nr</th>
            <th>Continut</th>
            <th>Suma</th>
            <th>Data</th>
            <th>Status</th>
        </tr>
    </thead>
    <?php global $date; ?>
	<?php for($i = 0; $i < sizeof ($date); $i=$i+1): ?>
    <tbody>
	
		
		
		<td><?php echo  $date[$i]["Nume"]; ?></td>
		<td><?php echo  $date[$i]["Prenume"]; ?></td>
		<td><?php echo  $date[$i]["Telefon"]; ?></td>
		<td><?php echo  $date[$i]["Judet"]; ?></td>
		<td><?php echo  $date[$i]["Localitate"]; ?></td>
		<td><?php echo  $date[$i]["Strada"]; ?></td>
		<td><?php echo  $date[$i]["Numar"]; ?></td>
		<td><?php echo  $date[$i]["Continut"]; ?></td>
		<td><?php echo  $date[$i]["Suma"]; ?></td>
		<td><?php echo  $date[$i]["Data"]; ?></td>
		<td><?php echo  $date[$i]["Status"]; ?></td>
		
		
      
    </tbody>
	<?php endfor ?>
</table>

</html>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, tr {
    border: 1px solid black;
    text-align: left;
    padding: 8px;
}

tbody:nth-child(even) {
    background-color: #dddddd;
}
</style>