<?php
  include_once('header.php'); 
if(isset($_SESSION['user']) ) {
  $email = $_SESSION['user'];
  $idClientAdresa = $_SESSION['idClientAdresa']; //bine doar dupa register

  /* echo "$idClientAdresa"; */

    mysql_connect("localhost", "root", "") or die (mysql_error()); //Connect to server
    mysql_select_db("Curierat") or die ("Eroare DB"); //Connect to database

    $query = mysql_query("Select * from client WHERE Email='$email'"); // Query the users table

    while($row = mysql_fetch_assoc($query)) // display all rows from query
       {
          $nume = $row['Nume'];
          $prenume = $row['Prenume']; 
          $telefon = $row['Telefon'];
          $email = $row['Email'];
          $contact = $row['PersoanaContact'];
          $idclient = $row['IdClient'];
       }


    $query = mysql_query("Select * from clientadresa WHERE IdClient='$idclient' AND AdresaPrincipala = 1");
    while($row = mysql_fetch_assoc($query))
          $idadresa = $row['IdAdresa'];

    $query = mysql_query("Select * from adresa WHERE IdAdresa='$idadresa'");

    while($row = mysql_fetch_assoc($query)) 
       {
          $judet = $row['Judet'];
          $localitate = $row['Localitate']; 
          $strada = $row['Strada'];
          $numar = $row['Numar'];
       }
  }
  else {
        Print '<script>alert("Nu ai acces!");</script>'; 
        Print '<script>window.location.assign("login.php");</script>'; 
  }
 ?>

<html>
<head>
<style> 
.flex-container {
    display: -webkit-flex;
    display: flex;
    -webkit-justify-content: center;
    justify-content: center;
    width: 100%;
    height: 40%;

    background-color: lightgrey;
}

.flex-container2 {
    display: -webkit-flex;
    display: flex;
    -webkit-justify-content: center;
    justify-content: center;
    width: 100%;
    height: 60%;

    background-color: lightgrey;
}

.flex-item {
    background-color: cornflowerblue;
    width: 500px;
    height: 500px;
    margin: 10px;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 8px 12px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.container {
    padding: 16px;
}

.button {
    position: relative;
    background-color: #4CAF50;
    border: none;
    font-size: 10px;
    color: #FFFFFF;
    padding: 12px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    cursor: pointer;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

</style>
</head>
<body>

<form action="procesare.php" method="POST">

<div class="flex-container">
 
     <div class="container">
            
            <label><b>Detalii Expeditor</b></label><br/><br/>

            <input type="hidden" name = "idclientE" value = "<?php echo $idclient; ?>">

            <label><b>Nume</b></label>
            <input type="text" placeholder="<?php echo $nume; ?>" disabled name="numeE" >

            <label><b>Prenume</b></label>
            <input type="text" placeholder="<?php echo $prenume; ?>" disabled name="prenumeE" >

            <label><b>Telefon</b></label>
            <input type="text" placeholder="<?php echo $telefon; ?>" disabled name="telefonE" >

            <label><b>Persoana Contact</b></label>
            <input type="text" placeholder="<?php echo $contact; ?>" disabled name="contactE">
      </div>
  <br/>
  <div class="container">

            <label><b>Adresa Expeditor</b></label><br/><br/>

            <input type="hidden" name = "idadresaE" value = "<?php echo $idadresa; ?>">

            <label><b>Judet</b></label>
            <input type="text" placeholder="<?php echo $judet; ?>" disabled name="judetE" >

            <label><b>Localitate</b></label>
            <input type="text" placeholder="<?php echo $localitate; ?>" disabled name="localitateE" >

            <label><b>Strada</b></label>
            <input type="text" placeholder="<?php echo $strada; ?>" disabled name="stradaE" >

            <label><b>Nr</b></label>
            <input type="text" placeholder="<?php echo $numar; ?>" disabled name="numarE" >
      </div>  

    <div class="container">

            <label><b>Detalii Destinatar</b></label><br/><br/>

            <label><b>Nume</b></label>
            <input type="text" placeholder="Introduceti Numele D" name="numeD" required>

            <label><b>Prenume</b></label>
            <input type="text" placeholder="Introduceti Prenumele D" name="prenumeD" required>

            <label><b>Telefon</b></label>
            <input type="text" placeholder="Introduceti numarul de Telefon al D" name="telefonD" required>

            <label><b>Persoana Contact</b></label>
            <input type="text" placeholder="Introduceti Persoana de Contact" name="contactD">
      </div>

    <div class="container">

            <label><b>Adresa Destinatar</b></label><br/><br/>

            <label><b>Judet</b></label>
            <input type="text" placeholder="Introduceti Judetul D" name="judetD" required>

            <label><b>Localitate</b></label>
            <input type="text" placeholder="Introduceti Localitate D" name="localitateD" required>

            <label><b>Strada</b></label>
            <input type="text" placeholder="Introduceti Strada D" name="stradaD" required>

            <label><b>Nr</b></label>
            <input type="text" placeholder="Introduceti Numarul D" name="numarD" required>
      </div>   

</div>

<div class="flex-container2">
       <div class="container">
            <br/><br/><br/>
            <label><b>Dimensiuni Colet</b></label><br/><br/>

            <label><b>Greutate (kg)</b></label>
            <input type="text" placeholder="Introduceti Greutatea" name="greutate" >

            <label><b>Lungime (cm)</b></label>
            <input type="text" placeholder="Introduceti Lungimea" name="lungime" >

            <label><b>Latime (cm)</b></label>
            <input type="text" placeholder="Introduceti Latimea" name="latime" >

            <label><b>Inaltime (cm)</b></label>
            <input type="text" placeholder="Introduceti Inaltimea" name="inaltime">
      </div>
  <br/>

          <div class="container">
            <br/><br/><br/>
            <label><b>Detalii Colet</b></label><br/><br/>

            <label><b>Se percepe ramburs?</b></label><br/><br>
            <input type="radio" name="YES">da
            <input type="radio" name="NU">nu
            <br/><br/>

            <label><b>Suma</b></label>
            <input type="text" placeholder="Introduceti Suma" name="suma" >

            <label><b>Observatii</b></label>
            <input type="text" placeholder="Introduceti Observatii" name="observatii" >

            <label><b>Continut</b></label>
            <input type="text" placeholder="Introduceti Detalii" name="continut">
      </div>

      <div class="container">
            <br/><br/><br/>
            <font color ="lightgrey"> ************************************** </font>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/>
            Comanda va fi livrata ***<br/>
            Alte detalii relevante ***
      </div>

      <div class="container">
              <br/><br/><br/>
              <font color ="lightgrey"> ************************************* </font>
             <br/><br/><br/><br/><br/><br/><br/><br/><br/>
            Trimit comanda? 
            <button type="submit" class = "button" >DA</button>
            <button onclick="location.href='curier.php'" type="button" class="cancelbtn">Revocare</button>
      </div>
    </div>
  </form>

</body>
</html>