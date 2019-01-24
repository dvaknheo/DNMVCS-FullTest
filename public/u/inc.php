<?php
require(__DIR__.'/../../headfile/headfile.php');

$options=[
	'path'=>__DIR__,
	'path_controller'=>'app/Controller',
	'path_view'=>'app/view',
	'path_config'=>'app/config',
	'path_lib'=>'app/lib',
	'ext'=>[
		'key_for_action'=>null,
		'path_mode'=>true,
		'path_mode_path'=>__DIR__,
		'path_mode_to_action'=>true;
		'path_mode_key_for_action'=>'act',
	],
];
\DNMVCS\DNMVCS::RunQuickly($options);


return;
?>
<a href="/u/one.php">无缝切换到无 path_info 方式</a>


<pre>
///
///  login  => u/login.php
///  '' => u/index.php
///  'admin/foo'=> u/admin.php?act= foo


//  one_file_mode ,filename.
</pre>
