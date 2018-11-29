<?php
use DNMVCS\DNMVCS as DN;
?>
<!doctype html>
<html>
<body>
<h1>Hello DNMVCS</h1>
<div>
Time Now is <?php echo $var;?>
</div>
<div>For More Take the DNMVCS-FullTest (TODO)</div>
<hr/>
<?php DN::ShowBlock('inc-static',$this->data);
?>
</body>
</html>