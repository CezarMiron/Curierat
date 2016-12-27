<?php

 mysql_connect("localhost", "root", "") or die (mysql_error()); //conectare la BD
 mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

$query = mysql_query("
   			SELECT
   			E.IdExpediere,
			CC.Nume AS NumeE,
			CC.Prenume AS PrenumeE,
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
			INNER JOIN Client AS CC
			ON E.IdClientE=CC.IdClient
   	");

   $date = array();

   while ($row = mysql_fetch_array($query)) 
   {
   		$IdExpediere = $row['IdExpediere'];  //in fiecare variabila pun pe rand valorile din BD
   		$NumeExp = $row['NumeE'];
		$PrenumeExp = $row['PrenumeE'];
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

   		//ulterior ele sunt puse in vectorul $date pentru a le afisa

   		$aux = array(
					            "IdExpediere" => $IdExpediere,
					            "NumeExpeditor" => $NumeExp,
					            "PrenumeExpeditor" => $PrenumeExp,
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

?>

<html>
<table>
    <thead>
        <tr>
            <th>Id Expediere</th>
            <th>Nume Exp</th>
            <th>Prenume Exp</th>
            <th>Nume Dst</th>
            <th>Prenume Dst</th>
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
	
	<!-- afisare vectorul creat -->	
		
		<td><?php echo  $date[$i]["IdExpediere"]; ?></td>
		<td><?php echo  $date[$i]["NumeExpeditor"]; ?></td>
		<td><?php echo  $date[$i]["PrenumeExpeditor"]; ?></td>
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