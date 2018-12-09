<?php
namespace MY\Base;
use \DNMVCS\DNMVCS as DN;

class App extends \DNMVCS\DNMVCS
{
	public $NO_SETTING=false;
	public $is_stop=false;
	public function init($options=[])
	{
		$options['ext']['use_strict_db_manager']=true;
		$options['ext']['use_ext_db']=true;
		parent::init($options);
		DN::G()->assignRewrite([
			'~article/(\d+)/?(\d+)?'=>'article/?id=$1&page=$2',
		]);
		
		DN::G()->assignRoute([
			'~abc(\d*)'=>function($x){var_dump("work",$x);},
		]);

		return $this;
	}
	public function run()
	{
		if($this->is_stop){return;}
		return parent::run();
	}

}