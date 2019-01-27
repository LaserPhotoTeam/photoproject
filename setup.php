<?php

// Setup script, do not forget to remove it from the server when the init is done.

require 'config.php';

$db = mysqli_connect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME) or die("Wrong config.php settings.");
mysqli_set_charset($db, 'utf8');

print "<html><body><br>&nbsp;<br>";

$sqlQuery = "DROP TABLE IF EXISTS pf_phototrain";
$hQuery = mysqli_query($db, $sqlQuery);

$strSql = "CREATE TABLE pf_phototrain (
   id int(11) unsigned NOT NULL AUTO_INCREMENT,
   social_id char(128) NOT NULL default '',
   user_id_1 char(128) NOT NULL default '',
   user_id_2 char(128) NOT NULL default '',
   user_id_3 char(128) NOT NULL default '',
   user_id_4 char(128) NOT NULL default '',
   user_profile_link_1 char(128) NOT NULL default '',
   user_profile_link_2 char(128) NOT NULL default '',
   user_profile_link_3 char(128) NOT NULL default '',
   user_profile_link_4 char(128) NOT NULL default '',
   image_link char(128) NOT NULL default '',
   status int(2) NOT NULL default '1',
   PRIMARY KEY (id)
) ENGINE=MyISAM";

if(!($hQuery = @mysqli_query($db, $strSql)))
{
   print "MySQL Create Table Error (pf_phototrain): ".mysqli_error($db)."<br>";
}

print dirname(__FILE__);
print "<br>";
print "<b>OK!</b>";
print "</body></html>";

exit;

?>
