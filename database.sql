/*
SQLyog Ultimate v9.01 
MySQL - 5.6.17 : Database - larashop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`larashop` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `larashop`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_05_19_014556_entrust_setup_tables',1);

/*Table structure for table `option_general` */

DROP TABLE IF EXISTS `option_general`;

CREATE TABLE `option_general` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gen_store_name` varchar(255) DEFAULT NULL,
  `gen_store_val` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `option_general` */

insert  into `option_general`(`id`,`gen_store_name`,`gen_store_val`,`created_at`,`updated_at`) values (1,'store_url','http://www.opencart.com/','2015-05-29 12:58:43','2015-05-29 05:58:43'),(2,'store_name','adad','2015-05-29 12:58:44','2015-05-29 05:58:44'),(3,'store_owner','adad','2015-05-29 12:58:44','2015-05-29 05:58:44'),(4,'store_address','adad','2015-05-29 12:58:44','2015-05-29 05:58:44'),(5,'store_email','adadad@ada.com','2015-05-29 12:58:44','2015-05-29 05:58:44'),(6,'store_phone','adadad','2015-05-29 12:58:44','2015-05-29 05:58:44'),(7,'store_fax','adad','2015-05-29 12:58:45','2015-05-29 05:58:45'),(8,'store_logo','girl2.jpg','2015-05-29 12:58:45','2015-05-29 05:58:45');

/*Table structure for table `option_mail` */

DROP TABLE IF EXISTS `option_mail`;

CREATE TABLE `option_mail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mail_key` varchar(255) DEFAULT NULL,
  `mail_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `option_mail` */

insert  into `option_mail`(`id`,`mail_key`,`mail_value`,`created_at`,`updated_at`) values (1,'mail_driver','SMTP','2015-06-08 07:21:20','2015-06-08 00:21:20'),(2,'mail_host','','2015-06-08 07:21:20','2015-06-08 00:21:20'),(3,'mail_port','587','2015-06-08 07:21:20','2015-06-08 00:21:20'),(4,'mail_username','','2015-06-08 07:21:20','2015-06-08 00:21:20'),(5,'mail_password','','2015-06-08 07:21:21','2015-06-08 00:21:21'),(6,'mail_encryption','TLS','2015-06-08 07:21:21','2015-06-08 00:21:21');

/*Table structure for table `option_payment` */

DROP TABLE IF EXISTS `option_payment`;

CREATE TABLE `option_payment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `option_payment` */

insert  into `option_payment`(`id`,`payment_type`,`payment_status`,`payment_description`,`created_at`,`updated_at`) values (1,'credit_card','1','','2015-06-16 12:43:46','2015-06-08 20:11:07'),(2,'mandiri_clickpay','1',NULL,'2015-06-16 12:44:21','0000-00-00 00:00:00'),(3,'cimb_clicks','1',NULL,'2015-06-16 12:44:38','0000-00-00 00:00:00'),(4,'bank_transfer','1',NULL,'2015-06-16 12:57:18','0000-00-00 00:00:00'),(5,'bri_epay','1',NULL,'2015-06-16 12:58:14','0000-00-00 00:00:00'),(6,'telkomsel_cash','1',NULL,'2015-06-16 12:58:24','0000-00-00 00:00:00'),(7,'xl_tunai','1',NULL,'2015-06-16 12:58:38','0000-00-00 00:00:00'),(8,'echannel','1',NULL,'2015-06-16 12:58:49','0000-00-00 00:00:00'),(9,'bbm_money','1',NULL,'2015-06-16 12:58:52','0000-00-00 00:00:00'),(10,'cstore','1',NULL,'2015-06-16 12:59:02','0000-00-00 00:00:00');

/*Table structure for table `option_shipping` */

DROP TABLE IF EXISTS `option_shipping`;

CREATE TABLE `option_shipping` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ship_option_name` varchar(255) NOT NULL,
  `ship_option_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `option_shipping` */

insert  into `option_shipping`(`id`,`ship_option_name`,`ship_option_value`,`created_at`,`updated_at`) values (1,'enable_shipping','1','2015-06-08 06:45:34','2015-06-07 23:45:34'),(2,'shipping_method','jne,tiki,pos','2015-06-08 06:45:34','2015-06-07 23:45:34'),(3,'rajaongkir_key','c32c3ab9158c2a7d8558d7787c2ca919','2015-06-08 06:45:34','2015-06-07 23:45:34'),(4,'shipping_from','501','2015-06-08 06:45:35','2015-06-07 23:45:35');

/*Table structure for table `option_shop` */

DROP TABLE IF EXISTS `option_shop`;

CREATE TABLE `option_shop` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `shop_opt_name` varchar(255) DEFAULT NULL,
  `shop_opt_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `option_shop` */

