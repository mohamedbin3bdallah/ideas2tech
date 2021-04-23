<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
		parent::__construct();
		$this->sections = array();
		$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
		if(!empty($sections))
		{
			foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
		}
	}
	
	public function login()
	{
		//header('Content-Type: application/json');
		//header('Content-Type: text/html; charset=utf-8');

		$response = array('data'=>'');
		if(in_array('U',$this->sections))
		{
			//$_POST = '{"email":"aaaaa@aaaaa.com","password":"123123"}';
			//$request = json_decode($_POST);
			//$request = json_decode(file_get_contents('php://input'));
			$request = $_POST;
			if(isset($request) && !empty($request))
			{
				if(isset($request['email'],$request['password']))
				{
					$data = $this->Admin_mo->getrow('users',array('uemail'=>str_replace(array('"',"'",' '), '',$request['email']),'uutid'=>'5'));
					if(isset($data) && !empty($data))
					{
						if(password_verify($request['password'], $data->upassword))
						{
							if($data->uactive == '1')
							{
								$response['message'] = 'user_exist';
								$response['data'] = array('id'=>$data->uid,'name'=>$data->uname);
								$response['code'] = '1';
							}
							else { $response['message'] = 'user_not_active'; $response['code'] = '6'; }
						}
						else { $response['message'] = 'password_not_match'; $response['code'] = '5'; }
					}
					else { $response['message'] = 'user_not_exist'; $response['code'] = '0'; }
				}
				else { $response['message'] = 'request_match_error'; $response['code'] = '4'; }
			}
			else { $response['message'] = 'request_error'; $response['code'] = '3'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}

	public function register()
	{
		$response = array('data'=>'');
		if(in_array('U',$this->sections))
		{
			//$request = json_decode($_POST);
			//$request = json_decode(file_get_contents('php://input'));
			$request = $_POST;
			if(isset($request) && !empty($request))
			{
				if(isset($request['name'],$request['username'],$request['password'],$request['email'],$request['mobile'],$request['address']))
				{
					$username = $this->Admin_mo->exist('users',' where username like "'.str_replace(array('"',"'",' '), '',$request['username']).'"','');
					$email = $this->Admin_mo->exist('users',' where uemail like "'.str_replace(array('"',"'",' '), '',$request['email']).'"','');
					$mobile = $this->Admin_mo->exist('users',' where umobile like "'.str_replace(array('"',"'",' '), '',$request['mobile']).'"','');
					if($username == 0 && $email == 0 && $mobile == 0)
					{
						$verificationCode = mt_rand(11111,99999);
						$set_arr = array('uutid'=>5, 'uname'=>str_replace(array('"',"'"), '',$request['name']), 'username'=>str_replace(array('"',"'",' '), '',$request['username']), 'uemail'=>str_replace(array('"',"'",' '), '',$request['email']), 'umobile'=>str_replace(array('"',"'",' '), '',$request['mobile']), 'uaddress'=>$request['address'], 'upassword'=>password_hash($request['password'], PASSWORD_BCRYPT, array('cost'=>10)), 'ucode'=>$verificationCode, 'utime'=>time());
						$uid = $this->Admin_mo->set('users', $set_arr);
						if(empty($uid))
						{
							$response['message'] = 'somthing_wrong';
							$response['code'] = '5';
						}
						else
						{
							$response['message'] = 'success';
							$response['data'] = 'Activation link: '.base_url().'frontend/active/'.$request['username'].'/'.$verificationCode;
							$response['code'] = '1';
						}
					}
					else
					{
						if($username != 0) $response['message'][] = 'username_exist';
						if($email != 0) $response['message'][] = 'email_exist';
						if($mobile != 0) $response['message'][] = 'mobile_exist';
						$response['code'] = '0';
					}
				}
				else { $response['message'] = 'request_match_error'; $response['code'] = '4'; }
			}
			else { $response['message'] = 'request_error'; $response['code'] = '3'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function forgotpassword()
	{
		$response = array('data'=>'');
		if(in_array('U',$this->sections))
		{
			//$request = json_decode($_POST);
			//$request = json_decode(file_get_contents('php://input'));
			$request = $_POST;
			if(isset($request) && !empty($request))
			{
				if(isset($request['email']))
				{
					$email = $this->Admin_mo->exist('users',' where uemail like "'.str_replace(array('"',"'",' '), '',$request['email']).'"','');
					if($email != 0)
					{
						$newpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+') , 0 , 9);
						if($this->Admin_mo->update('users', array('upassword'=>password_hash($newpassword, PASSWORD_BCRYPT, array('cost'=>10)),'uuid'=>0,'utime'=>time()), array('uemail'=>$request['email'])))
						{
							$response['message'] = 'success';
							$response['data'] = 'New Password: '.$newpassword;
							$response['code'] = '1';
						}
						else
						{
							$response['message'] = 'somthing_wrong';
							$response['code'] = '5';
						}
					}
					else
					{
						$response['message'] = 'email_not_exist';
						$response['code'] = '0';
					}
				}
				else { $response['message'] = 'request_match_error'; $response['code'] = '4'; }
			}
			else { $response['message'] = 'request_error'; $response['code'] = '3'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function services()
	{
		$response = array('data'=>'');
		if(in_array('CG',$this->sections))
		{
			$data = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
			if(isset($data) && !empty($data))
			{
				$response['message'] = 'data_exist';
				$response['image'] = base_url().$this->config->item('categories_folder');
				$response['thumb'] = base_url().$this->config->item('categories_thumb_folder');
				$response['data'] = $data;
				$response['code'] = '1';
			}
			else { $response['message'] = 'data_not_exist'; $response['code'] = '0'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function projects()
	{
		$response = array('data'=>'');
		if(in_array('PR',$this->sections))
		{
			$data = $this->Admin_mo->getjoinLeft('products.*,categories.cgtitleen as categoryen,categories.cgtitlear as categoryar','products',array('categories'=>'products.prcgid = categories.cgid'),array('cgactive'=>'1','practive'=>'1'));
			if(isset($data) && !empty($data))
			{
				$response['message'] = 'data_exist';
				$response['image'] = base_url().$this->config->item('products_folder');
				$response['thumb'] = base_url().$this->config->item('products_thumb_folder');
				$response['data'] = $data;
				$response['code'] = '1';
			}
			else { $response['message'] = 'data_not_exist'; $response['code'] = '0'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function faq()
	{
		$response = array('data'=>'');
		if(in_array('FA',$this->sections))
		{
			$data = $this->Admin_mo->getwhere('faq',array('faactive'=>'1'));
			if(isset($data) && !empty($data))
			{
				$response['message'] = 'data_exist';
				$response['data'] = $data;
				$response['code'] = '1';
			}
			else { $response['message'] = 'data_not_exist'; $response['code'] = '0'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function about()
	{
		$response = array('data'=>'');
		if(in_array('AB',$this->sections))
		{
			$data = $this->Admin_mo->getrow('about',array('abid'=>'1'));
			if(isset($data) && !empty($data))
			{
				$response['message'] = 'data_exist';
				$response['data'] = $data;
				$response['code'] = '1';
			}
			else { $response['message'] = 'data_not_exist'; $response['code'] = '0'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function plans()
	{
		$response = array('data'=>'');
		if(in_array('PL',$this->sections))
		{			$system = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data = $this->Admin_mo->getjoinLeft('plans.*,categories.cgtitleen as categoryen,categories.cgtitlear as categoryar','plans',array('categories'=>'plans.plcgid = categories.cgid'),array('cgactive'=>'1','plactive'=>'1'));
			if(isset($data) && !empty($data))
			{
				$response['message'] = 'data_exist';
				$response['data'] = $data;								$response['currency'] = $system->currency;								$response['payemail'] = $system->payemail;
				$response['code'] = '1';
			}
			else { $response['message'] = 'data_not_exist'; $response['code'] = '0'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
	
	public function contact()
	{
		$response = array();
		if(in_array('MG',$this->sections))
		{
			//$request = json_decode($_POST);
			//$request = json_decode(file_get_contents('php://input'));
			$request = $_POST;
			if(isset($request) && !empty($request))
			{
				if(isset($request['id'],$request['name'],$request['email'],$request['title'],$request['body']))
				{
					$set_arr = array('mgeid'=>$request['id'], 'mgname'=>$request['name'], 'mgemail'=>$request['email'], 'mgtitle'=>$request['title'], 'mgbody'=>$request['body'], 'mgtime'=>time());
					$mgid = $this->Admin_mo->set('messages', $set_arr);
					if(!empty($mgid))
					{
						$response['message'] = 'success';
						$response['code'] = '1';
					}
					else { $response['message'] = 'somthing_wrong'; $response['code'] = '5'; }
				}
				else { $response['message'] = 'request_match_error'; $response['code'] = '4'; }
			}
			else { $response['message'] = 'request_error'; $response['code'] = '3'; }
		}
		else { $response['message'] = 'plugin_not_active'; $response['code'] = '2'; }
		
		echo json_encode($response);
	}
}