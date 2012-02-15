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
        $band_website = remove_http($band_website); //remove http if entered
               
    }


    //fix caps of band names
    $band_name = ucwords(strtolower($escpMe->$_POST['band_name'][$bandCount]));
    
    //create string of all band names (for good hash)
    if(empty($band_string))
    $band_string = $band_name;
    else
    $band_string = $band_string.' // '.$band_name;
   
    $query = "INSERT INTO `bands` (`band_name`,`website`,`location`) VALUES('$band_name',$band_website,'".$escpMe->$_POST['band_location'][$bandCount]."');";
    mysql_query($query);
    $band_id[$bandCount] = mysql_insert_id();
    $bandCount++;
}

//keep track of who is submitting the show for security purposes
$query = "INSERT INTO `submitters` (`ip_address`,`email`) VALUES('".$_SERVER['REMOTE_ADDR']."','".$escpMe->$_POST['your_email']."');";
mysql_query($query);
$submitter_id = mysql_insert_id();

$date_time = sql_datetime($escpMe->$_POST['show_date'],$escpMe->$_POST['show_time']);

$hash = sha1($band_string);
//create hash for secure unique id of show 

//Insert the show
$query = "INSERT INTO `shows` (`venue_id`,`start_time`,`submitter_id`,`hash`) VALUES('$venue_id','$date_time','".$submitter_id."','$hash');";
mysql_query($query);
$show_id = mysql_insert_id();
//Show/Band relation table
for($i=0; $i<$bandCount; $i++){
    $query = "INSERT INTO `show_bands` (`band_id`,`show_id`,`order`) VALUES('$band_id[$i]','$show_id','$i');";
    mysql_query($query);
}

require_once("send_link.php");

header("Location: ../index.php");

?>
