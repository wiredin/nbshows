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

function us_date($DateTime){
    return date_format(new DateTime($DateTime), 'm/d/Y');

}

function mil_time($DateTime){
    return date_format(new DateTime($DateTime), 'H:i:s');
}

function sql_datetime($usDate, $usTime){
    $date_time = date_create_from_format('m/j/Y', $usDate);
    $date_time = date_format($date_time, 'Y-m-d');
    $date_time = $date_time.' '.$usTime;
    return $date_time; 
}

function get_date_now(){
    return date("m/d/Y");
}


function get_bands_array($row){
    $lineups = explode(",",$row['order']);
    $names = explode(",",$row['bands']);
    $websites = explode(",",$row['websites']);
    $locations = explode(",",$row['locations']);

    
    for($i=0; $i<count($lineups); $i++){
         $bands[$i] = array("name"=>$names[$i],"website"=>$websites[$i], "location"=>$locations[$i],"lineup"=>$lineups[$i]); 
    }
    usort($bands,"cmp_bands");
    return $bands;
}

function cmp_bands($a,$b){
    if($a['lineup'] == $b['lineup']){
        return 0;
    }

     return ($a['lineup'] < $b['lineup']) ? -1 : 1;
}

function print_bands($bands, $canceled){
foreach($bands as $band){
    echo ($canceled==1 ? '<del>' : '');
    if($band['website']!='blank'){ ?>
	<a target="_blank" href="http://<?php echo $band['website']; ?>"><?php echo $band['name'].'</a> ';
        if(($GLOBALS['location_abbv']!=$band['location'])&&(!empty($band['location'])))
            echo ' ('.$band['location'].') '; 
         }else{   

         echo ' <strong>'.$band['name'].'</strong> ';
 

        if(($GLOBALS['location_abbv']!=$band['location'])&&(!empty($band['location'])))
            echo '('.$band['location'].') ';       
           }

    $c++;
    echo ($c == count($bands) ? "": "//");    
    }
     
   echo ($canceled==1 ? '</del>' : '');
$c = 0;
}

function remove_http($url = '')
{
     return(str_replace(array('http://','https://'), '', $url));
}


//provided by doob_ at gmx dot de  http://www.php.net/manual/en/function.checkdate.php#87250
function check_date($date) {
    if(strlen($date) == 10) {
        $pattern = '/\.|\/|-/i';    // . or / or -
        preg_match($pattern, $date, $char);
        
        $array = preg_split($pattern, $date, -1, PREG_SPLIT_NO_EMPTY); 
        
        if(strlen($array[2]) == 4) {
            // dd.mm.yyyy || dd-mm-yyyy
            if($char[0] == "."|| $char[0] == "-") {
                $month = $array[1];
                $day = $array[0];
                $year = $array[2];
            }
            // mm/dd/yyyy    # Common U.S. writing
            if($char[0] == "/") {
                $month = $array[0];
                $day = $array[1];
                $year = $array[2];
            }
        }
        // yyyy-mm-dd    # iso 8601
        if(strlen($array[0]) == 4 && $char[0] == "-") {
            $month = $array[1];
            $day = $array[2];
            $year = $array[0];
        }
        if(checkdate($month, $day, $year)) {    //Validate Gregorian date
            return TRUE;
        
        } else {
            return FALSE;
        }
    }else {
        return FALSE;    // more or less 10 chars
    }
}
