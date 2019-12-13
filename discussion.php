<?php
session_start();
$connexion = mysqli_connect("localhost","root","","discussion");
$_SESSION['id'];
$_SESSION['login'];

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
	if (!empty($_POST['envoicomentaire']))
	 {
		
		if (!empty($_POST["entrecom"])) 		
		{   echo "string";
		$com = $_POST["entrecom"];
		$id_user = $_SESSION['id'];

		$reqcom="INSERT INTO messages(message,id_utilisateur,date) VALUES (\"$com\",\"$id_user\",NOW())";
	 	$lecom = mysqli_query($connexion, $reqcom);
	 			 	var_dump($lecom);
	 	}
	 	else
	    {
	    	$erreur="champ vide";
	    }
	 	
	}

}

	                   //AFFICHE DES REQUETTE

	//REQUETTE SELECTION LOGIN UTILSETEURS
$req_selcet_log = "SELECT  login FROM utilisateurs where id='".$_SESSION['id']."'";
$req_selcet_log_bdd = mysqli_query($connexion,$req_selcet_log);
$req_selcet_login_by_id = mysqli_fetch_row($req_selcet_log_bdd);

	//REQUETTE SELECTION COMMENTAIRE ET DATE
$req_selcet_comdate = "SELECT  message FROM messages where date > (NOW() - INTERVAL 1 WEEK)
 ";
$req_selcet_comdate_bdd = mysqli_query($connexion,$req_selcet_comdate);
$req_selcet_com_by_id = mysqli_fetch_all($req_selcet_comdate_bdd);



?>

<section class="oc-section-text1">
	        <h2>theme</h2>
	<div class="oc-div-zonetext1">
		                       <!--ZONE AFFICHE TEXTE-->
	 <form method="POST" action="discussion.php">
		   <table>
		   	      <tr>
		   	      	  <td>
		         
		              </td> 
		            
		            	<?php foreach ( $req_selcet_com_by_id as $key ): ?>
		            		<tr class="tbladmin">
			<td class="tbladmin"><?php echo $req_selcet_login_by_id[0].":".$key[0] ?></td>
			
			

		</tr>
		
	<?php endforeach ?>
		           <tr>
		       
		           </tr>
		   </table>
	</div>
	<div >	
		<table class="oc-espacecom">
          <tr>
            <td>
              <label  for="entrecom">commentaire :</label>
        </td>
        <td>
              <input type="text" name="entrecom" placeholder=""><!--php pour laisser le text dans l'input-->
            </td>
          </tr>
      </table>
           <br/>
	      	      <input class="envoi-comentaire" type="submit" name="envoicomentaire" value="envoyé le commentaire">
    </div>
    </form>
</section>
<?php

	if (isset($erreur))
		 {
			echo "<strong>".'<font size= "5px" color="red">'.$erreur.'</font>'."</strong>";
		}
?>

</body>
</html>