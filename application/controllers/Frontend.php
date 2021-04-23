<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

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
		
		$this->languages = array('en','ar');

		$this->sections = array();
		$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
		if(!empty($sections))
		{
			foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
		}
		
		$this->pages = array();
		if(in_array('PG',$this->sections))
		{
			$pages = $this->Admin_mo->getwhere('pages',array('pgactive'=>'1'));
			if(!empty($sections))
			{
				foreach($pages as $page) { $this->pages['url'][$page->pgid] = $page->pgurl; $this->pages['titleen'][$page->pgid] = $page->pgtitleen; $this->pages['titlear'][$page->pgid] = $page->pgtitlear; $this->pages['descen'][$page->pgid] = $page->pgdescen; $this->pages['descar'][$page->pgid] = $page->pgdescar; $this->pages['keywordsen'][$page->pgid] = $page->pgkeywordsen; $this->pages['keywordsar'][$page->pgid] = $page->pgkeywordsar; }
			}
		}
	}

	public function errorpage()
	{
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->lang->load($data['system']->langs, $data['system']->langs);
		$this->load->view('404',$data);
	}

	public function index($front_lang)
	{
		if(!empty($this->pages) && in_array('index',$this->pages['url']) && in_array($front_lang,$this->languages))
		{
			$data['admessage'] = '';
			$data['pageid'] = array_search('index', $this->pages['url']);
			//$data['slides'] = $this->Admin_mo->getwhere('slides',array('sdactive'=>'1'));
			$data['front_lang'] = $front_lang;
			if($this->config->item('slides_thumb_folder') != '')
			{
				$data['slides_thumb_folder'] = $this->config->item('slides_thumb_folder');
				$data['slides_folder'] = $this->config->item('slides_folder');
			}
			else $data['slides_folder'] = $data['slides_thumb_folder'] = $this->config->item('slides_folder');

			//$this->load->view('calenderdate');
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			//$this->load->view('frontend/header-'.$front_lang,$data);
			$this->load->view('frontend/index-'.$front_lang,$data);
			//$this->load->view('frontend/footer-'.$front_lang,$data);
		}
		else redirect('404', 'refresh');
	}
	
	public function login($front_lang)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('login',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('login', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/login-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function userlog($front_lang)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE) && in_array($front_lang,$this->languages))
		{
		    $this->lang->load($front_lang, $front_lang);
				$this->config->set_item('language', $front_lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('email', 'lang:email' , 'trim|required|valid_email|max_length[255]');
			$this->form_validation->set_rules('password', 'lang:password', 'trim|required|min_length[6]|max_length[255]');
			if($this->form_validation->run() == FALSE)
			{
				$data['pageid'] = array_search('login', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->lang->load($front_lang, $front_lang);
				$this->config->set_item('language', $front_lang);
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/login-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else
			{
				$user = $this->Admin_mo->getrow('users',array('uemail like'=>set_value('email')));
				if(!empty($user))
				{
					if($user->uactive == '1')
					{
						if(password_verify(set_value('password'), $user->upassword))
						{
							if($user->uutid == 5)
							{
								//if(set_value('remember') == 1) $this->input->set_cookie(array('name'=>'uid', 'value'=>$user->uid, 'expire'=>time()+86500, 'path'=>'/'));
								$this->session->set_userdata('uid', $user->uid);
								$this->session->set_userdata('username', $user->username);
								redirect('services-'.$front_lang, 'refresh');
							}
							else 
							{
								$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('no_privils').'</div>';
							}
						}
						else
						{
							$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('wrong_password').'</div>';
						}
					}
					else
					{
						$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('user_not_active').'</div>';
					}
				}
				else
				{
					$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('user_not_exist').'</div>';
				}
				$data['pageid'] = array_search('login', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/login-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
		}
		else
		{
			redirect('index-'.$front_lang, 'refresh');
		}
	}
	
	public function logout($front_lang)
	{
		unset($_SESSION['uid'],$_SESSION['username']);
		//delete_cookie("uid");
		redirect('services-'.$front_lang, 'refresh');
	}

	public function registration($front_lang)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('registration',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('registration', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/registration-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function register($front_lang)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE) && in_array($front_lang,$this->languages))
		{
		    $this->lang->load($front_lang, $front_lang);
		    $this->config->set_item('language', $front_lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('name', 'lang:name' , 'trim|required|max_length[255]|is_unique[users.username]');
		$this->form_validation->set_rules('username', 'lang:username' , 'trim|required|alpha|min_length[6]|max_length[255]|is_unique[users.uname]');
		$this->form_validation->set_rules('email', 'lang:email' , 'trim|required|max_length[255]|valid_email|is_unique[users.uemail]');
		$this->form_validation->set_rules('mobile', 'lang:mobile' , 'trim|required|max_length[25]|numeric');
		$this->form_validation->set_rules('address', 'lang:address' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('password', 'lang:password', 'trim|required|min_length[6]|max_length[255]');
		$this->form_validation->set_rules('cnfpassword', 'lang:cnfpassword', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('registration', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['front_lang'] = $front_lang;
			$this->load->view('frontend/header-'.$front_lang,$data);
			$this->load->view('frontend/registration-'.$front_lang,$data);
			$this->load->view('frontend/footer-'.$front_lang,$data);
		}
		else
		{
			$verificationCode = mt_rand(11111,99999);
			if($this->sendemail($this->config->item('email_sender'),'Info',set_value('email'),'Activation','Activation link: '.base_url().'/active/'.set_value('username').'/'.$verificationCode))
			{
				$this->load->library('notifications');
				$set_arr = array('uutid'=>5, 'uname'=>set_value('name'), 'username'=>set_value('username'), 'uemail'=>set_value('email'), 'umobile'=>set_value('mobile'), 'uaddress'=>set_value('address'), 'upassword'=>password_hash(set_value('password'), PASSWORD_BCRYPT, array('cost'=>10)), 'ucode'=>$verificationCode, 'utime'=>time());
				$uid = $this->Admin_mo->set('users', $set_arr);
				if(empty($uid))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('registration-'.$front_lang, 'refresh');
				}
				else
				{
					$this->notifications->addNotify(0,'U',' اضاف المستخدم '.set_value('name'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,usee,%" or usertypes.utprivileges like "%,uadd,%"');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					redirect('registration-'.$front_lang, 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('registration-'.$front_lang, 'refresh');
			}
		}
		}
		else
		{
			redirect('index-'.$front_lang, 'refresh');
		}
	}
	
	public function services($front_lang)
	{
		if(in_array('CG',$this->sections) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('services',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('services', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['services'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
				$data['front_lang'] = $front_lang;
				if($this->config->item('categories_thumb_folder') != '')
				{
					$data['categories_thumb_folder'] = $this->config->item('categories_thumb_folder');
					$data['categories_folder'] = $this->config->item('categories_folder');
				}
				else $data['categories_folder'] = $data['categories_thumb_folder'] = $this->config->item('categories_folder');
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/services-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function projects($front_lang)
	{
		if(in_array('PR',$this->sections) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('projects',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('projects', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['projects'] = $this->Admin_mo->getjoinLeft('products.prid as prid,products.primg as primg,products.prtitle'.$front_lang.' as prtitle,products.prdesc'.$front_lang.' as prdesc,categories.cgtitle'.$front_lang.' as cgtitle','products',array('categories'=>'products.prcgid = categories.cgid'),array('categories.cgactive'=>'1','products.practive'=>'1'));
				$data['front_lang'] = $front_lang;
				//$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
				$data['categories'] = $this->Admin_mo->getjoinLeft('cgtitle'.$front_lang.' as cgtitle','categories',array(),array('cgactive'=>'1'));
				if($this->config->item('products_thumb_folder') != '')
				{
					$data['products_thumb_folder'] = $this->config->item('products_thumb_folder');
					$data['products_folder'] = $this->config->item('products_folder');
				}
				else $data['products_folder'] = $data['products_thumb_folder'] = $this->config->item('products_folder');
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/projects-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function faqs($front_lang)
	{
		if(in_array('FA',$this->sections) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('faq',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('faq', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['faqs'] = $this->Admin_mo->getjoinLeft('faid as faid,fatitle'.$front_lang.' as fatitle,fadesc'.$front_lang.' as fadesc','faq',array(),array('faactive'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/faqs-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function active($username,$code)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE))
		{
			$data['admessage'] = '';
			$data['front_lang'] = 'en';
			$data['pageid'] = array_search('login', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$user = $this->Admin_mo->getrow('users',array('username like'=>$username));
			if(!empty($user))
			{
				if($user->uactive != '1')
				{
					if($user->ucode == $code)
					{
						if($this->Admin_mo->update('users',array('ucode'=>'','uactive'=>'1'),array('username like'=>$username,'ucode'=>$code,'uactive'=>'0')))
						{
						    $this->lang->load('en', 'en');
							$this->config->set_item('language', 'en');
						    $data['activemessage'] = '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('user_is_active').'</div>';
						}
						else
						{
							$this->lang->load('en', 'en');
							$this->config->set_item('language', 'en');
							$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('something_wrong').'</div>';
						}
					}
					else 
					{
						$this->lang->load('en', 'en');
						$this->config->set_item('language', 'en');	
						$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('wrong_code').'</div>';
					}
				}
				else
				{
					$this->lang->load('en', 'en');
					$this->config->set_item('language', 'en');
					$data['activemessage'] = '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('user_was_active').'</div>';
				}
			}
			else
			{
				$this->lang->load('en', 'en');
				$this->config->set_item('language', 'en');
				$data['activemessage'] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$this->lang->line('user_not_exist').'</div>';
			}
			$this->load->view('frontend/header-en',$data);
			$this->load->view('frontend/login-en',$data);
			$this->load->view('frontend/footer-en',$data);
		}
		else redirect('index-en', 'refresh');
	}
	
	public function forgotpassword($front_lang)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('forgotpassword',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('forgotpassword', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/forgotpassword-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function newpassword($front_lang)
	{
		if(in_array('U',$this->sections) && ($this->session->userdata('uid') == FALSE) && in_array($front_lang,$this->languages))
		{
		    $this->lang->load($front_lang, $front_lang);
		    $this->config->set_item('language', $front_lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('email', 'lang:email' , 'trim|required|max_length[255]|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$data['pageid'] = array_search('forgotpassword', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['front_lang'] = $front_lang;
			$this->load->view('frontend/header-'.$front_lang,$data);
			$this->load->view('frontend/forgotpassword-'.$front_lang,$data);
			$this->load->view('frontend/footer-'.$front_lang,$data);
		}
		elseif(!$this->Admin_mo->exist('users','where uemail like "'.set_value('email').'"',''))
		{
			$_SESSION['time'] = time(); $_SESSION['message'] = 'emailnotexist';
			redirect('forgotpassword-'.$front_lang, 'refresh');
		}
		else
		{
			$newpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+') , 0 , 9);
			if($this->sendemail($this->config->item('email_sender'),'Info',set_value('email'),'New Password','Your New Password IS: '.$newpassword))
			{
				$this->load->library('notifications');
				if($this->Admin_mo->update('users', array('upassword'=>password_hash($newpassword, PASSWORD_BCRYPT, array('cost'=>10)),'uuid'=>0,'utime'=>time()), array('uemail'=>set_value('email'))))
				{
					$this->notifications->addNotify(0,'U',' عدل المستخدم '.set_value('email'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,usee,%" or usertypes.utprivileges like "%,uedit,%"');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					redirect('forgotpassword-'.$front_lang, 'refresh');
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('forgotpassword-'.$front_lang, 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('forgotpassword-'.$front_lang, 'refresh');
			}
		}
		//redirect('about/add', 'refresh');
		}
		else
		{
			redirect('index-'.$front_lang, 'refresh');
		}
	}
	
	public function about($front_lang)
	{
		if(in_array('AB',$this->sections) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('about',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('about', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['about'] = $this->Admin_mo->getrow('about',array('abid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/about-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function contact($front_lang)
	{
		if(in_array('U',$this->sections) && in_array($front_lang,$this->languages))
		{
			$this->lang->load($front_lang, $front_lang);
			$this->config->set_item('language', $front_lang);
			if(!empty($this->pages) && in_array('contact',$this->pages['url']))
			{
				$data['admessage'] = '';
				$data['pageid'] = array_search('contact', $this->pages['url']);
				$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
				$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
				$data['front_lang'] = $front_lang;
				$this->load->view('frontend/header-'.$front_lang,$data);
				$this->load->view('frontend/contact-'.$front_lang,$data);
				$this->load->view('frontend/footer-'.$front_lang,$data);
			}
			else redirect('404', 'refresh');
		}
		else redirect('index-'.$front_lang, 'refresh');
	}
	
	public function sendmessage($front_lang)
	{
		if(in_array('CT',$this->sections) && in_array($front_lang,$this->languages))
		{
		    $this->lang->load($front_lang, $front_lang);
		    $this->config->set_item('language', $front_lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		if($this->session->userdata('uid') == FALSE)
		{
			$this->form_validation->set_rules('name', 'lang:name' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('email', 'lang:email' , 'trim|required|max_length[255]|valid_email');
		}
		$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('body', 'lang:message' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['admessage'] = '';
			$data['pageid'] = array_search('index', $this->pages['url']);
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$data['contact'] = $this->Admin_mo->getrow('contact',array('ctid'=>'1'));
			$data['front_lang'] = $front_lang;
			$this->load->view('frontend/header-'.$front_lang,$data);
			$this->load->view('frontend/contact-'.$front_lang,$data);
			$this->load->view('frontend/footer-'.$front_lang,$data);
		}
		else
		{
			if($this->sendemail($this->config->item('email_sender'),'Contact Form',$this->config->item('email_sender'),set_value('title'),set_value('body')))
			{
				$this->load->library('notifications');
				if($this->session->userdata('uid') == FALSE) $set_arr = array('mgeid'=>0, 'mgname'=>set_value('name'), 'mgemail'=>set_value('email'), 'mgtitle'=>set_value('title'), 'mgbody'=>set_value('body'), 'mgtime'=>time());
				else $set_arr = array('mgeid'=>$this->session->userdata('uid'), 'mgtitle'=>set_value('title'), 'mgbody'=>set_value('body'), 'mgtime'=>time());
				$mgid = $this->Admin_mo->set('messages', $set_arr);
				if(empty($mgid))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('contact-'.$front_lang, 'refresh');
				}
				else
				{
					$this->notifications->addNotify(0,'CT',' اضاف رسالة '.set_value('title'),'inner join usertypes on users.uutid = usertypes.utid where usertypes.utprivileges like "%,ctsee,%" or usertypes.utprivileges like "%,ctedit,%"');
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					redirect('contact-'.$front_lang, 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('contact-'.$front_lang, 'refresh');
			}
		}
		}
		else
		{
			redirect('index-'.$front_lang, 'refresh');
		}
	}
	public function sendemail($from,$name,$to,$subject,$body)
	{
		require_once('../PHPMailer/class.phpmailer.php');
		require_once('../PHPMailer/class.smtp.php');
		require_once('../PHPMailer/PHPMailerAutoload.php');
		$mail             = new PHPMailer(); // defaults to using php "mail()"
		$mail->IsSMTP(); // telling the class to use SMTP
		//$mail->Host       = "smtp.secureserver.net";
		$mail->Host       = "localhost";
		//	$mail->Host       = "smtpout.secureserver.net";      // sets GMAIL as the SMTP server
		//	$mail->SMTPAuth   = true;                  // enable SMTP authentication
		//	$mail->SMTPSecure = 'ssl';
		//	$mail->Port = 465;
		//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		//$mail->Username   = "";  // GMAIL username
		//$mail->Password   = "";					
		//$mail->AddReplyTo("name@yourdomain.com","First Last");
		$mail->SetFrom($from, $name);
		$mail->AddAddress($to);
		$mail->Subject    = $subject;
		//$mail->AltBody    = "You can active your account on : "; // optional, comment out and test
		$mail->Body    = $body;
		if($mail->Send()) return 1;
		else return 0;
	}
}