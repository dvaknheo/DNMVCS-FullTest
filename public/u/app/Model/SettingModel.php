<?php
namespace UUU\Model;
use DNMVCS\DNMVCS as DN;

class SettingModel extends BaseModel
{
	public function get($key)
	{
		$sql="SELECT v FROM Settings WHERE k=?";
		$ret=DN::DB()->fetchColumn($sql,$key);
		return $ret;
	}
	public function set($key,$value)
	{

		$sql="INSERT INTO Settings (k,v) VALUES(?,?) ON DUPLICATE KEY UPDATE  v=?";
		$ret=DN::DB()->execQuick($sql,$key,$value,$value);
	}
}