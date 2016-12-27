<?php
include_once('header.php');
?>

<html>
    <head>
        <title>Curierat</title>
        <link rel="stylesheet" type="text/css" href="CSS/styleRegister.css" /> 

    </head>
    <body>

        <form action="register.php" method="POST">
          <div class="container">

            <label><b>Email</b></label>
            <input type="text" placeholder="Introduceti Email" name="email" required>

            <label><b>Parola</b></label>
            <input type="password" placeholder="Introduceti Parola" name="password" required>

            <button type="submit">Inregistrare</button>
            <div class="container" style="background-color:#f1f1f1">
              <button onclick="location.href='index.php'" type="button" class="cancelbtn">Revocare</button>
            </div>


           </div>
        </form>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") { // verific daca s-a intrat in pagina register.php cu metoda POST

  $email = mysql_real_escape_string($_POST['email']); //citesc parametrii 
  $password = mysql_real_escape_string($_POST['password']);

  $bool = true;

  mysql_connect("localhost", "root", "") or die (mysql_error());
  mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

  $query = mysql_query("SELECT * FROM users");
  while ($row = mysql_fetch_array($query))
  {
    $table_users = $row['Email'];
    if($email == $table_users) //verific daca email-ul este folosit, daca da, trimit mesaj de eroare
    {
      $bool = false;
      Print '<script>alert("Email folosit!");</script>';
      Print '<script>window.location.assign("register.php");</script>';
    }
  }

  if($bool)
  {
    mysql_query("INSERT INTO users (Email,Password) VALUES ('$email','$password')"); //le inserez in BD
    $query = mysql_query("SELECT * FROM users");
    while ($row = mysql_fetch_array($query))
    {
        $table_users = $row['Email'];
        $table_usersID = $row['IdUser'];
        if($email == $table_users) {

            $_SESSION['email'] = $email;
            $_SESSION['id'] = $table_usersID;
        }
    }
    
    Print '<script>alert("Utilizator inregistrat cu succes!");</script>';
    Print '<script>window.location.assign("infopersonal.php");</script>';
  }

}
?>