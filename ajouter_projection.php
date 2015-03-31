<!DOCTYPE html>
<html lang="fr"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ajout des projections</title>
    </head>

    <body>

        <?php 
            include("date_festival.php");
            include ("test_ajout_projection.php");
            include("connexion_bdd.php");

            $film=$_POST['film'];
            $salle=$_POST['salle'];
            $datej=$_POST['datejour'];

            //Si la date n'est pas saisie
            if($datej=="") {
                echo'<script> alert("Date non saisie");
                            document.location.href="form_ajout_projection.php";
                    </script>';
            }
            
            $tr=$_POST['tr'];
            $heure=$_POST['heure'];
            $min=$_POST['min'];

            //la durée et la categorie du films qu'on ajoute
            $queryfilm= "SELECT DUREE, CATEGORIE FROM films WHERE ID_FILM = '$film'";
            $resultfilm = mysqli_query($con, $queryfilm);
             
            while($array = mysqli_fetch_array($resultfilm)){
            $duree = $array['DUREE'];
            $cat = $array['CATEGORIE'];
            }

            /*-----Traitement date------*/
            $date_conv= date_eclat($datej);
            $date = date_debut($datej,$heure,$min);
            $heureproj= traitement_heure($date);
            $jourproj= traitement_jour($date);
            $datefin =  date_fin($date,$tr,$duree);
            $datej= date_fest($date);


            //Les jury associé au film
            $queryjury= "SELECT N__JURY FROM jury j INNER JOIN juger jj ON jj.ID_INDIVIDU=j.ID_INDIVIDU WHERE ID_FILM = '".$film."'";
            $resultatjury = mysqli_query($con,$queryjury) or die ("Erreur dans la requête SQL 2 ".mysql_error());


            /*------fonctions de teste dans test_ajout_projection.php--------*/

            //si un jury est associé
            if(mysqli_num_rows($resultatjury)!=0){
                while($array2 = mysqli_fetch_array($resultatjury)){
                    $njury=$array2['N__JURY'];
                }
                //Teste si le jury a deja 3 prj dans la journée
                $tt=test_jury($jourproj,$njury);
                if($tt==99) {
                    echo'<script>
                    alert("Nombre max de projections pour ce jury atteint");
                        document.location.href="planning_admin.php";
                        </script>';
                    exit;
                }
            }

            $test=test_ajout($cat,$salle,$heureproj,$jourproj,$tr);
            if(	$date_conv< $jourp || $date_conv> $jourd) {
                $test=99999;
            }

            if($test==900){
                    $queryproj= "INSERT INTO projeter (ID_FILM, ID_SALLE, DATE_DEBUT_PROJECTION, DATE_FIN_PROJECTION) VALUES ($film,$salle,'".$datej."','".$datefin."')";
                    $insertion = mysqli_query($con, $queryproj);
                    
                    //Cas succès
                    echo'<script> alert("Projection ajoutée");
                                document.location.href="planning_admin.php";
                        </script>';
            }else if($test>900&&$test<9000) {
                echo'<script> alert("Créneau deja utilisé");
                        document.location.href="planning_admin.php";
                    </script>';
            }
            else if($test>=9000&&$test<99999) {
                echo'<script> alert("Pas de tapis rouge le matin ou l\'après-midi");
                            document.location.href="planning_admin.php";
                    </script>';
            }else if($test<900){
                    echo'<script> alert("Salle non appropriée ");
                            document.location.href="planning_admin.php";
                        </script>';
            }else if($test=99999){
                    echo'<script>  alert("Date ne correspond pas");
                                document.location.href="planning_admin.php";
                        </script>';
            }
          ?>
    </body>
</html>