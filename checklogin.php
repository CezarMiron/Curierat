<?php
    session_start();
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $bool = true;

    mysql_connect("localhost", "root", "") or die (mysql_error()); //Connect to server
    mysql_select_db("Curierat") or die ("Eroare DB"); //Connect to database

    $query = mysql_query("Select * from users WHERE Email='$email'"); // Query the users table
    $exists = mysql_num_rows($query); //Checks if email exists
    $table_users = "";
    $table_password = "";

    if($exists > 0) //IF there are no returning rows or no existing email
    {
       while($row = mysql_fetch_assoc($query)) // display all rows from query
       {
          $table_users = $row['Email']; // the first email row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['Password']; // the first password row is passed on to $table_password, and so on until the query is finished
          $table_isAdmin = $row['IsAdmin'];
       }
       if(($email == $table_users) && ($password == $table_password))// checks if there are any matching fields
       {
          if($password == $table_password && $table_isAdmin == 1)
          {
             $_SESSION['user'] = $email;

             $query_ID = mysql_query("
                    SELECT CA.IdClientAdresa
                    FROM clientadresa CA
                    INNER JOIN client C ON ( CA.IdClient = C.IdClient )
                    WHERE Email = '$email' and CA.AdresaPrincipala = 1
              ");

             $row_ID = mysql_fetch_row($query_ID);
             $idClientAdresa = $row_ID[0];

             $_SESSION['admin'] = "yes";
             $_SESSION['idClientAdresa'] = $idClientAdresa;

             header("location: admin.php"); // redirects the user to the authenticated home page
          }

          if($password == $table_password && $table_isAdmin == 0)
          {

            $_SESSION['user'] = $email;

             $query_ID = mysql_query("
                    SELECT CA.IdClientAdresa
                    FROM clientadresa CA
                    INNER JOIN client C ON ( CA.IdClient = C.IdClient )
                    WHERE Email = '$email' and CA.AdresaPrincipala = 1
              ");

             $row_ID = mysql_fetch_row($query_ID);
             $idClientAdresa = $row_ID[0];

            $_SESSION['idClientAdresa'] = $idClientAdresa;
            header("location: home.php"); // redirects the user to the authenticated home page
          }

       }
       else
       {
        Print '<script>alert("Parola incorecta!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
       }
    }
    else
    {
        Print '<script>alert("Email Incorect");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>