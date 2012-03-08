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

$escpMe = new MysqlStringEscaper;

//validation array for (uses less code)
$filter = array(
    'band_website' => FILTER_VALIDATE_URL,
   
    'your_email' => FILTER_VALIDATE_EMAIL,

    'promoter_email' => FILTER_VALIDATE_EMAIL

);

$method = $_SERVER['REQUEST_METHOD'];

//
if($method === POST){

    $show = $_POST;

    //fix some of the array keys
    $show['start_time'] = $show['show_date'];
    $show_time = $show['show_time']; 

    for($i=0; $i<count($show['band_name']); $i++){
        $bands[$i]['name'] = $show['band_name'][$i];     
        $bands[$i]['website'] = $show['band_website'][$i];     
        $bands[$i]['location'] = $show['band_location'][$i];     
    }


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



   if(!$err){
       require_once('backend.php');
       die();
   }

}else{


    $query = "SELECT S.show_id, S.venue_id, venue_name, start_time, S.submitter_id, SBM.email , sb.band_id, canceled, group_concat(`band_name` separator ',') AS bands, group_concat(`website` separator ',') AS websites, group_concat(`order` separator ',') AS `order`, group_concat(`location` separator ',') AS locations  FROM `shows` S, `bands` B, `show_bands` sb, `venues` V , `submitters` SBM WHERE `hash`='".$escpMe->$_GET['h']."' AND  B.band_id=sb.band_id AND S.show_id=sb.show_id AND SBM.submitter_id=S.submitter_id AND V.venue_id=S.venue_id;";
    $results = mysql_query($query);
    $show = mysql_fetch_array($results);
    $bands = get_bands_array($show); 
    $show_time = substr($show['start_time'], 11,18);
}


openDB();

//no hash given or bad hash -kill script
if((empty($_GET['h'])) || ($show['show_id']==NULL)){
    require_once "../header.php";
    echo "Sorry, that something isn't here.";
    require_once "../footer.php";
    die();
}




require_once('../header.php');
?>

<script type="text/javascript">
var i=<?php echo count($bands); ?>;
</script>
<script type="text/javascript" src="add_bands.js"></script>
<link rel="stylesheet" type="text/css" href="../stylesheets/calendarview.css" />

<h3>List a show</h3>
<div id="submit">

<form method="POST" action="?h=<?php echo $_GET['h']; ?>">
<input type="hidden" name="hash" value="<?php echo $_GET['h']; ?>">
<dl border=1 id="topForm">
<dt>Venue</dt>
<dd><input type="text" value="<?php echo $show['venue_name']; ?>" name="venue_name" class="text_input">
<div class="err_txt"><?php echo $err_venue_name; ?></div>
<p>Where is the show happening?</p></dd>

<dt>Date</dt>
<dd><input name="show_date" class="date_input" id="selected_date" type="text" value="<?php  echo us_date($show['start_time']);  ?>">
<select name="show_time"> 
<?php 

$first_two = substr($show_time,0,2);
$second_two = substr($show_time,3,2);

for($i=12; $i<23; $i++){ 
    if($i!=12)
       $h = $i-12;
    else
       $h = $i;

    if($first_two == $i)
        if($second_two == "00")
        $selectedEven = "selected='selected'";    
        else
        $selectedHalf = "selected='selected'";

?>
<option value="<?php echo $i; ?>:00:00" <?php echo $selectedEven; ?>  ><?php echo $h; ?>:00 pm</option>
<option value="<?php echo $i; ?>:30:00" <?php echo $selectedHalf; ?> ><?php echo $h; ?>:30 pm</option>
<?php
   $selectedEven = "";
   $selectedHalf = "";
   } 
?>
</select>
<div class="err_txt"><?php echo $err_show_date; ?></div>
</dd>
<dt><span style="color:red;"> Canceled</span></dt>
<?php 
    if($show['canceled']==1){
        $cancelChecked = 'checked="checked"';
     }

?>
<dd>Has this show been cancelled?  <input type="checkbox" name="canceled" id="canceled" <?php echo $cancelChecked; ?> value=1> Check the box if yes.</dd>
</dl>


<dl id="bandsForm">
<dt class="band_num">Headlining Band</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $bands[0]['name']; ?>" name="band_name[]" class="text_input"> 
<div class="err_txt"><?php echo $err_band_name[0]; ?></div>
</dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $bands[0]['website']; ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $bands[0]['location']; ?>" name="band_location[]" class="location_input" maxlength="2"> (State) or "NB" for New Brunswick</dd>

<dt class="band_num">Band #2</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $bands[1]['name']; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $bands[1]['website'];  ?>" name="band_website[]" class="text_input"></dd>

<dt>Location</dt>
<dd><input type="text" value="<?php echo $bands[1]['location']; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>


<dt class="band_num">Band #3</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $bands[2]['name']; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $bands[2]['website'];  ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $bands[2]['location']; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>

<?php
for($i=3; $i<count($bands); $i++){
?>
<dt class="band_num">Band #<?php echo $i+1; ?></dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $bands[$i]['name']; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $bands[$i]['website'];  ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $bands[$i]['location']; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>
<?php
}
?>
<div id="moreBands<?php echo count($bands); ?>"></div>
<dt> </dt><dd><a onClick="add_band();" style="cursor:pointer; font-weight:bold; color: #3972C8; " >Add another band</a></dd>

</dl>
<dl id="topForm">



<dt></dt><dd style="margin-top:5px;"><input type="submit"  class="submit_input" name="submit" value="Save"></dd>
</dl>
</div>
<div style="clear:both;"></div>
</form>



<?php

require_once('../footer.php');

