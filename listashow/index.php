<?php
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

    if(empty($_POST['venue_name'])){
        $err_venue_name = 'You forgot to enter the venue!';
        $err = 1;
    }
    
    if(!check_date($_POST['show_date'])){
        $err_show_date= 'Invalid date!';
        $err = 1;
    }
   
   
    for($i=0; $i<count($_POST['band_name']); $i++){
    
        if(empty($_POST['band_name'][$i])){
            if($i==0){
               $err_band_name[0] = "There aren't any bands playing this show?";
               $err = 1;
            }    
        }
    }

    if(!empty($_POST['your_email'])){
        if(empty($inputs['your_email'])){
            $err_your_email = "Invalid Email";
            $err = 1;
        }
    }else{
        $err_your_email = "What is your email?";
        $err = 1;
    }


    if(!empty($_POST['promoter_email'])){
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

require_once('../header.php');
?>

<script type="text/javascript" src="add_bands.js"></script>
<link rel="stylesheet" type="text/css" href="../stylesheets/calendarview.css" />


<h3>List a show</h3>
<div id="submit">

<form method="POST" action="index.php">
<dl border=1 id="topForm">
<dt>Venue</dt>
<dd><input type="text" value="<?php echo $_POST['venue_name']; ?>" name="venue_name" class="text_input">
<div class="err_txt"><?php echo $err_venue_name; ?></div>
<p>Where is the show happening?</p></dd>

<dt>Date:</dt>
<dd><input name="show_date" class="date_input" id="selected_date" type="text" value="<?php if(empty($_POST['show_date'])){ echo get_date_now(); } else { echo $_POST['show_date']; } ?>">
<select name="show_time"> 
<option value="12:00:00">12:00 pm</option>
<option value="12:30:00">12:30 pm</option>
<option value="13:00:00">1:00 pm</option>
<option value="13:30:00">1:30 pm</option>
<option value="14:00:00">2:00 pm</option>
<option value="14:30:00">2:30 pm</option>
<option value="15:00:00">3:00 pm</option>
<option value="15:30:00">3:30 pm</option>
<option value="16:00:00">4:00 pm</option>
<option value="16:30:00">4:30 pm</option>
<option value="17:00:00">5:00 pm</option>
<option value="17:30:00">5:30 pm</option>
<option value="18:00:00">6:00 pm</option>
<option value="18:30:00">6:30 pm</option>
<option value="19:00:00" selected="selected">7:00 pm</option>
<option value="19:30:00">7:30 pm</option>
<option value="20:00:00">8:00 pm</option>
<option value="20:30:00">8:30 pm</option>
<option value="21:00:00">9:00 pm</option>
<option value="21:30:00">9:30 pm</option>
<option value="22:00:00">10:00 pm</option>
<option value="22:30:00">10:30 pm</option>
<option value="23:00:00">11:00 pm</option>
<option value="23:30:00">11:30 pm</option>
</select>
<div class="err_txt"><?php echo $err_show_date; ?></div>
</dd>
</dl>
<dl id="bandsForm">
<dt class="band_num">Headlining Band</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $_POST['band_name'][0]; ?>" name="band_name[]" class="text_input"> 
<div class="err_txt"><?php echo $err_band_name[0]; ?></div>
</dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $_POST['band_website'][0]; ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $_POST['band_location'][0]; ?>" name="band_location[]" class="location_input" maxlength="2"> (State) or "NB" for New Brunswick</dd>

<dt class="band_num">Band #2</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $_POST['band_name'][1]; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $_POST['band_website'][1]; ?>" name="band_website[]" class="text_input"></dd>

<dt>Location</dt>
<dd><input type="text" value="<?php echo $_POST['band_location'][1]; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>


<dt class="band_num">Band #3</dt>
<dt>Name</dt>
<dd><input type="text" value="<?php echo $_POST['band_name'][2]; ?>" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="<?php echo $_POST['band_website'][2]; ?>" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="<?php echo $_POST['band_location'][2]; ?>" name="band_location[]" class="location_input" maxlength="2"></dd>



<div id="moreBands4"></div>
<dt> </dt><dd><a onClick="add_band()" style="cursor:pointer; font-weight:bold; color: #3972C8; font-size:.9em;" >Add another band</a></dd>

</dl>
<dl id="topForm">
<dt>Your Email</dt>
<dd><input type="text" value="<?php echo $_POST['your_email']; ?>" name="your_email" class="text_input">
<div class="err_txt"><?php echo $err_your_email; ?></div>
<p>
Not published, we will send you a link to edit the listing with.
</p>
</dd>



<dt></dt><dd style="margin-top:5px;"><input type="submit" name="submit" value="Submit"></dd>
</dl>
</div>
<div style="clear:both;"></div>
</form>



<?php

require_once('../footer.php');
?>
