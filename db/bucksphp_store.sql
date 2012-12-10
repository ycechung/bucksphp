# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.20)
# Database: bucksphp_store
# Generation Time: 2012-12-10 02:10:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `title`, `body`, `created_at`)
VALUES
	(1,'About Us','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.\r\n\r\nLorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.\r\n\r\nLorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','2012-12-05 02:33:02'),
	(2,'Shipping Info','blah blah blah','2012-12-05 02:40:56');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `created_at`)
VALUES
	(1,'Walrus T-Shirt','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','http://www.cottonable.com/wp-content/uploads/2010/01/walrus-cartoon-tee-t-shirt-animal-illustration-apparel-clothing-mustache-fuzzy-ink-men.jpg',12.00,'2012-12-10 01:05:41'),
	(2,'Dolphin T-Shirt','Lorem ipsum adipisicing sint consequat do veniam ea.\r\n\r\n		Lorem ipsum dolore sit eu dolore ut est eiusmod.','http://www.animalshirts.net/dolphinshirts/10-3081.jpg',13.50,'2012-12-10 01:05:41'),
	(3,'Angry Leopard Seal','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','http://rlv.zcache.com/leopard_seal_vs_penguin_battle_tshirt-p235094727998853049z7of7_210.jpg',12.00,'2012-12-10 01:05:41'),
	(4,'\"Harry\" Otter Tee','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','http://2.bp.blogspot.com/-dYqVW-0sjaE/T7uM4QzX-HI/AAAAAAAAEew/M_PcTjVjT_U/s640/Harry+Otter.jpg',14.99,'2012-12-10 01:05:41'),
	(5,'Polar Bear Hoodie','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','http://www.toxel.com/wp-content/uploads/2009/07/hoodie06.jpg',34.99,'2012-12-10 01:05:41'),
	(6,'Porpoise Pun Tee','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','http://skreened.com/render-product/r/u/a/ruacboqgyfiugvwqfqas/for-all-intensive-porpoises-t-shirt.american-apparel-juniors-fitted-tee.light-blue.w760h760.jpg',16.00,'2012-12-10 01:05:41'),
	(7,'Another Otter t-shirt','Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.','',24.00,'2012-12-10 01:05:41'),
	(8,'New Shirt #1','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://images.t-shirts.com/ursus-maritimus-discoteque-front-hr.jpg',21.00,'2012-12-10 01:05:41'),
	(9,'New Shirt #2','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://www.popsci.com/files/imagecache/article_image_large/articles/PolarCasino_fullsize.jpg',18.00,'2012-12-10 01:05:41'),
	(10,'New Shirt #3','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://www.fhm.com/App_Media/Uploads/Images/Original/polar-bear-t-shirt.jpg',18.00,'2012-12-10 01:05:41'),
	(11,'New Shirt #4','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://image.spreadshirt.com/image-server/v1/products/18423414/views/1,width=378,height=378,appearanceId=347/humpback-whale-cute!-Kids--Shirts.png',24.00,'2012-12-10 01:05:41'),
	(12,'New Shirt #5','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://image.spreadshirt.com/image-server/v1/products/16493434/views/1,width=378,height=378,appearanceId=94/Chocolate-WHALING-HUMPBACK-WHALE-SHAPE-T-Shirts.png',20.00,'2012-12-10 01:05:41'),
	(13,'New Shirt #6','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://i1.cpcache.com/product/372988202/peace_love_save_the_whales_tshirt.jpg?height=380&width=380',23.00,'2012-12-10 01:05:41'),
	(14,'New Shirt #7','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://www.splitreason.com/Product_Images/448f523af3a5-xl.jpg',24.00,'2012-12-10 01:05:41'),
	(15,'New Shirt #8','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://wizardswardrobe.blogly.net/images/i_did_it_on_porpoise_tshirt-p235610925366058537qetf_328.jpg',22.00,'2012-12-10 01:05:41'),
	(16,'New Shirt #9','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://www.solidthreads.com/media/0a/a207920136e61cc1eb8542_m.jpg',19.00,'2012-12-10 01:05:41'),
	(17,'New Shirt #10','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://rlv.zcache.com/find_your_porpoise_rev_t_shirt-ra056236ee1f7453ebb4d187167cd61db_f0cjj_512.jpg',20.00,'2012-12-10 01:05:41'),
	(18,'New Shirt #11','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://farm3.staticflickr.com/2727/4476342383_41025631d5.jpg',18.00,'2012-12-10 01:05:41'),
	(19,'New Shirt #12','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://walrusnyc.com/work/wp-content/uploads/2009/12/three-walrus-moon-t-shirt.jpg',25.00,'2012-12-10 01:05:41'),
	(20,'New Shirt #13','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://1.bp.blogspot.com/_KCZIG-pJj1I/SQ1YDsR35XI/AAAAAAAADKE/_vFLeQL-iqo/s400/The+Walrus+vs+The+Eggmen+shirt.png',23.00,'2012-12-10 01:05:41'),
	(21,'New Shirt #14','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://www.teecraze.com/images/woot/walrus.jpg',27.00,'2012-12-10 01:05:41'),
	(22,'New Shirt #15','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://cdn.designbyhumans.com/design/4/3h3-640x480.jpg',20.00,'2012-12-10 01:05:41'),
	(23,'New Shirt #16','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://lib.store.yahoo.net/lib/yhst-11870311283124/manatee-hoodie-navy.gif',19.00,'2012-12-10 01:05:41'),
	(24,'New Shirt #17','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://25.media.tumblr.com/OdlXd8GB3m943auxKrckh6GRo1_500.png',24.00,'2012-12-10 01:05:41'),
	(25,'New Shirt #18','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://3.bp.blogspot.com/_rnmIIAHRXsw/Sorqlw5TT_I/AAAAAAAAAC0/njG73wduV94/s400/horiz.gif',18.00,'2012-12-10 01:05:41'),
	(26,'New Shirt #19','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://www.bluemanateebooks.com/files/images/manatee_logos/BooManateeScreenShotBig.png',21.00,'2012-12-10 01:05:41'),
	(27,'New Shirt #20','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://www.kingsroadmerch.com/files/image/original/3/0/9/3091.jpg',23.00,'2012-12-10 01:05:41'),
	(28,'New Shirt #21','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','http://i49.photobucket.com/albums/f297/lasagnacassidy/walrus-shirt.jpg',22.00,'2012-12-10 01:05:41'),
	(29,'New Shirt #22','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://media.hideyourarms.com/wp-content/uploads/2012/08/supermanatee.jpg',28.00,'2012-12-10 01:05:41'),
	(30,'New Shirt #23','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://robot6.comicbookresources.com/wp-content/uploads/2012/07/figblackmensffffff.jpg',28.00,'2012-12-10 01:05:41'),
	(31,'New Shirt #24','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://rlv.zcache.com/i_love_dugongs_t_shirts-r71314d361c4c4cc6b9837039efa2d6b2_f0ywz_512.jpg',20.00,'2012-12-10 01:05:41'),
	(32,'New Shirt #25','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://rlv.zcache.com/smiling_sea_lion_shirt-p235656091510505797zvna9_400.jpg',28.00,'2012-12-10 01:05:41'),
	(33,'New Shirt #26','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','http://www.polyvore.com/cgi/img-thing?.out=jpg&size=l&tid=43064644',23.00,'2012-12-10 01:05:41'),
	(34,'New Shirt #27','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://www.ineedmorelife.com/blog/wp-content/uploads/2008/03/seal.gif',24.00,'2012-12-10 01:05:41'),
	(35,'New Shirt #35','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','http://lib.store.yahoo.net/lib/yhst-11870311283124/otter-gold.gif',20.00,'2012-12-10 01:05:41'),
	(36,'New Shirt #36','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\r\n\r\n  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','  http://www.animalshirts.net/shirts/otter-shirt.jpg',24.00,'2012-12-10 01:05:41');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sizes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sizes`;

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `price_difference` decimal(10,2) NOT NULL DEFAULT '0.00',
  `product_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;

