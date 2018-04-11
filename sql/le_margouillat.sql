-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 11 avr. 2018 à 18:09
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `le_margouillat`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `summary` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `summary`) VALUES
(1, 'Réplique', 'Le Margouillat vous propose un très large choix de répliques Airsoft AEG, pompes, sniper ou répliques de poing. \r\nDans le but de vous apporter un maximum de satisfaction lors de vos parties d’Airsoft, celles-ci sont sélectionnées avec soin par l’équipe du margouillat, composée de joueurs avertis. \r\nRetrouvez les répliques Airsoft de type AK, M4 (HK416, AMOEBA, OCTARMS, LT595, G28, PAR MK3, CXP HOG et TRANSFORM4), G36, mais aussi des L85, des MP5, des SIG 552, des HK417, des répliques de soutien, et bien d\'autres..\r\n\r\nDécouvrez les plus grandes marques de l\'Airsoft tels que TOKYO MARUI, ICS, ARES, G&P, BO-MANUFACTURE ou encore VFC! '),
(2, 'Packs répliques', 'Dans cette catégorie, vous pourrez retrouver une selection de packs conféctionnés par nos soins, vous permettant d\'économiser en optant pour une réplique d\'airsoft fournie avec des accessoires et consommables indispensables sur le terrain pour vos parties à moindre coût !\r\nVous pourrez retrouver des packs sur les répliques d\'airsoft de poing fonctionnant à gaz ou CO2, fournis avec chargeurs, billes, holster, sparclettes et/ou bouteilles de gaz supplémentaires. \r\n\r\nLes répliques longues AEG et Sniper sont également concernées, elles aussi proposée avec des chargeurs, consommables et autres accessoires fournis pour une réduction sur le coût total de l\'ensemble.\r\n\r\nProfitez de tarifs avantageux sur vos marques préférées telles que ICS, KWC, ARES Amoeba, BO-Dynamics, Vega Force Company (VFC), G&G Armament, ASG, Tokyo Marui, Stark Arms, ainsi que d\'autres à venir !'),
(3, 'Accessoire', 'Le Margouillat vous propose un large choix d\'équipement pour votre réplique d\'airsoft. \r\nVous trouverez ainsi des poignées tactiques, lunettes de visée, visées holographiques, silencieux, lampes tactiques et de nombreux accessoires..\r\n \r\nDécouvrez également notre gamme de chargeurs high-cap, mid-cap ou low-cap adaptés à votre style de jeu.\r\nEquipez votre réplique d\'airsoft d\'une batterie LiPo ou NiMH avec un chargeur intelligent.\r\n \r\nRetrouvez nos marques phares telles que Night Evolution, UTG, AIM-O, King Arms, G&P, ICS, ARES, Vega Force Company (VFC), Tokyo Marui, Madbull, Swiss Arms...\r\n'),
(4, 'Equipement', 'Nous vous proposons dans cette rubrique tous les accessoires pour vous équiper dans les meilleurs conditions pour vos parties d\'airsoft. En premier lieu les protections occulaires, avec lunettes ou masques, indispensales et obligatoires pour jouer. \r\n\r\nVous pourrez ensuite choisir des gants, genouillères, casques, et autre protections corporelles. Une large gamme de vêtements de jeu pour l\'airsoft vous est également proposée. Vous trouverez aussi nos holsters, gilets ou vestes tactiques, et poches amovibles afin d\'avoir sur vous tout votre équipement lors de votre partie. \r\n \r\nIndispensable pour une bonne communication entre coéquipiers, nous vous proposons tout une gamme de talkie-walkies, ptt, casques et oreillettes.\r\n \r\nRetrouvez nos marques phares telles que CONDOR, 5.11 Tactical, Claw Gear, Flyye Industrie, Z-Tactical, Midland, Oakley, ESS, FMA, Vega Force Company (VFC), Mechanix, SHS, Leatherman, Guarder...\r\n'),
(5, 'Consommable', 'Retrouvez dans cette catégorie tous les consommables nécessaires pour la pratique de l\'Airsoft.\r\n\r\nDes billes bio ou plastique avec des marques comme XTREME PRECISION, BO-MANUFACTURE, RAIN, G&G ARMAMENT, SWISS ARMS, KIG ARMS ou traçantes comme les G&G ARMAMENT, MADBULL bien évidemment de différents grammages: 0.12 0.20 0.23 0.25 0.28 0.30 0.36 0.40 0.43 grammes.\r\n\r\nMais aussi des sparclettes de CO2, des bouteilles de gaz ou d\'entretien, idéal pour vos répliques d\'airsoft, à vous de choisir!'),
(6, 'Pièce d\'upgrate', 'Retrouvez dans cette catégorie toutes les pièces pour upgrader au mieux votre réplique!\r\nVous aurez le choix d\'équiper votre réplique avec des pièces internes de qualité qui augmenteront les performances et la fiabilité de celle-ci.\r\nDes canons de précision, des ressorts de puissances, des bearings, des pistons et des gears... vous trouverez toutes les pièces de votre réplique!\r\n \r\nNous vous conseillons des pièces internes de marque GUARDER, SHS, KANZEN, MADBULL, NINEBALL, LAYLAX et PDI.  ');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `product_category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `price` text NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `in_stock` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `image`, `product_category`, `title`, `content`, `price`, `is_published`, `in_stock`) VALUES
(1, '4c26b0f501f781b43f0f9241d77b513d.png', 1, 'Réplique FAMAS SV Tokyo Marui AEG', ' Le FAMAS est le fusil d\'assaut réglementaire des l\'armée Française depuis 1979. Sa conception Bullpup(chargeur à l\'arrière) lui permet de rester compact tout en étant équipé d\'un canon long. Il peut aussi bien être utilisé par les droitiers que les gauchers.\r\n \r\n Le fabriquant Tokyo Marui a conçu une très bonne réplique du FAMAS avec une finition ABS exemplaire pour une allure proche de l\'arme véritable. La version SV, qui n\'est autre que l\'évolution du modèle F1 proposé par la firme Japonaise, dispose d\'un garde allant du pistol-grip au garde main comme sur le modèle FAMAS G2.\r\n \r\n Facilement transportable grâce à sa poignée supérieure, il dispose également d\'une prise en main confortable avec son pistol grip ergonomique.', '289,00', 1, '10'),
(2, '29e48b729552621616d15c0a82f58016.png', 1, 'Réplique FAMAS F1 Nylon Fibre AEG', 'Le FAMAS F1 est le fusil d\'assaut réglementaire de l\'armée Française depuis 1979. Sa conception Bullpup (chargeur à l\'arrière) lui permet de rester compact tout en étant équipé d\'un canon long. Il peut aussi bien être utilisé par les droitiers que les gauchers.\r\n\r\nFacilement transportable grâce à sa poignée supérieure, il dispose également d\'une prise en main confortable grâce à sa crosse ergonomique. Le FAMAS est dôté d\'un Bipied rabattable incorporé conférant une meilleure stabilité lors des tirs lointains. On retrouve également un rail picatinny sous le canon afin d\'y greffer divers accessoires tactiques.\r\n\r\nCybergun revisite une de ses répliques phares en la proposant dans une version nylon fibre plus résistante et plus agréable au toucher pour de meilleures sensations sur le terrain !', '209,99', 1, '17'),
(4, 'f8af0bab23e8ab96d873acc7e40eec1f.png', 2, 'Pack RUDIS III Or SECUTOR Gaz / CO2', 'Ce pack est constitué d\'une réplique de poing airsoft GBB RUDIS III version noir et or. Vous pourrez par conséquent choisir un chargeur supplémentaire Gaz ou CO2et ainsi bénéficier dun tarif réduit. ', '220,80', 1, '12'),
(5, 'a63fc8c5d915e1f1a40f40e6c7499863.png', 2, 'Pack ultimate CZ Scorpion EVO.3 ASG', 'OPS-Store vous propose un pack Ultimate aventageux comprenant une réplique airsoft CZ Scorpion EVO.3 ASG, une batterie LiPo pour l\'alimenter, deux chargeurs 75 billes supplémentaires, un ressort M95 pour pouvoir jouer sur n\'importe quel scénario, ainsi qu\'une visée MRO AIM-O !', '469,90', 1, '3'),
(6, '54eb551059f626c9e2682813fff354a8.png', 3, 'Viseur point rouge FC-1 DE AIM', 'AIM-O propose un viseur point rouge tout en métal avec une finition parfaite et couleur Dark Earth. Ce Red Dot est court et l\'optique est à une hauteur de 3 cm, ce qui permet de l\'utiliser confortablement même avec un casque et un stalker.\r\n\r\nLe point rouge possède plusieurs niveaux de luminosité. Il est réglable en dérive et en rehausse grâce à 2 vis sur les cotés. Le viseur fonctionne avec une pile CR2032.', '64,90', 1, '4'),
(7, 'e0cf1f47118daebc5b16269099ad7347.png', 3, 'Chargeur 40 billes TR16 MBR 308 G&G', 'Chargeur d\'origine pour TR16 MBR 308 AEG de la marque G&G avec capacité de 40 billes. Il permet l\'arrêt automatique du tir quand il est vide. \r\n\r\nCe chargeur en ABS noir contient des cartouches factices de 7.62 mm. Idéal pour ne plus être à court de bille sur les terrains d\'airsoft.', '19,90', 1, '58'),
(8, '6cf7e97db3595534ba7691cdc074c2a5.png', 4, 'Gants M-Pact 3 Coqués Noir Mechanix', 'Paire de gants d\'intervention M-PACT 3 coqués noirs confortables et résistants, idéal pour la pratique de l\'airsoft !', '42,90', 1, '14');

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`) VALUES
(1, 'réplique longue', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_of_account` int(1) NOT NULL DEFAULT '0',
  `civility` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `address` text,
  `postal_code` varchar(5) NOT NULL,
  `country` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `type_of_account`, `civility`, `email`, `password`, `lastname`, `firstname`, `address`, `postal_code`, `country`, `birthday`, `is_admin`) VALUES
(4, 1, 0, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'admin', 'admin', 'admin', '2018-02-27', 1),
(5, 1, 0, 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', 'user', '00000', 'user', '1999-03-26', 0),
(8, 0, 1, 'cocolarpenteur@gmail.com', '2fe3f4742040e1dd4fe42051263fc398', 'larpenteur', 'Coralie', '3 square des sablons', '78160', 'Marly-le-Roi', '1999-01-08', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
