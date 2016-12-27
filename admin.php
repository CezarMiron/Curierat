<?php
include_once('header.php');
?>


 <style>

.button {
    position: relative;
    background-color: #4CAF50;
    border: none;
    font-size: 18px;
    color: #FFFFFF;
    padding: 20px;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    cursor: pointer;
}

.buttonR {
    position: relative;
    background-color: #C35817;
    border: none;
    font-size: 18px;
    color: #FFFFFF;
    padding: 20px;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    cursor: pointer;
}

form {
    display: inline-block;
}

select {
  
    position: relative;
    background-color: black;
    border: none;
    font-size: 14px;
    color: #FFFFFF;
    padding: 17px;

}

.container {
    padding: 16px;
}

</style>

<html>
	<head>
		<title>Cuerierar</title>
	</head>
	<body>
	<center>
	<form action = "admin.php" method="POST"> 
		<input type="hidden" name="param" value = "1">
		<button type = "submit" class = "button" > Afisare </button>		
	</form>

	<form action = "admin.php" method="POST"> 
		<input type="hidden" name="param" value = "2">
		<button type="submit" class="button" >Modificare</button>		
	</form>

	<form action = "admin.php" method="POST"> 
		<input type="hidden" name="param" value = "0">
		<button type = "submit" class = "button" > <font color = "black"> Stergere Selectie </font> </button>		
	</form>
	</center>



	</body>
</html>



