<?php
$message = "CLIT Fest 2012 will be held in New Brunswick! <a href='http://clitfestnb.tumblr.com/donate'> Find out more.</a>";
require_once('main_functions.php');
require_once('config_variables.php');
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
        <?php } ?>
        <div class="whatShow">
          <?php
             $bands = get_bands_array($show);
             print_bands($bands,$show['canceled']);
           echo '-'.pretty_time($show['start_time']); ?> @ <?php echo $show['venue_name']; ?></div>
        <?php $prev_date=$show_date;
         }
       
       ?>
    </div>
<?php
require_once('footer.php');
?>
