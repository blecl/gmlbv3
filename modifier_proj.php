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
                
            $ids=$_POST['ids'];//identifiant de la projection à modifier
            $datej=$_POST['datejour'];
                
            if($datej=="") {
                echo'<script>
                        alert("Date non saisie");
                        document.location.href="planning_admin.php";
                    </script>';
            }   
            $tr=$_POST['tr'];
            $heure=$_POST['heure'];
            $min=$_POST['min'];
            $salle=$_POST['salle'];

            //Extraction des infos de la projection
            $query= "SELECT CATEGORIE, DUREE, p.ID_FILM AS idf FROM projeter p INNER JOIN films f ON f.ID_FILM = p.ID_FILM INNER JOIN salle s ON s.ID_SALLE = p.ID_SALLE WHERE ID_PROJECTION = '".$ids."'";
            $resultat = mysqli_query($con,$query) or die ("Erreur dans la requête SQL 1 ".mysql_error());

            while($array = mysqli_fetch_array($resultat)){
                $cat = $array['CATEGORIE'];
                $duree = $array['DUREE'];
                $idf= $array['idf'];
            }
                
            $date_conv= date_eclat($datej);
            $date = date_debut($datej,$heure,$min);
            $heureproj= traitement_heure($date);
            $jourproj= traitement_jour($date);
            $datefin =  date_fin($date,$tr,$duree);
            $datej= date_fest($date);
                
                
            /*------fonctions de teste dans test_ajout_projection.php--------*/
                
                
            //numero du jury associé au film
            $queryjury= "SELECT N__JURY FROM jury j INNER JOIN juger jj ON jj.ID_INDIVIDU=j.ID_INDIVIDU WHERE ID_FILM = '".$idf."'";
            $resultatjury = mysqli_query($con,$queryjury) or die ("Erreur dans la requête SQL 2 ".mysql_error());
            if(mysqli_num_rows($resultatjury)!=0){
                while($array2 = mysqli_fetch_array($resultatjury)){
                    $njury=$array2['N__JURY'];
                }
                $tt=test_jury($jourproj,$njury);
                if($tt==99) {
                    echo'<script>
                            alert("Nombre max de projections pour le jury atteint");
                            document.location.href="planning_admin.php";
                        </script>';
                    exit;
                }
            }
                
            $test= test_ajout($cat,$salle,$heureproj,$jourproj,$tr); 
            if(	$date_conv< $jourp || $date_conv> $jourd) {
                $test=99999;
            }
         
            if($test==900){
                $queryproj= "UPDATE projeter SET DATE_DEBUT_PROJECTION = '".$datej."' , DATE_FIN_PROJECTION = '".$datefin."', ID_SALLE = '".$salle."' WHERE ID_SALLE = '$salle[0]' AND ID_PROJECTION = '$ids'";
                $insertion = mysqli_query($con, $queryproj);

                echo'<script>
                        alert("Projection modifiée");
                        document.location.href="planning_admin.php";
                    </script>';
            }else if($test>900&&$test<9000) {
                echo'<script>
                        alert("Créneau non libre");
                        document.location.href="planning_admin.php";
                    </script>';
            } else if($test>=9000&&$test<99999) {
                echo'<script>
                        alert("Pas de tapis rouge le matin");
                        document.location.href="planning_admin.php";
                </script>';
            }else if($test<900){
                echo'<script>
                    alert("Salle non appropriée !!");
                    document.location.href="planning_admin.php";
                </script>';
            } else if($test=99999){
                echo'<script>
                        alert("Date ne correspond pas");
                        document.location.href="planning_admin.php";
                    </script>';
            }
        ?>
  </body>
</html>