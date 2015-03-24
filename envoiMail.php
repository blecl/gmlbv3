<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>
<?php

$sujet = "Demande de partenariat";

$nomhebergement = $_post["nom_hebergement"];
$telhebergement = $_post["telephone"];
$typehebergement = $_post["type"];
$numrue = $_post["numero_rue"];
$nomrue = $_post["nom_rue"];
$cp = $_post["CP"];
$ville = $_post["ville"];
$nomcontact = $_post["nom_contact"];
$prenomcontact = $_post["prenom_contact"];
$mailcontact = $_post["mail_contact"];
$telcontact = $_post["telephone_contact"];

$sujet = 'Demande de partenariat';

$message = "Bonjour,<br/>
Un nouvel hébergement souhaite faire partie de votre réseau de partenaire. <br/><br/>
Voici les informations du contact : <br/>
Nom de l'hébergement : ".$nomhebergement."<br/>
Numéro de telephone de lhebergement : ".$telhebergement."<br/>
Type d'hébergement : ".$typehebergement."<br/>
<br/>
Adresse de l'hébergement<br/>
- Numéro de la rue : ".$numrue."<br/>
- Nom de la rue : ".$nomrue."<br/>
- Code postal : ".$cp."<br/>
- Ville : ".$ville."<br/>
<br/>
Contact de l'hebergement :<br/>
- Nom du contact : ".$nomcontact."<br/>
- Prénom du contact : ".$prenomcontact."<br/>
- Adresse mail du contact : ".$mailcontact."<br/>
- Telephone du contact : ".$telcontact." <br/><br/>
Merci de le recontacter.";


$destinataire = 'gwendoline.gonzalez-carracedo@etu.univ-lyon3.fr';

$headers = 'From: '.$nomhebergement.'<"'.$mailcontact.'">'."\n"; 
$headers .= "Reply-To: ".$destinataire."\n";
$headers .= "Content-Type: text/html; charset=\"utf-8\"";

if(mail($destinataire,$sujet,$message,$headers))
{
        echo'<script>alert("Votre mail à bien été envoyé !"); document.location.href="login.php";</script>';
	exit;
}
else
{
        echo "Une erreur c'est produite lors de l'envoi de l'email.";
}


?>