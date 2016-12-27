	<link rel="stylesheet" type="text/css" href="CSS/style.css" /> 

		<ul>
 			 <?php session_start();
 			 
 			 if(isset($_SESSION['user']) ) { $a = $_SESSION['user']; ?> <!--verific daca exista deja un user pentru a afisa campurile corespunzatoare -->
 			  
 			 	<li><a class="active" href="index.php">Home</a></li>
 				<li><a href="servicii.php">Servicii</a></li>
 				<li><a href="curier.php">Cheama Curier</a></li>

 				<?php if(isset($_SESSION['admin'])) { ?>  <!-- verific daca utilizatorul este admin, daca da, afisez si campul administratorului -->
 					<li><a href="admin.php">Admin</a></li> <?php } ?>

 			 	<li><a href="contact.php">Contact</a></li>
  				<li style="float:right"><a href="logout.php">Logout</a></li>
  				<li style="float:right"><a href="myinfo.php">Salut, <?php echo"$a" ?></a></li> 
  			 
  			 <?php 
  			 }  else { ?>

  			 	<li><a class="active" href="index.php">Home</a></li>
 				<li><a href="servicii.php">Servicii</a></li>

 				<?php if(isset($_SESSION['admin'])) { ?>
 					<li><a href="admin.php">Admin</a></li> <?php } ?>
 				
 			 	<li><a href="contact.php">Contact</a></li>
  				<li style="float:right"><a href="login.php">Login</a></li>
  			 	<li style="float:right"><a href="register.php">Inregistrare</a></li>

  			<?php } ?>


 		</ul>
 		<br/>


