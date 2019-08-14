<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('seller')};
CREATE TABLE {$this->getTable('seller')} (
  `seller_id` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `payment_status` smallint(6) NOT NULL,
  `order_status` smallint(6) NOT NULL,
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY  (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS {$this->getTable('sellerbank')};
CREATE TABLE {$this->getTable('sellerbank')} (
  `bankinfoid` int(11) unsigned NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `acc_num` varchar(100) NOT NULL,
  `acc_bank` varchar(100) NOT NULL,
  `acc_branch` varchar(100) NOT NULL,
  `acc_ifsc` varchar(100) NOT NULL,
  PRIMARY KEY  (`bankinfoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS {$this->getTable('sellerproducts')};
CREATE TABLE {$this->getTable('sellerproducts')} (
  `prdids` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `price` decimal(12,4) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` decimal(12,4) NOT NULL,
  PRIMARY KEY  (`prdids`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 