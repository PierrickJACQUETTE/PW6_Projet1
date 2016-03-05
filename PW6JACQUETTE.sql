
--
-- Base de données: `PW6JACQUETTE`
--

--


--
-- Structure de la table `Cours`
--

CREATE TABLE IF NOT EXISTS `Cours` (
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `Cours_id` int(32) NOT NULL AUTO_INCREMENT,
  `Date` datetime NOT NULL,
  `Prix` int(32) NOT NULL,
  `Categorie` int(32) NOT NULL,
  PRIMARY KEY (`Cours_id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `Name` varchar(40) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `Password` varchar(40) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `User_id` int(32) NOT NULL AUTO_INCREMENT,
  `Date` datetime DEFAULT NULL,
  `Credit` int(32) NOT NULL DEFAULT '100',
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Structure de la table `User/Cours`
--

CREATE TABLE IF NOT EXISTS `UserCours` (
  `Id_user` int(32) NOT NULL,
  `Id_cours` int(32) NOT NULL,
  `Id_Relation` int(32) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id_Relation`),
  CONSTRAINT `fk_user` FOREIGN KEY (`Id_user`) REFERENCES `User`(`User_id`),
  CONSTRAINT `fk_cours` FOREIGN KEY (`Id_cours`) REFERENCES `Cours`(`Cours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci AUTO_INCREMENT=1 ;
