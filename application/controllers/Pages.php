<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',pgsee,') !== false && in_array('PG',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['pages'] = $this->Admin_mo->get('pages');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/pages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',pgadd,') !== false && in_array('PG',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/page-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/page-add',$data);
		$this->load->view('footers/page-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',pgadd,') !== false && in_array('PG',$this->sections))
		{
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
		$this->form_validation->set_rules('keywordsen', 'lang:keywordsen' , 'trim|required');
		$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
		$this->form_validation->set_rules('keywordsar', 'lang:keywordsar' , 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url' , 'trim|required|max_length[255]|is_unique[pages.pgurl]');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			 $data['system'] = $this->mysystem;
			$this->load->view('headers/page-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/page-add',$data);
			$this->load->view('footers/page-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('pguid'=>$this->session->userdata('uid'), 'pgtitleen'=>set_value('titleen'), 'pgdescen'=>set_value('descen'),  'pgkeywordsen'=>set_value('keywordsen'), 'pgtitlear'=>set_value('titlear'), 'pgdescar'=>set_value('descar'),  'pgkeywordsar'=>set_value('keywordsar'), 'pgurl'=>strtolower(set_value('url')), 'pgactive'=>set_value('active'), 'pgtime'=>time());
			$pgid = $this->Admin_mo->set('pages', $set_arr);
			if(empty($pgid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('pages/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('pages', 'refresh');
			}
		}
		//redirect('pages/add', 'refresh');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',pgedit,') !== false && in_array('PG',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['page'] = $this->Admin_mo->getrow('pages',array('pgid'=>$id));
		if(!empty($data['page']))
		{
			$this->load->view('headers/page-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/page-edit',$data);
			$this->load->view('footers/page-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'pages';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/pages',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/pages');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
	
	public function editpage($id)
	{
		if(strpos($this->loginuser->privileges, ',pgedit,') !== false && in_array('PG',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
			$this->form_validation->set_rules('keywordsen', 'lang:keywordsen' , 'trim|required');
			$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
			$this->form_validation->set_rules('keywordsar', 'lang:keywordsar' , 'trim|required');
			$this->form_validation->set_rules('url', 'lang:url' , 'trim|required|max_length[255]');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['page'] = $this->Admin_mo->getrow('pages',array('pgid'=>$id));
				$this->load->view('headers/page-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/page-edit',$data);
				$this->load->view('footers/page-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('pages','where pgid <> '.$id.' and pgurl like "'.set_value('url').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('pages/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('pguid'=>$this->session->userdata('uid'), 'pgtitleen'=>set_value('titleen'), 'pgdescen'=>set_value('descen'),  'pgkeywordsen'=>set_value('keywordsen'), 'pgtitlear'=>set_value('titlear'), 'pgdescar'=>set_value('descar'), 'pgkeywordsar'=>set_value('keywordsar'), 'pgurl'=>strtolower(set_value('url')), 'pgactive'=>set_value('active'), 'pgtime'=>time());
					if($this->Admin_mo->update('pages', $update_array, array('pgid'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('pages', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('pages', 'refresh');
		}
		//redirect('about', 'refresh');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',pgdelete,') !== false && in_array('PG',$this->sections))
		{
		$page = $this->Admin_mo->getrow('pages', array('pgid'=>$id));
		if(!empty($page))
		{
			$this->Admin_mo->del('pages', array('pgid'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('pages', 'refresh');
		}
		else
		{
			$data['title'] = 'pages';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/pages',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/pages');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
}