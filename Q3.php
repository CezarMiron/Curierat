<?php

// ***AFISARE NUMELE, PRENUMELE CLIENTULUI CARE ARE DE RIDICAT O SUMA MAI MARE DECAT MEDIA SUMELOR DE BANI TRIMISE*** 

mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

$query = mysql_query(
	"
	
	SELECT Nume, Prenume, E.Data, D.Suma
	FROM expediere E
	INNER JOIN client C ON E.IdClientE = C.IdClient
	INNER JOIN detalii D ON E.IdDetalii = D.IdDetalii
	WHERE D.Suma > (
					SELECT AVG(X.Suma)
					FROM detalii X
    			INNER JOIN expediere M ON M.IdDetalii = X.IdDetalii
    				)
	");

	$date = array();

   while ($row = mysql_fetch_array($query))
   {
   		$Nume = $row['Nume'];
   		$Prenume = $row['Prenume'];
   		$Data = $row['Data'];
   		$Suma = $row['Suma'];


   		$aux = array(
					            "Nume" => $Nume,
					            "Prenume" => $Prenume,
					            "Data" => $Data,
					            "Suma" => $Suma

					            );
   		array_push($date, $aux);
   	}

 ?>

<html>
<table>
    <thead>
        <tr>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Data Expediere</th>
            <th>Suma</th>
            </tr>
    </thead>
  <?php global $date; ?>
	<?php for($i = 0; $i < sizeof ($date); $i=$i+1): ?>
    <tbody>
	
		<td><?php echo  $date[$i]["Nume"]; ?></td>
		<td><?php echo  $date[$i]["Prenume"]; ?></td>
		<td><?php echo  $date[$i]["Data"]; ?></td>
		<td><?php echo  $date[$i]["Suma"]; ?></td>

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
