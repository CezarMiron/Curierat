<?php

// aceasta pagina primeste ca parametrii toate datele necesare pentru expedierea unui colet

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $numeD = mysql_real_escape_string($_POST['numeD']);
  $prenumeD = mysql_real_escape_string($_POST['prenumeD']);
  $telefonD = mysql_real_escape_string($_POST['telefonD']);
  $contactD = mysql_real_escape_string($_POST['contactD']); 

  $idClientE = mysql_real_escape_string($_POST['idclientE']); 
  $idAdresaE = mysql_real_escape_string($_POST['idadresaE']); 

  $judetD = mysql_real_escape_string($_POST['judetD']);
  $localitateD = mysql_real_escape_string($_POST['localitateD']);
  $stradaD = mysql_real_escape_string($_POST['stradaD']);
  $numarD = mysql_real_escape_string($_POST['numarD']);

  mysql_connect("localhost", "root", "") or die (mysql_error());
  mysql_select_db("curierat") or die ("Nu se poate face conexiunea cu baza de date");

  mysql_query("INSERT INTO client (Nume,Prenume,Telefon,PersoanaContact) VALUES ('$numeD','$prenumeD','$telefonD','$contactD')");
  $idClientD = mysql_insert_id();
  mysql_query("INSERT INTO adresa (Judet,Localitate,Strada,Numar) VALUES ('$judetD','$localitateD','$stradaD','$numarD')");
  $idAdresaD = mysql_insert_id();

  mysql_query("INSERT INTO clientadresa (IdClient,IdAdresa) VALUES ('$idClientD','$idAdresaD')");
  $idClientAdresaD = mysql_insert_id();

  $greutate = mysql_real_escape_string($_POST['greutate']);
  $lungime = mysql_real_escape_string($_POST['lungime']);
  $latime = mysql_real_escape_string($_POST['latime']);
  $inaltime = mysql_real_escape_string($_POST['inaltime']); 

  $suma = mysql_real_escape_string($_POST['suma']);
  $observatii = mysql_real_escape_string($_POST['observatii']);
  $continut = mysql_real_escape_string($_POST['continut']);

  mysql_query("INSERT INTO continut (Greutate,Inaltime,Lungime,Latime) VALUES ('$greutate','$inaltime','$lungime','$latime')");
  $idContinut = mysql_insert_id();

  mysql_query("INSERT INTO detalii (Suma,Observatii,Continut) VALUES ('$suma','$observatii','$continut')");
  $idDetalii = mysql_insert_id();

  $status = "In curs de procesare";
  $datetime = (new \DateTime())->format('Y-m-d H:i:s');
  
  //sunt introduse pe rand in BD, ulterior se populeaza tabelul expediere

  mysql_query("INSERT INTO expediere (IdClientE,   IdAdresaE,  IdClientD,   IdAdresaD,    IdContinut,  IdDetalii,  Status) VALUES 
  	                                ('$idClientE','$idAdresaE','$idClientD','$idAdresaD','$idContinut','$idDetalii','$status' )"   );

   Print '<script>alert("Comanda inregistrata cu succes!");</script>';
   Print '<script>window.location.assign("index.php");</script>'; 
   

  }
 ?>