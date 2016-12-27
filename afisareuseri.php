<?php
//if(!isset($_SESSION['admin']) ) {
mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");
$query = mysql_query("
   			SELECT  U.IdUser,
				    C.Nume,
					C.Prenume,
					U.Email,
					C.Telefon,
					C.PersoanaContact,
					A.Judet,
					A.Localitate,
					A.Strada,
					A.Numar
			FROM users U
			INNER JOIN client C ON C.IdUser = U.IdUser
			INNER JOIN clientadresa CA ON CA.IdClient = C.IdClient
			INNER JOIN adresa A ON CA.IdAdresa = A.IdAdresa
   	");

   $date = array();

   while ($row = mysql_fetch_array($query))
   {
   		$IdUser = $row['IdUser'];
   		$Nume = $row['Nume'] ;
   		$Prenume = $row['Prenume'] ;
   		$Email = $row['Email'] ;
   		$Telefon = $row['Telefon'] ;
   		$PersoanaContact = $row['PersoanaContact'] ;
   		$Judet = $row['Judet'] ;
   		$Localitate = $row['Localitate'] ;
   		$Strada = $row['Strada'];
   		$Numar = $row['Numar'] ;

   		$aux = array(
					            "IdUser" => $IdUser,
								"Nume" => $Nume,
								"Prenume" => $Prenume,
								"Email" => $Email,
								"Telefon" => $Telefon,
								"PersoanaContact" => $PersoanaContact,
								"Judet" => $Judet,
								"Localitate" => $Localitate,
								"Strada" => $Strada,
								"Numar" => $Numar
								
   		 							);

   		array_push($date, $aux);

	}
/*
}

else
{
	 Print '<script>alert("Trebuie sa te loghezi mai intai!");</script>'; // Prompts the user
     Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
}
*/
?>

<html>
<table>
    <thead>
        <tr>
            <th>IdUser</th>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>PersoanaContact</th>
            <th>Judet</th>
            <th>Localitate</th>
            <th>Strada</th>
            <th>Numar</th>
        </tr>
    </thead>
    <?php global $date; ?>
	<?php for($i = 0; $i < sizeof ($date); $i=$i+1): ?>
    <tbody>
	
		
		
		<td><?php echo  $date[$i]["IdUser"]; ?></td>
		<td><?php echo  $date[$i]["Nume"]; ?></td>
		<td><?php echo  $date[$i]["Prenume"]; ?></td>
		<td><?php echo  $date[$i]["Email"]; ?></td>
		<td><?php echo  $date[$i]["Telefon"]; ?></td>
		<td><?php echo  $date[$i]["PersoanaContact"]; ?></td>
		<td><?php echo  $date[$i]["Judet"]; ?></td>
		<td><?php echo  $date[$i]["Localitate"]; ?></td>
		<td><?php echo  $date[$i]["Strada"]; ?></td>
		<td><?php echo  $date[$i]["Numar"]; ?></td>
		
		
      
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