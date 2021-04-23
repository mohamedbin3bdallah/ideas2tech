<!--====================================-->
<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/contact-us-ar.css">

<div class="contact">
    <div class="container">
        <h1 class="head"><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
        <div class="design"></div>
        
        <?php
			if(in_array('MG',$this->sections) && in_array('CT',$this->sections) && $contact->ctactive == '1' && $contact->ctmap != '') { $fclass = 'text col-md-6 fadeInLeft wow'; $lclass = 'map col-md-6 fadeInRight wow'; }
			elseif(in_array('CT',$this->sections) && $contact->ctactive == '1' && $contact->ctmap != '') { $fclass = 'text fadeInLeft wow'; $lclass = 'map col-md-12 fadeInRight wow'; }
			elseif(in_array('MG',$this->sections)) { $fclass = 'text col-md-12 fadeInLeft wow'; $lclass = 'map fadeInRight wow'; }
			else { $fclass = 'text fadeInLeft wow'; $lclass = 'map fadeInRight wow'; }

			if(in_array('MG',$this->sections)) {
			$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class'=>$fclass, 'data-wow-duration'=>'1.8s' ,'data-wow-offset'=>'300');
			echo form_open('sendmessage-ar', $attributes);
			echo validation_errors();
		?>
            <table width='100%'>
			<?php if($this->session->userdata('uid') == FALSE){ ?>
                <tr>
                    <td>الاسم: &nbsp;</td>
                    <td>
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
					</td>
                </tr>
                <tr>
                    <td>الايميل: &nbsp;</td>
                    <td>
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
					</td>
                </tr>
			<?php } ?>
				<tr>
                    <td>العنوان: &nbsp;</td>
                    <td>
					<?php
					$data = array(
										'type' => 'text',
										'name' => 'title',
										'id' => 'title',
										'placeholder' => 'العنوان',
										'class' => 'form-control',
										//'max' => 255,
										//'required' => 'required',
										'value' => set_value('Title')
									);
									echo form_input($data);
					?>
					</td>
                </tr>
                <tr>
                    <td>الرسالة: &nbsp;</td>
                    <td>
					<?php
					$data = array(
										'name' => 'body',
										'id' => 'body',
										'rows' => 7,
										'placeholder' => 'الرسالة',
										'class' => 'form-control col-md-7 col-xs-12',
										'value' => set_value('body')
									);
									echo form_textarea($data);
					?>
					</td>
                </tr>
            </table>
			<?php
									$data = array(
										'name' => 'submit',
										'id' => 'submit',
										'class' => 'btn button',
										'value' => 'ارسال',
										'type' => 'submit',
										//'disabled' => 'disabled',
										'content' => 'ارسال'
									);
									echo form_submit($data);
			?>
			<?php if(in_array('CT',$this->sections) && $contact->ctactive == '1') { ?>
            <?php if($contact->ctaddressar != '') { ?><p class="fa fa-map-marker"> &nbsp; <?php echo $contact->ctaddressar; ?></p><?php } ?>
            <?php if($contact->ctemail != '') { ?><p class="fa fa-envelope"> &nbsp;  <a href="mailto:<?php echo $contact->ctemail; ?>"><?php echo $contact->ctemail; ?></a></p><?php } ?>
            <?php if($contact->ctphone != '') { ?><p class="fa fa-phone-square"> &nbsp; <?php echo $contact->ctphone; ?></p><?php } ?>
			<?php if($contact->ctmobile != '') { ?><p class="fa fa-mobile"> &nbsp; <?php echo $contact->ctmobile; ?></p><?php } ?>
			<?php } ?>
		<?php echo form_close(); } ?>
        
        <?php if(in_array('CT',$this->sections) && $contact->ctactive == '1' && $contact->ctmap != '') { ?>
        <div class="<?php echo $lclass; ?>">
            <?php echo htmlspecialchars_decode($contact->ctmap); ?>
        </div>
		<?php } ?>
        </div>
        
    </div>