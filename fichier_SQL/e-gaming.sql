-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 oct. 2022 à 09:17
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-gaming`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Souris'),
(2, 'Clavier'),
(6, 'Ecran'),
(5, 'Casque');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_prod` int NOT NULL,
  `id_session` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_panier`),
  KEY `id_user` (`id_user`),
  KEY `id_prod` (`id_prod`),
  KEY `id_session` (`id_session`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_user`, `id_prod`, `id_session`, `quantite`) VALUES
(35, 0, 8, '32hlkij6nm56mcjqm9euo9tflv', 3),
(32, 0, 8, 'pmme9fesbb4rgbsmatnolerqp5', 1),
(42, 1, 14, '1jdjjq6f7q8kk4a9kmt3i2ba4u', 2),
(30, 0, 16, 'vtku42672odp7tpr2blt5m8po1', 1),
(28, 0, 8, '10hfr8812utt33ldvp5c4g1446', 1),
(38, 0, 5, '32hlkij6nm56mcjqm9euo9tflv', 1),
(47, 1, 17, '1jdjjq6f7q8kk4a9kmt3i2ba4u', 2);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_prod` int NOT NULL AUTO_INCREMENT,
  `nom_prod` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `desc_prod` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `prix_prod` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `photo_prod` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_prod`, `nom_prod`, `desc_prod`, `prix_prod`, `photo_prod`, `id_categorie`) VALUES