insert  into `option_shop`(`id`,`shop_opt_name`,`shop_opt_value`,`created_at`,`updated_at`) values (1,'product_perpage_front','5','2015-06-03 04:02:53','2015-06-02 21:02:53'),(2,'product_perpage_admin','5','2015-06-03 04:02:54','2015-06-02 21:02:54'),(3,'display_mode','0','2015-06-03 04:02:54','2015-06-02 21:02:54'),(4,'category_product_count','0','2015-06-03 04:02:54','2015-06-02 21:02:54'),(5,'enable_slideshow','1','2015-06-03 04:06:18','0000-00-00 00:00:00'),(7,'share_button_product','0','2015-06-03 04:31:24','0000-00-00 00:00:00');

/*Table structure for table `option_social` */

DROP TABLE IF EXISTS `option_social`;

CREATE TABLE `option_social` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `social_key` varchar(255) DEFAULT NULL,
  `social_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `option_social` */

insert  into `option_social`(`id`,`social_key`,`social_value`,`created_at`,`updated_at`) values (1,'facebook','http://facebook.com/instagram','2015-06-08 03:24:27','2015-06-07 20:17:14'),(2,'twitter','http://twitter.com/syiewa','2015-06-08 02:25:54','2015-06-07 19:25:54'),(3,'instagram','http://instagram.com/syiewa','2015-06-08 02:25:54','2015-06-07 19:25:54'),(4,'google+','https://plus.google.com/syiewa','2015-06-08 02:25:54','2015-06-07 19:25:54');

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `payment_id` int(10) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `total_price` int(100) DEFAULT NULL,
  `comments` text,
  `shipping_type` varchar(255) DEFAULT NULL,
  `shipping_fee` varchar(255) DEFAULT NULL,
  `shipping_to` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `order` */

insert  into `order`(`id`,`order_id`,`user_id`,`payment_id`,`order_status`,`created_at`,`updated_at`,`total_price`,`comments`,`shipping_type`,`shipping_fee`,`shipping_to`) values (10,NULL,11,NULL,NULL,'2015-06-18 02:48:50','2015-06-18 02:48:50',103000,NULL,'jne-CTC-4000','3000','419'),(11,1,11,3,'settlement','2015-06-18 09:54:38','2015-06-18 02:54:38',104000,NULL,'jne-CTC-4000','4000','419');

/*Table structure for table `order_product` */

DROP TABLE IF EXISTS `order_product`;

CREATE TABLE `order_product` (
  `order_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `order_product` */

