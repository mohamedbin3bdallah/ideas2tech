<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',fasee,') !== false && in_array('FA',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['faqs'] = $this->Admin_mo->get('faq');
		$this->load->view('calenderdate');
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/faq',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'faq';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',faadd,') !== false && in_array('FA',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/faq-add',$data);
		$this->load->view('footers/faq-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'faq';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',faadd,') !== false && in_array('FA',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('titleen', 'lang:questionen' , 'trim|required|max_length[255]|is_unique[faq.fatitleen]');
		$this->form_validation->set_rules('descen', 'lang:answeren' , 'trim|required');
		$this->form_validation->set_rules('titlear', 'lang:questionar' , 'trim|required|max_length[255]|is_unique[faq.fatitlear]');
		$this->form_validation->set_rules('descar', 'lang:answerar' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['system'] = $this->mysystem;
			$this->load->view('headers/faq-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/faq-add',$data);
			$this->load->view('footers/faq-add');
			$this->load->view('notifys');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('fauid'=>$this->session->userdata('uid'), 'fatitleen'=>set_value('titleen'), 'fadescen'=>set_value('descen'), 'fatitlear'=>set_value('titlear'), 'fadescar'=>set_value('descar'), 'faactive'=>set_value('active'), 'fatime'=>time());
			$faid = $this->Admin_mo->set('faq', $set_arr);
			if(empty($faid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('faq/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('faq', 'refresh');
			}
		}
		//redirect('faq/add', 'refresh');
		}
		else
		{
		$data['title'] = 'faq';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',faedit,') !== false && in_array('FA',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['faq'] = $this->Admin_mo->getrow('faq',array('faid'=>$id));
		if(!empty($data['faq']))
		{
			$this->load->view('headers/faq-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/faq-edit',$data);
			$this->load->view('footers/faq-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'faq';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/faq',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/faq');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'faq';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
	}
	
	public function editfaq($id)
	{
		if(strpos($this->loginuser->privileges, ',faedit,') !== false && in_array('FA',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
				$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('titleen', 'lang:questionen' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descen', 'lang:answeren' , 'trim|required');
			$this->form_validation->set_rules('titlear', 'lang:questionar' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descar', 'lang:answerar' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['faq'] = $this->Admin_mo->getrow('faq',array('faid'=>$id));
				$this->load->view('headers/faq-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/faq-edit',$data);
				$this->load->view('footers/faq-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('faq','where faid <> '.$id.' and fatitleen like "'.set_value('titleen').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('faq/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('fauid'=>$this->session->userdata('uid'), 'fatitleen'=>set_value('titleen'), 'fadescen'=>set_value('descen'), 'fatitlear'=>set_value('titlear'), 'fadescar'=>set_value('descar'), 'faactive'=>set_value('active'), 'fatime'=>time());
					if($this->Admin_mo->update('faq', $update_array, array('faid'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('faq', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('faq', 'refresh');
		}
		//redirect('faq', 'refresh');
		}
		else
		{
		$data['title'] = 'faq';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',fadelete,') !== false && in_array('FA',$this->sections))
		{
		$faq = $this->Admin_mo->getrow('faq', array('faid'=>$id));
		if(!empty($faq))
		{
			$this->Admin_mo->del('faq', array('faid'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('faq', 'refresh');
		}
		else
		{
			$data['title'] = 'faq';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/faq',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/faq');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'faq';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/faq',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/faq');
		$this->load->view('messages');
		}
	}
}