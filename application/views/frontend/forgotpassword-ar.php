<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/login-reg.css">
<h1 class="head"><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
<div class="log">
  <div class="container">
		<?php
			//echo $admessage;
			$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form col-sm-5 col-xs-12', 'dir' => 'rtl');
			echo form_open('newpassword-ar', $attributes);
			//echo '<h2 class="title">نسيت كلمة المرور</h2>';
			echo validation_errors();
		?>
		<?php if(isset($activemessage)) echo $activemessage; ?>
		<?php
			$data = array(
				'type' => 'email',
				'name' => 'email',
				'id' => 'email',
				'placeholder' => 'البريد الالكتروني',
				'class' => 'form-control',
				'value' => set_value('email')
			);
			echo form_input($data);
		?>
		<?php
			$data = array(
				'name' => 'submit',
				'id' => 'submit',
				'class' => 'btn btn-block',
				'value' => 'ارسال',
				'type' => 'submit',
				'content' => 'ارسال'
			);
			echo form_submit($data);
		?>
        <a href="<?php echo base_url(); ?>login-ar">الدخول؟</a> <br>
        <a href="<?php echo base_url(); ?>registration-ar">انشاء حساب جديد؟</a>
      <?php	echo form_close();	?>
  </div>  
</div>