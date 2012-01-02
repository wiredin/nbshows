<?php
$path = '';
require_once('header.php');
require_once('mysql_parse.php');
?>
    <div id="calendar">
        <?php
            while($show = mysql_fetch_array($results)){
                  $show_date = pretty_date($show['start_time']); //get pretty date from ugly SQL date_time
                  if($prev_date != $show_date){
        ?>
        <div class="whatDay"><?php echo $show_date; ?></div>
        <?php }
        $bands = get_bands_array($show);
         ?>
        <div class="whatShow">
          <?php
              foreach($bands as $band){ 
                  if($band['website']!='blank'){ ?> 
                      <a target="_blank" href="http://<?php echo $band['website']; ?>"><?php echo $band['name']; ?></a>         
                <?php  }else{   
  
                       echo ' <strong>'.$band['name'].'</strong> '; 
                  }
             
               $c++;
               echo ($c == count($bands) ? "": "//");    
               } 
             $c = 0;
           echo '-'.pretty_time($show['start_time']); ?> @ <?php echo $show['venue_name']; ?></div>
        <?php $prev_date=$show_date;
         }
       ?>
    </div>
<?php
require_once('footer.php');
?>
