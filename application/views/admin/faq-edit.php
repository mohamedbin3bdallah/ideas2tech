		<div class="right_col" role="main">
          <div class="" >
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('edit_faq'); ?></h3>
              </div>

              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>
			
            <div class="clearfix"></div>
            
			<div class="row" dir="<?php if($system->langs == 'ar') echo 'rtl'; ?>">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Form Design <small>different form elements</small></h2>-->
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>-->
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<?php
						//echo $admessage;
						//echo form_error('name');
						echo validation_errors();
						$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');
						echo form_open_multipart('faq/editfaq/'.$faq->faid, $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->
					<?php
						if($system->langs == 'ar') { $label_class = ' col-md-push-6 col-sm-push-6'; $input_class = ' col-md-pull-1 ol-sm-pull-2'; }
						else { $label_class = ''; $input_class = ''; }
					?>

                      <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('questionen').' <span class="required">*</span>','titleen',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'titleen',
								'id' => 'title',
								'placeholder' => lang('questionen'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								//'readonly' => 'TRUE',
								'value' => $faq->fatitleen
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('questionar').' <span class="required">*</span>','titlear',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'titlear',
								'id' => 'title',
								'placeholder' => lang('questionar'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								//'readonly' => 'TRUE',
								'value' => $faq->fatitlear
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('answeren').' <span class="required">*</span>','descen',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'name' => 'descen',
								'id' => 'desc',
								'placeholder' => lang('answeren'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => $faq->fadescen
							);
							echo form_textarea($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('answerar').' <span class="required">*</span>','descar',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'name' => 'descar',
								'id' => 'desc',
								'placeholder' => lang('answerar'),
								'class' => 'form-control col-md-7 col-xs-12',
								'value' => $faq->fadescar
							);
							echo form_textarea($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
                        <?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('active'),'active',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'name' => 'active',
								'id' => 'active',
								/*'checked' => 'TRUE',*/
								'class' => 'js-switch',
								'value' => 1
							);
							if($faq->faactive == '1') $data['checked'] = 'TRUE';
							echo form_checkbox($data);
						?>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
						  <?php																				
							$data = array(
								'name' => 'submit',
								'id' => 'submit',
								'class' => 'btn btn-success',
								'value' => 'true',
								'type' => 'submit',
								'content' => lang('edit')
							);
							echo form_button($data);
						?>
                        </div>
                      </div>

                    <?php								
						echo form_close();
					?>
                  </div>
                </div>
              </div>
            </div>
		  </div>
        </div>