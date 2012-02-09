<?php
/*
City Shows
Edit Show Listing Page (Front End with Validation)
Author: Mike Weiss
02/04/2012
*/


$path='../';
$page = "listashow";
require_once('../main_functions.php');
require_once('../config_variables.php');

//validation array for (uses less code)
$filter = array(
    'band_website' => FILTER_VALIDATE_URL,
   
    'your_email' => FILTER_VALIDATE_EMAIL,

    'promoter_email' => FILTER_VALIDATE_EMAIL

);

$method = $_SERVER['REQUEST_METHOD'];

//
if($method === POST){
    $inputs = filter_input_array( INPUT_POST, $filter );

    if(empty($show['venue_name'])){
        $err_venue_name = 'You forgot to enter the venue!';
        $err = 1;
    }
    
    if(!check_date($show['show_date'])){
        $err_show_date= 'Invalid date!';
        $err = 1;
    }
   
   
    for($i=0; $i<count($show['band_name']); $i++){
    
        if(empty($show['band_name'][$i])){
            if($i==0){
               $err_band_name[0] = "There aren't any bands playing this show?";
               $err = 1;
            }    
        }
    }

    if(!empty($show['your_email'])){
        if(empty($inputs['your_email'])){
            $err_your_email = "Invalid Email";
            $err = 1;
        }
    }else{
        $err_your_email = "What is your email?";
        $err = 1;
    }


    if(!empty($show['promoter_email'])){
        if(empty($inputs['promoter_email'])){
            $err_promoter_email = "Invalid Email";
            $err = 1;
        }
    } 

   if(!$err){
       require_once('backend.php');
       die();
   }

}


openDB();
$escpMe = new MysqlStringEscaper;

$query = "SELECT S.show_id, S.venue_id, venue_name, start_time, S.submitter_id, SBM.email , sb.band_id, group_concat(`band_name` separator ',') AS bands, group_concat(`website` separator ',') AS websites, group_concat(`order` separator ',') AS `order`, group_concat(`location` separator ',') AS locations  FROM `shows` S, `bands` B, `show_bands` sb, `venues` V , `submitters` SBM WHERE `hash`='".$escpMe->$_GET['h']."' AND  B.band_id=sb.band_id AND S.show_id=sb.show_id AND SBM.submitter_id=S.submitter_id AND V.venue_id=S.venue_id;";
$results = mysql_query($query);
$show = mysql_fetch_array($results);

require_once('../header.php');
?>

<script type="text/javascript" src="add_bands.js"></script>
<link rel="stylesheet" type="text/css" href="../stylesheets/calendarview.css" />


<h3>List a show</h3>
<div id="submit">

<form method="POST" action="index.php">
<dl border=1 id="topForm">
<dt>Venue</dt>
<dd><input type="text" value="<?php echo $show['venue_name']; ?>" name="venue_name" class="text_input">
<div class="err_txt"><?php echo $err_venue_name; ?></div>
<p>Where is the show happening?</p></dd>

<dt>Date:</dt>
<dd><input name="show_date" class="date_input" id="selected_date" type="text" value="<?php  echo us_date($show['start_time']);  ?>">
<select name="show_time"> 
<?php 
for($i=12; $i<23; $i++){ 
    if($i!=12)
       $h = $i-12;
    else
       $h = $i;


?>
<option value="<?php echo $i; ?>:00:00"><?php echo $h; ?>:00 pm</option>
<option value="<?php echo $i; ?>:30:00"><?php echo $h; ?>:30 pm</option>
<?php } ?>
</select>
<div class="err_txt"><?php echo $err_show_date; ?></div>
</dd>
</dl>
<dl id="bandsForm">
<dt class="band_num">Headlining Band</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $show['band_name'][0]; ?>" name="band_name[]" class="text_input"> 
<div class="err_txt"><?php echo $err_band_name[0]; ?></div>
</dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $show['band_website'][0]; ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $show['band_location'][0]; ?>" name="band_location[]" class="location_input" maxlength="2"> (State) or "NB" for New Brunswick</dd>

<dt class="band_num">Band #2</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $show['band_name'][1]; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $show['band_website'][1]; ?>" name="band_website[]" class="text_input"></dd>

<dt>Location</dt>
<dd><input type="text" value="<?php echo $show['band_location'][1]; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>


<dt class="band_num">Band #3</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $show['band_name'][2]; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $show['band_website'][2]; ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $show['band_location'][2]; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>



<div id="moreBands4"></div>
<dt> </dt><dd><a onClick="add_band()" style="cursor:pointer; font-weight:bold; color: #3972C8; font-size:.9em;" >Add another band</a></dd>

</dl>
<dl id="topForm">
<dt>Your Email</dt>
<dd><input type="text" value="<?php echo $show['email']; ?>" name="your_email" class="text_input">
<div class="err_txt"><?php echo $err_your_email; ?></div>
<p>
Not published, we will send you a link to edit the listing with.
</p>
</dd>



<dt></dt><dd style="margin-top:5px;"><input type="submit" name="submit" value="Update"></dd>
</dl>
</div>
<div style="clear:both;"></div>
</form>



<?php

require_once('../footer.php');
?>