insert  into `order_product`(`order_id`,`product_id`,`quantity`) values (9,26,1),(10,26,1),(11,26,1);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) DEFAULT NULL,
  `page_slug` varchar(100) DEFAULT NULL,
  `page_type` varchar(10) DEFAULT NULL,
  `page_status` int(11) DEFAULT '0',
  `page_position` enum('top','bottom') DEFAULT 'top',
  `page_order` int(11) DEFAULT '0',
  `page_parent` int(11) DEFAULT '0',
  `page_content` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`page_name`,`page_slug`,`page_type`,`page_status`,`page_position`,`page_order`,`page_parent`,`page_content`,`created_at`,`updated_at`) values (9,'Privacy Policy','privacy-policy','page',1,'bottom',0,0,'<span style=\"font-weight: bold;\">PRIVACY STATEMENT</span><br><br><br><br>----<br><br><br><br>SECTION 1 - WHAT DO WE DO WITH YOUR INFORMATION?<br><br><br><br>When you purchase something from our store, as part of the buying and selling process, we collect the personal information you give us such as your name, address and email address.<br><br>When you browse our store, we also automatically receive your computer’s internet protocol (IP) address in order to provide us with information that helps us learn about your browser and operating system.<br><br>Email marketing (if applicable): With your permission, we may send you emails about our store, new products and other updates.<br><br><br><br>SECTION 2 - CONSENT<br><br><br><br>How do you get my consent?<br><br>When you provide us with personal information to complete a transaction, verify your credit card, place an order, arrange for a delivery or return a purchase, we imply that you consent to our collecting it and using it for that specific reason only.<br><br>If we ask for your personal information for a secondary reason, like marketing, we will either ask you directly for your expressed consent, or provide you with an opportunity to say no.<br><br><br><br>How do I withdraw my consent?<br><br>If after you opt-in, you change your mind, you may withdraw your consent for us to contact you, for the continued collection, use or disclosure of your information, at anytime, by contacting us at support@shopify.com or mailing us at: Shopify 126 York Street, Suite 200 Ottawa Ontario Canada K1N 5T5<br><br><br>SECTION 3 - DISCLOSURE<br><br><br><br>We may disclose your personal information if we are required by law to do so or if you violate our Terms of Service.<br><br><br><br>SECTION 4 - SHOPIFY<br><br><br><br>Our store is hosted on Shopify Inc. They provide us with the online e-commerce platform that allows us to sell our products and services to you.<br><br>Your data is stored through Shopify’s data storage, databases and the general Shopify application. They store your data on a secure server behind a firewall.<br><br><br><br>Payment:<br><br>If you choose a direct payment gateway to complete your purchase, then Shopify stores your credit card data. It is encrypted through the Payment Card Industry Data Security Standard (PCI-DSS). Your purchase transaction data is stored only as long as is necessary to complete your purchase transaction. After that is complete, your purchase transaction information is deleted.<br><br>All direct payment gateways adhere to the standards set by PCI-DSS as managed by the PCI Security Standards Council, which is a joint effort of brands like Visa, MasterCard, American Express and Discover.<br><br>PCI-DSS requirements help ensure the secure handling of credit card information by our store and its service providers.<br><br>For more insight, you may also want to read Shopify’s Terms of Service here or Privacy Statement here.<br><br><br><br>SECTION 5 - THIRD-PARTY SERVICES<br><br><br><br>In general, the third-party providers used by us will only collect, use and disclose your information to the extent necessary to allow them to perform the services they provide to us.<br><br>However, certain third-party service providers, such as payment gateways and other payment transaction processors, have their own privacy policies in respect to the information we are required to provide to them for your purchase-related transactions.<br><br>For these providers, we recommend that you read their privacy policies so you can understand the manner in which your personal information will be handled by these providers.<br><br>In particular, remember that certain providers may be located in or have facilities that are located a different jurisdiction than either you or us. So if you elect to proceed with a transaction that involves the services of a third-party service provider, then your information may become subject to the laws of the jurisdiction(s) in which that service provider or its facilities are located.<br><br>As an example, if you are located in Canada and your transaction is processed by a payment gateway located in the United States, then your personal information used in completing that transaction may be subject to disclosure under United States legislation, including the Patriot Act.<br><br>Once you leave our store’s website or are redirected to a third-party website or application, you are no longer governed by this Privacy Policy or our website’s Terms of Service. <br><br><br><br>Links<br><br>When you click on links on our store, they may direct you away from our site. We are not responsible for the privacy practices of other sites and encourage you to read their privacy statements.<br><br>SECTION 6 - SECURITY<br><br><br><br>To protect your personal information, we take reasonable precautions and follow industry best practices to make sure it is not inappropriately lost, misused, accessed, disclosed, altered or destroyed.<br><br>If you provide us with your credit card information, the information is encrypted using secure socket layer technology (SSL) and stored with a AES-256 encryption.&nbsp; Although no method of transmission over the Internet or electronic storage is 100% secure, we follow all PCI-DSS requirements and implement additional generally accepted industry standards.<br><br><br><br>SECTION 7 - COOKIES<br><br><br><br>&nbsp;Here is a list of cookies that we use. We’ve listed them here so you that you can choose if you want to opt-out of cookies or not.<br><br>&nbsp;_session_id, unique token, sessional, Allows Shopify to store information about your session (referrer, landing page, etc).<br><br>&nbsp;_shopify_visit, no data held, Persistent for 30 minutes from the last visit, Used by our website provider’s internal stats tracker to record the number of visits<br><br>&nbsp;_shopify_uniq, no data held, expires midnight (relative to the visitor) of the next day, Counts the number of visits to a store by a single customer.<br><br>cart, unique token, persistent for 2 weeks, Stores information about the contents of your cart.<br><br>&nbsp;_secure_session_id, unique token, sessional<br><br>&nbsp;storefront_digest, unique token, indefinite If the shop has a password, this is used to determine if the current visitor has access.<br><br><br><br><br><br>SECTION 8 - AGE OF CONSENT<br><br><br><br>&nbsp;By using this site, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence and you have given us your consent to allow any of your minor dependents to use this site.<br><br><br><br>SECTION 9 - CHANGES TO THIS PRIVACY POLICY<br><br><br><br>We reserve the right to modify this privacy policy at any time, so please review it frequently. Changes and clarifications will take effect immediately upon their posting on the website. If we make material changes to this policy, we will notify you here that it has been updated, so that you are aware of what information we collect, how we use it, and under what circumstances, if any, we use and/or disclose it.<br><br>If our store is acquired or merged with another company, your information may be transferred to the new owners so that we may continue to sell products to you.<br><br><br><br>QUESTIONS AND CONTACT INFORMATION<br><br><br><br>If you would like to: access, correct, amend or delete any personal information we have about you, register a complaint, or simply want more information contact our Privacy Compliance Officer at support@shopify.com or by mail at Shopify<br><br>[Re: Privacy Compliance Officer]<br><br>[126 York Street, Suite 200 Ottawa Ontario Canada K1N 5T5]<br><br>----','2015-05-11 06:07:28','2015-05-13 04:08:57'),(10,'Contact Us','contact-us','page',1,'top',2,0,'','2015-05-12 03:43:30','2015-05-13 07:04:48'),(11,'Blog','blog','page',1,'top',0,0,'<strong>Note:</strong> Be very careful when echoing content that is \r\nsupplied by users of your application. Always use the double curly brace\r\n syntax to escape any HTML entities in the content.','2015-05-12 03:49:09','2015-05-13 03:20:47'),(12,'About Us','blog/about-us','page',1,'top',1,0,'','2015-05-12 03:49:46','2015-05-13 07:04:48'),(13,'Terms of use','privacy-policy/terms-of-use','page',1,'bottom',0,9,'','2015-05-13 02:18:12','2015-05-13 04:33:16'),(14,'Refund Policy','privacy-policy/refund-policy','page',1,'bottom',1,9,'','2015-05-13 02:19:18','2015-05-13 04:33:16');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values (14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(22,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(30,3),(31,3),(32,3),(33,3),(34,3),(14,4),(15,4),(16,4),(17,4),(18,4),(19,4),(20,4),(21,4),(22,4),(23,4),(24,4),(25,4),(26,4),(27,4),(28,4),(29,4),(30,4),(31,4),(32,4),(33,4),(34,4);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (14,'page-read',NULL,NULL,'2015-05-19 07:13:15','2015-05-19 07:13:15'),(15,'page-create',NULL,NULL,'2015-05-19 07:13:15','2015-05-19 07:13:15'),(16,'page-update',NULL,NULL,'2015-05-19 07:13:15','2015-05-19 07:13:15'),(17,'page-delete',NULL,NULL,'2015-05-19 07:13:15','2015-05-19 07:13:15'),(18,'backend',NULL,NULL,'2015-05-20 03:53:35','2015-05-20 03:53:35'),(19,'product-read',NULL,NULL,'2015-05-21 01:58:57','2015-05-21 01:58:57'),(20,'product-create',NULL,NULL,'2015-05-21 01:58:58','2015-05-21 01:58:58'),(21,'product-update',NULL,NULL,'2015-05-21 01:58:58','2015-05-21 01:58:58'),(22,'product-delete',NULL,NULL,'2015-05-21 01:58:58','2015-05-21 01:58:58'),(23,'slideshow-read',NULL,NULL,'2015-05-21 01:58:58','2015-05-21 01:58:58'),(24,'slideshow-create',NULL,NULL,'2015-05-21 01:58:58','2015-05-21 01:58:58'),(25,'slideshow-update',NULL,NULL,'2015-05-21 01:58:58','2015-05-21 01:58:58'),(26,'slideshow-delete',NULL,NULL,'2015-05-21 01:58:59','2015-05-21 01:58:59'),(27,'category-read',NULL,NULL,'2015-05-21 01:58:59','2015-05-21 01:58:59'),(28,'category-create',NULL,NULL,'2015-05-21 01:58:59','2015-05-21 01:58:59'),(29,'category-update',NULL,NULL,'2015-05-21 01:58:59','2015-05-21 01:58:59'),(30,'category-delete',NULL,NULL,'2015-05-21 01:58:59','2015-05-21 01:58:59'),(31,'user-read',NULL,NULL,'2015-05-21 01:58:59','2015-05-21 01:58:59'),(32,'user-create',NULL,NULL,'2015-05-21 01:59:00','2015-05-21 01:59:00'),(33,'user-update',NULL,NULL,'2015-05-21 01:59:00','2015-05-21 01:59:00'),(34,'user-delete',NULL,NULL,'2015-05-21 01:59:00','2015-05-21 01:59:00');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_category` int(10) NOT NULL,
  `product_sku` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_description` text,
  `product_price` bigint(100) DEFAULT NULL,
  `product_status` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`id`,`id_category`,`product_sku`,`product_name`,`product_description`,`product_price`,`product_status`,`created_at`,`updated_at`,`slug`) values (23,7,'test','test 1','test',200000,1,'2015-05-05 05:55:54','2015-05-12 07:36:02','test-1'),(25,8,'1231','Madrid 4th','Madrid 4th',200000,1,'2015-05-05 07:38:02','2015-05-13 02:22:58','madrid-4th'),(26,8,'1212','Madrid Home','Madrid Home Warna Putih',100000,1,'2015-05-12 05:11:49','2015-05-12 05:11:49','jersey/la-liga/madrid-home'),(27,8,'221313','Madrid Away','',100000,1,'2015-05-12 07:05:11','2015-05-12 07:05:11','jersey/la-liga/madrid-away'),(28,8,'1231','Madrid 3rd','',100000,1,'2015-05-12 07:05:55','2015-05-12 07:05:55','jersey/la-liga/madrid-3rd');

/*Table structure for table `product_attr` */

DROP TABLE IF EXISTS `product_attr`;

CREATE TABLE `product_attr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_product` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `values` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `product_attr` */

insert  into `product_attr`(`id`,`id_product`,`name`,`values`,`created_at`,`updated_at`) values (24,23,'warna','biru,hijau,kuning','2015-05-12 07:36:02','2015-05-12 07:36:02'),(25,23,'ukuran','s,m,l,xl,xxl','2015-05-12 07:36:02','2015-05-12 07:36:02'),(26,25,'ukuran','S,M,L,XL,XXL','2015-05-13 02:22:58','2015-05-13 02:22:58');

/*Table structure for table `product_category` */

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `parent` int(10) DEFAULT '0',
  `order` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `slug` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `product_category` */

insert  into `product_category`(`id`,`name`,`parent`,`order`,`status`,`created_at`,`updated_at`,`slug`,`image`) values (7,'Jersey',0,0,1,'2015-05-12 12:04:15','2015-05-12 05:04:15','jersey',NULL),(8,'La Liga',7,0,1,'2015-05-12 12:06:48','2015-05-12 05:06:48','jersey/la-liga',NULL),(9,'Seri A',7,1,1,'2015-05-13 02:15:53','2015-05-13 02:15:53','jersey/seri-a',NULL),(10,'Sepatu',0,2,1,'2015-05-13 08:53:51','2015-05-13 08:53:51','sepatu',NULL),(11,'Sepatu Lari',10,3,1,'2015-05-13 08:54:23','2015-05-13 08:54:23','sepatu/sepatu-lari',NULL);

/*Table structure for table `product_img` */

DROP TABLE IF EXISTS `product_img`;

CREATE TABLE `product_img` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_product` int(10) DEFAULT NULL,
  `img_name` varchar(100) DEFAULT NULL,
  `path_thumb` varchar(100) DEFAULT NULL,
  `path_full` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `primary` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `product_img` */

insert  into `product_img`(`id`,`id_product`,`img_name`,`path_thumb`,`path_full`,`created_at`,`updated_at`,`primary`) values (14,22,'6jkxL.jpg','images/products/thumb/6jkxL.jpg','images/products/full/6jkxL.jpg','2015-05-05 04:36:32','2015-05-05 04:36:32',0),(17,25,'pixXL.jpg','images/products/thumb/pixXL.jpg','images/products/full/pixXL.jpg','2015-05-05 07:38:02','2015-05-05 07:38:02',0),(27,23,'vJxbG.jpg','images/products/thumb/vJxbG.jpg','images/products/full/vJxbG.jpg','2015-05-06 08:01:18','2015-05-06 08:01:18',0),(28,23,'h4gFM.jpg','images/products/thumb/h4gFM.jpg','images/products/full/h4gFM.jpg','2015-05-06 08:01:20','2015-05-06 08:01:20',0),(33,23,'3rJU7.jpg','images/products/thumb/3rJU7.jpg','images/products/full/3rJU7.jpg','2015-05-06 08:15:00','2015-05-06 08:15:00',0),(34,25,'emGp8.jpg','images/products/thumb/emGp8.jpg','images/products/full/emGp8.jpg','2015-05-13 02:23:31','2015-05-13 02:23:31',0),(35,25,'aA0bL.jpg','images/products/thumb/aA0bL.jpg','images/products/full/aA0bL.jpg','2015-05-13 02:23:50','2015-05-13 02:23:50',0);

/*Table structure for table `product_meta` */

DROP TABLE IF EXISTS `product_meta`;

CREATE TABLE `product_meta` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_description` text,
  `meta_keyword` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_product` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `product_meta` */

insert  into `product_meta`(`id`,`meta_title`,`meta_description`,`meta_keyword`,`created_at`,`updated_at`,`id_product`) values (10,'test','test','test','2015-05-07 07:05:12','2015-05-07 07:05:12',23);

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`user_id`,`role_id`) values (2,4),(6,4),(9,5);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) values (3,'owner','Project Owner Ndes','User is the owner of a given project','2015-05-19 02:49:23','2015-05-20 02:51:56'),(4,'admin','User Administrator','User is allowed to manage and edit other users','2015-05-19 02:49:23','2015-05-19 02:49:23'),(5,'customer','Customer','User Customer','2015-05-25 02:55:30','2015-05-25 02:55:30');

/*Table structure for table `slideshow` */

DROP TABLE IF EXISTS `slideshow`;

CREATE TABLE `slideshow` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ss_name` varchar(100) DEFAULT NULL,
  `ss_description` text,
  `ss_url` varchar(100) DEFAULT NULL,
  `ss_status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_order` int(10) DEFAULT NULL,
  `ss_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `slideshow` */

insert  into `slideshow`(`id`,`ss_name`,`ss_description`,`ss_url`,`ss_status`,`created_at`,`updated_at`,`ss_order`,`ss_image`) values (1,'E-SHOPPER','Slideshow number 1<br>','http://lara.shop/backend/slideshow/create',1,'2015-05-19 01:32:17','2015-05-19 01:32:17',1,'e-shopper.jpg');

/*Table structure for table `user_payment` */

DROP TABLE IF EXISTS `user_payment`;

CREATE TABLE `user_payment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `payment_code` int(10) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_payment` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(10) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mob_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`password`,`remember_token`,`activation_code`,`created_at`,`updated_at`,`status`,`username`,`avatar`,`provider`,`provider_id`,`phone`,`mob_phone`,`city`,`province`,`address`,`postal_code`) values (2,'admin',NULL,'ada@ada.com','$2y$10$OK6MOdj89yFJ3rXiIb9vyO7aQrUgzQLNzM7Mx8MabcYI5OmDtWO2i','sFWSxayqpmBRtqhPUyp86hzdxFA1HXNUOzaZEnf3DpU9p0DRoUOsdEH6nQ5K',NULL,'2015-05-19 03:00:32','2015-05-26 01:38:39',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'test 12345',NULL,'telo33@telo.com','',NULL,NULL,'2015-05-20 04:01:38','2015-05-20 04:08:00',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'Wasi Arnosa',NULL,'devil.syiewa@gmail.com','$2y$10$4xJ47eOcHvb.HqpAM32WxOG1CaufB5aryFP01kumUMJ8Xf.mc3uR6','OlZQ3hA1MLoNEZrwTyH1XMuDM51Rdn91iSQPtudZaBYCyprxbJArL9OmUm0d',NULL,'2015-05-22 08:04:42','2015-06-16 03:48:16',1,NULL,'https://graph.facebook.com/v2.2/1044947206/picture?type=normal',NULL,'1044947206','1414141','114141','','','address 1',NULL),(10,'Wasi Arnosa',NULL,NULL,'','Vjpji04YgcdimjOaNg85liT2ljY9ZjPK4jhArIII2H8dbKEIFObvVKy20h9O',NULL,'2015-05-25 03:58:58','2015-06-16 03:51:10',1,'Syiewa','http://pbs.twimg.com/profile_images/450900068724273152/IGbwH2oI_normal.jpeg',NULL,'63434803',NULL,NULL,NULL,NULL,NULL,NULL),(11,'telo','kampret','ada12@ada.com','$2y$10$hxTypSMnmiSjCKhFtltsN.mOOTiryjwU8NDY3ufBnbuVDt4rTLYne',NULL,'ABXhBH9zPwwYe4SlW5j5JXFJqxlt3q6CfnddyOaRT7TTqxePh1Wi3vIiaWIrada12@ada.com','2015-06-16 03:56:41','2015-06-18 02:52:40',1,NULL,NULL,NULL,NULL,'89183131','131313131','419','5','satu dua tiga',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
