        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>home" class="site_title"><span><?php echo $system->website; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic ">
                <img src="<?php if($this->loginuser->uimage != '' && file_exists($this->config->item('users_folder').$this->loginuser->uimage)) echo base_url().$this->config->item('users_folder').$this->loginuser->uimage; else echo base_url().$this->config->item('users_folder').'user.png'; ?>" alt="<?php echo $this->loginuser->username; ?>" class="img-circle profile_img" style="max-height:55px;">
              </div>
              <div class="profile_info">
                <span><?php echo lang('welcome'); ?>,</span>
                <h2><?php echo $this->loginuser->username; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

			<br>
			<br>
			<br>
			<br>

            <!-- sidebar menu -->
			<?php if($system->langs == 'ar') { ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->
                <ul class="nav side-menu" style="text-align:right;">
				  <?php if($this->loginuser->uutid ==  '1') { ?><li><a href="<?php echo base_url(); ?>systemy"><?php echo lang('system'); ?> <i class="fa fa-cog"></i></a></li><?php } ?>

				  <?php if(strpos($this->loginuser->privileges, ',scadd,') !== false || strpos($this->loginuser->privileges, ',scsee,') !== false) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('sections'); ?> <i class="fa fa-tree"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',scadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections/add"><?php echo lang('add_section'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',scsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections"><?php echo lang('sections'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				  <?php if((in_array('U',$this->sections) || in_array('UT',$this->sections)) && (strpos($this->loginuser->privileges, ',utadd,') !== false || strpos($this->loginuser->privileges, ',utsee,') !== false || strpos($this->loginuser->privileges, ',uadd,') !== false || strpos($this->loginuser->privileges, ',usee,') !== false)) { ?>
				  <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('users'); ?> <i class="fa fa-user"></i></a>
					<ul class="nav child_menu">
						<?php if(in_array('UT',$this->sections)) { if(strpos($this->loginuser->privileges, ',utadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes/add"><?php echo lang('add_usertype'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',utsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes"><?php echo lang('usertypes'); ?></a></li><?php } } ?>
						<?php if(in_array('U',$this->sections)) { if(strpos($this->loginuser->privileges, ',uadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/add"><?php echo lang('add_user'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',usee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users"><?php echo lang('users'); ?></a></li><?php } } ?>
					</ul>
                  </li>
				  <?php } ?>

				   <?php if((in_array('PG',$this->sections)) && (strpos($this->loginuser->privileges, ',pgadd,') !== false || strpos($this->loginuser->privileges, ',pgsee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('pages'); ?> <i class="fa fa-list-alt"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',pgadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages/add"><?php echo lang('add_page'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',pgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages"><?php echo lang('pages'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				  <?php if((in_array('AB',$this->sections)) && (strpos($this->loginuser->privileges, ',abadd,') !== false || strpos($this->loginuser->privileges, ',absee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('about'); ?> <i class="fa fa-hospital-o"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',absee,') !== false) { ?><li><a href="<?php echo base_url(); ?>aboutus"><?php echo lang('about'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				   <?php if((in_array('SD',$this->sections)) && (strpos($this->loginuser->privileges, ',sdadd,') !== false || strpos($this->loginuser->privileges, ',sdsee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('slides'); ?> <i class="fa fa-sliders"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',sdadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>slides/add"><?php echo lang('add_slide'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',sdsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>slides"><?php echo lang('slides'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				  <?php if((in_array('CG',$this->sections)) && (strpos($this->loginuser->privileges, ',cgadd,') !== false || strpos($this->loginuser->privileges, ',cgsee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('categories'); ?> <i class="fa fa-folder-open"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',cgadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>categories/add"><?php echo lang('add_category'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',cgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>categories"><?php echo lang('categories'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				   <?php if((in_array('PR',$this->sections)) && (strpos($this->loginuser->privileges, ',pradd,') !== false || strpos($this->loginuser->privileges, ',prsee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('products'); ?> <i class="fa fa-picture-o"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',pradd,') !== false) { ?><li><a href="<?php echo base_url(); ?>products/add"><?php echo lang('add_product'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',prsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>products"><?php echo lang('products'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				  <?php if((in_array('FA',$this->sections)) && (strpos($this->loginuser->privileges, ',faadd,') !== false || strpos($this->loginuser->privileges, ',fasee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('faq'); ?> <i class="fa fa-question"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',faadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>faq/add"><?php echo lang('add_faq'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',fasee,') !== false) { ?><li><a href="<?php echo base_url(); ?>faq"><?php echo lang('faq'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				  <?php if((in_array('PL',$this->sections)) && (strpos($this->loginuser->privileges, ',pladd,') !== false || strpos($this->loginuser->privileges, ',plsee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('plans'); ?> <i class="fa fa-columns"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',pladd,') !== false) { ?><li><a href="<?php echo base_url(); ?>plans/add"><?php echo lang('add_plan'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',plsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>plans"><?php echo lang('plans'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>				  				  				  <?php if((in_array('OD',$this->sections)) && strpos($this->loginuser->privileges, ',odsee,') !== false) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('orders'); ?> <i class="fa fa-shopping-cart"></i></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',odsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>orders"><?php echo lang('orders'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>
				  
				  <?php if((in_array('CT',$this->sections) || in_array('SM',$this->sections) || in_array('MG',$this->sections)) && (strpos($this->loginuser->privileges, ',ctedit,') !== false || strpos($this->loginuser->privileges, ',smedit,') !== false || strpos($this->loginuser->privileges, ',mgsee,') !== false)) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('contact'); ?> <i class="fa fa-phone"></i></a>
					<ul class="nav child_menu">
						<?php if(in_array('CT',$this->sections) && strpos($this->loginuser->privileges, ',ctedit,') !== false) { ?><li><a href="<?php echo base_url(); ?>contactus/contact"><?php echo lang('contact'); ?></a></li><?php } ?>
						<?php if(in_array('SM',$this->sections) && strpos($this->loginuser->privileges, ',smedit,') !== false) { ?><li><a href="<?php echo base_url(); ?>contactus/socialmedia"><?php echo lang('socialmedia'); ?></a></li><?php } ?>
						<?php if(in_array('MG',$this->sections) && strpos($this->loginuser->privileges, ',mgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>messages"><?php echo lang('messages'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
                </ul>
              </div>
            </div>
			<?php } else { ?>
			 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->
                <ul class="nav side-menu" style="text-align:left;">
				  <?php if($this->loginuser->uutid ==  '1') { ?><li><a href="<?php echo base_url(); ?>systemy"><i class="fa fa-cog"></i> <?php echo lang('system'); ?></a></li><?php } ?>

				  <?php if(strpos($this->loginuser->privileges, ',scadd,') !== false || strpos($this->loginuser->privileges, ',scsee,') !== false) { ?>
				   <li><a><i class="fa fa-tree"></i> <?php echo lang('sections'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',scadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections/add"><?php echo lang('add_section'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',scsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections"><?php echo lang('sections'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				  <?php if((in_array('U',$this->sections) || in_array('UT',$this->sections)) && (strpos($this->loginuser->privileges, ',utadd,') !== false || strpos($this->loginuser->privileges, ',utsee,') !== false || strpos($this->loginuser->privileges, ',uadd,') !== false || strpos($this->loginuser->privileges, ',usee,') !== false)) { ?>
				  <li><a><i class="fa fa-user"></i> <?php echo lang('users'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(in_array('UT',$this->sections)) { if(strpos($this->loginuser->privileges, ',utadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes/add"><?php echo lang('add_usertype'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',utsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes"><?php echo lang('usertypes'); ?></a></li><?php } } ?>
						<?php if(in_array('U',$this->sections)) { if(strpos($this->loginuser->privileges, ',uadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/add"><?php echo lang('add_user'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',usee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users"><?php echo lang('users'); ?></a></li><?php } } ?>
					</ul>
                  </li>
				  <?php } ?>

				   <?php if((in_array('PG',$this->sections)) && (strpos($this->loginuser->privileges, ',pgadd,') !== false || strpos($this->loginuser->privileges, ',pgsee,') !== false)) { ?>
				   <li><a><i class="fa fa-list-alt"></i> <?php echo lang('pages'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',pgadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages/add"><?php echo lang('add_page'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',pgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages"><?php echo lang('pages'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				  <?php if((in_array('AB',$this->sections)) && (strpos($this->loginuser->privileges, ',abadd,') !== false || strpos($this->loginuser->privileges, ',absee,') !== false)) { ?>
				   <li><a><i class="fa fa-hospital-o"></i> <?php echo lang('about'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',absee,') !== false) { ?><li><a href="<?php echo base_url(); ?>aboutus"><?php echo lang('about'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>

				   <?php if((in_array('SD',$this->sections)) && (strpos($this->loginuser->privileges, ',sdadd,') !== false || strpos($this->loginuser->privileges, ',sdsee,') !== false)) { ?>
				   <li><a><i class="fa fa-sliders"></i> <?php echo lang('slides'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',sdadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>slides/add"><?php echo lang('add_slide'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',sdsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>slides"><?php echo lang('slides'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				  <?php if((in_array('CG',$this->sections)) && (strpos($this->loginuser->privileges, ',cgadd,') !== false || strpos($this->loginuser->privileges, ',cgsee,') !== false)) { ?>
				   <li><a><i class="fa fa-folder-open"></i> <?php echo lang('categories'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',cgadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>categories/add"><?php echo lang('add_category'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',cgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>categories"><?php echo lang('categories'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				   <?php if((in_array('PR',$this->sections)) && (strpos($this->loginuser->privileges, ',pradd,') !== false || strpos($this->loginuser->privileges, ',prsee,') !== false)) { ?>
				   <li><a><i class="fa fa-picture-o"></i> <?php echo lang('products'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',pradd,') !== false) { ?><li><a href="<?php echo base_url(); ?>products/add"><?php echo lang('add_product'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',prsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>products"><?php echo lang('products'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				   <?php if((in_array('FA',$this->sections)) && (strpos($this->loginuser->privileges, ',faadd,') !== false || strpos($this->loginuser->privileges, ',fasee,') !== false)) { ?>
				   <li><a> <i class="fa fa-question"></i> <?php echo lang('faq'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',faadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>faq/add"><?php echo lang('add_faq'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',fasee,') !== false) { ?><li><a href="<?php echo base_url(); ?>faq"><?php echo lang('faq'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  
				  <?php if((in_array('PL',$this->sections)) && (strpos($this->loginuser->privileges, ',pladd,') !== false || strpos($this->loginuser->privileges, ',plsee,') !== false)) { ?>
				   <li><a> <i class="fa fa-columns"></i> <?php echo lang('plans'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',pladd,') !== false) { ?><li><a href="<?php echo base_url(); ?>plans/add"><?php echo lang('add_plan'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',plsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>plans"><?php echo lang('plans'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>				  				  				  <?php if((in_array('OD',$this->sections)) && strpos($this->loginuser->privileges, ',odsee,') !== false) { ?>				   <li><a> <i class="fa fa-shopping-cart"></i> <?php echo lang('orders'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',odsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>orders"><?php echo lang('orders'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>

				  <?php if((in_array('CT',$this->sections) || in_array('SM',$this->sections) || in_array('MG',$this->sections)) && (strpos($this->loginuser->privileges, ',ctedit,') !== false || strpos($this->loginuser->privileges, ',smedit,') !== false || strpos($this->loginuser->privileges, ',mgsee,') !== false)) { ?>
				   <li><a><i class="fa fa-phone"></i> <?php echo lang('contact'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(in_array('CT',$this->sections) && strpos($this->loginuser->privileges, ',ctedit,') !== false) { ?><li><a href="<?php echo base_url(); ?>contactus/contact"><?php echo lang('contact'); ?></a></li><?php } ?>
						<?php if(in_array('SM',$this->sections) && strpos($this->loginuser->privileges, ',smedit,') !== false) { ?><li><a href="<?php echo base_url(); ?>contactus/socialmedia"><?php echo lang('socialmedia'); ?></a></li><?php } ?>
						<?php if(in_array('MG',$this->sections) && strpos($this->loginuser->privileges, ',mgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>messages"><?php echo lang('messages'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
                </ul>
              </div>
            </div>
			<?php } ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
            <!-- /menu footer buttons -->
          </div>
        </div>