-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Juin 2016 à 10:05
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `monopoly`
--

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `idCardType` int(11) NOT NULL,
  `idOwner` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cards`
--

INSERT INTO `cards` (`id`, `idCardType`, `idOwner`, `idStatus`) VALUES
(1, 3, 1, 1),
(2, 3, 1, 1),
(3, 6, 1, 1),
(4, 1, 1, 1),
(5, 19, 1, 1),
(6, 22, 1, 3),
(7, 11, 1, 1),
(8, 18, 1, 1),
(9, 3, 1, 1),
(10, 15, 1, 1),
(11, 14, 1, 1),
(12, 1, 1, 1),
(13, 1, 1, 1),
(14, 6, 1, 1),
(15, 9, 1, 1),
(16, 7, 1, 1),
(17, 12, 1, 1),
(18, 22, 1, 3),
(19, 22, 1, 2),
(20, 7, 1, 1),
(21, 8, 6, 1),
(22, 18, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `cardsintrades`
--

CREATE TABLE `cardsintrades` (
  `idCard` int(11) NOT NULL,
  `idTrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cardsintrades`
--

INSERT INTO `cardsintrades` (`idCard`, `idTrade`) VALUES
(6, 14),
(18, 14),
(22, 14),
(19, 15);

-- --------------------------------------------------------

--
-- Structure de la table `cardstatus`
--

CREATE TABLE `cardstatus` (
  `idStatus` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cardstatus`
--

INSERT INTO `cardstatus` (`idStatus`, `label`) VALUES
(1, 'Disponible'),
(2, 'Proposée à l''échange'),
(3, 'En cours d''échange');

-- --------------------------------------------------------

--
-- Structure de la table `cardtypes`
--

CREATE TABLE `cardtypes` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cardtypes`
--

INSERT INTO `cardtypes` (`id`, `label`, `color`) VALUES
(1, 'Rue de Vaugirard', 'lightblue'),
(2, 'Rue de Courcelles', 'lightblue'),
(3, 'Avenue de la République', 'lightblue'),
(4, 'Rue Lecourbe', 'brown'),
(5, 'Boulevard de Belleville', 'brown'),
(6, 'Boulevard de la Villette', 'magenta'),
(7, 'Avenue de Neuilly', 'magenta'),
(8, 'Rue de Paradis', 'magenta'),
(9, 'Avenue Mozart', 'orange'),
(10, 'Boulevard Saint-Michel', 'orange'),
(11, 'Place Pigalle', 'orange'),
(12, 'Avenue Matignon', 'red'),
(13, 'Boulevard Malesherbes', 'red'),
(14, 'Avenue Henri-Martin', 'red'),
(15, 'Faubourg Saint-Honoré', 'yellow'),
(16, 'Place de la Bourse', 'yellow'),
(17, 'Rue la Fayette', 'yellow'),
(18, 'Avenue de Breteuil', 'green'),
(19, 'Avenue Foch', 'green'),
(20, 'Boulevard des Capucines', 'green'),
(21, 'Avenue des Champs-Elysées', 'blue'),
(22, 'Rue de la Paix', 'blue');

-- --------------------------------------------------------

--
-- Structure de la table `connected`
--

CREATE TABLE `connected` (
  `ip` varchar(30) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `connected`
--

INSERT INTO `connected` (`ip`, `timestamp`) VALUES
('::1', 1465373078);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `idUser1` int(11) NOT NULL,
  `idUser2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `idConversation` int(11) NOT NULL,
  `body` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `idSender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `trades`
--

CREATE TABLE `trades` (
  `id` int(11) NOT NULL,
  `idTradeStatus` int(11) NOT NULL DEFAULT '0',
  `dateBegin` int(11) NOT NULL,
  `dateEnd` int(11) DEFAULT NULL,
  `idSeeker` int(11) DEFAULT NULL,
  `idGiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `trades`
--

INSERT INTO `trades` (`id`, `idTradeStatus`, `dateBegin`, `dateEnd`, `idSeeker`, `idGiver`) VALUES
(11, 3, 1465300422, 1465334774, NULL, 1),
(12, 3, 1465301004, 1465334774, NULL, 1),
(13, 3, 1465301191, 1465334774, NULL, 1),
(14, 2, 1465306822, NULL, 6, 1),
(15, 1, 1465313032, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tradestatus`
--

CREATE TABLE `tradestatus` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tradestatus`
--

INSERT INTO `tradestatus` (`id`, `label`) VALUES
(1, 'Proposé'),
(2, 'Rejoint'),
(3, 'Annulé par le donneur'),
(4, 'Refusé par le donneur'),
(5, 'Terminé avec succès'),
(6, 'Annulé par le participant');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_at` int(11) DEFAULT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `registered_at`, `admin`) VALUES
(1, 'Maxime', 'LUCAS', 'maxime.lucas96@gmail.com', '9c141468d5117247905ea6624a2689e9097f066f', 1464216005, 1),
(5, 'Camille', 'PORTELETTE', 'camille.05@live.fr', '9c141468d5117247905ea6624a2689e9097f066f', 1464216020, 0),
(6, 'Admin', 'ADMIN', 'admin@mail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1465321305, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cardsintrades`
--
ALTER TABLE `cardsintrades`
  ADD PRIMARY KEY (`idTrade`,`idCard`);

--
-- Index pour la table `cardstatus`
--
ALTER TABLE `cardstatus`
  ADD PRIMARY KEY (`idStatus`);

--
-- Index pour la table `cardtypes`
--
ALTER TABLE `cardtypes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `connected`
--
ALTER TABLE `connected`
  ADD PRIMARY KEY (`ip`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tradestatus`
--
ALTER TABLE `tradestatus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `cardstatus`
--
ALTER TABLE `cardstatus`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `cardtypes`
--
ALTER TABLE `cardtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `tradestatus`
--
ALTER TABLE `tradestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
