<?php
use \DNMVCS\DNMVCS as DN;
//var_dump("OK");exit;
//require('inc.php');return;
//chdir(__DIR__);
require(__DIR__.'/../../headfile/headfile.php');

$options=[
	'path'=>__DIR__,
	'namespace'=>'UUU',
	'path_controller'=>'app/Controller',
	'path_view'=>'app/view',
	'path_config'=>'app/config',
	'path_lib'=>'app/lib',
	//'ext'=>['x'=>'z'],
	'base_class'=>'Base\AppEx',
	
];
try{
echo "aa\n\nn\n\n\<hr />\n\n\n";
echo md5(spl_object_hash(DN::G()));

echo "bbb<hr />\n";

DN::G()->init($options);
echo md5(spl_object_hash(DN::G()));

echo " ccc<hr />\n";

DN::G()->run();
echo "ddd<hr />\n";

}catch(\Throwable $ex){
var_dump($ex);
}
echo "bb";

return;
var_dump(\DNMVCS\DNMVCS::SG()->_GET);
var_dump(DATE(DATE_ATOM));return;

var_dump("22222222~");

$old_url="a/b?g=aaaaa";
$template_url="~a/b";
$new_url="e/f?g=h";
$t=\DNMVCS\RouteHookMapAndRewrite::G()->replaceRegexUrl($old_url,$template_url,$new_url);
var_dump($t);
var_dump(DATE(DATE_ATOM));return;

$url="test/a?bc=d";
?>

<a href="<?= \DNMVCS\DNMVCS::URL($url);?>"><?= \DNMVCS\DNMVCS::URL($url);?></a>
<a href="/u/one.php">无缝切换到无 path_info 方式</a>

