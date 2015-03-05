-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 20 Février 2015 à 17:02
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `filesharing`
--

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_users_fk` (`user_id`),
  KEY `images_tags_fk` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `online` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `online`, `created`, `modified`) VALUES
(1, 'Expo SAUVAGE', 1, '2015-02-18 23:26:34', '2015-02-20 17:06:06'),
(2, 'Prochaine projection au Club', 1, '2015-02-20 17:06:25', '2015-02-20 17:06:25'),
(3, 'Expo PRINGY', 0, '2015-02-20 17:06:41', '2015-02-20 17:06:41'),
(4, 'Expo Nandy', 0, '2015-02-20 17:07:01', '2015-02-20 17:07:01');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_USER` (`nom`,`prenom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'COUE', 'Anthony', 'admin', 'a2df76c0ecb3c21bc83cb57c67c90c95a0066c8d', 'admin', '2015-01-10 18:13:54', '2015-01-21 19:59:34'),
(2, 'BODIN', 'Alain', 'alainbodin@free.fr', 'dfb6dea467bdf9baf2a353674d656fa5b317b6f7', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'AUBIN', 'Arnaud', 'apns77@free.fr', 'a02fe704452786e47d952df041c09e2c57b39c73', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'MOREAU', 'Xavier', 'bat.diver77@gmail.com', '02b31ddf80a3740633fedad0c44bda49e293951a', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'CAUWET', 'Camille', 'calliope35@hotmail.com', '98829ad38f3fe82036e0cac5bfcd0b1b63b828b7', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'LAFONT', 'Christian', 'christian-lafont@ovi.com', 'c35c663c4a1e55a1bc9950e6a0bc4a7cb959cd0a', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'DEVIVIER', 'Grégory', 'crixos.inwe@orange.fr', 'b60205fc9f61aef0df0257a16a562fd36b69e43d', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ROUX', 'Christelle', 'croux77@gmail.com', '01057bd4e84342e703e4d5a4258b3718b3f3a6ba', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'SOARES', 'Norbert', 'f0edx@9online.fr', '28669f8d1e79579ea99dc25366a62b19616245ec', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'JEAN-BAPTISTE', 'Frédéric', 'fjbdp@msn.com', 'f61e84f62fa04d64573f8576548399169050282d', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'DAVID', 'Frédéric', 'frederic.david77@free.fr', '0526c031ef652ef5ea09fdf13be58687d8c5fb41', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'ORMEAUX', 'Guy', 'gormeaux@gmail.com', '48de4d9b1e93811e19bdffd3538b19d90196304c', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'WALLYN', 'Guillaume', 'guillaume_wallym@hotmail.fr', 'e877af37bf02ccec440b15a513cc553798d12528', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'CONTASSOT', 'Ingrid', 'ingrid.contassot@gmail.com', 'b462224752f578ee00d27f012da8d94007b55804', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'PETIT', 'Jean-Pierre', 'jeanpierre2711@free.fr', '4ffaf7a8df8f20eec5bd1c2662b7a28cee5ca319', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'COHEN', 'Jéremy', 'jeremy.cohen@jrmc.fr', 'c71a2b7c09d669016e5486c14572b4cc5d26ed42', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'CAUSSINUS', 'Jérome', 'jeromecaussinus@gmail.com', '1fd940b1e4e94d9c1a86f65a85a13c8f7430ee3a', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'GENESTE', 'Jean-Louis', 'jl.geneste@free.fr', '7cd6e8037d54e994b509befb5c0c4113789d8476', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BOUYGE', 'Jean-Pierre', 'jpbouyge@free.fr', '2d1f03cfd21bfab6b8438ee7036020431f20a34c', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'LEITE', 'Laetitia', 'laetitia.leite@hotmail.fr', '58bebd424ffa3983880598ca500d2568657428ec', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'VIEIRA', 'Alexande', 'lexa.vieira@gmail.com', '2d9699d5939edff570db8a2090172bb346a3495e', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BARNOLE', 'Marie-Laure', 'marie-laure.bar@hotmail.fr', 'e7d98c61b782e36b5ccbf22b1c7a0be0294d631c', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BAYNAUD', 'Martine', 'martinebaynaud@hotmail.com', '628d5c0f25eb222eac9fc713ab945d4f6912345f', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'PETITJEAN', 'Marie', 'mavaado@gmail.com', '689975e1d6e77b2f563e535ac94b9fc7d9a145a0', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'CAYLA', 'Bérangère', 'mbebe77@gmail.com', '2af2f3efedc50d444758758ab7f3afcdacbbddc6', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'TRICHES', 'Nathalie', 'nathalie.triches@free.fr', '40188caba26421a6d82031a24bea3cc16bb38b67', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'DESMET', 'Olivier', 'olivier.desmet77@gmail.com', 'cd553e9ce20beea37ef55dffbfad20ad6d4035fc', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'ROQUES', 'Patrick', 'patroques@wanadoo.fr', 'f639952b72df44afba39db1e9d705d79aebdc8c4', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'GOBRY', 'Philippe', 'philippe.gobry@orange.fr', '5da3b555664394757aa211190b28a6219445d262', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'GINER', 'Dominique', 'phirgen@hotmail.fr', '54b658a114e6761dd9fa8eb7bab001f8db02e6e9', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'CHALANT', 'Stéphane', 'photo@channs.com', 'af9c2ae8f97fc64d8648d6a355bfa2f37012e595', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'SALVATORE', 'Damien', 'salvatoredamien@gmail.com', 'eec02fab08713473ec5a42e3f6c0ffd06cbd196e', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'WALLYN', 'Sandrine', 'sandrine_w@hotmail.fr', 'ca9da94d6c29a036a1bbd284e5ed42066a1f2362', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'DIMITRIPOULOS', 'Sarah', 'saradim@wanadoo.fr', 'f99d6d17ebae5b24603c23cc161c9e1652b5d497', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'SCHMIDT', 'Basile', 'schmidt.basile@onetouchent.com', '803c7631d3e0dc33ee833f69a64c219d9cff4bdd', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'TEP', 'Soria', 'soria.tep@gmail.com', '6381d9b83b06e6af4284a51dd4ee43002f7a83ba', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'CAZORLA', 'Stéphane', 'stephane.cazorla@gmail.com', '0b15efee41eb4df47b961f4a68efe05742c1a79c', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'DELAISSEZ', 'Sylvain', 'sylvain.delaissez@free.fr', '57b3c429a6e6db05d7abe416478b2a42030368bf', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CAYLA', 'Frédéric', 'tactac77@gmail.com', '2572d3d0b22b2e29cbe65e1ff1c538a3573c45ba', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'PONIMBALLON', 'Teddy', 'teddy.ponimballon@yahoo.fr', '0e9e514fb6e0c33d96fcd026df072b43f49c0ee7', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'TETON', 'Serge', 'teton.serge@orange.fr', 'bdfa8995eeb876a811366e6bbfbe51a00f6bd444', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'TANGUY', 'Hervé', 'vevecarpiste@hotmail.fr', 'cc4cc077d0880dc550e4f3020e9353df33aba760', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'RUGGERI', 'Vincent', 'vince.ruggeri@free.fr', 'da054306a278ed0936d6084b0f3bd5282ad5f684', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'DOREE', 'Yann', 'yann.doree@free.fr', '4a09ae77bb1598c1d7c6d0f10c4b4d591d4af232', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'SEGALEN', 'Yann', 'yannsegalen@hotmail.fr', '665dd1b0c98842035f714eb54ff7fb60287ce58b', 'user', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_tags_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `images_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
