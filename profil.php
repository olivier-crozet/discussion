<?php
session_start();


//$samerelapute = mysqli_connect("localhost","root","","discussion");
$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', '');
//$reqeco = "SELECT `login` FROM `utilisateurs` where login=$_SESSION['login']";
//$reqecho = mysqli_query($samerelapute, $reqeco);
//echo $reqecho;
//if (empty($_SESSION['id'])) 
   // {
      
    // unset ($_SESSION ['login'] );}
//      CONECTION BASE DE DONNE MYSQL
$connexion = mysqli_connect("localhost","root","","discussion");

//      CONECTION BASE DE DONNER PDO


if(isset($_SESSION['login'])) 
{$_SESSION['login'];
  $getid = intval($_SESSION['login']); //securise la variable evite l'injection de text bizare
  $log = $_SESSION['login'];


  //requete pdo qui bug
 //$reqecolog =$bdd->prepare("SELECT login FROM utilisateurs where id='".$_SESSION['id']."'");
 //$reqecolog =execute(array($getid)); 

//$convert = array($reqecolog);
//var_dump($convert);
//$comma_separated = implode("",$convert);
//$comma_separated = http_build_query("",$convert)

//$nomuser = $reqecolog->fetch($reqecolog,$bdd); 
 //$reqecolo = $reqecolog->fetch();
 //var_dump($comma_separated);
 //var_dump($reqecolog);
 
     
$reqecolog = "SELECT  login FROM utilisateurs where id='".$_SESSION['id']."'";
$reqlog = mysqli_query($connexion,$reqecolog);
$loginid = mysqli_fetch_row($reqlog);
 
 var_dump($loginid) ;
    
                // WHEN YOU PUSH BUTTON test 1

      $login = $_SESSION['login']; //evite l'injection ?? what the fuck??
      if (isset($_POST['modif']))
       {       
       $login = htmlspecialchars($_POST['newlogin']) ; //evite l'injection ?? what the fuck??
       $password = sha1($_POST['newpassword']);//sha1 achage
       $password2 = sha1($_POST['newpassword2']);//sha1 et un cryptage mais c mieux hash //

              if ( (strlen($login)) >0  )
                {
                                    //REQUETE PDO
                 $id = $_SESSION['id'];
                 //$_SESSION['login']; //= $login;
                 $sessionlogin = $_SESSION['login'];
                          

  //   REQUETE ET EXUCUSION EN MYSQLI
 /*  $requetmodif = "UPDATE utilisateurs SET login = '$login', prenom = '$prenom', nom = '$nom', password = '$password' WHERE login = '".$_SESSION['login']."'";
   $inser= mysqli_query($connexion, $requetmodif);  */

                
               
                         if ( strlen($_POST["newpassword"]) >3 && strlen($_POST["newpassword2"]) >3 && $_POST["newpassword"] == $_POST["newpassword2"])
                         {


                          $requser=$bdd->prepare("UPDATE utilisateurs SET login='$login' where login='$sessionlogin'");
                          $requser->execute(array($getid));// what a fuck (repure infos via url??)
                          $userinfo = $requser->fetch();
                          $_SESSION['login'] = $login;
                     var_dump($userinfo);

      
                        $reqmdp = $bdd->prepare("UPDATE utilisateurs SET password = '$password' where id=$id");
                        $reqmdp->execute(array($getid));// what a fuck (repure infos via url??)
                        $usermdp = $reqmdp->fetch();
                        $_SESSION['password'] = $password;

                             header("location profil.php");


                             $erreur = "le profil a etait modifié !";
                          }
else
                {
                   $erreur="completer les trois premier champ";
                }
                          }
 
                         else{
                              $erreur = "mot de passe au moin 3 caractere";
                             } 

              }


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
              <?php if (!empty($_SESSION['login'] == "admin" )){echo "<li ><a href=\"admin.php\">admin</a></li>";}?>
           <?php  if  (isset($_SESSION['id'])) { echo  '<li>'.'<a href= "">'.$login.'</a>'.'</li>';} ?>
           </ul>
       </nav>
   
          <!--HTML TABLEAU INPUT-->

                          <h1>profil de <?php echo $loginid[0] ; ?> </h1>

</header>

       <section>  
           <h1 class="titrelogin">modifier votre profil !</h1>
  
        <article class="paneaulogin">
          <form  method="POST" action="" >
        <table>
          <tr>
            <td>
              <label  for="newlogin"> login :</label>
        </td>
        <td>
              <input type="text" name="newlogin" placeholder="ecrire votre pseudo" value=<?php if(isset($_SESSION['login'])){echo $login;} ?> />
            </td>
          </tr>
       
              <tr>
               <td>
                <label  for="newpassword">mot de passe :</label>
              </td>
              <td>
            
                <input type="password" name="newpassword" placeholder="ecrire votre mot de passe">
              </td>
          </tr>
          <tr>
               <td>
                <label  for="newpassword2">confirmer votre mot de passe :</label>
              </td>
              <td>
                <input type="password" name="newpassword2" placeholder="ecrire votre mot de passe">
              </td>
          </tr>
          
        </table>
        <br/>
                <input class="butonconexion-modif" type="submit" name="modif" value="modifier le profil"/>    
          </form>


  <?php
      //MESSAGE D'ERREUR!!



    if (isset($erreur))
     {
      echo '<font color="red">'.$erreur.'</font>';
    }
  ?>
      
        </article>
    
       </section>

              <!--FOOTER-->
<footer>
           
</footer>

    
   

</body>
</html>

<?php 
}
else 
{
  echo "vous n'etes pas connecter !";

echo "<li >.<a  href=\"index.php\">revenir a l'Accueil en cliquant sur se liens</a></li>";
   //si l'id de session n'est pas touver !
}
?>