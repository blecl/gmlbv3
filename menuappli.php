﻿<!DOCTYPE html>
<?php session_start(); ?>
<html lang="fr">  
    <head>
        <link rel="stylesheet" type="text/css" href="styles/general.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/menuhorizontal.css" media="all">
    </head>
   
     <body>
	<?php 
            if ($_SESSION['login'] != null){
                    include("entete_deconnexion.php");
            }else{
                include("entete.php");
            }
            
            include("connexion_bdd.php");
            
            if ($_SESSION['login'] == 'admin'){
                    include ("menuadmin.php");
            }else if ($_SESSION['login'] == 'hebergement'){
                    include ("menuhebergement.php");
            }else{
                    include ("menuprojection.php");
            }
	?>
        
    </body>
</html>