<!DOCTYPE html>
<html lang="fr"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ajout des projections</title>
    </head>

    <body>
        <?php 
            include("connexion_bdd.php");

            $ids=$_POST['ids'];//identifiant de la projection à supprimer
            $query=("DELETE FROM projeter WHERE ID_PROJECTION = '$ids'");
            $result = mysqli_query($con, $query);
             
            echo'<script>
                    alert("Projection supprimée");
                    document.location.href="planning_admin.php";
                </script>';
        ?>      
      </body>
  </html>