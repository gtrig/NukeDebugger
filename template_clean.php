<?php
global $dbg;
?>

Controller:<?php echo $dbg->controller; ?>
Action:<?php echo $dbg->action; ?>
   
DBG Enabled at
file: <?php echo $dbg->enable_backtrace[1]['file'];?>
and line: <?php echo $dbg->enable_backtrace[1]['line'];?>

<?php
if($dbg->data_sql){
?>

------------------SQL Queries (<?php echo count($dbg->data_sql);?>)------------------
<?php
    foreach($dbg->data_sql as $k=>$entry)
    {
?>

<?php
$trace = $entry["backtrace"][0];
?>
<?php if($entry['description']!=""){ ?>
Desc : <?php echo $entry['description'];?>

<?php } ?>
File : <?php echo($trace['file']);?>

Line : <?php echo($trace['line']);?>

<?php echo($entry["data"]);?>

########

<?php
    }
}
?>
<?php
if($dbg->data_text){
?>



------------------Text (<?php echo count($dbg->data_text);?>)------------------
<?php
    foreach($dbg->data_text as $k=>$entry)
    {
?>
<?php
$trace = $entry["backtrace"][0];
?>
<?php if($entry['description']!=""){ ?>
Desc : <?php echo $entry['description'];?>

<?php } ?>
File : <?php echo($trace['file']);?>

Line : <?php echo($trace['line']);?>

<?php echo($entry["data"]);?>

########

<?php
    }
}
?>
<?php
if($dbg->data_array){
?>



------------------Arrays (<?php echo count($dbg->data_array);?>)------------------
<?php
    foreach($dbg->data_array as $k=>$entry)
    {
?>
<?php
$trace = $entry["backtrace"][0];
?>
<?php if($entry['description']!=""){ ?>
Desc : <?php echo $entry['description'];?>

<?php } ?>
File : <?php echo($trace['file']);?>

Line : <?php echo($trace['line']);?>

<?php print_r($entry["data"]);?>

########

<?php
    }
}
?>