-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 oct. 2024 à 18:07
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
-- Base de données : `dashboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `firstname`, `created_at`, `updated_at`) VALUES
(14, 'kFriesen@yahoo.com', '[]', '$2y$13$0xCGfYdvlHY0v6/5Jj8JSOl2CVwutGD5vu26ZmeK95eN7f5g5x1Ye', 'Schamberger', 'Rozella', '2024-10-11 17:42:51', '2024-10-11 17:42:51'),
(15, 'Cheyanne18@Reynolds.com', '[]', '$2y$13$/XBmQ7vcyRT0H3m5RgPhUujqfT9pbOzhYH/E6eKRgH0gKCwBY9eWe', 'Schulist', 'Melisa', '2024-10-11 17:42:53', '2024-10-11 17:42:53'),
(16, 'Tyrique84@gmail.com', '[]', '$2y$13$5FQgKIuFmnP/nVPUBI7NpuARoF3fHPVU4MrQMQW7NDB3vjvxehy1K', 'Greenfelder', 'Ellsworth', '2024-10-11 17:42:54', '2024-10-11 17:42:54'),
(17, 'Von.Lavonne@Carter.com', '[]', '$2y$13$qOCjPjnzJS2EV7UyMvHj9u0Rz8QOYycmP0guEj.YWQG9jIGNf5xqy', 'Harber', 'Ruthe', '2024-10-11 17:42:56', '2024-10-11 17:42:56'),
(18, 'Cameron53@Shields.org', '[]', '$2y$13$rNoTUNQeZgxBK/XLQfI2zOjg1Q/VYShf5JfNPALyC8J97.p/o93VS', 'McGlynn', 'Vernice', '2024-10-11 17:42:58', '2024-10-11 17:42:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
