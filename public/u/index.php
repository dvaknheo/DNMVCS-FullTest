<?php
require(__DIR__.'/../../headfile/headfile.php');

$options=[
	'path'=>__DIR__,
	'path_controller'=>'app/Controller',
	'path_view'=>'app/view',
	'path_config'=>'app/config',
	'path_lib'=>'app/lib',
];
\DNMVCS\DNMVCS::RunQuickly($options);

?>
<a href="/u/one.php">无缝切换到无 path_info 方式</a>

