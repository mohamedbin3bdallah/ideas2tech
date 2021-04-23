<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php echo $this->pages['desc'.$front_lang][$pageid]; ?>">
	<meta name="keywords" content="<?php echo $this->pages['keywords'.$front_lang][$pageid]; ?>">
	<title><?php echo $this->pages['title'.$front_lang][$pageid]; ?></title>
	<link rel="apple-touch-icon" href="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>">
	<link rel="shortcut icon" href="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>">

    <link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/index-rtl.css">
</head>

<body>
<!--==== Header ====-->
<!--==== Header ====-->
<header>
    <div class="container">
        <div class="col-md-2 logo"><a href="<?php echo base_url(); ?>index-ar"><img src="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>" alt=""></a></div>
        <div class="col-md-8">
            <h1>We help transform ideas into Technologies! </h1>
            <h4>ِAlways a better way of doing things! </h4>
        </div>
       <?php if(in_array('SM',$this->sections) && isset($contact) && $contact->smactive == '1') { ?>
        <div class="social">
            <ul class="list-inline">
                <?php if($contact->smfacebook != '') { ?><li><a target="_blank" href="<?php echo $contact->smfacebook; ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
                <?php if($contact->smtwitter != '') { ?><li><a target="_blank"  href="<?php echo $contact->smtwitter; ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
                <?php if($contact->sminstagram != '') { ?><li><a target="_blank"  href="<?php echo $contact->sminstagram; ?>"><i class="fa fa-instagram"></i></a></li><?php } ?>
                <?php if($contact->smyoutube != '') { ?><li><a target="_blank"  href="<?php echo $contact->smyoutube; ?>"><i class="fa fa-youtube"></i></a></li><?php } ?>
                <span><img src="<?php echo base_url(); ?>idea2tech/icons/Layer2.png" alt=""></span>
				<li>تابعنا</li>
            </ul>
        </div>
		<?php } ?>
    </div>
</header>



<!--===== NavBar =====-->
<!--===== NavBar =====-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <ul class="nav navbar-nav">
            <li id="index-ar"><a href="<?php echo base_url(); ?>index-ar">الرئيسية</a></li>
            <li id="about-ar"><a href="<?php echo base_url(); ?>about-ar">من نحن</a></li>
            <li id="projects-ar"><a href="<?php echo base_url(); ?>projects-ar">مشارعنا</a></li>
            <li id="services-ar"><a href="<?php echo base_url(); ?>services-ar">خدماتنا</a></li>
            <li id="plans-ar"><a href="<?php echo base_url(); ?>plans-ar">اطلب الان</a></li>
            <li id="contact-ar"><a href="<?php echo base_url(); ?>contact-ar">اتصل بنا</a></li>
          </ul>
      </ul>
      
        
    <ul class="nav navbar-nav ">
		<?php if($this->session->userdata('uid') == TRUE){ ?>
            <li><a href=""> اهلا  <?php echo $this->session->userdata('username');?> </a></li>
            <li><a href="<?php echo base_url(); ?>logout-ar"> خروج </a></li>
        <?php } else {?>
          <li id="registration-ar"><a href="<?php echo base_url(); ?>registration-ar"><span class="glyphicon glyphicon-user"></span> تسجيل</a></li>
          <li id="login-ar"><a href="<?php echo base_url(); ?>login-ar"><span class="glyphicon glyphicon-log-in"></span> دخول</a></li>
		 <?php }?>
          <li><a href="<?php echo base_url(); ?>index-en"><span class="fa fa-language"></span> English</a></li>

    </ul>
    </div>
  </div>
</nav>