<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
</html>

<!--Tester sous mac : opérationnel en modifiant juste les paramètres de connexion BDD car le reste est géré automatique par mamp. 
Il faut rajouter un mot de passe root dans le fichier connexion_bdd.php pour se connecter a la BDD (les paramètres de connexion ne sont pas les mêmes de mac (mamp) à windows(wamp)).
Attention les mails sont envoyés dans les spams avec l'adresse de l'université.
Les adresses gmail, hotmail pour la réception des mails ont été testés et ne fonctionne pas car elles sont bloqués par les hébergeurs !

Dans le cadre de notre projet, la compatibilité Windows n'est possible qu'en présence d'un serveur SMTP. 
Nous n'avons pas mis en place de serveur de mail (temps de mise en place assez long), mais pour une implémentation réele, il aurai fallu en mettre un, ce qui aurait résolu le problème.
-->
<?php

	$sujet = "Demande de partenariat";
	
	$nomhebergement = $_POST["nom_hebergement"];
	$telhebergement = $_POST["telephone"];
	$typehebergement = $_POST["type"];
	$numrue = $_POST["numero_rue"];
	$nomrue = $_POST["nom_rue"];
	$cp = $_POST["CP"];
	$ville = $_POST["ville"];
	$nomcontact = $_POST["nom_contact"];
	$prenomcontact = $_POST["prenom_contact"];
	$mailcontact = $_POST["mail_contact"];
	$telcontact = $_POST["telephone_contact"];
	
	$sujet = 'Demande de partenariat';
	
	$message = "Bonjour,<br/>
	Un nouvel hébergement souhaite faire partie de votre réseau de partenaire.<br/><br/>
	Voici les informations du contact : <br/>
	Nom de l'hébergement : ".$nomhebergement."<br/>
	Numéro de telephone de lhebergement : ".$telhebergement."<br/>
	Type d'hébergement : ".$typehebergement."<br/>
	<br/>
	Adresse de l'hébergement<br/>
	- Numéro de la rue : ".$numrue."<br/>
	- Nom de la rue : ".$nomrue."<br/>
	- Code POSTal : ".$cp."<br/>
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
	
	if(mail($destinataire,$sujet,$message,$headers)) {
            echo'<script>alert("Votre mail à bien été envoyé !"); 		
                document.location.href="login.php";</script>';
            exit;
	}else {
	        echo "Une erreur c'est produite lors de l'envoi de l'email.";
	}


?>