
<?php
    //***AFISARE COMENZILE DIN ULTIMA SAPTAMANA EXPEDIATE DIN BUCURESTI***  

	mysql_connect("localhost", "root", "") or die (mysql_error()); 
    mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

	$query = mysql_query(
	"
	SELECT E.IdExpediere
	FROM expediere E
	INNER JOIN adresa A ON A.IdAdresa = E.IdAdresaE
	WHERE E.IdExpediere IN     
     (   
     SELECT K.IdExpediere 
     FROM expediere K 
     WHERE 
     K.Data >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
	 AND 
     K.Data < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
     ) AND A.Localitate LIKE 'Bucuresti'

	");

	while ($row = mysql_fetch_array($query))
    {
        echo $row['IdExpediere'];
        echo '<br/>';
    }

?>


