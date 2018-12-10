<?php
require(__DIR__.'/../boot/headfile.php');

$project_root=realpath(__DIR__.'/..');

$options=[
	'path'=>$project_root,
];
\DNMVCS\DNMVCS::RunQuickly($options);
//$path=realpath('../');
//\DNMVCS\DNMVCS::G()->init(['path'=>$path])->run();