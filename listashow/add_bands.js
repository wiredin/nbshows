var i=4;

function add_band(){
    document.getElementById('moreBands').innerHTML += '<dt>Band '+i+'</dt><dd><input type="text" value="" name="band_names[]" class="text_input"></dd><dt>Website</dt><dd><input type="text" value="" name="band_websites[]" class="text_input"></dd><dt>Location</dt><dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"></dd>';   
i++;
}




