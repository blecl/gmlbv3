<!DOCTYPE html>
<html lang="fr"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ajout des projections</title>
    </head>

    <body>
        <?php 

            include("connexion_bdd.php");

            $film=$_POST['film'];
            $jury=$_POST['jury'];
            $j=0;

            //toues les memebres du jury qu'on traite
            $resultjury = mysqli_query($con, "SELECT ID_INDIVIDU FROM jury WHERE N__JURY = '$jury'");
            while($array2 = mysqli_fetch_array($resultjury)){
            $jure[$j] = $array2['ID_INDIVIDU'];
            $j++; 
            }

            //associe chaque memebre du jury au film qui sera jugé
            for($i=0;$i<$j;$i++){
                    $queryproj= "INSERT INTO juger (ID_FILM, ID_INDIVIDU) VALUES ($film,$jure[$i])";
                    $insertion = mysqli_query($con, $queryproj);
            }
                    echo'<script> alert("Jury ajouté");
                            document.location.href="form_ajout_projection.php";
                        </script>';

          ?>
      </body>
</html>