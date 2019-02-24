<?php
$a=[];//get_declared_classes();
var_dump("Client");
require(__DIR__.'/../headfile/headfile.php');

$project_root=realpath(__DIR__.'/..');

$options=[
	'path'=>$project_root,
];
//var_export(\DNMVCS\DNMVCS::G()->init()->options);return;

\DNMVCS\DNMVCS::RunQuickly($options);

//$b=get_declared_classes();var_dump(array_values(array_diff($b,$a)));