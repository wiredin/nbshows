<?php
$path = '';
require_once('header.php');
require_once('parse.php');
$shows = get_and_sort_shows();
?>
    <div id="calendar">
        <?php
        foreach($shows as $show){
            if($prev_date != $show['date']){
        ?>
        <div class="whatDay"><?php echo $show['date']; ?></div>
        <?php } ?>
        <div class="whatShow"><a href="#"><?php echo $show['title']; ?></a> -<?php echo $show['time']; ?> @ <?php echo $show['where']; ?></div>
        <?php $prev_date=$show['date'];
         } ?>
    </div>
<?php
require_once('footer.php');
?>
