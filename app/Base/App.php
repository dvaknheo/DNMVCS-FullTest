<?php
namespace MY\Base;
class App extends \DNMVCS\DNMVCS
{
	public function init($options=array())
	{
		$options['ext']['use_strict_db_manager']=true;
		$options['ext']['use_facade']=true;
		parent::init($options);
		return $this;
	}
}