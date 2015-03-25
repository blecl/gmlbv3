
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
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
if($datej=="")
{
echo'<script>
alert("Date non saisie");
document.location.href="form_ajout_projection.php";
</script>';
}
$tr=$_POST['tr'];
$heure=$_POST['heure'];
$min=$_POST['min'];

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






$queryjury= "SELECT N__JURY FROM jury j INNER JOIN juger jj ON jj.ID_INDIVIDU=j.ID_INDIVIDU WHERE ID_FILM = '".$film."'";
$resultatjury = mysqli_query($con,$queryjury) or die ("Erreur dans la requête SQL 2 ".mysql_error());
if(mysqli_num_rows($resultatjury)!=0){
	while($array2 = mysqli_fetch_array($resultatjury)){
	$njury=$array2['N__JURY'];
	}
	$tt=test_jury($jourproj,$njury);
	if($tt==99)
	{
		echo'<script>
		alert("Plus de 3 projections");
		document.location.href="planning_admin.php";
		</script>';
		exit;
	}
}





/*------Testes dans test_ajout_projection.php--------*/
$test=test_ajout($cat,$salle,$heureproj,$jourproj,$tr);
if(	$date_conv< $jourp || $date_conv> $jourd)
{
	$test=99999;
}

if($test==900){
	$queryproj= "INSERT INTO projeter (ID_FILM, ID_SALLE, DATE_DEBUT_PROJECTION, DATE_FIN_PROJECTION) VALUES ($film,$salle,'".$datej."','".$datefin."')";
	$insertion = mysqli_query($con, $queryproj);

	echo'<script>
alert("Projection ajoutée");
document.location.href="planning_admin.php";
</script>';
}else if($test>900&&$test<9000)
	{
		echo'<script>
alert("Créneau non libre");
document.location.href="planning_admin.php";
</script>';
}
else if($test>=9000&&$test<99999)
	{
		echo'<script>
alert("Pas de tapis rouge le matin ou l\'après-midi");
document.location.href="planning_admin.php";
</script>';
}else if($test<900){
	echo'<script>
alert("Salle non appropriée !!");
document.location.href="planning_admin.php";
</script>';
}
else if($test=99999){
	echo'<script>
alert("Date ne correspond pas");
document.location.href="planning_admin.php";
</script>';
}
  ?>
  </body>
  </html>