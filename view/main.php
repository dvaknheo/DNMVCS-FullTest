<?php
use DNMVCS\DNMVCS as DN;
?>
<!doctype html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body>
<h1>Hello DNMVCS</h1>
<div>
Time Now is <?php echo $var;?>
</div>
<div>haha </div>
<hr/>
<?php DN::ShowBlock('inc-static');?>
<?php DN::ShowBlock('inc-backtrace');?>
<?php DN::ShowBlock('inc-coroutine');?>

</body>
</html>