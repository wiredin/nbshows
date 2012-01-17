<?php
$path='../';
$page = "listashow";
require_once('../main_functions.php');
require_once('../config_variables.php');
require_once('../header.php');
?>

<script type="text/javascript" src="add_bands.js"></script>
<link rel="stylesheet" type="text/css" href="../stylesheets/calendarview.css" />


<h3>List a show</h3>
<div id="submit">
<dl border=1 class="submitLayout">

<form method="POST" action="backend.php">
<dt>Venue</dt>
<dd><input type="text" value="" name="venue_name" class="text_input">
<p>Where is the show happening?
</p>
</dd>

<dt>Date:</dt>
<dd><input name="show_date" class="date_input" id="selected_date" type="text"value="<?php echo get_date_now(); ?>">
<select name="show_time"> 
<option value="720">12:00 pm</option>
<option value="750">12:30 pm</option>
<option value="780">1:00 pm</option>
<option value="810">1:30 pm</option>
<option value="840">2:00 pm</option>
<option value="870">2:30 pm</option>
<option value="900">3:00 pm</option>
<option value="930">3:30 pm</option>
<option value="960">4:00 pm</option>
<option value="990">4:30 pm</option>
<option value="1020">5:00 pm</option>
<option value="1050">5:30 pm</option>
<option value="1080">6:00 pm</option>
<option value="1110">6:30 pm</option>
<option value="1140">7:00 pm</option>
<option value="1170">7:30 pm</option>
<option value="1200">8:00 pm</option>
<option value="1230">8:30 pm</option>
<option value="1260">9:00 pm</option>
<option value="1290">9:30 pm</option>
<option value="1320">10:00 pm</option>
<option value="1350">10:30 pm</option>
<option value="1380">11:00 pm</option>
<option value="1410">11:30 pm</option>
</select>
</dd>

<h5>Headlining band</h5>
<dt>Band 1</dt>
<dd><input type="text" value="" name="band_name[]" class="text_input"> Headliner!</dd>


<dt>Website</dt>
<dd><input type="text" value="" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"> (State) or "NB" for New Brunswick</dd>

<dt>Band 2</dt>
<dd><input type="text" value="" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="" name="band_website[]" class="text_input"></dd>

<dt>Location</dt>
<dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"></dd>

<dt>Band 3</dt>
<dd><input type="text" value="" name="band_name[]" class="text_input"></dd>


<dt>Website</dt>
<dd><input type="text" value="" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"></dd>



<div id="moreBands"></div>
<dt> </dt><dd><a onClick="add_band()" style="cursor:pointer; font-weight:bold; color: #3972C8;" >Add band</a></dd>


<dt>Your Email</dt>
<dd><input type="text" value="" name="your_email" class="text_input">
<p>
Not published, it's for us incase we have a question.
</p>
</dd>




<dt>Promoters Email</dt>
<dd><input type="text" value="" name="promoter_email" class="text_input">
<p>
So people can ask about the show. Can be left blank
</p>
</dd>

<dt></dt><dd style="margin-top:5px;"><input type="submit" name="submit" value="Submit"></dd>

</div>
<div style="clear:both;"></div>
</form>




<?php

require_once('../footer.php');
?>
