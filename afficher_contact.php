<!DOCTYPE html>
    <?php session_start(); ?>
<html lang="fr"> 
    <head>
        <meta charset="utf-8">	       
        <link rel="stylesheet" type="text/css" href="styles/general.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/menuhorizontal.css" media="all"> 
        <link rel="stylesheet" type="text/css" href="styles/styles.css" media="all"> 
        <title> Liste contact</title>	
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
                $ID= ($_GET['ID_H']);
                // Creation et envoi de la requete
                $query = "SELECT NOM_CONTACT, PRENOM_CONTACT, MAIL_CONTACT, TEL_CONTACT FROM HEBERGEMENT WHERE ID_HEBERGEMENT LIKE '".$ID."'";
            ?>
            
            <table id="liste_contact">
                <tr>
                    <th>Nom du contact</th>
                    <th>Prénom du contact </th>
                    <th>Mail du contact</th>
                    <th>Téléphone du contact</th>
                </tr>
            
            <?php
                if ($result=mysqli_query($con,$query)) {
                    while ($row=mysqli_fetch_row($result)) {
                        $Nom_contact = $row[0]; 
                        $Prenom_contact = $row[1];
                        $Tel_contact = $row[2];
                        $Mail_contact = $row[3];
                        echo " <tr> <td>$Nom_contact</td>
                                    <td>$Prenom_contact</td>
                                    <td>$Tel_contact</td>
                                    <td>$Mail_contact</td>
                                </tr>";
                    }
                }
                else {
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