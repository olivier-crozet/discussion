
<?php
		//DEBUT SESSION ET DESTRUCTION
session_start();
 if (!empty($_POST['formdeconexion'])) 
    {   	
    unset ( $_SESSION ['id'] );
    unset ($_SESSION['login']);
	}
			// CONNEXION BASE DE DONNé mysqli
$connexion = mysqli_connect("localhost","root","","discussion");
?>
          <!--HTML LIENS FICHIER-->
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="inscription.css">
	<title>inscription</title>
</head>

<?php



                // WHEN YOU PUSH BUTTON 
if (isset($_POST['inscription']))
	{				
		$login = htmlspecialchars($_POST['login']) ; //evite l'injection ?? what the fuck??
	 
	 	$password = sha1($_POST['password']);//sha1 achage
	 	$password2 = sha1($_POST['password2']);//sha1 achage

			//CHAMP DE FORMULAIRE REMPLI
	if ( !empty($_POST["login"])  && !empty($_POST["password"]) && !empty($_POST["password2"]) && (strlen($_POST["password"])) >3 && (strlen($_POST["password2"]) >3)) 
		{
		  
		  

              // verifier les doublon
			$reqdoublon = "SELECT `login` FROM `utilisateurs` where login=\"$login\";";
       		
			$verifdoublon = mysqli_query($connexion, $reqdoublon);
			$result = mysqli_fetch_array($verifdoublon);
       		

			
	 		$loginlength = strlen($login);// evite de l'injection dans url? pas compris??
	 		if($loginlength <= 255)
	 		{

	 			if ($password == $password2)
	 			 {  // FONCTIONNE EN PDO
	 		 	//$reque="INSERT INTO utilisateurs(login, prenom, nom, password) VALUES('".$login."', '".$prenom."', '".$nom."','".$password."')"; //requette ok
	 		 	//fin du code bon en PDO
	 		 	
	 			//$insertmbr = $connexion->prepare($reque);
               // $insertmbr->execute();
                

	 		 				//CODE BON EN mysql
	 			 if (!isset ($_SESSION['login'])&&$result==NULL)
	 		 		{
	 				$requete="INSERT INTO utilisateurs(login,password)
	 			 				VALUES (\"$login\",\"$password\")";
	 			 	$inser= mysqli_query($connexion, $requete);
					$erreur= "votre compte a bien était créer !";
	 				header("location: index.php?id=".$_SESSION['id']);
	 				}
	 					//fin du code bon en mysql
	 				else
	 				{
	 				$erreur= "login deja existant !";
	 				} 			
	 			}



	 			else
	 			{
	 			$erreur = "vos mots de passe sont different !";
	 			}

	 	}
	 		
 		else     
			 {
		 	$erreur = "votre pseudo ne doit pas dépasser 255 caractère  ! ";
			 }
		}

				// CHAMP DE FORMULAIRE VIDE
	else
	{
	$erreur = "<br/>.tous les champ doivent etre complétés et le mot de passe doit contenir plus de 3 caractere !";
	}
 } 
			
 

?>
<body class="oc-body-accueil-btp">
	<div class="oc-backgroud-btp">
  <header class="oc-header-btp">
       <nav class ="oc-nav-btp" >
        <ul id="oc-nav-btp">
        	
      	     <li ><a href="index.php">Accueil</a></li><!--
          --><li ><a href="inscription.php">inscription</a></li><!--
          --><li ><a href="profil.php">profil</a></li>
    	     <?php if (isset($_SESSION['login']) && $_SESSION['login'] == "admin"){echo "<li ><a href=\"admin.php\">admin</a></li>";}?>
   		     <?php  if  (isset($_SESSION['id'])) { echo  '<li>'.'<a href= "">'.$_SESSION['login'].'</a>'.'</li>';} ?>
         </ul>
       </nav>
   </header>	
					<!--HTML TABLEAU INPUT-->
<header>
	  	<h1 class="h1inscription">inscription</h1>
</header>
       <section>	
		       <h1 class="titrelogin">inscrivez vous !</h1>
	
	      <article class="oc-paneaulogin-inscription">
	      	<form  method="POST" action="" >
	      <table class="tablinscri">
	      	<tr>
	      		<td>
	      			<label  for="login"> login :</label>
				</td>
				<td>
	      			<input type="text" name="login" placeholder="ecrire votre pseudo" value="<?php if(isset($login)){echo $login;} ?>">
	      		</td>
	      	</tr>
	      	<tr>
	      	    <td>
	      	    	
	      	    	<label  for="password">mot de passe :</label>
	      	    </td>
	      	    <td>
	      	    	<input type="password" name="password" placeholder="ecrire votre mot de passe">
	      	    </td>
	      	</tr>
	      	<tr>
	      	     <td>
	      	    	<label  for="password2">confirmer votre mot de passe :</label>
	      	    </td>
	      	    <td>
	      	    	<input type="password" name="password2" placeholder="ecrire votre mot de passe">
	      	    </td>
	      	</tr>
	      	
	      </table>
	      <br/>
	      	      <input  class="buton-inscription" type="submit" name="inscription" value="s'inscrire"/>		
	      	</form>


	<?php
			//MESSAGE D'ERREUR!!
		if (isset($erreur))
		 {
			echo "<strong>".'<font size= "5px" color="white">'.$erreur.'</font>'."</strong>";
		}
	?>
	    
	      </article>
	  
       </section>

       				<!--FOOTER-->
<footer>
	          <!--  <p>authentifier vous avec:</p>
	            <img class="logofb"src="logofb.png"><img class="logoinsta" src="logoinsta.png"> -->
</footer>

	  
	 

</body>
</html>