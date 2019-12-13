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
 <form method="POST" action="discussion.php">

<?php
	                             //PARTIE INSERTION COMMENTAIRE DANS LA DATABASE
if (isset($_SESSION['id'])) 
{	 			 
	
	if (isset($_POST['envoi-comentaire']))
	 {
		# code...
	

		if (!empty($_POST["entrecom"])) 		
		{
		$com = $_POST["entrecom"];
		$id_user = $_SESSION['id'];
		$reqcom="INSERT INTO messages(message,id_utilisateur,date) VALUES (\"$com\",\"$id_user\", NOW())";
	 	$lecom = mysqli_query($connexion, $reqcom);
	 			 	
	 	}
	 	else
	    {
	    	$erreur="champ vide";
	    }
	 	
	}
	else
	{
	echo"laisser un commentaire ;) ";
	}
}
?>

<section class="oc-section-text1">
	        <h2>theme</h2>
	<div class="oc-div-zonetext1">
	
	</div>
	<div >	
		<table class="oc-espacecom">
          <tr>
            <td>
              <label  for="entrecom">commentaire :</label>
        </td>
        <td>
              <input type="text" name="entrecom" placeholder="entré votre commentaire"><!--php pour laisser le text dans l'input-->
            </td>
          </tr>
      </table>
           <br/>
	      	      <input class="envoi-comentaire" type="submit" name="envoi-comentaire" value="envoyé le commentaire"/>
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