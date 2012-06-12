var is_set = false;

function add_band(top){
    if(!is_set){
        curr_top = top;
        is_set = true;
    }
    curr_top += 123;

    document.getElementById('topForm').innerHTML += '<dt class="band_num" style="position:relative; top:'+curr_top+'px; margin-bottom:-23px" >Band #'+(i+1)+'</dt>';
    
       
    document.getElementById('sortable').innerHTML += '<li class="ui-state-band-draggable"><dl class="bandsForm"><dt>Name</dt><dd><input type="text" value="" name="band_name[]" class="text_input"></dd><dt>Website</dt><dd><input type="text" value="" name="band_website[]" class="text_input"></dd><dt>Location</dt><dd><input type="text" value="" name="band_location[]" class="location_input" maxlength="2"></dd></dl></li>';   
i++;
}




