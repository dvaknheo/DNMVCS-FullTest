<?php

require(__DIR__.'/../headfile/headfile.php');

$project_root=realpath(__DIR__.'/..');

$options=[
	'path'=>$project_root,
];
//var_export(\DNMVCS\DNMVCS::G()->init()->options);return;

\DNMVCS\DNMVCS::RunQuickly($options);
return;
//$b=get_declared_classes();var_dump(array_values(array_diff($b,$a)));
var_export(\DNMVCS\DNMVCS::G()->options);
echo "zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";
register_shutdown_function(function(){
$e=error_get_last();

if(E_COMPILE_ERROR===$e['type']){
    echo "something wrong~";
}else{
    var_dump($e);
}
ob_end_flush();

});
ob_start(function($str){
    return "[[ $str]]";
});

try{
    echo  "aaaaaaaaaaaaaaaa";
    require('noooooooooo.php');
    echo "bbbbbbbbbbbbbbbbbb";
}catch(\Throwable $ex){
    var_dump("??????????????????????????????");
}
ob_end_flush();
echo "zzzzzzzzzzzzzzzzzzzzzzzzzzzz";