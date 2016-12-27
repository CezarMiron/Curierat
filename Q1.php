<?php

	// ***AFISARE USERII CARE NU AU EFECTUAT O COMANDA IN ULTIMA SAPTAMANA*** 


	mysql_connect("localhost", "root", "") or die (mysql_error());
    mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

	$query = mysql_query(
	"
	SELECT U.Email
	FROM users U
	INNER JOIN client C ON C.IdUser = U.IdUser
	WHERE C.IdClient NOT IN
	(SELECT E.IdClientE FROM expediere E WHERE
 
	E.Data >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
	AND E.Data < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY)
	");

	while ($row = mysql_fetch_array($query))
    {
        echo $row['Email'];
        echo '<br/>';
    }

?>


