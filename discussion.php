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
           <?php  if  (isset($_SESSION['id'])) { echo  '<li>'.'<a href= "">'.$login.'</a>'.'</li>';} ?>
           </ul>
       </nav>
   </header>
   </div>
          <!--HTML TABLEAU INPUT-->

                          <h1 class="titre-discussion">salon de discussion</h1>


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
	 	    	                    //requete d'insertion
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

?>

<section class="oc-section-text1">
	        <h2>theme</h2>
	<div class="oc-div-zonetext1">
		                       <!--ZONE AFFICHE TEXTE-->
	 <form class="form-affichage" method="POST" action="">
<?php
	        //REQUETTE JOINLES 2 TABLE
$req_jointe = "SELECT  login,  message, date FROM utilisateurs LEFT JOIN messages ON utilisateurs.id = messages.id_utilisateur ORDER BY `date`  DESC LIMIT 35";
	$req_jointe_bdd = mysqli_query($connexion,$req_jointe);

	 	$row = mysqli_fetch_all($req_jointe_bdd);
 ?>
                     <!--AFFICHE DE LA DATA BASE-->
		   <table>		   	
			<?php 
			foreach ( $row as $key ){
				if (!empty($key[1]))
    				{
					# code...
    					if ($login == $key[0]) 
				//	echo "<strong>".'<font size= "5px" color="red">'.$key.'</font>'."</strong>";
    			    		{
    			    			echo "<tr class=\"psedo-affichage\"><td class=\"taillepse\" >".$key[0].":"."</td>"."<td class=\"texttd\" >".$key[1]."</td>"."<td class=\"date-affichage\">".$key[2]."<td>"."</tr>";
    			    		}

    			    	else{
    			    		echo "<tr><td class=\"taillepse\">".$key[0].":"."</td>"."<td class=\"texttd\">".$key[1]."</td>"."<td \"date-affichage\">".$key[2]."</td>"."</tr>";
			                }// } 
			         }
}
?>			
		   </table>
	    </div>
	<div >	
		<!--<table class="oc-espacecom">-->
          <tr>
            <td>
              <label class="inputcom"  for="entrecom">commentaire :</label>
        </td>
        <td>
              <input class="inputcom" type="text" name="entrecom" ><!--php pour laisser le text dans l'input-->
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