(15, 'Razer naga', 'souris sans fil  2000dpi', '120', 'souris razer.jpg', 1),
(16, 'razer diamonback', 'souris filaire 200dpi', '65', 'souris razer2.jpg', 1),
(17, 'logitech g502', 'souris filaire 2000dpi professionel', '80', 'logitech g502.jpg', 1),
(18, 'logitech g302', 'g302 filaire 2000 dpi', '55', 'logitech g203.jpg', 1),
(19, 'logitech hero', 'souris gaming 2000dpi style icemat', '100', 'logitech hero.jpg', 1),
(20, 'Steelseries Bee', 'souris steelseries wireless 2000dpi', '95', 'steelseries bee.jpg', 1),
(21, 'Corsair X200', 'clavier gaming mécanique rétro-éclairé', '90', 'clavier corsair x200.jpg', 2),
(22, 'Corsair Pink', 'clavier gaming mécanique rétro-éclairé', '100', 'clavier corsair pink.jpg', 2),
(23, 'Corsair X500', 'clavier gaming mécanique rétro-éclairé', '120', 'clavier corsair x500.jpg', 2),
(24, 'Corsair retro', 'clavier gaming mécanique rétro-éclairé , un style rétro machine à écrire', '75', 'clavier logitech.jpg', 2),
(26, 'Corsaire Virtuoso', 'Casque gaming 7.1 filaire.', '80', 'casque corsaire virtuoso.jpg', 5),
(27, 'Corsair void', 'Casque gaming 7.1 filaire.', '100', 'casque corsair void.jpg', 5),
(28, 'Razer cat', 'Casque gaming 7.1 filaire.', '80', 'casque razer cat.jpg', 5),
(30, 'Asus E852', 'ecran gaming asus 144hz 1ms', '220', 'ecran asus e852.jpg', 6),
(31, 'BenQ h852', 'ecran benQ haute performance 1ms, 144hz.', '300', 'ecran benQ h852.jpg', 6),
(32, 'MSI T540', 'ecran gaming', '145', 'msi t540.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

DROP TABLE IF EXISTS `recuperation`;
CREATE TABLE IF NOT EXISTS `recuperation` (
  `id_rec` int NOT NULL AUTO_INCREMENT,
  `mail_rec` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `code` int NOT NULL,
  `confirme` int NOT NULL,
  PRIMARY KEY (`id_rec`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `prenom_user` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `mail_user` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `adresse_user` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `ville_user` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `postal_user` int NOT NULL,
  `password_user` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `mail_user`, `adresse_user`, `ville_user`, `postal_user`, `password_user`, `role`) VALUES
(1, 'romain', 'michel', 'romain@gmail.com', '4 rue gerin ricard', 'marseille', 13003, '$2y$10$/uuJqCffqpI2FSHWM67amuHPozhdYsDmzNiijIwJ4xsxytD.dyQgK', 'admin'),
(3, 'jean', 'valjean', 'jean@gmail.com', '4 rue de la rue', '', 0, '$2y$10$x6EQGe6Xv8wT5Y30XDQ1dOvFJLM1VDyZWzivEPPmFtRi9L/qdVL/S', 'user'),
(4, 'robert', 'robert', 'robert@gmail.com', '4 rue', '', 0, '$2y$10$8jBqPv.8UaCaWksUXa7jze2Wrtf3CxshjjQw/sfsbZgcl9udW8RJm', 'user'),
(6, 'jacques', 'jacques', 'jacques@gmail.com', 'rue jacques', '', 0, '$2y$10$d91XJYmqbvVMGoiDU3BYaO6XO7QiJ6sN8Hd2PFwqZRVXRpbpTLXUK', 'user'),
(7, 'henri', 'henri', 'henri@gmail.com', 'rue henri', '', 0, '$2y$10$2BShlPOK3Y0Js3CelpyDJ.Kj2Gf3qYAgfljpz/Sgnxf0EVNyTUGZW', 'user'),
(10, 'jean-jacques-robert-henri-pierre-paul', 'jean-jacques-robert-henri', 'jean-jacques-robert-henri@gmail.com', 'rue jean-jacques-robert-henri', '', 0, '$2y$10$1iwNRuLiPBuJAeHgRplbnu.Z1et7dsN9jbx257OULwCsV9Cx1kSyS', 'user'),
(11, 'sami', 'sami', 'sami@gmail.com', 'rue sami', '', 0, '$2y$10$UZ4rAoVGNHNWCudkA9u2x.DfsGkxdm0jp2qIzkccuIteBIFUD9RxS', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `user_session`
--

DROP TABLE IF EXISTS `user_session`;
CREATE TABLE IF NOT EXISTS `user_session` (
  `id_session` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `id_user` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_session`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `user_session`
--

INSERT INTO `user_session` (`id_session`, `id_user`, `created_at`) VALUES
('fk6rad8r3dde42l845i96bkbj3', 1, '2022-10-08 09:55:14'),
('7s396boan760k5m7sdgffrn0e1', 1, '2022-10-07 12:37:44'),
('9qvd3a20itn2q8h26rreeechel', 1, '2022-10-07 09:26:54'),
('ttfbetnk0e7r1pgr8k0iehcbc4', 1, '2022-10-06 18:26:56'),
('4eef0usokvi18g5os6gbdc1g5v', 3, '2022-10-06 18:04:28'),
('ciottbe9kmf80f944nm823q60n', 1, '2022-10-06 13:52:55'),
('pa23coqgvj9a7lvl0r687u1314', 1, '2022-10-06 09:57:54'),
('32hlkij6nm56mcjqm9euo9tflv', 1, '2022-10-05 12:56:08'),
('6uuj1rrvijaorb3ebmf1akt6nq', 1, '2022-10-04 16:47:17'),
('385c0n3vt9t2lb1r8ush0ea06s', 1, '2022-10-04 16:27:34'),
('353h4gkeesb0fian7u918pg0bj', 1, '2022-10-04 11:20:17'),
('pmme9fesbb4rgbsmatnolerqp5', 1, '2022-09-29 11:07:57'),
('d1qugard344eve5o74e7ghio53', 1, '2022-10-02 10:35:41'),
('krjimb63hb4udsnm5ul4iscc07', 3, '2022-10-02 09:42:54'),
('pu5vs59irkdk79inqvs8tqkhbe', 1, '2022-10-02 09:34:09'),
('rdd4d2tv0jb75884e0o2gnroid', 1, '2022-10-02 09:22:39'),
('0flo76rgu1frh65e2qob65hgo1', 1, '2022-09-30 12:59:45'),
('ds8oc4vf8av5m3c3jand51d82g', 1, '2022-09-30 12:00:54'),
('tfkgistkqjrhfvsovj1l1du399', 1, '2022-09-30 11:38:15'),
('5h9p7i9s7m6jl4eso1l0kqkomc', 1, '2022-09-30 11:29:42'),
('ld6l42sq20kj4aqfndqu23ngvt', 1, '2022-09-30 10:19:44'),
('tjpobvak3v7ggoofsp5g60pmau', 1, '2022-09-29 21:16:57'),
('v05ocegn5q0o6jjpgrvbs6v035', 1, '2022-09-29 11:15:11'),
('1jdjjq6f7q8kk4a9kmt3i2ba4u', 1, '2022-10-10 10:27:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
