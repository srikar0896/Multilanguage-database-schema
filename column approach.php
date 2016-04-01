/*This solution is the simplest one and basically it creates an additional column for each text (each language) 
that needs to be translated (there is may be a number of such columns in your table, like: title, name, description etc.). 
Below the example for such table in MySQL*/
CREATE TABLE app_product (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `title_en` varchar(255) NOT NULL,
  `title_es` varchar(255) NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
); 

QUERYING:

<?php
// Retrieve titles for all languages
$sql = "SELECT * FROM `app_product` WHERE 1";
if($result = mysql_query($sql)){
    if($row = mysql_fetch_assoc($result)){
        echo "English: ".$row["title_en"]."<br>";
        echo "Spanish: ".$row["title_es"]."<br>";
        echo "French: ".$row["title_fr"]."<br>";
    }
}

// Retrieve appropriate title according to the chosen language in the system
$sql = "SELECT `title_".$_SESSION['current_language']."` as `title`
        FROM `app_product`";
if($result = mysql_query($sql)){
    if($row = mysql_fetch_assoc($result)){
        echo "Current Language: ".$row["title"];
    }
}
?> 
