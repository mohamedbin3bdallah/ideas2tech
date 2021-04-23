<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',prsee,') !== false && in_array('PR',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		//$data['products'] = $this->Admin_mo->get('products');
		$data['products'] = $this->Admin_mo->getjoinLeft('products.*,categories.cgtitle'.$this->mysystem->langs.' as category','products',array('categories'=>'products.prcgid = categories.cgid'),array());
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/products',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'products';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',pradd,') !== false && in_array('PR',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/product-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/product-add',$data);
		$this->load->view('footers/product-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'products';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',pradd,') !== false && in_array('PR',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
		$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]');
		$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
		$this->form_validation->set_rules('category', 'lang:category' , 'trim|required');
		$this->form_validation->set_rules('img', 'lang:image' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;
			$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
			$this->load->view('headers/product-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/product-add',$data);
			$this->load->view('footers/product-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('pruid'=>$this->session->userdata('uid'), 'prtitleen'=>set_value('titleen'), 'prdescen'=>set_value('descen'), 'prtitlear'=>set_value('titlear'), 'prdescar'=>set_value('descar'), 'prcgid'=>set_value('category'), 'practive'=>set_value('active'), 'prtime'=>time());
			if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) { $set_arr['primg'] = $this->uploadimg('img',$this->config->item('products_folder'),$this->config->item('products_thumb_folder'),mt_rand()); };
			$prid = $this->Admin_mo->set('products', $set_arr);
			if(empty($prid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('products/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('products', 'refresh');
			}
		}
		//redirect('products/add', 'refresh');
		}
		else
		{
		$data['title'] = 'products';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',predit,') !== false && in_array('PR',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['product'] = $this->Admin_mo->getrow('products',array('prid'=>$id));
		if(!empty($data['product']))
		{
			$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
			$this->load->view('headers/product-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/product-edit',$data);
			$this->load->view('footers/product-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'products';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/products',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/products');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'products';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
	}
	
	public function editproduct($id)
	{
		if(strpos($this->loginuser->privileges, ',predit,') !== false && in_array('PR',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
			$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
			$this->form_validation->set_rules('category', 'lang:category' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['product'] = $this->Admin_mo->getrow('products',array('prid'=>$id));
				$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
				$this->load->view('headers/product-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/product-edit',$data);
				$this->load->view('footers/product-edit');
				$this->load->view('messages');
			}
			else
			{
				$update_array = array('pruid'=>$this->session->userdata('uid'), 'prtitleen'=>set_value('titleen'), 'prdescen'=>set_value('descen'), 'prtitlear'=>set_value('titlear'), 'prdescar'=>set_value('descar'), 'prcgid'=>set_value('category'), 'practive'=>set_value('active'), 'prtime'=>time());
				//if(set_value('icon') != '' && set_value('page') == 'الرسائل') $update_array['abicon'] = set_value('icon');
				if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) { $update_array['primg'] = $this->uploadimg('img',$this->config->item('products_folder'),$this->config->item('products_thumb_folder'),mt_rand()); if($update_array['primg'] != '' && set_value('oldimg') != '' && file_exists($this->config->item('products_folder').set_value('oldimg'))) unlink($this->config->item('products_folder').set_value('oldimg')); if($update_array['primg'] != '' && set_value('oldimg') != '' && file_exists($this->config->item('products_thumb_folder').set_value('oldimg'))) unlink($this->config->item('products_thumb_folder').set_value('oldimg')); }
				if($this->Admin_mo->update('products', $update_array, array('prid'=>$id)))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('products', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('products', 'refresh');
		}
		//redirect('products', 'refresh');
		}
		else
		{
		$data['title'] = 'products';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',prdelete,') !== false && in_array('PR',$this->sections))
		{
		$product = $this->Admin_mo->getrow('products', array('prid'=>$id));
		if(!empty($product))
		{
			$this->Admin_mo->del('products', array('prid'=>$id));
			if($product->primg != '' && file_exists($this->config->item('products_folder').$product->primg)) unlink($this->config->item('products_folder').$product->primg);
			if(file_exists($this->config->item('products_thumb_folder').$product->primg)) unlink($this->config->item('products_thumb_folder').$product->primg);
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('products', 'refresh');
		}
		else
		{
			$data['title'] = 'products';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/products',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/products');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'products';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/products',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/products');
		$this->load->view('messages');
		}
	}
	
	public function imageSize()
	{
		if ($_FILES['img']['size'] > 1024000)
		{
			//$this->form_validation->set_message('imageSize', 'يجب ان يكون حجم الصورة 1 ميجا او اقل');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function imageType()
	{
		if (!in_array(strtoupper(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)),array('JPG','JPEG','PNG','JIF','BMP','TIF')))
		{
			//$this->form_validation->set_message('imageType', 'يجب ان يكون نوع الملف المرفوع واحد من هذه الانواع : JPG,JPEG,PNG,JIF,BMP,TIF');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function uploadimg($inputfilename,$image_director,$image_director_thumb,$newname)
	{
		$file_extn = pathinfo($_FILES[$inputfilename]['name'], PATHINFO_EXTENSION);
		if(!is_dir($image_director)) $create_image_director = mkdir($image_director);
		$name = $newname.".".$file_extn;
		if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.$name))
		{
			if($image_director_thumb != '')
			{
				$this->load->library('Resize');
				$this->resize->construct($image_director.$name);
				$this->resize->resizeImage(275, 275, 'exact');
				$this->resize->saveImage($image_director_thumb.$name, 100);
			}
			return $name;
		}
		else return '';
	}
}