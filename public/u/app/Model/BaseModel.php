<?php
namespace UUU\Model;
use \DNMVCS\DNMVCS as DN;

class BaseModel
{
	use \DNMVCS\DNSingleton;

	public $table_name=null;
	public function getList(int $page=1,int $page_size=10){
		$start=$page-1;
		$sql="SELECT SQL_CALC_FOUND_ROWS  * from {$this->table_name} where deleted_at is null order by id desc limit $start,$page_size";
		$data=DN::DB()->fetchAll($sql);
		$sql="SELECT FOUND_ROWS()";
		$total=DN::DB()->fetchColumn($sql);
		return array($data,$total);
	}
	public function get($id)
	{
		$sql="select * from {$this->table_name} where id =? and deleted_at is null";
		$ret=DN::DB()->fetch($sql,$id);
		return $ret;
	}
	public function add($data)
	{
		$date=date('Y-m-d H:i:s');
		$data['created_at']=$date;
		$data['updated_at']=$date;
		$ret=DN::DB()->insert($this->table_name,$data);
		
		return $ret;
	}
	public function update($id,$data)
	{
		$date=date('Y-m-d H:i:s');
		$data['updated_at']=$date;
		$ret=DN::DB()->update($this->table_name,$id,$data);
		
		return $ret;
	}
	public function delete($id)
	{
		$date=date('Y-m-d H:i:s');
		$sql="update $this->table_name set deleted_at=? where id=? ";
		$ret=DN::DB()->execQuick($sql,$date,$id);
		return $ret;
	}
}