<?php
namespace UUU\Base;
use \DNMVCS\DNMVCS as DN;

class AppEx extends \DNMVCS\DNMVCS
{
	public $NO_SETTING=false;
	public $is_stop=false;
	public function onInit()
	{
		//$options['ext']['use_strict_db_manager']=true;
		DN::G()->assignRewrite([
			'~article/(\d+)/?(\d+)?'=>'article?id=$1&page=$2',
		]);

		DN::G()->assignRoute([
			'~abc(\d*)'=>function($x){var_dump("work",$x);},
		]);
		var_dump("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh {$this->path} hhhhhhhhhhhhhhhhhhhhh");
		return $this;
	}
	public function run()
	{
var_dump(md5(spl_object_hash(static::SG())));
var_dump(static::SG()->_SERVER['SCRIPT_FILENAME']);
		return parent::run($xx);
	}

}