<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',scsee,') !== false)
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['sections'] = $this->Admin_mo->get('sections');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/sections',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'sections';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',scadd,') !== false)
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/section-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/section-add',$data);
		$this->load->view('footers/section-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'sections';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',utadd,') !== false)
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('name', 'lang:name' , 'trim|required|max_length[255]|is_unique[sections.scname]');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;
			$this->load->view('headers/section-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/section-add',$data);
			$this->load->view('footers/section-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('scuid'=>$this->session->userdata('uid'), 'sc'.$this->mysystem->langs.'name'=>set_value('name'), 'scactive'=>set_value('active'), 'sctime'=>time());
			$scid = $this->Admin_mo->set('sections', $set_arr);
			if(empty($scid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('sections/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('sections', 'refresh');
			}
		}
		//redirect('sections/add', 'refresh');
		}
		else
		{
		$data['title'] = 'sections';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',scedit,') !== false)
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['section'] = $this->Admin_mo->getrow('sections',array('scid'=>$id));
		if(!empty($data['section']))
		{
			$this->load->view('headers/section-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/section-edit',$data);
			$this->load->view('footers/section-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'sections';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/sections',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/sections');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'sections';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
	}
	
	public function editsection($id)
	{
		if(strpos($this->loginuser->privileges, ',scedit,') !== false)
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('name', 'lang:name' , 'trim|required|max_length[255]');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['section'] = $this->Admin_mo->getrow('sections',array('scid'=>$id));
				$this->load->view('headers/section-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/section-edit',$data);
				$this->load->view('footers/section-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('sections','where scid <> '.$id.' and sc'.$this->mysystem->langs.'name like "'.set_value('name').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('sections/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('scuid'=>$this->session->userdata('uid'), 'sc'.$this->mysystem->langs.'name'=>set_value('name'), 'scactive'=>set_value('active'), 'sctime'=>time());
					if($this->Admin_mo->update('sections', $update_array, array('scid'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('sections', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('sections', 'refresh');
		}
		//redirect('sections', 'refresh');
		}
		else
		{
		$data['title'] = 'sections';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',utdelete,') !== false)
		{
		$section = $this->Admin_mo->getrow('sections', array('scid'=>$id));
		if(!empty($section))
		{
			$this->Admin_mo->del('sections', array('scid'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('sections', 'refresh');
		}
		else
		{
			$data['title'] = 'sections';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/sections',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/sections');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'sections';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/sections',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/sections');
		$this->load->view('messages');
		}
	}
}