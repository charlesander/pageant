CREATE TABLE `organisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(40) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `postal_code` varchar(40) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `organisation_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` smallint(1) DEFAULT '1',
  `created_on` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IX_organisation_id` (`organisation_id`),
  CONSTRAINT `fk_organisation_id` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `organisation` (`id`,`name`,`address1`,`address2`,`address3`,`city`,`country_id`,`postal_code`,`email`,`phone`,`web`,`created_on`,`created_by`,`updated_on`,`updated_by`,`deleted`) VALUES 
(1,'Deans Knight Capital Management','Suite 730 ','999 West Hastings','','Vancouver',127,'V6C 2W2',NULL,'+1 604 669 0212','https://www.example.com/','2000-05-04 00:00:00','NCNMigrate','2017-07-05 12:58:26','m.test@fundmap.com',0),
(2,'Towers Watson','60 Margaret Street','Level 14',NULL,'Sydney',173,'NSW 2000',NULL,'+61 2 9253 3333','https://www.example.com/','2014-11-20 16:44:26','VBelitski','2004-09-16 00:00:00','mmenon',0),
(3,'James Pappas Investment Counsel','5342 Sandhamn Place',NULL,NULL,'Longboat Key',61,'34228-2056',NULL,'2 942 587 9708','https://www.example.com/','2004-10-14 00:00:00','lmuratova','2011-05-16 00:00:00','rfortuna',0),
(4,'Vestar Capital Partners','245 Park Avenue','41st Floor',NULL,'New York',61,'10167',NULL,'2 212 351 1600','https://www.example.com/','1999-08-02 00:00:00','gchung','2013-03-18 19:43:44','wnegron',0),
(5,'Marsico Capital Management','1200 17th Street','Suite 1300','','Denver',61,'80202',NULL,'+1 888 860 8686','https://www.example.com/','2000-12-12 00:00:00','swall','2017-07-21 08:04:28','Henry',0),
(6,'Oak Forest Investment Management','10000 Memorial Drive','Suite 600',NULL,'Houston',61,'20817',NULL,'2 501 530 9201','','2004-10-13 00:00:00','lmuratova','2004-10-13 00:00:00','lmuratova',0),
(7,'Constantia Privatbank Aktiengesellschaft','Bankgasse 2',NULL,NULL,'Vienna',158,'A-1010',NULL,'43 1 536 160','https://www.example.com/','2001-01-11 00:00:00','swall','2004-06-04 00:00:00','bhagueny',0),
(8,'Renaissance Capital','Two Greenwich Plaza',NULL,NULL,'Greenwich',61,'06830-5424',NULL,'2 203 622 2978','https://www.example.com/','2004-10-15 00:00:00','lmuratova','2011-05-16 00:00:00','rfortuna',0),
(9,'Lighthouse Capital Management','10000 Memorial Drive','Suite 600',NULL,'Houston',61,'77024-3411',NULL,'2 713 688 6881','https://www.example.com/','2004-09-29 00:00:00','lmuratova','2005-01-25 00:00:00','lpope',0),
(10,'Invesco',NULL,7,'7800 East Union Avenue','Denver',61,'80237',NULL,'+2 503 930 6300','','2000-06-14 00:00:00','Charlton-Nauroth','2008-08-21 00:00:00','lpope',0);

INSERT INTO `organisation_contact` (`id`,`organisation_id`,`name`,`title`,`phone`,`email`,`active`,`created_on`,`created_by`,`updated_on`,`updated_by`,`deleted`) VALUES
(1,1,'James Pappas','Director of Marketing','2 942 587 3408',NULL,1,'2004-10-14 00:00:00','lmuratova','2004-10-14 00:00:00','lmuratova',0),
(2,2,'Norman W. Alpert','Founder, Managing Director','2 262 351 1600','test@vestarcap.com',1,'1999-08-02 00:00:00','gchung','2012-02-17 00:00:00','smuniz',1),
(3,2,'Daniel S. O\'Connell','Managing Director/Chief Executive Officer',NULL,NULL,1,'2012-02-17 00:00:00','smuniz','2012-02-17 00:00:00','smuniz',0),
(4,2,'Brendan J. Spillane','Managing Director/Corporate Chief Financial Officer',NULL,NULL,1,'2012-02-17 00:00:00','smuniz','2012-02-17 00:00:00','smuniz',0),
(5,2,'Ken O\'Keefe','Managing Director and COO',NULL,NULL,1,'2012-02-17 00:00:00','smuniz','2012-02-17 00:00:00','smuniz',0),
(6,2,'Steven Della Rocca','General Counsel and Managing Director ',NULL,NULL,0,'2012-02-17 00:00:00','smuniz','2012-02-17 00:00:00','smuniz',0),
(7,3,'Thomas F. Marsico','Chairman & CEO','2 503 454 5600',NULL,1,'2002-10-29 00:00:00','lpope','2005-02-09 00:00:00','lpope',0),
(8,4,'Jay M. Weistein','Director of Marketing','2 501 580 9201',NULL,1,'2004-10-13 00:00:00','lmuratova','2004-10-13 00:00:00','lmuratova',0),
(9,5,'Tuergen Lucasser','Fund Manager','2 406 234 8173',NULL,1,'2001-01-11 00:00:00','swall','2004-06-04 00:00:00','bhagueny',0),
(10,6,'Barbara Soldano','Client & Marketing Contact','2 203 672 2978',NULL,1,'2004-10-15 00:00:00','lmuratova','2004-10-15 00:00:00','lmuratova',0),
(11,6,'William H. Choice','Director of Marketing','2 713 688 7481',NULL,1,'2004-09-29 00:00:00','lmuratova','2004-09-29 00:00:00','lmuratova',0),
(12,7,'Tuergen Lucasser','Fund Manager','2 406 234 8173',NULL,1,'2001-01-11 00:00:00','swall','2004-06-04 00:00:00','bhagueny',0),
(13,7,'Laura Parsons','Marketing Contact','2 505 930 6300',NULL,1,'2000-06-14 00:00:00','Charlton-Nauroth','2000-06-14 00:00:00','Charlton-Nauroth',0);

