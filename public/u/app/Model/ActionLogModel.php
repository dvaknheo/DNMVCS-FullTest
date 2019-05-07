<?php
namespace UUU\Model;
use UUU\Base\ModelHelper as M;

class ActionLogModel
{
	public function log($action,$type='')
	{
		M::DB()->insertData('ActionLogs',['contents'=>$action,'type'=>$type,'created_at'=>date('Y-m-d H:i:s')]);
	}
	public function get($id)
	{
		
	}
	public function getList(int $page=1,int $page_size=10)
	{
		$start=$page-1;
		$sql="SELECT SQL_CALC_FOUND_ROWS  * from ActionLogs where true order by id desc limit $start,$page_size";
		$data=M::DB()->fetchAll($sql);
		$sql="SELECT FOUND_ROWS()";
		$total=M::DB()->fetchColumn($sql);
		return array($data,$total);
	}
}