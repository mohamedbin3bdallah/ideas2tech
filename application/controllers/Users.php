<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$this->mysystem = $this->Admin_mo->getrow('system',array('id'=>'1'));
	    if(!$this->session->userdata('uid'))
	    { 
			redirect('home');
	    }
		else
		{
			$this->loginuser = $this->Admin_mo->getrowjoinLeftLimit('users.*,usertypes.utprivileges as privileges','users',array('usertypes'=>'users.uutid=usertypes.utid'),array('users.uid'=>$this->session->userdata('uid')),'');
			$this->sections = array();
			$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
			}
		}
	}

	public function index()
	{
		if(strpos($this->loginuser->privileges, ',usee,') !== false && in_array('U',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['users'] = $this->Admin_mo->getjoinLeft('users.*,usertypes.utname as utname','users',array('usertypes'=>'users.uutid = usertypes.utid'),array('users.uid != '=>'1'));
		$this->load->view('calenderdate');
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/users',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'users';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
	}

	public function name_validation()
	{
		if($_POST['val'] != '' && $_POST['val'] != ' ')
		{
			if(isset($_POST['id']) && $_POST['id'] != '') $where = 'uid <> '.$_POST['id'].' and';
			else $where = '';
			 
			if(!preg_match('/[^0-9 ]/',$_POST['val'])) echo 5;
			elseif(strlen($_POST['val']) < 5) echo 2;
			elseif(strlen($_POST['val']) > 255) echo 3;
			elseif($this->Admin_mo->exist('users','where '.$where.' uname like "'.$_POST['val'].'"','')) echo 4;
			else echo 1;
		}
		else echo 0;
	}

	public function email_validation()
	{
		if($_POST['val'] != '' && $_POST['val'] != ' ')
		{
			if(isset($_POST['id']) && $_POST['id'] != '') $where = 'uid <> '.$_POST['id'].' and';
			else $where = '';
			
			if(filter_var($_POST['val'], FILTER_VALIDATE_EMAIL) === false) echo 2;
			elseif($this->Admin_mo->exist('users','where '.$where.' uemail like "'.$_POST['val'].'"','')) echo 4;
			else echo 1;
		}
		else echo 0;
	}
	
	public function password_validation()
	{
		if($_POST['val1'] != '')
		{
			if(strlen($_POST['val1']) < 6) echo 2;
			elseif(strlen($_POST['val1']) > 255) echo 3;
			elseif($_POST['val2'] != '' && $_POST['val2'] != ' ' && $_POST['val1'] != $_POST['val2']) echo 4;
			elseif($_POST['val2'] != '' && $_POST['val2'] != ' ' && $_POST['val1'] == $_POST['val2']) echo 5;
			else echo 1;
		}
		else echo 0;
	}
	
	public function cnfpassword_validation()
	{
		if($_POST['val1'] != '' && $_POST['val2'] != '')
		{
			if($_POST['val1'] != $_POST['val2']) echo 4;
			else echo 1;
		}
		else echo 0;
	}
	
	public function username_validation()
	{
		if($_POST['val'] != '' && $_POST['val'] != ' ')
		{
			if(isset($_POST['id']) && $_POST['id'] != '') $where = 'uid <> '.$_POST['id'].' and';
			else $where = '';
			
			if(preg_match('/[^a-z]/',$_POST['val'])) echo 2;
			elseif(strlen($_POST['val']) < 5) echo 3;
			elseif(strlen($_POST['val']) >= 255) echo 5;
			elseif($this->Admin_mo->exist('users','where '.$where.' username like "'.$_POST['val'].'"','')) echo 4;
			else echo 1;
		}
		else echo 0;
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',uadd,') !== false && in_array('U',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['usertypes'] = $this->Admin_mo->getwhere('usertypes',array('utactive'=>'1','utid != '=>'1'));
		$this->load->view('headers/user-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/user-add',$data);
		$this->load->view('footers/user-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'users';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',uadd,') !== false && in_array('U',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('username', 'lang:username' , 'trim|alpha|required|max_length[255]|is_unique[users.username]');
		$this->form_validation->set_rules('name', 'lang:name' , 'trim|required|max_length[255]|is_unique[users.uname]');
		$this->form_validation->set_rules('email', 'lang:email' , 'trim|required|max_length[255]|valid_email|is_unique[users.uemail]');
		$this->form_validation->set_rules('password', 'lang:password', 'trim|required|min_length[6]|max_length[255]');
		$this->form_validation->set_rules('cnfpassword', 'lang:cnfpassword', 'trim|required|matches[password]');
		$this->form_validation->set_rules('mobile', 'lang:mobile' , 'trim|max_length[50]|numeric');
		$this->form_validation->set_rules('address', 'lang:address' , 'trim|max_length[255]');
		$this->form_validation->set_rules('usertype', 'lang:usertype' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['title'] = 'users';
			$data['system'] = $this->mysystem;
			$data['usertypes'] = $this->Admin_mo->getwhere('usertypes',array('utactive'=>'1','utid != '=>'1'));
			$this->load->view('headers/user-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/user-add',$data);
			$this->load->view('footers/user-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('uuid'=>$this->session->userdata('uid'), 'username'=>set_value('username'), 'uname'=>set_value('name'), 'uemail'=>set_value('email'), 'upassword'=>password_hash(set_value('password'), PASSWORD_BCRYPT, array('cost'=>10)), 'uutid'=>set_value('usertype'), 'umobile'=>set_value('mobile'), 'uaddress'=>set_value('address'), 'uactive'=>set_value('active'), 'utime'=>time());
			$uid = $this->Admin_mo->set('users', $set_arr);
			if(empty($uid))
			{
				$data['admessage'] = 'Not Saved';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('users/add', 'refresh');
			}
			else
			{
				$data['admessage'] = 'Successfully Saved';
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('users', 'refresh');
			}
		}
		//redirect('users/add', 'refresh');
		}
		else
		{
		$data['title'] = 'users';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',uedit,') !== false && in_array('U',$this->sections))
		{
		$data['admessage'] = '';
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['usertypes'] = $this->Admin_mo->getwhere('usertypes',array('utactive'=>'1','utid != '=>'1'));
		$data['user'] = $this->Admin_mo->getrow('users',array('uid'=>$id));
		if(!empty($data['user']))
		{
			$this->load->view('headers/user-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/user-edit',$data);
			$this->load->view('footers/user-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'users';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/users',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/users');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'users';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
	}
	
	public function edituser($id)
	{
		if(strpos($this->loginuser->privileges, ',uedit,') !== false && in_array('U',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('username', 'lang:username' , 'trim|alpha|required|max_length[255]');
			$this->form_validation->set_rules('name', 'lang:name' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('email', 'lang:email' , 'trim|required|max_length[255]|valid_email');
			$this->form_validation->set_rules('password', 'lang:password', 'trim|min_length[6]|max_length[255]');
			$this->form_validation->set_rules('cnfpassword', 'lang:cnfpassword', 'trim|matches[password]');
			$this->form_validation->set_rules('mobile', 'lang:mobile' , 'trim|max_length[50]|numeric');
			$this->form_validation->set_rules('address', 'lang:address' , 'trim|max_length[255]');
			$this->form_validation->set_rules('usertype', 'lang:usertype' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				//$data['admessage'] = 'validation error';
				//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				$data['system'] = $this->mysystem;
				$data['usertypes'] = $this->Admin_mo->getwhere('usertypes',array('utactive'=>'1','utid != '=>'1'));
				$data['user'] = $this->Admin_mo->getrow('users',array('uid'=>$id));
				$this->load->view('headers/user-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/user-edit',$data);
				$this->load->view('footers/user-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('users','where uid <> '.$id.' and username like "'.set_value('username').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'usernameexist';
					redirect('users/edit/'.$id, 'refresh');
				}
				if($this->Admin_mo->exist('users','where uid <> '.$id.' and uname like "'.set_value('name').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('users/edit/'.$id, 'refresh');
				}
				if($this->Admin_mo->exist('users','where uid <> '.$id.' and uemail like "'.set_value('email').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'emailexist';
					redirect('users/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('uuid'=>$this->session->userdata('uid'), 'username'=>set_value('username'), 'uname'=>set_value('name'), 'uemail'=>set_value('email'), 'uutid'=>set_value('usertype'), 'umobile'=>set_value('mobile'), 'uaddress'=>set_value('address'), 'uactive'=>set_value('active'), 'utime'=>time());
					if(set_value('password') != '' && set_value('password') != ' ')  $update_array['upassword'] = password_hash(set_value('password'), PASSWORD_BCRYPT, array('cost'=>10));
					if($this->Admin_mo->update('users', $update_array, array('uid'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('users', 'refresh');
				}
			}
		}
		else
		{
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('users', 'refresh');
		}
		//redirect('users', 'refresh');
		}
		else
		{
		$data['title'] = 'users';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',udelete,') !== false && $id != '1' && in_array('U',$this->sections))
		{
		$user = $this->Admin_mo->getrow('users', array('uid'=>$id));
		if(!empty($user))
		{
			if($user->uimage != '' && file_exists($this->config->item('users_folder').$user->uimage)) unlink($this->config->item('users_folder').$user->uimage);
			if(file_exists($this->config->item('users_thumb_folder').$user->uimage)) unlink($this->config->item('users_thumb_folder').$user->uimage);
			$this->Admin_mo->del('users', array('uid'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('users', 'refresh');
		}
		else
		{
			$data['title'] = 'users';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/users',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/users');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'users';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/users',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/users');
		$this->load->view('messages');
		}
	}
}