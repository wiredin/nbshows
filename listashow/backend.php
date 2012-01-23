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
$bandCount=0;
while(!empty($_POST['band_name'][$bandCount])){
    if(empty($_POST['band_website'][$bandCount])|| $_POST['band_website'][$bandCount]==' '){
        $band_website = "'blank'";
    }else{
        $band_website = "'".$escpMe->$_POST['band_website'][$bandCount]."'";
    }
    $query = "INSERT INTO `bands` (`band_name`,`website`,`location`) VALUES('".$escpMe->$_POST['band_name'][$bandCount]."',$band_website,'".$escpMe->$_POST['band_location'][$bandCount]."');";
    mysql_query($query);
    $band_id[$bandCount] = mysql_insert_id();
    echo $query;
    echo '<br>';
    echo mysql_error();
    echo '<br>';
    //if band already exhists
    if(mysql_error()){
         $query = "SELECT `band_id` FROM `bands` WHERE website='".$escpMe->$_POST['band_website'][$bandCount]."' AND band_name='".$escpMe->$_POST['band_name'][$bandCount]."';";
         $results = mysql_query($query);
         $bd = mysql_fetch_array($results);
         $band_id[$bandCount] = $bd['band_id']; 
    }
    $bandCount++;
}

//keep track of who is submitting the show for security purposes
$query = "INSERT INTO `submitters` (`ip_address`) VALUES('".$_SERVER['REMOTE_ADDR']."');";
mysql_query($query);
$submitter_id = mysql_insert_id();

$date_time = sql_datetime($escpMe->$_POST['show_date'],$escpMe->$_POST['show_time']);

//Insert the show
$query = "INSERT INTO `shows` (`venue_id`,`start_time`, `promoter_email`,`submiter_id`) VALUES('$venue_id','$date_time','".$escpMe->$_POST['promoter_email']."','".$submitter_id."');";
mysql_query($query);
$show_id = mysql_insert_id();

//Show/Band relation table
for($i=0; $i<$bandCount; $i++){
    $query = "INSERT INTO `show_bands` (`band_id`,`show_id`,`order`) VALUES('$band_id[$i]','$show_id','$i');";
    mysql_query($query);
}

?>
