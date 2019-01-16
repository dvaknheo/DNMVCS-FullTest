<?php
require(__DIR__.'/../headfile/headfile.php');

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
$server_options['port']=$_SERVER['argv'][1])??$server_options['port'];
$server=null;
\DNMVCS\DNMVCS::RunAsServer($server_options,$dn_options,$server);