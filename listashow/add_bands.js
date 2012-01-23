var i=4;

function add_band(){
    document.getElementById('moreBands').innerHTML += '<dt class="band_num">Band #'+i+'<dt>Name</dt><dd><input type="text" value="" name="band_names[]" class="text_input"></dd><dt>Website</dt><dd><input type="text" value="" name="band_websites[]" class="text_input"></dd><dt>Location</dt><dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"></dd>';   
i++;
}




