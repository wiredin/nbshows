<?php

$completeurl = "https://www.google.com/calendar/feeds/2auatm870r5a2as9ukgmnp3jq0%40group.calendar.google.com/public/basic";
$xml = simplexml_load_file($completeurl);

$i=1;
while($title = $xml->entry[$i]->title){
echo $title;
echo "<br>";
$s_items = split(' ',$xml->entry[$i]->summary);

$days = array('Mon'=>'Monday', 'Tue'=>'Tuesday', 'Wed'=>'Wednesday', 'Thu'=>'Thursday', 'Fri'=>'Friday','Sat'=>'Saturday', 'Sun'=>'Sunday');
$when = rtrim($days[$s_items[1]].', '.$s_items[2].' '.$s_items[3],',');
$time = $s_items[5];
$removables = array('<br>','Event', 'Status', 'confirmed', ':');
$where = str_replace($removables, '', ($s_items[12].' '.$s_items[13].' '.$s_items[14].' '.$s_items[15]));
$i++;
echo $when;
echo '<br>';
echo $time;
echo '<br>';
echo $where;
echo '<p></p>';
}


foreach ($s_items as $item){
    $item = htmlentities($item);
   /* if($item == 'When:'){
        $curr_item = $item;
        $identifier=true;
    }
    else if((strpos($item,','))){
        if($curr_item!='time'){
            $when = $when.' '.$item;
            $curr_item = 'date';
            $identifier = true;
        }
    }

    else if(strpos($item,'pm') ){
        $curr_item = 'time';
        $identifier = true;
        $time = $item;
    }
    if(strpos($item,"Where")){
        $curr_item = 'Where:';
        $itentifier = true;
      //  echo 'zzaazz:'.$item;
    }
    else if(strpos($item,"Event")){
        $curr_item = 'Event';
        $itentifier = true;
    }


    if($identifier==false){
        if($curr_item == 'When:'){
            $when=$when.' '.$item;
	}

	if($curr_item == 'Where:'){
            $where=$where.' '.$item;
        }

    }
*/
}




?>
