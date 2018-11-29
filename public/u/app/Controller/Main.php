<?php
namespace MY\Controller;
use DNMVCS\DNMVCS as DN;
use MY\Service as S;
use MY\Service\SessionService;
use MY\Service\ArticleService;
use MY\Service\UserService;
class FacadeRoot
{
 public static function __callStatic($name, $arguments) 
    {
        // 注意: $name 的值区分大小写
        echo "Calling static method '$name' "
             . implode(', ', $arguments). "\n";
			 var_dump(static::class);
			 var_dump(get_called_class());
			 debug_print_backtrace();
    }
}
class JustFacade
{
	public static function Foo()
	{
		echo "Hit!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
	}
}
class DNController
{
	public function __construct()
	{
		DN::Import('Pager');
		/*
		DN::G()->assignExceptionHandler('DNMVCS\DNException',function($ex){

			var_dump($ex->getMessage());
		});
			*/
	}
	public function i()
	{
		$t=$_SERVER;
		ksort($t);
		var_export($t);
	}
	public function index()
	{
		$page=intval($_GET['page']??1);
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
		$params=DN::Parameters();
		
		$id=intval($_GET['id']??1);
		$page=intval($_GET['page']??1);
		$page=($page>1)?:1;
		$page_size=10;
		
		$article=S\ArticleService::G()->getArticleFullInfo($id,$page,$page_size);
		if(!$article){
			DN::G()->onShow404();return;
		}
		DN::RecordsetH($article['comments'],['content','username']);
		$html_pager=(new \Pager($article['comments_total'],$page_size))->get_page_output();
		$url_add_comment=DN::URL('addcomment');
		DN::Show(get_defined_vars(),'article');
	}
	public function reg()
	{
debug_print_backtrace();		DN::G()->setViewWrapper('user/inc_head.php','user/inc_foot.php');
		DN::Show(get_defined_vars(),'user/reg');
	}
	public function login()
	{
	var_dump("ssssssssssss");
	debug_print_backtrace();
		DN::G()->setViewWrapper('user/inc_head.php','user/inc_foot.php');
		DN::Show(get_defined_vars(),'user/login');
	}
	public function logout()
	{
		SessionService::G()->logout();
		DN::ExitRouteTo('/');
	}
	
	public function do_reg()
	{
		$user=UserService::G()->reg($_POST['username'],$_POST['password']);
		SessionService::G()->setCurrentUser($user);
		DN::ExitRouteTo('/');
	}
	public function do_login()
	{
		$user=UserService::G()->login($_POST['username'],$_POST['password']);
		SessionService::G()->setCurrentUser($user);
		
		DN::ExitRouteTo('/');
	}
	public function do_addcomment()
	{
		$user=SessionService::G()->getCurrentUser();
		UserService::G()->addComment($user['id'],$_POST['article_id'],$_POST['content']);
		
		DN::ExitRouteTo('/');
	}
	public function do_delcomment()
	{
		$user=SessionService::G()->getCurrentUser();
		UserService::G()->deleteCommentByUser($user['id'],$_POST['id']);
		
		DN::ExitRouteTo('/');
	}
}