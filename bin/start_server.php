<?php
$file=realpath(__DIR__.'/../../DNMVCS/DNMVCS.php');
if(is_file($file)){
	require $file;
}else{
////[[[[
$IN_COMPOSER=true;

$project_root=realpath(__DIR__.'/..');

if($IN_COMPOSER){
	require($project_root.'/vendor/autoload.php');
}else{
	require($project_root.'/../DNMVCS.php');
}
////]]]]
}
////[[[[
$path=realpath(__DIR__.'/../').'/';
$server_options=[
	'port'=>9528,
	//'http_handler_basepath'=>$path,
];

$dn_options=[
	'path'=>$path,
];

////]]]]

$setting=[];
$setting_file=$path.'config/setting.php';
if(is_file($setting_file)){
	$setting=include($setting_file);
}
$server_options=array_replace_recursive($server_options,$setting['server_options']??[]);

$server=null;
\DNMVCS\DNMVCS::RunAsServer($server_options,$dn_options,$server);