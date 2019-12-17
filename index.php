<?php
session_start();
               //si on clique sur la connexion
 if (!empty($_POST['formdeconexion'])) 
    {   	
    unset ( $_SESSION ['id'] );
    unset ($_SESSION['login']);	
$erreur="<p class='codeerreur'>vous n'etes pas connecté !";
    }
?>

<html>
<head>
	   <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="index.css">
     <title>accueil</title>
</head>
       <body class="oc-body-accueil-btp">
  <div class="oc-backgroud-btp">

					 <!--HEADER ADMIN -->
  <header class="oc-header-btp">
       <nav class ="oc-nav-btp" >
          <ul id="oc-nav-btp">
              <li ><a  href="index.php">Accueil</a></li><!--
          --><?php if (!isset($_SESSION['login'])) 
                      { 
                        echo "<li ><a href=\"inscription.php\">inscription</a></li>";
                      } ?><!--
           --><li ><a href="profil.php">profil</a></li><!--
           --><?php 
                        if (!isset($_SESSION['login']))
                         {
                         echo "vous netes pas conecté";
                         }
                         else{
                              if($_SESSION['login'])
                              {
                               echo "<li ><a href=\"discussion.php\">discussion</a></li>";
                              };
                         }?>
              <?php
                    if  (isset($_SESSION['id'])) { echo  '<li>'.'<a href= "">'."connecté".'</a>'.'</li>';} ?>       
          </ul>

       </nav>
   </header>
	  				<!--FIN HEADER ADMIN-->

<h1 class="titrelogin-index">proposition et discution sur les problème moraux liées au I.A</h1>

<section class="oc-section-index1">	
	
		       <!--MODULE DE CONEXION-->
	      <article class="paneaulogin-index">
	        

               <!--debut formulaire-->
         <div class="div-tableau-connexion" >
    <form method="post" action="index.php"><!--pour le php -->
<?php
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=discussion','root','');
	if (isset($_POST['formconnexion']))
	 { 
		$loginconexion = htmlspecialchars($_POST['psedoconect']);
		$passwordconexion =sha1($_POST['passwordconect']);
	   	if (!empty($_POST['psedoconect']) && !empty($_POST['passwordconect']) )
	   	{
			$requser = $bdd->prepare("SELECT * FROM utilisateurs where login = ? AND password = ?");
			$requser->execute(array($loginconexion, $passwordconexion));
			$userexist = $requser->rowcount();
		    	if($userexist == 1)
			     {			
			     	$userinfo = $requser->fetch();
			     	session_start();
			     	$_SESSION['id'] = $userinfo['id'];
			     	$_SESSION['login'] = $userinfo['login'];
			         	header("location: index.php?id=".$_SESSION['id']);
			    	}
		    	else
		    	{
			   	$erreur = "<br/>mauvais psedo ou mauvais mot de passe !";
		    	}
	     		}
	   	else
	   	{
			$erreur = "<p class=\"er\"><br/>tous les champ doives etre completés !";
			}	
	}
?>
    	<!--fin du php-->  
    	 <table class="inputconexion" >
          <tr>
              <td>
                <label  for="psedoconect"> login :</label>
              </td>
              <td>
                <input type="text" name="psedoconect" placeholder="ecrire votre pseudo" value="<?php if(isset($_SESSION['login'])){echo $_SESSION['login'];} ?>"><!--php pour laisser le text dans l'input-->
              </td>
          </tr>
          <tr>
               <td>
                <label  for="passwordconect">mot de passe :</label>
              </td>
              <td>
                <input type="password" name="passwordconect" placeholder="ecrire votre mot de passe">
              </td>
          </tr>    
        </table>
        <br/>
                <input class="butonconexion" type="submit" name="formconnexion" value="CONNEXION"/>  
        <br/><br/>
        		<input class="butonconexion2" type="submit" name="formdeconexion" value="se deconnecté"/>       		   
          </form>
        
        </table>
      
    </article>

        <!--PARTIE ACTU-->
    <article class="oc-article-actu">

             <h2>Actualité I.A</h2>

        <div class="oc-div-article1">
               <h3> Intégrer l’éthique dans les algorithmes soulève des défis titanesques</h3>
           <div>
                      <p>Deux chercheurs de Télécom Paris, David Bounie et Winston Maxwell, décrivent dans une tribune au « Monde » les solutions concrètes à apporter aux risques de discrimination que peuvent générer les algorithmes des plates-formes.</p>
           </div>
</section>
                           <!--FIN DE SECTION-->
</section >
<section class="oc-section-index2" >
                        <img class="oc-image1-actu" src="image/hombre.jpg">
                  <div class="oc-div-article2">
                    <p>Tribune. Trois mois après le lancement de la carte de crédit Apple en août 2019 aux Etats-Unis, le cofondateur d’Apple Steve Wozniack accuse le service de discriminer les femmes en leur attribuant des lignes de crédits dix fois inférieures à celles des hommes ! La raison ? L’algorithme détermine automatiquement la ligne de crédit. Oui, d’accord, mais quelle est l’explication ? Steve Wozniack et sa femme attendent toujours la réponse…

De plus en plus d’exemples dans la justice, la santé, l’éducation et la finance, montrent que les outils d’intelligence artificielle (IA) ne peuvent être déployés sans contrôle dans des systèmes de sécurité ou d’accès à des ressources essentielles au risque de généraliser des biais, potentiellement discriminatoires, difficiles à interpréter et pour lesquels aucune explication n’est fournie aux utilisateurs.</p>
                  </div>

             </div>

           </article>
</section>

<footer>
 <!-- <div>
	<img class="ballon" src="image/foot-01.gif">  
  </div> -->
	 </footer>

</body>
</html>
