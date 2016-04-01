
CREATE TABLE IF NOT EXISTS `app_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `app_product_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `language_code` char(2) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `translation_id` (`product_id`),
  KEY `language_code` (`language_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `app_language` (
  `code` char(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
<?php
// Retrieve titles for all languages
$sql = "SELECT p.*, pt.title, pt.description, l.name as language_name
        FROM `app_product` p
        INNER JOIN `app_product_translation` pt ON p.id = pt.product_id
        INNER JOIN `app_language` l ON pt.language_code = l.code
        WHERE p.id = 1";
if($result = mysql_query($sql)){
    while($row = mysql_fetch_assoc($result)){
        echo "Language (".$row["language_name"]."): ".$row["title"]."<br>";
    }
}

// Retrieve appropriate title according to the chosen language in the system
$sql = "SELECT p.*, pt.title, pt.description
        FROM `app_product` p
        INNER JOIN `app_product_translation` pt ON p.id = pt.product_id
        WHERE p.id = 1 AND pt.language_code = '".$_SESSION['current_language']."'";
if($result = mysql_query($sql)){
    if($row = mysql_fetch_assoc($result)){
        echo "Current Language: ".$row["title"];
    }
}
?> 
/*
Advantages:
1.Advantages: •Proper normalization - seems like clean, relational approach
•Ease in adding a new language - doesn't require schema changes
•Columns keep there names - doesn't require "_lang" suffixes or something else
•Easy to query - relatively simple querying (only one JOIN is required)
*/
