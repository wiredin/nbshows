<?php

function cmp($a, $b)
{
    if ($a['full_date'] == $b['full_date']) {
        return 0;
    }
    return ($a['full_date'] < $b['full_date']) ? -1 : 1;
}

function get_and_sort_shows()
{

    $completeurl = "https://www.google.com/calendar/feeds/2auatm870r5a2as9ukgmnp3jq0%40group.calendar.google.com/public/basic";
    $xml = simplexml_load_file($completeurl);


    $shows =array(array('title'=>null,'date'=>null,'time'=>null,'where'=>null,'full_date'=>null));
    $i=0;
    $k=0;
    while($title = $xml->entry[$i]->title)
    {
	$s_items = split(' ',$xml->entry[$i]->summary);

	$days = array('Mon'=>'Monday', 'Tue'=>'Tuesday', 'Wed'=>'Wednesday', 'Thu'=>'Thursday', 'Fri'=>'Friday','Sat'=>'Saturday', 'Sun'=>'Sunday');
	$when = rtrim($days[$s_items[1]].', '.$s_items[2].' '.$s_items[3],',');
	$full_date = $s_items[2].' '.$s_items[3].' '.$s_items[4];
	$time = $s_items[5];
	$removables = array('<br>','Event', 'Status', 'confirmed', ':');
	$where = str_replace($removables, '', ($s_items[12].' '.$s_items[13].' '.$s_items[14].' '.$s_items[15]));
        $full_date=strtotime($full_date);
        $now = getdate();
        if(($full_date) && ($full_date >= $now[0]-100000))
	{
	    $shows[$k]['title'] = $title;
	    $shows[$k]['date'] = $when;
	    $shows[$k]['time'] = $time;
	    $shows[$k]['where'] = $where;
	    $shows[$k]['full_date'] = $full_date;
            $k++;
	}  
        
        $i++;
     }
     
    
     usort($shows,"cmp");
     return $shows;

}




?>