<?php 	

 if(isset($_SESSION['admin']) ) {
 	if($_SERVER["REQUEST_METHOD"] == "POST") {
 		$param = mysql_real_escape_string($_POST['param']);
 		if($param == 0)
 			echo '<script>window.location.assign("admin.php");</script>';

 	}
 }
 	
 else
 {
 	 Print '<script>alert("Nu ai acces de admin!");</script>'; // Prompts the user
   	 Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php  
 }
 		
 ?>

 <!DOCTYPE html>
 <html>
	<?php global $param; if($param == "1" || $param == "3" || $param == "4" || $param == "5" || $param == "6" || $param == "9" || $param == "10" || $param == "11"  || $param == "12" || $param == "13") { ?>
	<br/>
	<center>
	<form action = "admin.php" method="POST"> 
		<center>
		<input type="hidden" name="param" value = "3">
		<button type = "submit" class = "button" > Useri </button>
		</center>		
	</form>

	<form action = "admin.php" method="POST"> 
		<center>
		<input type="hidden" name="param" value = "4">
		<button type="submit" class="button" >Comenzi</button>
		</center>		
	</form>
	</center>

		<?php } ?>

		<?php global $param; if($param == "2" || $param == "7" || $param == "8") { ?>
			<br/>
			<center>
			<form action = "admin.php" method="POST"> 
				<center>
				<input type="hidden" name="param" value = "7">
				<button type = "submit" class = "button" > Useri </button>
				</center>		
			</form>

			<form action = "admin.php" method="POST"> 
				<center>
				<input type="hidden" name="param" value = "8">
				<button type="submit" class="button" >Comenzi</button>
				</center>		
			</form>
			</center>

		<?php } ?>

 </html>

 <html>
	<?php global $param; if($param == "3") { ?>
	<br/>
	<center>
	<?php
		include_once('afisareuseri.php');
	?>



	</center>

	<?php } ?>

	<?php global $param; if($param == "7") { ?>
	<br/>
	<center>


		<form action="admin_user.php" method="GET">
          <div class="container">

            <label><b>Email </b></label>
            <input type="text" placeholder="Introduceti Email" name="email" required>

            <button type="submit">OK</button>

           </div>
        </form>

	</center>

	<?php } ?>

		<?php global $param; if($param == "8") { ?>
	<br/>
	<center>

			
		<form action="deletecomanda.php" method="GET">
          <div class="container">
          	STERG Comanda : 
            <label><b>IdExpediere </b></label>
            <input type="text" placeholder="Introduceti id" name="IdExpediere" required>

            <button type="submit">OK</button>

           </div>
        </form>

	</center>

	<?php } ?>

	<?php global $param; if($param == "4" || $param == "5" || $param == "6" || $param == "9" || $param == "10" || $param == "11"  || $param == "12" || $param == "13" ) { ?>
	<br/>
	<center>
	<form action = "admin.php" method="POST"> 
		<center>
		<input type="hidden" name="param" value = "5">
		<button type = "submit" class = "button" > Toate Comenzile </button>
		</center>		
	</form>

	<form action = "admin.php" method="POST"> 
		<center>
		<input type="hidden" name="param" value = "6">
		<button type="submit" class="button" >Dupa parametru</button>
		</center>		
	</form>

	<form action = "admin.php" method="POST"> 
		<center>
		<input type="hidden" name="param" value = "9">
		<button type="submit" class="button" >Predefinite</button>
		</center>		
	</form>

	</center>

	<?php } ?>

 </html>


 <html>
	<?php global $param; if($param == "5") { ?>
	<br/>
	<?php
		include_once('afisarecomenzi.php');
    } ?>

	<?php global $param; if($param == "6") { ?>
	<br/>
	<center>
		
		<form action="admin_comenziX.php" method="GET">
          <div class="container">

            **SE INTRODUC DOAR PARAMETRII DUPA CARE SE DORESTE CAUTAREA**<BR/><BR/>
            !! Daca datele nu exista in BD, executia esueaza !!
            <BR/><BR/>
            <label><b>IdExpediere     </b></label>
            <input type="text" placeholder="Introduceti IdExpediere" name="IdExpediere">
            <BR/><BR/>

            <label><b>Numele Expeditorului </b></label>
            <input type="text" placeholder="Introduceti N Exp" name="NumeE">
            <BR/><BR/>

            <label><b>Numele Destinatarului </b></label>
            <input type="text" placeholder="Introduceti N Dest" name="NumeD">
            <BR/><BR/>

            <button type="submit">OK</button>

           </div>
        </form>

	</center>
	<?php } ?>

	<?php global $param; if($param == "9" || $param == "10" || $param == "11"  || $param == "12" || $param == "13") { ?>
	

	<center>
			<form action = "admin.php" method="POST"> 
				<center>
				<input type="hidden" name="param" value = "10">
				<button type = "submit" class = "buttonR" > DEF 1 </button>
				</center>		
			</form>

			<form action = "admin.php" method="POST"> 
				<center>
				<input type="hidden" name="param" value = "11">
				<button type="submit" class="buttonR" > DEF 1 </button>
				</center>		
			</form>

			<form action = "admin.php" method="POST"> 
				<center>
				<input type="hidden" name="param" value = "12">
				<button type = "submit" class = "buttonR" > DEF 1 </button>
				</center>		
			</form>

			<form action = "admin.php" method="POST"> 
				<center>
				<input type="hidden" name="param" value = "13">
				<button type="submit" class="buttonR" > DEF 1 </button>
				</center>		
			</form>

			</center>


	<?php } ?>


</html>

<html>
	<?php global $param; if($param == "10") { ?>
	<br/>
	<center><b>
	***AFISARE USERII CARE NU AU EFECTUAT O COMANDA IN ULTIMA SAPTAMANA***
	</b>
	<BR/><BR/>
	<?php include_once("Q1.php"); } ?>
	</center>

	<?php global $param; if($param == "11") { ?>
	<br/>
	<center><b>
	***AFISARE NUMARUL MAXIM DE COMENZI IN FUNCTIE DE DATA***
	</b>
	<BR/><BR/>
	<?php include_once("Q2.php"); } ?>
	</center>

	<?php global $param; if($param == "12") { ?>
	<br/>
	<center><b>
	***AFISARE NUMELE, PRENUMELE CLIENTULUI CARE ARE DE RIDICAT O SUMA MAI MARE DECAT MEDIA SUMELOR DE BANI TRIMISE***
	</b>
	<BR/><BR/>
	<?php include_once("Q3.php"); } ?>
	</center>

	<?php global $param; if($param == "13") { ?>
	<br/>
	<center><b>
	***AFISARE COMENZILE DIN ULTIMA SAPTAMANA EXPEDIATE DIN BUCURESTI***
	</b>
	<BR/><BR/>
	<?php include_once("Q4.php"); } ?>
	</center>


</html>
	

	



