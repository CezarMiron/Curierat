
<?php
include_once('header.php');

//folosesc aceasta pagina pentru a introduce datele personale, pentru a le edita dar si pentru a edita adminul orice user

?>

<html>
    <head>
        <title>Curierat</title>
        <link rel="stylesheet" type="text/css" href="styleRegister.css" /> 

    </head>
    <body>
        <?php if(!isset($_SESSION['user']) ) { ?>
        <label><center> Inca putin si contul tau este activ, completeaza campurile de mai jos ! </center></label><br>
        <?php } else { ?>
        <label><center> Te afli pe pagina in care modifici datele personale ! </center></label><br>
        <?php }  ?>

        <?php
        $idClientAdresa_Param = 0;

        if($_SERVER["REQUEST_METHOD"] == "GET") {
            if(isset($_SESSION['user']) )
              $GLOBALS["idClientAdresa_Param"] = mysql_real_escape_string($_GET['idClientAdresa']);
           /* echo  $idClientAdresa_Param; */

          }
        ?>

        <form action="infopersonal.php" method="POST">
          <div class="container">

            <label><b>Nume</b></label>
            <input type="text" placeholder = "Introduceti Numele" name="nume" required>

            <label><b>Prenume</b></label>
            <input type="text" placeholder="Introduceti Prenumele" name="prenume" required>

            <label><b>Telefon</b></label>
            <input type="text" placeholder="Introduceti numarul de Telefon" name="telefon" required>

            <label><b>Persoana Contact</b></label>
            <input type="text" placeholder="Introduceti Persoana de Contact" name="contact">

            <label><b>Judet</b></label>
            <input type="text" placeholder="Introduceti Judetul dvs" name="judet" required>

            <label><b>Localitate</b></label>
            <input type="text" placeholder="Introduceti Localitate dvs" name="localitate" required>

            <label><b>Strada</b></label>
            <input type="text" placeholder="Introduceti Strada dvs" name="strada" required>

            <label><b>Nr</b></label>
            <input type="text" placeholder="Introduceti Numarul dvs" name="numar" required>
            
              <?php if($_SERVER["REQUEST_METHOD"] == "GET") ?>
              <input type="hidden" name="idClientAdresa_Param" value="<?php echo $GLOBALS["idClientAdresa_Param"]; ?>">

            <button type="submit">Salvez si trec mai departe</button>

            <?php if(!isset($_SESSION['user']) ) { ?>
            <div class="container" style="background-color:#f1f1f1">
              <button onclick="location.href='infopersonal.php'" type="button" class="cancelbtn">Revocare</button>
            </div>
            <?php } ?>

            <?php if(isset($_SESSION['user']) ) { ?>
            <div class="container" style="background-color:#f1f1f1">
              <button onclick="location.href='myinfo.php'" type="button" class="cancelbtn">Revocare</button>
            </div>
            <?php } ?>


           </div>
        </form>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {

  $nume = mysql_real_escape_string($_POST['nume']);
  $prenume = mysql_real_escape_string($_POST['prenume']);
  $telefon = mysql_real_escape_string($_POST['telefon']);
  $contact = mysql_real_escape_string($_POST['contact']);

  if(!isset($_SESSION['user']) ) {
    $iduser = $_SESSION['id'];
    $email = $_SESSION['email'];
  }



  $judet = mysql_real_escape_string($_POST['judet']);
  $localitate = mysql_real_escape_string($_POST['localitate']);
  $strada = mysql_real_escape_string($_POST['strada']);
  $numar = mysql_real_escape_string($_POST['numar']);

  mysql_connect("localhost", "root", "") or die (mysql_error());
  mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

  if(!isset($_SESSION['user']) ) { 

    mysql_query("INSERT INTO client (Nume,Prenume,Telefon,PersoanaContact,IdUser,Email) VALUES ('$nume','$prenume','$telefon','$contact','$iduser','$email')");
    $idClient = mysql_insert_id();
    mysql_query("INSERT INTO adresa (Judet,Localitate,Strada,Numar) VALUES ('$judet','$localitate','$strada','$numar')");
    $idAdresa = mysql_insert_id();


    mysql_query("INSERT INTO clientadresa (IdClient,IdAdresa) VALUES ('$idClient','$idAdresa')");
    $idClientAdresa = mysql_insert_id();
    $_SESSION['idClientAdresa'] = $idClientAdresa;

    Print '<script>alert("Date introduse cu succes! Contul tau a fost creat cu succes!");</script>';
    Print '<script>window.location.assign("index.php");</script>';
  }

  else {
    /*update user */
    $idClientAdresa_Param = mysql_real_escape_string($_POST['idClientAdresa_Param']);
    $IDCLIENT = 0;
    $IDADRESA = 0;

    $query = mysql_query("SELECT * FROM clientadresa WHERE IdClientAdresa = '$idClientAdresa_Param'");
    while ($row = mysql_fetch_array($query))
    {
      global $IDCLIENT, $IDADRESA;
      $IDCLIENT = $row['IdClient'];
      $IDADRESA = $row['IdAdresa'];
    }

    mysql_query("UPDATE client SET Nume = '$nume', Prenume = '$prenume' , Telefon = '$telefon' ,PersoanaContact = '$contact' WHERE IdClient = '$IDCLIENT' ");
    mysql_query("UPDATE adresa SET Judet = '$judet' ,Localitate = '$localitate' ,Strada = '$strada' ,Numar = '$numar' WHERE IdAdresa = '$IDADRESA' ");

    Print '<script>alert("Date actualizate cu succes!");</script>';
    Print '<script>window.location.assign("index.php");</script>';
   
  }
}
?>
