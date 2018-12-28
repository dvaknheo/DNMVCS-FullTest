<?php
require(__DIR__.'/../headfile/headfile.php');

////[[[[
$path=realpath(__DIR__.'/../').'/';
$server_options=[
	'port'=>9528,
	'http_handler_basepath'=>$path,
	'http_handler_root'=>'public/t'
];

$dn_options=[
	'path'=>$path,
	'swoole'=>[
		'use_http_handler_root'=>true,
	],
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