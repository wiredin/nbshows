<?php

require_once('../main_functions.php');
require_once('../config_variables.php');




openDB();

$escpMe = new MysqlStringEscaper;

//get show_id from hash
$query = "SELECT `show_id` FROM `shows` WHERE `hash`='".$escpMe->$_POST['hash']."';";
$results = mysql_query($query);
$show = mysql_fetch_array($results);
$show_id = $show['show_id'];

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


//Update bands in `bands`
$bandCount=0;

$query = "DELETE FROM `show_bands` WHERE `show_id`='".$escpMe->$show_id."';";
mysql_query($query);


for($i=0; $i<10; $i++){
   if(!empty($_POST['band_name'][$bandCount])){
	if(empty($_POST['band_website'][$bandCount])|| $_POST['band_website'][$bandCount]==' '){
	    $band_website = "'blank'";
	}else{

	    $band_website = "'".$escpMe->$_POST['band_website'][$bandCount]."'";
	    $band_website = remove_http($band_website); //remove http if entered

	}

	//fix caps of band names
	$band_name = ucwords(strtolower($escpMe->$_POST['band_name'][$bandCount]));
         
        $query = "INSERT INTO `bands` (`band_name`,`website`,`location`) VALUES('$band_name',$band_website,'".$escpMe->$_POST['band_location'][$bandCount]."');";
         mysql_query($query);
        $band_id[$bandCount] = mysql_insert_id();
        $bandCount++;
     

    }
}

//make a datetime
$date_time = sql_datetime($escpMe->$_POST['show_date'],$escpMe->$_POST['show_time']);


//Update the show
$query = "UPDATE `shows` SET `venue_id`='$venue_id',`start_time`='$date_time', `canceled`='".$escpMe->$_POST['canceled']."' WHERE `show_id`='$show_id';";
$results = mysql_query($query);
for($i=0; $i<$bandCount; $i++){
    $query = "INSERT INTO `show_bands` (`band_id`,`show_id`,`order`) VALUES('$band_id[$i]','$show_id','$i');";
    mysql_query($query);
}

header("Location: ../index.php");

?>