INSERT INTO `sizes` (`id`, `name`, `price_difference`, `product_id`, `weight`, `created_at`)
VALUES
	(1,'Small',-1.00,1,0,'2012-12-10 01:05:41'),
	(2,'Medium',0.00,1,100,'2012-12-10 01:05:41'),
	(3,'Large',0.00,1,200,'2012-12-10 01:05:41'),
	(4,'XL',0.00,1,300,'2012-12-10 01:05:41'),
	(5,'2XL',3.00,1,400,'2012-12-10 01:05:41'),
	(6,'Small',0.00,2,0,'2012-12-10 01:05:41'),
	(7,'Medium',0.00,2,100,'2012-12-10 01:05:41'),
	(8,'Large',0.00,2,200,'2012-12-10 01:05:41'),
	(9,'XL',0.00,2,300,'2012-12-10 01:05:41'),
	(10,'Small',0.00,3,0,'2012-12-10 01:05:41'),
	(11,'Medium',0.00,3,100,'2012-12-10 01:05:41'),
	(12,'Large',0.00,3,200,'2012-12-10 01:05:41'),
	(13,'XL',0.00,3,300,'2012-12-10 01:05:41'),
	(14,'Youth Large',0.00,4,0,'2012-12-10 01:05:41'),
	(15,'Small',0.00,4,100,'2012-12-10 01:05:41'),
	(16,'Medium',0.00,4,200,'2012-12-10 01:05:41'),
	(17,'Large',0.00,4,300,'2012-12-10 01:05:41'),
	(18,'XL',0.00,4,400,'2012-12-10 01:05:41'),
	(19,'Small',0.00,5,0,'2012-12-10 01:05:41'),
	(20,'Medium',0.00,5,100,'2012-12-10 01:05:41'),
	(21,'Large',0.00,5,200,'2012-12-10 01:05:41'),
	(22,'Small',0.00,6,0,'2012-12-10 01:05:41'),
	(23,'Medium',0.00,6,100,'2012-12-10 01:05:41'),
	(24,'Large',0.00,6,200,'2012-12-10 01:05:41'),
	(25,'XL',0.00,6,300,'2012-12-10 01:05:41'),
	(26,'2XL',1.00,6,400,'2012-12-10 01:05:41'),
	(27,'3XL',2.00,6,500,'2012-12-10 01:05:41'),
	(28,'Small',0.00,7,0,'2012-12-10 01:05:41'),
	(29,'Medium',0.00,7,100,'2012-12-10 01:05:41'),
	(30,'Large',0.00,7,200,'2012-12-10 01:05:41'),
	(31,'Small',0.00,8,0,'2012-12-10 01:05:41'),
	(32,'Medium',0.00,8,100,'2012-12-10 01:05:41'),
	(33,'Large',0.00,8,200,'2012-12-10 01:05:41'),
	(34,'Youth Large',0.00,9,0,'2012-12-10 01:05:41'),
	(35,'Small',0.00,9,100,'2012-12-10 01:05:41'),
	(36,'Medium',0.00,9,200,'2012-12-10 01:05:41'),
	(37,'Large',0.00,9,300,'2012-12-10 01:05:41'),
	(38,'XL',0.00,9,400,'2012-12-10 01:05:41'),
	(39,'Small',0.00,10,0,'2012-12-10 01:05:41'),
	(40,'Medium',0.00,10,100,'2012-12-10 01:05:41'),
	(41,'Large',0.00,10,200,'2012-12-10 01:05:41'),
	(42,'Youth Large',0.00,11,0,'2012-12-10 01:05:41'),
	(43,'Small',0.00,11,100,'2012-12-10 01:05:41'),
	(44,'Medium',0.00,11,200,'2012-12-10 01:05:41'),
	(45,'Large',0.00,11,300,'2012-12-10 01:05:41'),
	(46,'XL',0.00,11,400,'2012-12-10 01:05:41'),
	(47,'Small',0.00,12,0,'2012-12-10 01:05:41'),
	(48,'Medium',0.00,12,100,'2012-12-10 01:05:41'),
	(49,'Large',0.00,12,200,'2012-12-10 01:05:41'),
	(50,'XL',0.00,12,300,'2012-12-10 01:05:41'),
	(51,'Small',0.00,13,0,'2012-12-10 01:05:41'),
	(52,'Medium',0.00,13,100,'2012-12-10 01:05:41'),
	(53,'Large',0.00,13,200,'2012-12-10 01:05:41'),
	(54,'XL',0.00,13,300,'2012-12-10 01:05:41'),
	(55,'Small',0.00,14,0,'2012-12-10 01:05:41'),
	(56,'Medium',0.00,14,100,'2012-12-10 01:05:41'),
	(57,'Large',0.00,14,200,'2012-12-10 01:05:41'),
	(58,'XL',0.00,14,300,'2012-12-10 01:05:41'),
	(59,'2XL',1.00,14,400,'2012-12-10 01:05:41'),
	(60,'3XL',2.00,14,500,'2012-12-10 01:05:41'),
	(61,'Small',0.00,15,0,'2012-12-10 01:05:41'),
	(62,'Medium',0.00,15,100,'2012-12-10 01:05:41'),
	(63,'Large',0.00,15,200,'2012-12-10 01:05:41'),
	(64,'Small',0.00,16,0,'2012-12-10 01:05:41'),
	(65,'Medium',0.00,16,100,'2012-12-10 01:05:41'),
	(66,'Large',0.00,16,200,'2012-12-10 01:05:41'),
	(67,'XL',0.00,16,300,'2012-12-10 01:05:41'),
	(68,'2XL',1.00,16,400,'2012-12-10 01:05:41'),
	(69,'3XL',2.00,16,500,'2012-12-10 01:05:41'),
	(70,'Youth Large',0.00,17,0,'2012-12-10 01:05:41'),
	(71,'Small',0.00,17,100,'2012-12-10 01:05:41'),
	(72,'Medium',0.00,17,200,'2012-12-10 01:05:41'),
	(73,'Large',0.00,17,300,'2012-12-10 01:05:41'),
	(74,'XL',0.00,17,400,'2012-12-10 01:05:41'),
	(75,'Small',0.00,18,0,'2012-12-10 01:05:41'),
	(76,'Medium',0.00,18,100,'2012-12-10 01:05:41'),
	(77,'Large',0.00,18,200,'2012-12-10 01:05:41'),
	(78,'Small',0.00,19,0,'2012-12-10 01:05:41'),
	(79,'Medium',0.00,19,100,'2012-12-10 01:05:41'),
	(80,'Large',0.00,19,200,'2012-12-10 01:05:41'),
	(81,'Small',0.00,20,0,'2012-12-10 01:05:41'),
	(82,'Medium',0.00,20,100,'2012-12-10 01:05:41'),
	(83,'Large',0.00,20,200,'2012-12-10 01:05:41'),
	(84,'XL',0.00,20,300,'2012-12-10 01:05:41'),
	(85,'Small',0.00,21,0,'2012-12-10 01:05:41'),
	(86,'Medium',0.00,21,100,'2012-12-10 01:05:41'),
	(87,'Large',0.00,21,200,'2012-12-10 01:05:41'),
	(88,'XL',0.00,21,300,'2012-12-10 01:05:41'),
	(89,'Small',0.00,22,0,'2012-12-10 01:05:41'),
	(90,'Medium',0.00,22,100,'2012-12-10 01:05:41'),
	(91,'Large',0.00,22,200,'2012-12-10 01:05:41'),
	(92,'XL',0.00,22,300,'2012-12-10 01:05:41'),
	(93,'Small',0.00,23,0,'2012-12-10 01:05:41'),
	(94,'Medium',0.00,23,100,'2012-12-10 01:05:41'),
	(95,'Large',0.00,23,200,'2012-12-10 01:05:41'),
	(96,'XL',0.00,23,300,'2012-12-10 01:05:41'),
	(97,'Small',0.00,24,0,'2012-12-10 01:05:41'),
	(98,'Medium',0.00,24,100,'2012-12-10 01:05:41'),
	(99,'Large',0.00,24,200,'2012-12-10 01:05:41'),
	(100,'Small',0.00,25,0,'2012-12-10 01:05:41'),
	(101,'Medium',0.00,25,100,'2012-12-10 01:05:41'),
	(102,'Large',0.00,25,200,'2012-12-10 01:05:41'),
	(103,'XL',0.00,25,300,'2012-12-10 01:05:41'),
	(104,'Small',0.00,26,0,'2012-12-10 01:05:41'),
	(105,'Medium',0.00,26,100,'2012-12-10 01:05:41'),
	(106,'Large',0.00,26,200,'2012-12-10 01:05:41'),
	(107,'XL',0.00,26,300,'2012-12-10 01:05:41'),
	(108,'Small',0.00,27,0,'2012-12-10 01:05:41'),
	(109,'Medium',0.00,27,100,'2012-12-10 01:05:41'),
	(110,'Large',0.00,27,200,'2012-12-10 01:05:41'),
	(111,'Small',0.00,28,0,'2012-12-10 01:05:41'),
	(112,'Medium',0.00,28,100,'2012-12-10 01:05:41'),
	(113,'Large',0.00,28,200,'2012-12-10 01:05:41'),
	(114,'Small',0.00,29,0,'2012-12-10 01:05:41'),
	(115,'Medium',0.00,29,100,'2012-12-10 01:05:41'),
	(116,'Large',0.00,29,200,'2012-12-10 01:05:41'),
	(117,'XL',0.00,29,300,'2012-12-10 01:05:41'),
	(118,'Small',0.00,30,0,'2012-12-10 01:05:41'),
	(119,'Medium',0.00,30,100,'2012-12-10 01:05:41'),
	(120,'Large',0.00,30,200,'2012-12-10 01:05:41'),
	(121,'XL',0.00,30,300,'2012-12-10 01:05:41'),
	(122,'Small',0.00,31,0,'2012-12-10 01:05:41'),
	(123,'Medium',0.00,31,100,'2012-12-10 01:05:41'),
	(124,'Large',0.00,31,200,'2012-12-10 01:05:41'),
	(125,'XL',0.00,31,300,'2012-12-10 01:05:41'),
	(126,'Small',0.00,32,0,'2012-12-10 01:05:41'),
	(127,'Medium',0.00,32,100,'2012-12-10 01:05:41'),
	(128,'Large',0.00,32,200,'2012-12-10 01:05:41'),
	(129,'Small',0.00,33,0,'2012-12-10 01:05:41'),
	(130,'Medium',0.00,33,100,'2012-12-10 01:05:41'),
	(131,'Large',0.00,33,200,'2012-12-10 01:05:41'),
	(132,'XL',0.00,33,300,'2012-12-10 01:05:41'),
	(133,'2XL',1.00,33,400,'2012-12-10 01:05:41'),
	(134,'3XL',2.00,33,500,'2012-12-10 01:05:41'),
	(135,'Small',0.00,34,0,'2012-12-10 01:05:41'),
	(136,'Medium',0.00,34,100,'2012-12-10 01:05:41'),
	(137,'Large',0.00,34,200,'2012-12-10 01:05:41'),
	(138,'XL',0.00,34,300,'2012-12-10 01:05:41'),
	(139,'Small',0.00,35,0,'2012-12-10 01:05:41'),
	(140,'Medium',0.00,35,100,'2012-12-10 01:05:41'),
	(141,'Large',0.00,35,200,'2012-12-10 01:05:41'),
	(142,'Youth Large',0.00,36,0,'2012-12-10 01:05:41'),
	(143,'Small',0.00,36,100,'2012-12-10 01:05:41'),
	(144,'Medium',0.00,36,200,'2012-12-10 01:05:41'),
	(145,'Large',0.00,36,300,'2012-12-10 01:05:41'),
	(146,'XL',0.00,36,400,'2012-12-10 01:05:41');

/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
