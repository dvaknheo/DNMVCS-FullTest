<?php
namespace MY\Base;
use Facades\MY\Base\App as FA;
use JsonRpc\MY\Service\TestSerice;

class App extends \DNMVCS\DNMVCS
{
	protected function onInit()
	{
        $this->options['ext']['Ext\FacadesAutoLoader']=[
            'facades_namespace'=>'Facades',
        ];
        $this->options['ext']['Ext\JsonRpcExt']=[
            'jsonrpc_backend'=>['http://test.dnmvcs.dev/json_rpc','127.0.0.1:80'],
        ];
		//return parent::init($options,$context);
	}
    protected function onRun()
    {
       
    }
	public static function ST()
	{
		var_dump("STSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTST");
	}

	public function foo()
	{
		var_dump("foo");
	}
	
	public function foo2()
	{
		var_dump("foo2");
	}
}