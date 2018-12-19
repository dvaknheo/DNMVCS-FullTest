<?php
use DNMVCS\DNMVCS as DN;
?>
<!doctype html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body>
<h1>Hello DNMVCS</h1>
<div>
欢迎使用 DNMVCS.
<a href="/OneFile.php">“一个文件全部模式”</a>
路由方式，子目录的路由

Time Now is <?php echo $var;?>
</div>
<?php // co:sleep(3);?>
<hr/>
<?php DN::ShowBlock('inc-static.php');?>
<?php DN::ShowBlock('inc-function.php');?>
<?php DN::ShowBlock('inc-backtrace');?>
<?php DN::ShowBlock('inc-file');?>

<?php DN::ShowBlock('inc-superglobal');?>

<?php DN::ShowBlock('inc-coroutine');?>

</body>
</html>