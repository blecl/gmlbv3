<!DOCTYPE html>
    <?php session_start(); ?>
<html lang="fr"> 
    <head>
        <meta charset="utf-8">	       
        <link rel="stylesheet" type="text/css" href="styles/general.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/menuhorizontal.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/styles.css" media="all">
        <title> Liste des services</title>	
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
                $ID= ($_GET['ID_H']);
                // Creation et envoi de la requete
                $query = "SELECT NOM_SERVICE FROM PROPOSER P
                INNER JOIN HEBERGEMENT H ON H.ID_HEBERGEMENT = P.ID_HEBERGEMENT
                INNER JOIN SERVICE S ON S.ID_SERVICE = P.ID_SERVICE 
                WHERE P.ID_HEBERGEMENT LIKE '".$ID."'";
            ?>
            
            <table id="liste_service">
                <tr>
                    <th>Services proposés</th>
                </tr>
            
            <?php
                if ($result=mysqli_query($con,$query)) {
                    while ($row=mysqli_fetch_row($result)) {
                        $Nom_service = $row[0]; 
                        echo "<tr> <td>$Nom_service</td></tr>";
                    }
                } else {
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