
DELETE FROM `filrouge`.`service`;

INSERT INTO `service` (`ID_SERVICE`, `NOM_SERVICE`) VALUES
(1, 'Sauna'),
(2, 'Piscine'),
(3, 'Hammam'),
(4, 'Spa'),
(5, 'Bar'),
(6, 'Casino'),
(7, 'Restaurant'),
(8, 'Discotheque'),
(9, 'Salle de sport'),
(10, 'Golf'),
(11, 'Wifi'),
(12, 'Room service prive'),
(13, 'Toileteur pour animaux de compagnie');


--
-- Contenu de la table `proposer`
--


DELETE FROM `filrouge`.`proposer`;

INSERT INTO `proposer` (`ID_HEBERGEMENT`, `ID_SERVICE`) VALUES
(1, 1),
(1, 2),
(1, 5),
(1, 6),
(2, 3),
(2, 7),
(3, 1),
(3, 12),
(4, 2),
(4, 5),
(4, 6);


--
-- Contenu de la table `hebergement`
--


DELETE FROM `filrouge`.`hebergement`;

INSERT INTO `hebergement` (`ID_HEBERGEMENT`, `NOM_HEBERGEMENT`, `TEL_HEBERGEMENT`, `CAPACITE_HEBERGEMENT`, `NOMBRE_ETOILES`, `RIB`, `NUMERO_RUE_HEBERGEMENT`, `RUE_HEBERGEMENT`, `CODE_POSTAL_HEBERGEMENT`, `VILLE_HEBERGEMENT`, `NOM_CONTACT`, `PRENOM_CONTACT`, `MAIL_CONTACT`, `TEL_CONTACT`, `TYPE_HEBERGEMENT`) VALUES
(1, 'Hotel de Provence', '970731381', 30, 3, '0123456789', 9, 'rue Moliere', 6400, 'Cannes', 'Dorj', 'Maxime', 'Maxime.dorj@cannes.com', '970731381', 'hotel'),
(2, 'InterContinental Carlton', '467934944', 135, 5, '0123456789', 58, 'La Croisette', 6414, 'Cannes', 'Bastien', 'Leclercq', 'bastien.leclercq@cannes.com', '634125676', 'hotel'),
(3, 'Majestic Barriere', '975182099', 349, 5, '0123456789', 10, 'La Croisette', 6407, 'Cannes', 'Gonzalez', 'Gwen', 'Gwen.Gonzalez@cannes.com', '673050207', 'hotel'),
(4, 'Radisson Blu', '492997320', 134, 4, '0123456789', 2, 'Boulevard Jean Hibert', 6400, 'Cannes', 'Bour', 'Lucie', 'Lucie.Bour@cannes.com', '492997320', 'hotel');




