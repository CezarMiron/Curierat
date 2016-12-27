<?php

if($_SERVER["REQUEST_METHOD"] == "GET") {

    mysql_connect("localhost", "root", "") or die (mysql_error());
    mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

    $email = mysql_real_escape_string($_GET['email']);

    $query = mysql_query("
        SELECT IdUser
        FROM users 
        WHERE Email LIKE '$email'
        ");
    if(mysql_num_rows($query)==0){
            Print '<script>alert("Nu exista acest utilizator in BD!");</script>';
            Print '<script>window.location.assign("admin.php");</script>';
    }

    $query = mysql_query("
        SELECT U.IdUser, C.IdClient
        FROM users U
        INNER JOIN client C ON C.IdUser = U.IdUser
        WHERE U.Email LIKE '$email'
        ");

    while ($row = mysql_fetch_array($query))
    {
        $IdUser = $row['IdUser'];
        $IdClient = $row['IdClient'];
    }

    $query = mysql_query("
        SELECT IdClientAdresa
        FROM clientadresa
        WHERE IdClient = '$IdClient'
        ");

    while ($row = mysql_fetch_array($query))
    {
        $IdClientAdresa = $row['IdClientAdresa'];
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") {

    mysql_connect("localhost", "root", "") or die (mysql_error());
    mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");
    $email = mysql_real_escape_string($_POST['Email']);



    mysql_query("
        DELETE FROM users
        WHERE Email = '$email';
        ");
    Print '<script>alert("Sters!");</script>';
    Print '<script>window.location.assign("admin.php");</script>';
    
}
?>
<html>
<center>
<br/><br/>
    <form method="GET" action="infopersonal.php">
        <input type="hidden" name="idClientAdresa" value="<?php echo $IdClientAdresa; ?>">
        Modifici datele pentru <b> <?php echo $email; ?> </b>
        <input type="submit" value="Da">
    </form>

    <form method="POST" action="admin_user.php">
        <input type="hidden" name="Email" value="<?php echo $email; ?>">
        Stergi userul <b> <?php echo $email; ?> </b>
        <input type="submit" value="Da">
    </form>
</center>
</html> 