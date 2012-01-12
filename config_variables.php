<?php


$link = openDB();
$str = new MysqlStringEscaper;

$query = "SELECT * FROM `variables`;";
$results = mysql_query($query);


while($row=mysql_fetch_array($results)){
      $GLOBALS[$row['name']] = $row['value'];
}
?>
