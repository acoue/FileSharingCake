-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 21 Janvier 2015 à 22:42
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
  PRIMARY KEY (`id`),
  KEY `images_users_fk` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'COUE', 'Anthony', 'admin', 'a2df76c0ecb3c21bc83cb57c67c90c95a0066c8d', 'admin', '2015-01-10 18:13:54', '2015-01-21 19:59:34');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
--
-- Contenu de la table `users`
--
INSERT INTO users(username,nom,prenom,role,password) values
('alainbodin@free.fr','BODIN','Alain','user','dfb6dea467bdf9baf2a353674d656fa5b317b6f7'),
('apns77@free.fr','AUBIN','Arnaud','admin','a02fe704452786e47d952df041c09e2c57b39c73'),
('bat.diver77@gmail.com','MOREAU','Xavier','user','02b31ddf80a3740633fedad0c44bda49e293951a'),
('calliope35@hotmail.com','CAUWET','Camille','user','98829ad38f3fe82036e0cac5bfcd0b1b63b828b7'),
('christian-lafont@ovi.com','LAFONT','Christian','user','c35c663c4a1e55a1bc9950e6a0bc4a7cb959cd0a'),
('crixos.inwe@orange.fr','DEVIVIER','Grégory','user','b60205fc9f61aef0df0257a16a562fd36b69e43d'),
('croux77@gmail.com','ROUX','Christelle','user','01057bd4e84342e703e4d5a4258b3718b3f3a6ba'),
('f0edx@9online.fr','SOARES','Norbert','user','28669f8d1e79579ea99dc25366a62b19616245ec'),
('fjbdp@msn.com','JEAN-BAPTISTE','Frédéric','user','f61e84f62fa04d64573f8576548399169050282d'),
('frederic.david77@free.fr','DAVID','Frédéric','user','0526c031ef652ef5ea09fdf13be58687d8c5fb41'),
('gormeaux@gmail.com','ORMEAUX','Guy','user','48de4d9b1e93811e19bdffd3538b19d90196304c'),
('guillaume_wallym@hotmail.fr','WALLYN','Guillaume','user','e877af37bf02ccec440b15a513cc553798d12528'),
('ingrid.contassot@gmail.com','CONTASSOT','Ingrid','user','b462224752f578ee00d27f012da8d94007b55804'),
('jeanpierre2711@free.fr','PETIT','Jean-Pierre','user','4ffaf7a8df8f20eec5bd1c2662b7a28cee5ca319'),
('jeremy.cohen@jrmc.fr','COHEN','Jéremy','user','c71a2b7c09d669016e5486c14572b4cc5d26ed42'),
('jeromecaussinus@gmail.com','CAUSSINUS','Jérome','user','1fd940b1e4e94d9c1a86f65a85a13c8f7430ee3a'),
('jl.geneste@free.fr','GENESTE','Jean-Louis','user','7cd6e8037d54e994b509befb5c0c4113789d8476'),
('jpbouyge@free.fr','BOUYGE','Jean-Pierre','user','2d1f03cfd21bfab6b8438ee7036020431f20a34c'),
('laetitia.leite@hotmail.fr','LEITE','Laetitia','user','58bebd424ffa3983880598ca500d2568657428ec'),
('lexa.vieira@gmail.com','VIEIRA','Alexande','admin','2d9699d5939edff570db8a2090172bb346a3495e'),
('marie-laure.bar@hotmail.fr','BARNOLE','Marie-Laure','user','e7d98c61b782e36b5ccbf22b1c7a0be0294d631c'),
('martinebaynaud@hotmail.com','BAYNAUD','Martine','user','628d5c0f25eb222eac9fc713ab945d4f6912345f'),
('mavaado@gmail.com','PETITJEAN','Marie','user','689975e1d6e77b2f563e535ac94b9fc7d9a145a0'),
('mbebe77@gmail.com','CAYLA','Bérangère','user','2af2f3efedc50d444758758ab7f3afcdacbbddc6'),
('nathalie.triches@free.fr','TRICHES','Nathalie','user','40188caba26421a6d82031a24bea3cc16bb38b67'),
('olivier.desmet77@gmail.com','DESMET','Olivier','user','cd553e9ce20beea37ef55dffbfad20ad6d4035fc'),
('patroques@wanadoo.fr','ROQUES','Patrick','user','f639952b72df44afba39db1e9d705d79aebdc8c4'),
('philippe.gobry@orange.fr','GOBRY','Philippe','user','5da3b555664394757aa211190b28a6219445d262'),
('phirgen@hotmail.fr','GINER','Dominique','user','54b658a114e6761dd9fa8eb7bab001f8db02e6e9'),
('photo@channs.com','CHALANT','Stéphane','user','af9c2ae8f97fc64d8648d6a355bfa2f37012e595'),
('salvatoredamien@gmail.com','SALVATORE','Damien','user','eec02fab08713473ec5a42e3f6c0ffd06cbd196e'),
('sandrine_w@hotmail.fr','WALLYN','Sandrine','user','ca9da94d6c29a036a1bbd284e5ed42066a1f2362'),
('saradim@wanadoo.fr','DIMITRIPOULOS','Sarah','user','f99d6d17ebae5b24603c23cc161c9e1652b5d497'),
('schmidt.basile@onetouchent.com','SCHMIDT','Basile','user','803c7631d3e0dc33ee833f69a64c219d9cff4bdd'),
('soria.tep@gmail.com','TEP','Soria','user','6381d9b83b06e6af4284a51dd4ee43002f7a83ba'),
('stephane.cazorla@gmail.com','CAZORLA','Stéphane','user','0b15efee41eb4df47b961f4a68efe05742c1a79c'),
('sylvain.delaissez@free.fr','DELAISSEZ','Sylvain','user','57b3c429a6e6db05d7abe416478b2a42030368bf'),
('tactac77@gmail.com','CAYLA','Frédéric','user','2572d3d0b22b2e29cbe65e1ff1c538a3573c45ba'),
('teddy.ponimballon@yahoo.fr','PONIMBALLON','Teddy','user','0e9e514fb6e0c33d96fcd026df072b43f49c0ee7'),
('teton.serge@orange.fr','TETON','Serge','user','bdfa8995eeb876a811366e6bbfbe51a00f6bd444'),
('vevecarpiste@hotmail.fr','TANGUY','Hervé','user','cc4cc077d0880dc550e4f3020e9353df33aba760'),
('vince.ruggeri@free.fr','RUGGERI','Vincent','user','da054306a278ed0936d6084b0f3bd5282ad5f684'),
('yann.doree@free.fr','DOREE','Yann','user','4a09ae77bb1598c1d7c6d0f10c4b4d591d4af232'),
('yannsegalen@hotmail.fr','SEGALEN','Yann','user','665dd1b0c98842035f714eb54ff7fb60287ce58b');