<?php

openDB();
$str = new MysqlStringEscaper;

$query = "SELECT S.show_id, S.venue_id, venue_name, start_time, submitter_id, sb.band_id, group_concat(`band_name` separator ',') AS bands, group_concat(`website` separator ',') AS websites, group_concat(`order` separator ',') AS `order`, group_concat(`location` separator ',') AS locations  FROM `shows` S, `bands` B, `show_bands` sb, `venues` V WHERE (start_time + INTERVAL 6 HOUR) > NOW() AND  B.band_id=sb.band_id AND S.show_id=sb.show_id AND V.venue_id=S.venue_id GROUP BY sb.show_id  ORDER BY start_time ASC;";

$results = mysql_query($query);


?>
