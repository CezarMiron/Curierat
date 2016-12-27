<?php

// ***AFISARE NUMARUL MAXIM DE COMENZI IN FUNCTIE DE DATA*** 


mysql_connect("localhost", "root", "") or die (mysql_error());
mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

$query = mysql_query(
	"
	SELECT * 
			FROM (
	        SELECT DATE(E.Data) as DataExp, COUNT(*) as Nr
			FROM expediere E
			WHERE E.Data IS NOT NULL
			GROUP BY DATE(E.Data)
		      ) as a
	WHERE Nr = (SELECT MAX(Nr) 
		    FROM (
			   SELECT (X.Data) as DataExp, COUNT(*) as Nr	
			   FROM expediere X
			   WHERE X.Data IS NOT NULL	
			   GROUP BY DATE (X.Data)
			  ) as b
		    )
	");

	$date = array();

   while ($row = mysql_fetch_array($query))
   {
   		$DataExp = $row['DataExp'];
   		$Nr = $row['Nr'];

   		$aux = array(
					            "DataExp" => $DataExp,
					            "Nr" => $Nr

					            );
   		array_push($date, $aux);
   	}

 ?>

<html>
<table>
    <thead>
        <tr>
            <th>Data Expediere</th>
            <th>Nr</th>
            </tr>
    </thead>
    <?php global $date; ?>
	<?php for($i = 0; $i < sizeof ($date); $i=$i+1): ?>
    <tbody>
		<td><?php echo  $date[$i]["DataExp"]; ?></td>
		<td><?php echo  $date[$i]["Nr"]; ?></td>
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