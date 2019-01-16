<?php
$file=realpath(__DIR__.'/../../DNMVCS/SwooleHttpServer.php');
if(is_file($file)){
	require($file);
}else{
	exit("Can't found DNMVCS.php -- By ".__FILE__);
}
$path=realpath(__DIR__.'/../').'/';

$server_options=[
	'port'=>9528,
	'http_handler_basepath'=>$path,
	'http_handler_root'=>'public',
];
\DNMVCS\SwooleHttpServer::G()->init($server_options)->run();