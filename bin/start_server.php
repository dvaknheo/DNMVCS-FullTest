<?php
require(__DIR__.'/../headfile/headfile.php');

////[[[[
$path=realpath(__DIR__.'/../').'/';
$httpd_options=[
	'port'=>9528,
	'http_handler_basepath'=>$path,
	'http_handler_root'=>'public',
	'with_http_handler_root'=>true,
];

$dn_options=[
	'path'=>$path,
	'swoole'=>$httpd_options,
];

////]]]]

$setting=[];
$setting_file=$path.'config/setting.php';
if(is_file($setting_file)){
	$setting=include($setting_file);
}
$server_options=array_replace_recursive($httpd_options,$setting['httpd_options']??[]);
$server_options['port']=($_SERVER['argv'][1])??$server_options['port'];
$server=null;
\DNMVCS\DNMVCS::RunAsServer($dn_options,$server);