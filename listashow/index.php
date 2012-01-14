<?php
$path='../';
require_once('../main_functions.php');
require_once('../config_variables.php');
require_once('../header.php');
?>

<script type="text/javascript" src="add_bands.js"></script>
<h3>List a show</h3>
<div id="submit">
<dl border=1 class="submitLayout">

<form method="POST" action="backend.php">
<dt>Venue</dt>
<dd><input type="text" value="" name="venue_name" class="text_input">
<p>Where is the show happening?
</p>
</dd>




<dt>Band 1</dt>
<dd><input type="text" value="" name="band_name[]" class="text_input"> Headliner!</dd>


<dt>Website</dt>
<dd><input type="text" value="" name="band_website[]" class="text_input"></dd>


<dt>Location</dt>
<dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"> (State) or "NB" for New Brunswick band</dd>

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
