
function add_band(){
    document.getElementById('moreBands'+i).innerHTML += '<dt class="band_num">Band #'+(i+1)+'<dt>Name</dt><dd><input type="text" value="" name="band_name[]" class="text_input"></dd><dt>Website</dt><dd><input type="text" value="" name="band_website[]" class="text_input"></dd><dt>Location</dt><dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"></dd><div id="moreBands'+(i+1)+'"></div>';   
i++;
}




