<?php
namespace MY\Model;
use DNMVCS\DNMVCS as DN;

class ActionLogModel extends \DNMVCS\DNModel
{
	public function log($action,$type='')
	{
		DN::DB()->insert('ActionLogs',['contents'=>$action,'type'=>$type,'created_at'=>date('Y-m-d H:i:s')]);
	}
	public function get($id)
	{
		
	}
	public function getList(int $page=1,int $page_size=10)
	{
		$start=$page-1;
		$sql="SELECT SQL_CALC_FOUND_ROWS  * from ActionLogs where true order by id desc limit $start,$page_size";
		$data=DN::DB()->fetchAll($sql);
		$sql="SELECT FOUND_ROWS()";
		$total=DN::DB()->fetchColumn($sql);
		return array($data,$total);
	}
}