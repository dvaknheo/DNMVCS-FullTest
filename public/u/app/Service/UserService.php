<?php
namespace MY\Service;
use DNMVCS\DNMVCS as DN;
use MY\Model as M;
use MY\Model\ActionLogModel;
use MY\UserException;
use MY\Model\UserModel;
use MY\Model\CommentModel;

class UserService
{
	use \DNMVCS\DNSingleton;
	public function reg($username,$password)
	{		
		$user=UserModel::G()->getUserByName($username);
		DN::ThrowOn($user,"用户已经存在");
		$id=UserModel::G()->addUser($username,$password);
		DN::ThrowOn(!$id,"注册失败");
		
		ActionLogModel::G()->log("$username 注册",'reg');
		
		return UserModel::G()->getUserDirect($id);
	}
	public function login($username,$password)
	{
		$user=UserModel::G()->getUserByName($username);
		DN::ThrowOn(!$user,"用户不存在");
		
		$flag=UserModel::G()->checkPass($password,$user['password']);
		DN::ThrowOn(!$flag,"密码错误");
		
		ActionLogModel::G()->log("$username 登录成功");
		unset($user['password']);
		ActionLogModel::G()->log("{$user['username']} 登录");
		return $user;
	}
	public function getUser($id)
	{
		$user=UserModel::G()->getUserDirect($id);
		unset($user['password']);
		return $user;
	}
	// 以下是各种操作
	
	public function changePassword($user_id,$oldpass,$newpass)
	{
		$user=UserModel::G()->getUserDirect($user_id);
		DN::ThrowOn(!$user,"用户不存在");
		
		$flag=UserModel::G()->checkPass($oldpass,$user['password']);
		DN::ThrowOn(!$flag,"旧密码错误");
		
		UserModel::G()->changePass($user['id'],$newpass);;
		ActionLogModel::G()->log("{$user['username']} 修改了登录密码");
	}
	public function addComment($user_id,$article_id,$content)
	{
		$user=UserModel::G()->getUserDirect($user_id);
		DN::ThrowOn(!$user,"用户不存在");
		
		CommentModel::G()->addData($user_id,$article_id,$content);
		ActionLogModel::G()->log("{$user['username']} 评论成功");
	}
	public function deleteCommentByUser($user_id,$comment_id)
	{
		$user=UserModel::G()->getUserDirect($user_id);
		DN::ThrowOn(!$user,"用户不存在");
		
		$comment=CommentModel::G()->get($comment_id);
		DN::ThrownOn(!$comment,"没找到评论");
		DN::ThrownOn($comment['user_id']!=$user_id,"不是你的评论",-1);
		CommentModel::G()->delete($id);
		ActionLogModel::G()->log("{$user['username']} 删除评论成功");
	}
}