<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/login-reg.css">
<h1 class="head"><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
<div class="log">
  <div class="container">
     
	  <?php
		//echo $admessage;
		$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form col-sm-5 col-xs-12', 'dir' => 'rtl');
		echo form_open('register-ar', $attributes);
		//echo '<h2 class="title">التسجيل</h2>';
		echo validation_errors();
	  ?>
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'name',
										'id' => 'name',
										'placeholder' => 'الاسم',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('name')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'username',
										'id' => 'username',
										'placeholder' => 'اسم المستخدم',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('username')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'type' => 'email',
										'name' => 'email',
										'id' => 'email',
										'placeholder' => 'البريد الالكتروني',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('email')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'mobile',
										'id' => 'mobile',
										'placeholder' => 'المحمول',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('mobile')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'type' => 'text',
										'name' => 'address',
										'id' => 'address',
										'placeholder' => 'العنوان',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('address')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'type' => 'password',
										'name' => 'password',
										'id' => 'password',
										'placeholder' => 'كلمة المرور',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('password')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'type' => 'password',
										'name' => 'cnfpassword',
										'id' => 'cnfpassword',
										'placeholder' => 'اعادة كلمة المرور',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('cnfpassword')
									);
									echo form_input($data);
									?>
									<?php
									$data = array(
										'name' => 'submit',
										'id' => 'submit',
										'class' => 'btn btn-block',
										'value' => 'تسجيل',
										'type' => 'submit',
										//'disabled' => 'disabled',
										'content' => 'تسجيل'
									);
									echo form_submit($data);
									?>
        <a href="<?php echo base_url(); ?>login-ar">لدي حساب بالفعل؟</a>
      <?php	echo form_close();	?>

  </div>  
</div>