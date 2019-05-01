<?php
namespace UUU\Controller;
use DNMVCS\DNMVCS as DN;
use DNMVCS\Pager;
use DNMVCS\DNException;

use UUU\Service\SessionService;
use UUU\Service\ArticleService;
use UUU\Service\UserService;

class Main
{
	public function __construct()
	{
	}
	public function index()
	{
		$page=intval(DN::SG()->_GET['page']??1);
		$page=($page>1)?:1;

		$user=SessionService::G()->getCurrentUser();
		
		list($articles,$total)=ArticleService::G()->getRecentArticle($page);
		DN::RecordsetH($articles,['title']);
		DN::RecordsetURL($articles,['url'=>'article/{id}']);


		$url_reg=DN::URL('reg');
		$url_login=DN::URL('login');
		$url_logout=DN::URL('logout');
		$url_admin=DN::URL('admin');
		
		DN::Show(get_defined_vars(),'main');
	}
	public function article()
	{
		$user=SessionService::G()->getCurrentUser();
		
		$id=intval(DN::SG()->_GET['id']??1);
		$page=intval(DN::SG()->_GET['page']??1);
		$page=($page>1)?:1;
		$page_size=10;
		
		$article=ArticleService::G()->getArticleFullInfo($id,$page,$page_size);
		if(!$article){
			DN::G()->onShow404();return;
		}
		DN::RecordsetH($article['comments'],['content','username']);
		$html_pager=Pager::Render($article['comments_total']);
		$url_add_comment=DN::URL('addcomment');
		DN::Show(get_defined_vars(),'article');
	}
	public function reg()
	{
		DN::G()->setViewWrapper('user/inc_head.php','user/inc_foot.php');
		DN::Show(get_defined_vars(),'user/reg');
	}
	public function login()
	{
		DN::G()->setViewWrapper('user/inc_head.php','user/inc_foot.php');
		DN::Show(get_defined_vars(),'user/login');
	}
	public function logout()
	{
		SessionService::G()->logout();
		DN::ExitRouteTo('');
	}
	
	public function do_reg()
	{
		try{
			$user=UserService::G()->reg(DN::SG()->_POST['username'],DN::SG()->_POST['password']);
		}catch(DNException $ex){
			DN::G()->assignViewData('error_info',$ex->getMessage());
			return $this->reg();
		}
		SessionService::G()->setCurrentUser($user);
		DN::ExitRouteTo('');
	}
	public function do_login()
	{
		try{
			$user=UserService::G()->login(DN::SG()->_POST['username'],DN::SG()->_POST['password']);
		}catch(DNException $ex){
			DN::G()->assignViewData('error_info',$ex->getMessage());
			return $this->login();
		}
		SessionService::G()->setCurrentUser($user);
		DN::ExitRouteTo('');
	}
	public function do_addcomment()
	{
		$user=SessionService::G()->getCurrentUser();
		UserService::G()->addComment($user['id'],DN::SG()->_POST['article_id'],DN::SG()->_POST['content']);
		DN::ExitRouteTo('');
	}
	public function do_delcomment()
	{
		$user=SessionService::G()->getCurrentUser();
		UserService::G()->deleteCommentByUser($user['id'],DN::SG()->_POST['id']);
		DN::ExitRouteTo('');
	}
	public function dump()
	{

		$ret=[];
		$tables=['Articles'];
		foreach($tables as $table){
			try{
				$sql="SHOW CREATE TABLE $table";
				$data=DN::DB()->fetch($sql);
				$str=$data['Create Table'];
				$str=preg_replace('/AUTO_INCREMENT=\d+/','AUTO_INCREMENT=1',$str);
				$ret[$table]=$str;
			}catch(\PDOException $ex){}
		}
		var_dump($ret);
		return $ret;
	}
}