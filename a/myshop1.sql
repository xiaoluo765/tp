# Host: localhost  (Version: 5.5.47)
# Date: 2018-07-04 21:33:59
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "goods"
#

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `uname` varchar(20) NOT NULL COMMENT '名称',
  `type` char(32) NOT NULL COMMENT '类别',
  `count` int(11) DEFAULT NULL COMMENT '总数',
  `sale` int(11) DEFAULT NULL COMMENT '销量',
  `create_at` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "goods"
#

INSERT INTO `goods` VALUES (1,'3','3',333,3,1529583303),(2,'2','2',2,2,1529583685),(3,'234','3',32,34343,1529662816),(5,'453','2',45,45,1529665912),(6,'565656','3',3344443,34343,1529665927);

#
# Structure for table "home_user"
#

DROP TABLE IF EXISTS `home_user`;
CREATE TABLE `home_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `upwd` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `create_at` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `email` varchar(20) NOT NULL DEFAULT '',
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Data for table "home_user"
#

INSERT INTO `home_user` VALUES (1,'123456','e10adc3949ba59abbe56e057f20f883e',NULL,'222222@qq.com','/static/uploads/20180703/b2565682e2aa6d24063f30d335d85364.png'),(5,'1','c4ca4238a0b923820dcc509a6f75849b',NULL,'1@qq.com',NULL),(8,'zhangsna','96e79218965eb72c92a549dd5a330112',NULL,'133333@qq.com',NULL),(10,'1111','e10adc3949ba59abbe56e057f20f883e',NULL,'1111@qq.com',NULL),(12,'111111','96e79218965eb72c92a549dd5a330112',NULL,'133333@qq.com',NULL),(13,'liid','96e79218965eb72c92a549dd5a330112',NULL,'133333@qq.com','/static/uploads/20180704/1dc379f45425fd8ee7ba70949ee0393b.png'),(14,'zhangsan','96e79218965eb72c92a549dd5a330112',NULL,'133333@qq.com','/static/uploads/20180704/64d0e80d705e9938c7f8e9803a8432d4.png');

#
# Structure for table "shop_cate"
#

DROP TABLE IF EXISTS `shop_cate`;
CREATE TABLE `shop_cate` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `cname` varchar(200) NOT NULL COMMENT '类别名称',
  `pid` int(10) unsigned DEFAULT '0' COMMENT '上一级类别的ID',
  `path` varchar(200) DEFAULT '0,' COMMENT '所有上级类别ID',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cname` (`cname`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

#
# Data for table "shop_cate"
#

INSERT INTO `shop_cate` VALUES (1,'手机 电话卡',0,'0,'),(2,'电视 盒子',0,'0,'),(3,'笔记本',0,'0,'),(4,'智能 家电',0,'0,'),(5,'健康 家居',0,'0,'),(6,'出行 儿童',0,'0,'),(7,'路由器 手机配件',0,'0,'),(8,'移动电源 插线板',0,'0,'),(9,'耳机 音箱',0,'0,'),(10,'生活 米兔',0,'0,'),(11,'图',0,'0,'),(13,'小米手机',1,'0,1,'),(14,'红米手机',1,'0,1,'),(15,'米粉卡',1,'0,1,'),(16,'电话卡',1,'0,1,'),(17,'华为',2,'0,2,'),(18,'小米',2,'0,2,'),(19,'苹果',2,'0,2,'),(20,'魅族',2,'0,2,'),(21,'三星',2,'0,2,'),(22,'OPPO',2,'0,2,'),(23,'ViVo',2,'0,2,'),(24,'锤子',2,'0,2,'),(25,'电脑整机',3,'0,3,'),(26,'电脑配件',3,'0,3,'),(27,'外设产品',3,'0,3,'),(28,'游戏设备',3,'0,3,'),(29,'网络产品',3,'0,3,'),(30,'办公设备',3,'0,3,'),(31,'文具耗材',3,'0,3,'),(32,'厨具',4,'0,4,'),(33,'家纺',4,'0,4,'),(35,'家装主材',4,'0,4,'),(36,'厨房卫浴',4,'0,4,'),(37,'五金电工',4,'0,4,'),(38,'女装',5,'0,5,'),(39,'男装',5,'0,5,'),(40,'内衣',5,'0,5,'),(41,'配饰',5,'0,5,'),(42,'童装',5,'0,5,'),(43,'童鞋',5,'0,5,'),(52,'宝马',6,'0,6,'),(53,'奔驰',6,'0,6,'),(54,'电视',2,'0,2,');

#
# Structure for table "shop_details"
#

DROP TABLE IF EXISTS `shop_details`;
CREATE TABLE `shop_details` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '详情ID',
  `orders_oid` char(18) NOT NULL COMMENT '所属订单号',
  `gid` int(10) unsigned NOT NULL COMMENT '商品ID',
  `price` decimal(9,2) NOT NULL COMMENT '商品购买价格',
  `cnt` int(11) NOT NULL COMMENT '购买数量',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

#
# Data for table "shop_details"
#

INSERT INTO `shop_details` VALUES (5,'201806291024204141',95,2100.00,3),(6,'201806291025492524',92,2888.00,1),(7,'201806291025492524',101,3000.00,2),(8,'201806291044536961',91,2399.00,1),(9,'201807021119327208',96,1800.00,1),(11,'201807021126283539',95,2100.00,1),(15,'201807021134441308',91,2399.00,1),(16,'201807021228044992',92,2888.00,1),(17,'201807021239291258',92,2888.00,1),(18,'201807021240383575',92,2888.00,1),(19,'201807021253367404',92,2888.00,1),(21,'201807022230022298',91,2399.00,1),(22,'201807031145556669',94,2000.00,1),(29,'201807041032557413',92,2888.00,1),(30,'201807041032557413',95,2100.00,1),(31,'201807041144518382',91,2399.00,2),(32,'201807041144518382',98,1400.00,1);

#
# Structure for table "shop_goods"
#

DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `gname` varchar(200) DEFAULT NULL COMMENT '商品名称',
  `cate_id` int(10) unsigned DEFAULT NULL COMMENT '商品分类ID',
  `price` decimal(8,2) DEFAULT NULL COMMENT '商品单价',
  `stock` int(11) DEFAULT NULL COMMENT '商品库存',
  `salecnt` int(10) unsigned DEFAULT '0' COMMENT '商品已卖数量',
  `gpic` varchar(100) DEFAULT NULL COMMENT '商品图片',
  `gdesc` text COMMENT '商品描述',
  `status` int(10) unsigned DEFAULT NULL COMMENT '商品状态 1.新品 2.上架 3.下架',
  `ctime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

#
# Data for table "shop_goods"
#

INSERT INTO `shop_goods` VALUES (7,'电视机 ',2,1100.00,100,0,'/static/uploads/20180625/26f7d6180b0c06d882b9e506c52d413a.jpg','电视机',3,1529907514),(8,'衬衫',8,232.00,100,0,'/static/uploads/20180625/4a6b895f35bada00a42855a3f7f867f9.jpg','衬衫',1,1529914654),(10,'冰箱',7,3424.00,100,0,'/static/uploads/20180625/a11b14c256f50e432ee6cb5b023be230.jpg','冰箱',2,1529914463),(89,'衣服',8,200.00,100,0,'/static/uploads/20180625/928b0448f4035882d949fd8fab0a4190.jpg','衣服',1,1529915379),(90,'上衣',8,23.00,100,0,'/static/uploads/20180625/1ac046491db5ceaae8b55f9de4e5d03d.jpg','上衣',1,1529915416),(91,'小米MIX 2 全陶瓷尊享版',13,2399.00,98,0,'/static/uploads/20180627/238922c8f7e4504f709f59bd3b1a21d7.jpg','全面屏2.0，Unibody 全陶瓷',2,1530105248),(92,'小米8 6GB+64GB',13,2888.00,102,0,'/static/uploads/20180627/17db0f1a6eb149ea921f0f2939fa482a.jpg','小米8',1,1530006201),(93,'小米MIX 2S 8GB+256GB',13,3000.00,100,0,'/static/uploads/20180627/1849ded16a296cd07861fd8dd8b21936.jpg','小米mix2x',1,1530012193),(94,'小米Max2 4GB+64GB',13,2000.00,100,0,'/static/uploads/20180626/b03442954c6b09a9278e3169c7b4b0cf.jpg','小米Max2',1,1530016309),(95,'小米6x 4GB+64GB',13,2100.00,100,0,'/static/uploads/20180626/9a75ea10c86168917fa652a6bcf30eaf.jpg','小米6x',1,1530016415),(96,'小米6 4GB+64GB',13,1800.00,100,0,'/static/uploads/20180626/3809ffaeef25cbb2be0725257a5af96c.jpg','小米6x',1,1530016485),(97,'红米1 4GB+64GB',14,1000.00,100,0,'/static/uploads/20180626/916bce54707568bae908bd118fa17188.jpg','红米1',1,1530016617),(98,'红米2 4GB+128GB',14,1400.00,99,0,'/static/uploads/20180626/d7c91238c8102c8f6e6a37ea965c71ac.jpg','红米2',1,1530016705),(99,'红米3 4GB+64GB',14,1600.00,100,0,'/static/uploads/20180626/3734d68de9408a9e5f98ca580b5fecc8.jpg','红米3',1,1530016781),(100,'红米4 6GB+64GB',14,1800.00,100,0,'/static/uploads/20180626/d881ec6544710a12cfb5060318443c29.jpg','红米4',1,1530016956),(101,'电视1',54,3000.00,100,0,'/static/uploads/20180626/9ec30e2ea8dee3836949a86ee41ced57.jpg','电视1',1,1530017911),(102,'电视2',54,1500.00,100,0,'/static/uploads/20180626/e904dd21be824a2e9fb111a5e5762e27.jpg','电视2',1,1530017950),(103,'电视3',54,2500.00,100,0,'/static/uploads/20180626/8342aa3cbbaf10073f0bfd4e61170433.jpg','电视3',1,1530017992),(104,'小米8 SE 4GB+64GB',13,2699.00,100,0,'/static/uploads/20180627/6ef3581891c3b6a10fbd59463f7ed94c.jpg','AI 超感光双摄，三星 AMOLED 屏幕',1,1530105130),(106,'小米6s 4GB+32GB',13,1999.00,100,0,'/static/uploads/20180627/669153dbbaecdcaf9b8e40ef69c32586.jpg','全索尼相机，骁龙660 AIE处理器',1,1530105355),(107,'洗衣机',10,445.00,100,0,'/static/uploads/20180625/b936b87877476ea776e39cbfed6401bb.jpg','洗衣机',1,1529916005),(108,'图1',11,1.00,100,0,'/static/uploads/20180628/dcb3dca8712009030fe19f0206e76fb3.jpg','图1',1,1530168649),(109,'图2',11,1.00,100,0,'/static/uploads/20180628/15ee48c0241b409db4c8a896fb0dc00c.jpg','图2',1,1530168733),(110,'图3',11,1.00,100,0,'/static/uploads/20180628/1d947e9e5fd32a2744271389a719f1ca.jpg','图3',1,1530168765),(111,'图4',11,1.00,100,0,'/static/uploads/20180628/b90aeebd6f0bbbb1df88b7ae2a306cc3.jpg','图4',1,1530168791),(112,'图5',11,1.00,100,0,'/static/uploads/20180628/9a00240193ac20f60aebd1cd7d4c93c8.jpg','图5',1,1530168825);

#
# Structure for table "shop_orders"
#

DROP TABLE IF EXISTS `shop_orders`;
CREATE TABLE `shop_orders` (
  `oid` char(18) NOT NULL COMMENT '订单号',
  `total` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `cnt` int(11) NOT NULL DEFAULT '0' COMMENT '总数量',
  `user_uid` int(11) NOT NULL COMMENT '下单人ID',
  `rec` varchar(20) NOT NULL COMMENT '收货人',
  `addr` varchar(200) DEFAULT NULL COMMENT '收货地址',
  `tel` varchar(15) DEFAULT NULL COMMENT '联系电话',
  `status` int(10) unsigned DEFAULT '1' COMMENT '订单状态 1.已下单 2.已发货 3.已收货 4.取消',
  `umsg` varchar(200) DEFAULT NULL COMMENT '买家留言',
  `create_at` int(10) unsigned DEFAULT '0' COMMENT '下单时间',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "shop_orders"
#

INSERT INTO `shop_orders` VALUES ('201807021126283539',2100.00,1,1,'阿萨','阿大撒大撒','1221212211',2,'阿斯顿撒',1530501988),('201807031145556669',2000.00,1,1,'李四','手机手机','13612345678',2,'手机手机',1530589555),('201807041032557413',4988.00,1,1,'lisi','广州市','13612345678',1,'手机手机',1530671575),('201807041144518382',6198.00,1,14,'zhangsan','广州市','13612345678',3,'手机手机',1530675891);

#
# Structure for table "shop_users"
#

DROP TABLE IF EXISTS `shop_users`;
CREATE TABLE `shop_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `uname` varchar(20) NOT NULL COMMENT '用户名称',
  `upwd` char(32) NOT NULL COMMENT '密码',
  `tel` varchar(20) DEFAULT NULL COMMENT '电话',
  `sex` enum('w','m','x') DEFAULT 'w' COMMENT '性别',
  `addr` varchar(200) DEFAULT '' COMMENT '收货地址',
  `auth` tinyint(3) unsigned DEFAULT '3' COMMENT '权限',
  `create_at` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

#
# Data for table "shop_users"
#

INSERT INTO `shop_users` VALUES (2,'li','14e1b600b1fd579f47433b88e8d85291','324546111324','w','',2,1529566971),(10,'2a','c81e728d9d4c2f636f067f89cc14862c','2','w','',1,1529572328),(11,'王五','c81e728d9d4c2f636f067f89cc14862c','234','w','',2,2018),(13,'bbbbbbb','b5b037a78522671b89a2c1b21d9b80c6','asdasdsad','w','',3,1529648133),(14,'ccccccc','a3dcb4d229de6fde0db5686dee47145d','asdasdasd','m','',1,1529648158),(15,'324234324','b68f50e80cc5da39becfc3dc27977f02','4545632123211','w','',2,1529660588),(16,'123321','96e79218965eb72c92a549dd5a330112','13812345678','m','',2,1529846387),(17,'123456','96e79218965eb72c92a549dd5a330112','13812345678','m','',3,1529932312),(18,'1234','e10adc3949ba59abbe56e057f20f883e','13612345678','m','',2,1530591657),(20,'1234567','96e79218965eb72c92a549dd5a330112','13612345678','m','',2,1530619096),(21,'111111','96e79218965eb72c92a549dd5a330112','13612345678','w','',2,1530669147);
