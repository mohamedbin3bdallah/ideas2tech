<head lang="en">
    <meta charset="UTF-8">
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

<!--===== Silder =====-->
<!--===== Silder =====-->
 <body>
  <div id="myCarousel" class="carousel slide" data-ride="carousel"> <!--data-interval="false"-->
  <!-- Indicators -->
  <ol class="carousel-indicators">
	<?php for($sl=0;$sl<count($slides);$sl++) { ?>
		<li data-target="#myCarousel" data-slide-to="<?php echo $sl; ?>" class="<?php if($sl == 0) echo 'active' ; ?>"></li>
	<?php } ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  <?php for($sl=0;$sl<count($slides);$sl++) { ?>
    <div class="item <?php if($sl == 0) echo 'active' ; ?>" style="background-image: url('<?php echo base_url().$slides_thumb_folder.$slides[$sl]->sdimg; ?>');">
        <div class="carousel-caption">
            <?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) { ?><img src="<?php echo base_url().$system->logo; ?>" alt="<?php echo $this->pages['title'.$front_lang][$pageid]; ?>"><?php } ?>
            <h1><?php echo $slides[$sl]->sdtitle; ?></h1>
            <p><?php echo $slides[$sl]->sddesc; ?></p>
            <a href="<?php echo base_url().($slides[$sl]->sdlinkurl).'-'.$front_lang; ?>"><button class="btn button">إقرأ المزيد </button></a>
            <a href="<?php echo base_url(); ?>index-en"><button class="btn button lang"> EN  </button></a>
        </div>
    </div>
  <?php } ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-circle-arrow-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-circle-arrow-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
   
 
<!--============ Footer ============-->
<!--============ Footer ============-->
	<script src="<?php echo base_url(); ?>idea2tech/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>idea2tech/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>idea2tech/js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <script src="<?php echo base_url(); ?>idea2tech/js/index.js"></script>
</body>
   
