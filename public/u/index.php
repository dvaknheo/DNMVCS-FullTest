<?php
require(__DIR__.'/../../vendor/autoload.php');

$options=[
	'path'=>__DIR__,
	'path_view'=>'app/view',
	'path_config'=>'app/config',
	'path_lib'=>'app/lib',
];
\DNMVCS\DNMVCS::RunQuickly($options);