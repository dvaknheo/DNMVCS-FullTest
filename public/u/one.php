<?php
require(__DIR__.'/../../headfile/headfile.php');

$options=[
	'path'=>__DIR__,
	'path_controller'=>'app/Controller',
	'path_view'=>'app/view',
	'path_config'=>'app/config',
	'path_lib'=>'app/lib',
	'ext'=>[
		'key_for_simple_route'=>'act',
		'key_for_simple_route_module' =>'module',
	]
];
\DNMVCS\DNMVCS::RunQuickly($options);