<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
    <title>NB Shows</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" > 
    <LINK href="<?php echo $path ?>stylesheets/styles.css" rel="stylesheet" type="text/css">
    <link rel="icon" 
      type="image/png" 
      href="favicon.ico">

    <script type="text/javascript">

      var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-250964-3']);
     _gaq.push(['_trackPageview']);

     (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    </script>

<!--list a show custom JS-->
<?php if($page=="listashow"){ ?>
<script type="text/javascript" src="<?php echo $path ?>javascripts/prototype.js"></script>
<script type="text/javascript" src="<?php echo $path ?>javascripts/calendarview.js"></script>
 <script>
      function setupCalendars() {

        // Popup Calendar
        Calendar.setup(
          {
            dateField: 'selected_date',
            triggerElement: 'selected_date'
          }
        )
      }

      Event.observe(window, 'load', function() { setupCalendars() })
    </script>
<?php
}
?>
<!-- end list a show custom JS-->
</head>
<body>
    <div id="content">
   <div class="headerMessage"><span class="headerMessageSpan">
    <?php
        echo $message;
    ?>
    </span>
    </div>

    <div id="header"><h2><a href="<?php echo $path; ?>"><img src="<?php echo $path ?>images/nbshows_evan_150.png" alt="NB Shows Logo"></a></h2><h4>The Unofficial NB Show Calendar</h4></div>


