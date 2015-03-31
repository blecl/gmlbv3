<!DOCTYPE html>

<html lang="fr"> 
    <head>
        <meta charset="utf-8">	       
        <link rel="stylesheet" type="text/css" href="styles/general.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/menuvertical.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/menuhorizontal.css" media="all">
        <link rel="stylesheet" type="text/css" href="styles/styles.css" media="all"> <!-- Qui sera a supprimer-->         	
        <script type="text/javascript" src="scripts/calendrier.js"></script>
		<script type="text/javascript" src="scripts/ProjectionJS.js"></script>

         <title> Saisie Projection</title>	
    </head>  

    <body>
		<?php include("date_festival.php");
		include("menuappli.php");
		include("connexion_bdd.php")?>

    <?php 

	
	$val=$_POST['value'];//identifiant de la projection selectionnée qu'on veut modifier, origine: ProjectionJS.js
	
	if($val=="ratatouille")//cas où aucune projection a été sélectionnée
	{
		echo'<script>alert("Selectionnez une projection"); document.location.href="planning_admin.php";</script>';
		exit;
	}
	
		
	$query= "SELECT NOM_FILM, NOM_SALLE, DATE_DEBUT_PROJECTION, DATE_FIN_PROJECTION FROM projeter p INNER JOIN films f ON f.ID_FILM = p.ID_FILM INNER JOIN salle s ON s.ID_SALLE = p.ID_SALLE WHERE ID_PROJECTION = '$val'";
    $result = mysqli_query($con, $query);

	while($array = mysqli_fetch_array($result)){
    $Noms[0] = $array['NOM_SALLE'];
    $Nomf[0] = $array['NOM_FILM'];
    $ddeb[0] = $array['DATE_DEBUT_PROJECTION'];
    $dfin[0] = $array['DATE_FIN_PROJECTION'];
    }
	?>
	 <div id="caracteristics">
    <div id="general">
	<label>Nom de salle : <?php echo $Noms[0]; ?></label> </br>
	<label>Nom du film : <?php echo $Nomf[0]; ?></label> </br>
	<label>Date et heure debut : <?php echo $ddeb[0]; ?></label> </br>
	<label>Date et heure fin: <?php echo $dfin[0]; ?></label> </br>
		
	<form action='supprimer_proj.php' method="POST" > 
	<input type='submit' value='Supprimer'/>
	<?php echo "<input type='hidden' name='ids' value='$val'/>";?>
	</form>

	<form action='form_modif_proj.php' method="POST"  > 
	<input type='submit' value='Modifier'/>
	<?php echo "<input type='hidden' name='ids' value='$val'/>"; ?>
	</form>

	</div>
    </div>

    </form>
    </body>
</html>