<!DOCTYPE html>
    <?php session_start(); ?>
<html lang="fr"> 
    <head>
        <meta charset="utf-8">	       
        <link rel="stylesheet" type="text/css" href="styles/general.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/menuhorizontal.css" media="all"> 
        <link rel="stylesheet" type="text/css" href="styles/styles.css" media="all"> 
        <title> Liste adresse</title>	
    </head>  

    <body>

        <?php 	
            if ($_SESSION['login'] != null){
                include("entete_deconnexion.php");
            else{		
		include("entete.php");
            }
            
            include("connexion_bdd.php");
            include("menuverticalhebergement.php");
        ?>
	
        <nav> 
            <ul id="menu">
                <li> <a href="caracteristique_admin.php">Gestion des hébergements</a></li>
                <li> <a href="planning_admin.php">Gestion des projections</a></li>
            </ul>
        </nav>

        <div id="caracteristics">
            <?php
                //Récupération de la variable
                $ID=($_GET['ID_H']);
                // Creation et envoi de la requete
                $query = "SELECT NUMERO_RUE_HEBERGEMENT, RUE_HEBERGEMENT, CODE_POSTAL_HEBERGEMENT, VILLE_HEBERGEMENT FROM HEBERGEMENT WHERE ID_HEBERGEMENT LIKE '".$ID."'";
                //Test de la requète
            ?>
            
            <table id="liste_adresse">
                    <tr>
                        <th>Numéro de rue </th>
                        <th>Nom de rue </th>
                        <th>Code postal</th>
                        <th>Ville</th>
                    </tr>
                    
                <?php
                    if ($result=mysqli_query($con,$query)){
                        while ($row=mysqli_fetch_row($result)){
                            $Num_rue = $row[0]; 
                            $Nom_rue = $row[1];
                            $cp = $row[2];
                            $Ville = $row[3];
                            echo " <tr> <td>$Num_rue</td>
                                        <td><a>$Nom_rue</a></td>
                                        <td><a>$cp</a></td>
                                        <td><a>$Ville</a></td>
                                    </tr>";
                        }
                    }else{
                        printf("Erreur lors de l'execution de la requète");
                    }
                    
                    // Libère la mémoire associée au résultat
                    mysqli_free_result($result);
                    // Fermeture de la connexion a la base de donnée
                    mysqli_close($con);
                ?> 
            </table>
        </div>
    </body>
</html>