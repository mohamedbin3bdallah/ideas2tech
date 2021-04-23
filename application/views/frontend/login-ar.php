<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/login-reg.css">
<h1 class="head"><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
<div class="log">
  <div class="container">
		<?php
			//echo $admessage;
			$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form col-sm-5 col-xs-12', 'dir' => 'rtl');
			echo form_open('userlog-ar', $attributes);
			//echo '<h2 class="title">الدخول</h2>';
			echo validation_errors();
		?>
		<?php if(isset($activemessage)) echo $activemessage; ?>
		<?php
			$data = array(
				'type' => 'email',
				'name' => 'email',
				'id' => 'email',
				'placeholder' => 'ادخل البريد الالكتروني',
				'class' => 'form-control',
				'value' => set_value('email')
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
				'value' => set_value('password')
			);
			echo form_input($data);
		?>
		<?php
			$data = array(
				'name' => 'submit',
				'id' => 'submit',
				'class' => 'btn btn-block',
				'value' => 'دخول',
				'type' => 'submit',
				'content' => 'دخول'
			);
			echo form_submit($data);
		?>
        <a href="<?php echo base_url(); ?>forgotpassword-ar">نسيت كلمة المرور؟</a> <br>
        <a href="<?php echo base_url(); ?>registration-ar">انشاء حساب جديد؟</a>
      <?php	echo form_close();	?>
  </div>  
</div>