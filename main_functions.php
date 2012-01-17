<?php

function openDB(){
    $dbhost = "db.nbshows.org";
    $dbuser = "mikeweiss";
    $dbpass = "ckmw11";
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    if (!$link) {
	die('Could not linkect: ' . mysql_error());
    }
    $dbname = "cityshows";
    mysql_select_db($dbname);
    return link;
}


//closeDB closes the linkection
function closeDB($link){
     mysql_close($link);
}



class MysqlStringEscaper
{
    function __get($value)
    {
        return mysql_real_escape_string($value);
    }
}


function pretty_date($DateTime){
    return date_format(new DateTime($DateTime), 'l, M j');
}

function pretty_time($DateTime){
    if(date_format(new DateTime($DateTime), 'i')==00){
	return date_format(new DateTime($DateTime), 'ga');
    }else{
	return date_format(new DateTime($DateTime), 'g:ia');
    }
}

function get_bands_array($row){
    $lineup = explode(",",$row['order']);
    $names = explode(",",$row['bands']);
    $websites = explode(",",$row['websites']);
    $locations = explode(",",$row['locations']);
    
    for($i=0; $i<count($lineup); $i++){
         $bands[$lineup[$i]] = array("name"=>$names[$i],"website"=>$websites[$i], "location"=>$locations[$i]); 
    } 

    sort($bands);
    return $bands;
}

function print_bands($bands){
foreach($bands as $band){
    if($band['website']!='blank'){ ?>
	<a target="_blank" href="http://<?php echo $band['website']; ?>"><?php echo $band['name'].' ';
        if(($GLOBALS['location_abbv']!=$band['location'])&&(!empty($band['location'])))
            echo '('.$band['location'].')'; ?></a>       
    <?php  }else{   

         echo ' <strong>'.$band['name'].' ';
 

        if(($GLOBALS['location_abbv']!=$band['location'])&&(!empty($band['location'])))
            echo '('.$band['location'].') ';       
        echo '</strong>';
           }

    $c++;
    echo ($c == count($bands) ? "": "//");    
    } 
$c = 0;
}

function get_date_now(){
    return date("m/j/Y");
}
