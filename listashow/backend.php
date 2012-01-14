<?php

require_once('../main_functions.php');
require_once('../config_variables.php');

openDB();

$escpMe = new MysqlStringEscaper;

//Insert venue into `venues`
$query = "INSERT INTO `venues` (`venue_name`) VALUES ('".$escpMe->$_POST['venue_name']."');";
mysql_query($query);
$venue_id = mysql_insert_id();

//if venue already exists
if (mysql_error()){
    $query = "SELECT `venue_id` FROM `venues` WHERE venue_name='".$escpMe->$_POST['venue_name']."';";
    $results = mysql_query($query);
    $vn = mysql_fetch_array($results);
    $venue_id = $vn['venue_id'];
}

//Insert bands into `bands`
$i=0;
while(!empty($_POST['band_name'][$i])){
$query = "INSERT INTO `bands` (`band_name`,`website`,`location`) VALUES('".$escpMe->$_POST['band_name'][$i]."','".$escpMe->$_POST['band_website'][$i]."','".$escpMe->$_POST['band_location'][$i]."');";
mysql_query($query);
echo $query."<br>";
$i++;
}


$query = "INSERT INTO `submitters` (`ip_address`) VALUES('".$_SERVER['REMOTE_ADDR']."');";
mysql_query($query);
$submitter_id = mysql_insert_id();



//$query = "INSERT INTO `shows` (`venue_id`,`start_time`, `promoter_email` `submiter_id`) VALUES() ";

?>
