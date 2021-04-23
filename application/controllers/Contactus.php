<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {

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
		$data['title'] = 'contact';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/contact');
		$this->load->view('messages');
	}

	public function contact()
	{
		if(strpos($this->loginuser->privileges, ',ctedit,') !== false && in_array('CT',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/contact',$data);
		$this->load->view('footers/contact');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'contact';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/contact');
		$this->load->view('messages');
		}
	}
	
	public function contactedit()
	{
		if(strpos($this->loginuser->privileges, ',ctedit,') !== false && in_array('CT',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('addressen', 'lang:addressen' , 'trim');
		$this->form_validation->set_rules('addressar', 'lang:addressar' , 'trim');
		$this->form_validation->set_rules('phone', 'lang:phone' , 'trim|max_length[255]');
		$this->form_validation->set_rules('mobile', 'lang:mobile' , 'trim|max_length[255]');
		$this->form_validation->set_rules('email', 'lang:email' , 'trim');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$this->load->view('headers/contact',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/contact',$data);
			$this->load->view('footers/contact');
			$this->load->view('messages');
		}
		else
		{
			$update_array = array('ctuid'=>$this->session->userdata('uid'), 'ctaddressen'=>set_value('addressen'), 'ctaddressar'=>set_value('addressar'), 'ctphone'=>set_value('phone'), 'ctmobile'=>set_value('mobile'), 'ctmap'=>set_value('map'), 'ctemail'=>set_value('email'), 'ctactive'=>set_value('active'), 'cttime'=>time());
			if($this->Admin_mo->update('contact', $update_array, array('ctid'=>'1')))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('contactus/contact', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contactus/contact', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
		$data['title'] = 'contact';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/contact',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/contact');
		$this->load->view('messages');
		}
	}
	
	public function socialmedia()
	{
		if(strpos($this->loginuser->privileges, ',smedit,') !== false && in_array('SM',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/socialmedia',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/socialmedia',$data);
		$this->load->view('footers/socialmedia');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'socialmedia';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/socialmedia',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/socialmedia');
		$this->load->view('messages');
		}
	}
	
	public function socialmediaedit()
	{
		if(strpos($this->loginuser->privileges, ',smedit,') !== false && in_array('SM',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('facebook', 'lang:facebook' , 'trim|valid_url');
		$this->form_validation->set_rules('googleplus', 'lang:googleplus' , 'trim|valid_url');
		$this->form_validation->set_rules('twitter', 'lang:twitter' , 'trim|valid_url');
		$this->form_validation->set_rules('instagram', 'lang:instagram' , 'trim|valid_url');
		$this->form_validation->set_rules('youtube', 'lang:youtube' , 'trim|valid_url');
		$this->form_validation->set_rules('linkedin', 'lang:linkedin' , 'trim|valid_url');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$this->load->view('headers/socialmedia',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/socialmedia',$data);
			$this->load->view('footers/socialmedia');
			$this->load->view('messages');
		}
		else
		{
			$update_array = array('smuid'=>$this->session->userdata('uid'), 'smfacebook'=>set_value('facebook'), 'smgoogleplus'=>set_value('googleplus'), 'smtwitter'=>set_value('twitter'), 'sminstagram'=>set_value('instagram'), 'smyoutube'=>set_value('youtube'), 'smlinkedin'=>set_value('linkedin'), 'smactive'=>set_value('active'), 'smtime'=>time());
			if($this->Admin_mo->update('contact', $update_array, array('ctid'=>'1')))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('contactus/socialmedia', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contactus/socialmedia', 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
		$data['title'] = 'socialmedia';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/socialmedia',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/socialmedia');
		$this->load->view('messages');
		}
	}
}