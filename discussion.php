<?php
session_start();
$connexion = mysqli_connect("localhost","root","","discussion");
$_SESSION['id'];
$login = $_SESSION['login'];

?>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="inscription.css">
  <title>profil</title>
</head>

<body class="oc-body-accueil-btp">
  <div class="oc-backgroud-btp">
  <header class="oc-header-btp">
       <nav class ="oc-nav-btp" >
        <ul id="oc-nav-btp">
          
           <li ><a  href="index.php">Accueil</a></li><!--
          --><?php if (!isset($_SESSION['login'])) { echo "<li ><a href=\"inscription.php\">inscription</a></li>";} ?><!--
           --><li ><a href="profil.php">profil</a></li>
              <?php if (!empty($_SESSION['login'] )){echo "<li ><a href=\"discussion.php\">discussion</a></li>";}?>
           <?php  if  (isset($_SESSION['id'])) { echo  '<li>'.'<a href= "">'."connecté".'</a>'.'</li>';} ?>
           </ul>
       </nav>
   </header>
   </div>
          <!--HTML TABLEAU INPUT-->

                          <h1>forum de discussion</h1>


<?php
	                             //PARTIE INSERTION COMMENTAIRE DANS LA DATABASE
if (isset($_SESSION['id'])) 
{	 			 

	if (isset($_POST['envoicomentaire']))
	 {
			 	    	$bouton=htmlspecialchars($_POST['entrecom']);

	 	    if (!empty($_POST["entrecom"])) 		
	 	    {   
	 	    	$id_user = $_SESSION['id'];

	 	    	$reqcom="INSERT INTO messages(message,id_utilisateur,date) VALUES (\"$bouton\",\"$id_user\",NOW())";
	 	    	$lecom = mysqli_query($connexion, $reqcom);
	 	    	header("location: discussion.php");
	 			 	
	 	    }
	 	    else
	 	    {
	    	$erreur="champ vide";
	        }	 	
	        
	}
	else
	{}
unset($bouton);

	                   //AFFICHE DES REQUETTE

	//REQUETTE SELECTION LOGIN UTILSETEURS
//$req_selcet_log = "SELECT  login FROM utilisateurs where id='".$_SESSION['id']."'";
//$req_selcet_log_bdd = mysqli_query($connexion,$req_selcet_log);
//$req_selcet_login_by_id = mysqli_fetch_all($req_selcet_log_bdd);

//$_SESSION['id_utilisateur']=$_SESSION['id'];

	//REQUETTE SELECTION COMMENTAIRE ET DATE
//$req_selcet_comdate = "SELECT  message FROM messages where date > (NOW() - INTERVAL 1 WEEK)
 //";

	                    //REQUETTE MELANGENT LES DEUX TABLE
 //$req_select_comdate = "SELECT `utilisateurs`.`login`, `messages`.`message`, `messages`.`date` FROM `utilisateurs` , `messages` ORDER BY `date`  DESC LIMIT 35";
//$req_select_comdate_bdd = mysqli_query($connexion,$req_select_comdate);
//$req_select_com_by_id = mysqli_fetch_all($req_select_comdate_bdd);

                 //REQUETE JOINTE
	//$req_jointe_all = mysqli_fetch_all($req_jointe_bdd);

	



?>

<section class="oc-section-text1">
	        <h2>theme</h2>
	<div class="oc-div-zonetext1">
		                       <!--ZONE AFFICHE TEXTE-->
	 <form method="POST" action="">
<?php


$req_jointe = "SELECT  login,  message, date FROM utilisateurs LEFT JOIN messages ON utilisateurs.id = messages.id_utilisateur ORDER BY `date`  DESC LIMIT 35";
	$req_jointe_bdd = mysqli_query($connexion,$req_jointe);

	 	$row = mysqli_fetch_all($req_jointe_bdd);
	 	
	 

 ?>
	
		
		   <table>
		   	
			<?php 
			foreach ( $row as $key ):
				
			echo $key[0].':'.$key[1].$key[2]."</br>"
		     
		?>
			
			
		   </table>
		   <?php  
		    endforeach ;


	       ?>
		 
	    </div>
	 

		  <!-- <table>
		   	      <tr>
		   	      	  <td>
		         
		              </td> -->
		            
		            	<!--<?php

		            	// foreach ( $req_jointe_all as $key ): 

		            	 	//foreach ($req_selcet_login_by_id as $key1 ): {
		            	 		# code...
		            	 	//}
		            	 	?>

		            		<tr class="tbladmin">-->
		<!--	<td class="tbladmin"><?php 
			//if (empty($_POST['envoicomentaire'])) 
			//{
				# code...
			
			//echo /*$login.":".$key[1].$key[2] ;*/ $req_jointe_all[0] /*}*/ ?></td>
			
			

		</tr>
		
	<?php //endforeach ;
         // endforeach ;	?>
		           <tr>
		       
		           </tr>
		   </table
	</div>>-->
	<div >	
		<!--<table class="oc-espacecom">-->
          <tr>
            <td>
              <label  for="entrecom">commentaire :</label>
        </td>
        <td>
              <input type="text" name="entrecom" ><!--php pour laisser le text dans l'input-->
            </td>
          </tr>
      </table>
           <br/>
	      	      <input class="envoi-comentaire" type="submit" name="envoicomentaire" value="envoyé le commentaire">
    </div>
    </form>
</section>
<?php

}

else 
{
	header("location: index.php");
}
	if (isset($erreur))

		 {
			echo "<strong>".'<font size= "5px" color="red">'.$erreur.'</font>'."</strong>";
		}

?>

</body>
</html>