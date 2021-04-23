<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="<?php echo $this->pages['desc'][$pageid]; ?>">
		<meta name="keywords" content="<?php echo $this->pages['keywords'][$pageid]; ?>">
		<title><?php echo $this->pages['title'][$pageid]; ?></title>
		<link rel="apple-touch-icon" href="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>">
		<link rel="shortcut icon" href="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>">
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>timber/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>timber/css/font-awesome.css">
		<link href="<?php echo base_url(); ?>gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="camera-css"  href="<?php echo base_url(); ?>timber/css/camera.css" type="text/css" media="all">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>timber/css/slicknav.php?logo=<?php echo $system->logo; ?>">
		<link rel="stylesheet" href="<?php echo base_url(); ?>timber/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>timber/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>timber/css/mystyle.css">
		
		<script type="text/javascript" src="<?php echo base_url(); ?>timber/js/jquery-1.8.3.min.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700|Open+Sans:700' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php echo base_url(); ?>timber/js/jquery.mobile.customized.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>timber/js/jquery.easing.1.3.js"></script> 
		<script type="text/javascript" src="<?php echo base_url(); ?>timber/js/camera.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>timber/js/myscript.js"></script>
		<script src="<?php echo base_url(); ?>timber/js/sorting.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>timber/js/jquery.isotope.js" type="text/javascript"></script>
		<!--script type="text/javascript" src="js/jquery.nav.js"></script-->
		

		<script>
			jQuery(function(){
					jQuery('#camera_wrap_1').camera({
					transPeriod: 500,
					time: 3000,
					height: '490px',
					thumbnails: false,
					pagination: true,
					playPause: false,
					loader: false,
					navigation: false,
					hover: false
				});
			});
			
			$(document).ready(function(){
				$(".aboutme").on('hover',function() {
					var id = $(this).attr('num');
					$("#circle"+id).addClass("rotate10");
				});
				$(".aboutme").on('mouseleave',function() {
					var id = $(this).attr('num');
					$("#circle"+id).removeClass("rotate10");
				});
			});
		</script>
		
	</head>
	<body>
    
    <!--home start-->
    
    <div id="home">
    	<div class="headerLine">
	<div id="menuF" class="default">
		<div class="container">
			<div class="row">
				<div class="logo col-md-4">
					<div>
						<a href="#home">
							<img src="<?php if(isset($system->logo) && $system->logo != '' && file_exists($system->logo)) echo base_url().$system->logo; ?>" width="107" height="37">
						</a>
					</div>
				</div>
				<div class="col-md-8">
					<div class="navmenu"style="text-align: center;">
					<?php if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4))) { ?>
						<ul id="menu">
							<li class="active" ><a href="#home">الرئيسية</a></li>
							<li><a href="#about">عن الشركة</a></li>
							<li><a href="#project">الأعمال</a></li>
							<li class="last"><a href="#contact">التواصل</a></li>
						</ul>
					<?php } else { ?>
						<ul id="menu">
							<?php if(in_array('CT',$this->sections)) { ?><li class="last"><a href="#contact">التواصل</a></li><?php } ?>
							<?php if(in_array('PR',$this->sections)) { ?><li><a href="#project">الأعمال</a></li><?php } ?>
							<?php if(in_array('AB',$this->sections)) { ?><li><a href="#about">عن الشركة</a></li><?php } ?>
							<li class="active" ><a href="#home">الرئيسية</a></li>
						</ul>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div class="container">
			<div class="row wrap">
				<div class="col-md-12 gallery">
					<?php if(in_array('SD',$this->sections)) { ?>
						<div class="camera_wrap camera_white_skin" id="camera_wrap_1" style="padding-bottom:55px;">
						<?php foreach($slides as $slide) { ?>
							<div data-thumb="" data-src="<?php echo base_url().$slides_folder.$slide->sdimg; ?>">
								<div class="img-responsive camera_caption fadeFromBottom">
									<h4><?php echo $slide->sdtitle; ?></h4>
									<p><?php echo $slide->sddesc; ?></p>
								</div>
							</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php if(in_array('AB',$this->sections)) { ?>
		<?php if(isset($abouts) && !empty($abouts)) { ?>
		<div class="container" id="about">
			<div class="row">
			<?php foreach($abouts as $about) { ?>
				<div class="col-md-4 project">
					<center><div class="circlebig"><div id="circle<?php echo $about->abid; ?>" class="circle"></div></div></center>
					<div class="aboutme" num="<?php echo $about->abid; ?>">
						<center><h3><i class="fa <?php echo $about->abicon; ?>"></i></h3>
						<h4><?php echo $about->abtitle; ?></h4></center>
						<p><?php echo htmlspecialchars_decode(stripslashes($about->abdesc)); ?></p>
					</div>
				</div>
			<?php } ?>				
			</div>
		</div>
		<?php } ?>
	<?php } ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 cBusiness">
					<h3>الحسابات الاجتماعية الرسمية لويكيبيديا العربية</h3>
					<h4> لبرمجيات الوسائط المتعددة والبرمجيات الإبداعية</h4>
				</div>
			</div>
		</div>
		<!--<div class="container">
			<div class="row">
				<div class="col-md-12 centPic">
					<img class="img-responsive"  src="<?php //echo base_url(); ?>timber/images/bizPic.png"/>
				</div>
			</div>
		</div>-->
    </div>
    
    <!--about start-->    
    
    <!--<div id="about">
    	<div class="line2">
			<div class="container">
				<div class="row Fresh">
					<div class="col-md-4 Des">
						<i class="fa fa-heart"></i>
						<h4>Fresh & Clean Design</h4>
						<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor. feugiat </p>
					</div>
					<div class="col-md-4 Ver">
						<i class="fa fa-cog"></i>
						<h4>Very Flexible</h4>
						<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor. feugiat </p>
					</div>
					<div class="col-md-4 Fully">
						<i class="fa fa-tablet"></i>
						<h4>Fully Responsive</h4>
						<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor. feugiat </p>
					</div>		
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 wwa">
					<span name="about" ></span>
					<h3>Who We Are? Meet Our Team!</h3>
					<h4>We listen, we discuss, we advise and develop. We love to learn and use the latest technologies.</h4>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row team">
				<div class="col-md-4 b1">
						<img class="img-responsive" src="images/picTeam/picT1.png">
						<h4>Tom Simpson</h4>
						<h5>CEO</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit <br/>quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget.</p>
						<ul>
							<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" ></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
						</ul>
				</div>
			
			
				<div class="col-md-4">
						<img class="img-responsive" src="images/picTeam/picT2.png">
						<h4>John Doe</h4>
						<h5>Project Manager</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br/> quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget.</p>
						<ul>
							<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" ></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
						</ul>
				</div>
		
			
				<div class="col-md-4 b3">
						<img class="img-responsive" src="images/picTeam/picT3.png">
						<h4>Anna White</h4>
						<h5>Developer</h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit<br/> quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget.</p>
						<ul>
							<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" ></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
						</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 hr1">
					<hr/>
				</div>
			</div>
		</div>		
		<div class="container">
			<div class="row">
				<div class="col-md-3 bar">
					<div class="progB chart" data-percent="64"  data-animate="3500">
						<div class="chart chart-content">
							<div class="percentage" data-percent="64">
							  <span class="percent">64</span>
							</div>
						</div>
					</div>
					<div class="textP">
						<h3>WordPress</h3>
						<p>Nulla consectetur ornare nibh, a auctor <br/>mauris scelerisque eu proin nec urna quis. </p>
					</div>
				</div>
				<div class="col-md-3 bar">
					<div class="progB chart" data-percent="22"  data-animate="3500">
						<div class="chart chart-content">
							<div class="percentage" data-percent="22">
							  <span class="percent">22</span>
							</div>
						</div>
					</div>
					<div class="textP">
						<h3>HTML5</h3>
						<p>Nulla consectetur ornare nibh, a auctor <br/>mauris scelerisque eu proin nec urna quis. </p>
					</div>
				</div>
				<div class="col-md-3 bar ">
					<div class="progB chart" data-percent="84"  data-animate="3500">
						<div class="chart chart-content">
							<div class="percentage" data-percent="22">
							  <span class="percent">84</span>
							</div>
						</div>
					</div>
					<div class="textP">
						<h3>CSS3</h3>
						<p>Nulla consectetur ornare nibh, a auctor <br/>mauris scelerisque eu proin nec urna quis. </p>
					</div>
				</div>
				<div class="col-md-3 bar ">
					<div class="progB chart" data-percent="45"  data-animate="3500">
						<div class="chart chart-content">
							<div class="percentage" data-percent="45">
							  <span class="percent">45</span>
							</div>
						</div>
					</div>
					<div class="textP">
						<h3>Woocommerce</h3>
						<p>Nulla consectetur ornare nibh, a auctor <br/>mauris scelerisque eu proin nec urna quis. </p>
					</div>
				</div>
			</div>
		</div>	
		
		
		<div class="container">
			<div class="row aboutUs">
				<div class="col-md-12 ">
					<h3>What Our Customers Say About Us?</h3>
				</div>
			</div>
		</div>
		
		<div style="position: relative;">
		
			<div class="container">
				<div class="row about">
					<div class="col-md-6">
						<div class="about1">
						<img class="pic1Ab" src="images/picAbout/aboutP1.png">
							<h3>Anna Smith, Company Inc.</h3>
							<p>Nulla consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor feugiat fermentum quisque eget pharetra, felis et venenatis. aliquam, nulla nisi lobortis elit ac.</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="about2">
						<img class="pic2Ab" src="images/picAbout/aboutP2.png">
							<h3>John Doe, Company Inc.</h3>
							<p>Consectetur ornare nibh, a auctor mauris scelerisque eu proin nec urna quis justo, adipiscing auctor, ut auctor feugiat fermentum nec quisque eget pharetra, felis et venenatis aliquam, nulla nisi lobortis elit, ac luctus.</p>
						</div>
					</div>
				</div>
			</div>
		
			<div class="horL"></div>
		
			<div class="container">
				<div class="row about">
					<div class="col-md-6">
						<div class="about1">
						<img class="pic1Ab" src="images/picAbout/aboutP3.png">
							<h3>Tom Sawyer, Company Inc.</h3>
							<p>A auctor mauris scelerisque eu proin nec urna quis justo adipiscing auctor ut auctor feugiat fermentum quisque eget pharetra, felis et venenatis aliquam, nulla nisi lobortis elit, acnterdum ante feugiat vitae.</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="about2">
						<img class="pic2Ab" src="images/picAbout/aboutP4.png">
							<h3>Sarah White, Company Inc.</h3>
							<p>Ornare nibh a auctor, mauris scelerisque eu proin nec urna nec a quis justo adipiscing auctor ut auctor feugiat fermentum quisque eget pharetra felis et venenatis aliquam, nulla nisi lobortis elit, ac eleifend nisl ante nec lorem. </p>
						</div>
					</div>
				</div>
			</div>
		
		</div>
    </div>-->
    <!--project start-->    
    <div id="project">    	
		<div class="line3">
			<div class="container">
				<div id="project1" ></div>
				<div class="row Ama">
					<div class="col-md-12">
					<span name="projects" id="projectss"></span>
					<h3>اعمالنا الرائعة</h3>
					<p>هنا لدينا بعض الاشياء التي سوف تحبونها</p>
					</div>
				</div>
			</div>
		</div>          
    
    
       <div class="container">

		<?php if(in_array('PR',$this->sections)) { ?>
		<?php if(isset($products) && !empty($products)) { ?>
		<div class="row">
			<!-- filter_block -->
			<?php if(in_array('CG',$this->sections)) { ?>
			<?php if(isset($categories) && !empty($categories)) { ?>
				<div id="options" class="col-md-12" style="text-align: center;">	
					<ul id="filter" class="option-set" data-option-key="filter">
						<li><a class="selected" href="#filter" data-option-value="*" class="current">الكل</a></li>
						<?php foreach($categories as $category) { ?>
							<li><a href="#filter" data-option-value=".<?php echo $category->cgid; ?>"><?php echo $category->cgtitle; ?></a></li>
						<?php } ?>
					</ul>
				</div><!-- //filter_block -->
			<?php } ?>
			<?php } ?>
		
			<div class="portfolio_block columns3   pretty" data-animated="fadeIn">	
				<?php foreach($products as $product) { ?>
					<div class="element col-sm-4   gall <?php echo $product->prcgid; ?>">
						<div class="portf_div">
						<?php if($product->primg != '' && file_exists($products_folder.$product->primg)) ?>
							<a class="plS" href="<?php echo base_url().$products_folder.$product->primg; ?>" rel="prettyPhoto[gallery]" title="<?php echo $product->prdesc; ?>">
								<img class="img-responsive picsGall" src="<?php echo base_url().$products_thumb_folder.$product->primg; ?>" alt="<?php echo $product->prtitle; ?>" style="border-top-right-radius: 55px;"/>
							</a>
						<?php?>
						<div class="view project_descr ">
							<h3 class="portf_title"><?php echo $product->prtitle; ?></h3>
							<!--<ul>
								<li><i class="fa fa-eye"></i>215</li>
								<li><a class="heart" href="#"><i class="fa-heart-o"></i>14</a></li>
							</ul>-->
						</div>
						</div>
					</div>
				<?php } ?>
			</div>
			
			
				
					<!--<div class="col-md-12 cBtn  lb" style="text-align: center;">
						<ul class="load_more_cont ">
							<li class="dowbload btn_load_more">
								<a href="javascript:void(0);" >
									<i class="fa fa-arrow-down"></i>Load More Projects
								</a>
							</li>
							<li class="buy">
								<a href="#">
									<i class="fa fa-shopping-cart"></i>Buy on Themeforest
								</a>
							</li>
						</ul>
					</div>-->
			
		</div>
		<?php } ?>
		<?php } ?>
			
			<script type="text/javascript">
				jQuery(window).load(function(){
					items_set = [
					
						{category : 'branding', lika_count : '77', view_count : '234', src : 'images/prettyPhotoImages/pic9.jpg', title : 'Foil Mini Badges', content : '' },
						
						{category : 'polygraphy', lika_count : '45', view_count : '100', src : 'images/prettyPhotoImages/pic7.jpg', title : 'Darko – Business Card Mock Up', content : '' },
						
						{category : 'text_styles', lika_count : '22', view_count : '140', src : 'images/prettyPhotoImages/pic8.jpg', title : 'Woody Poster Text Effect', content : '' }
						

					];
					jQuery('.portfolio_block').portfolio_addon({
						type : 1, // 2-4 columns simple portfolio
						load_count : 3,
						
						items : items_set
					});
					$('#container').isotope({
					  animationOptions: {
						 duration: 900,
						 queue: false
					   }
					});
				});
			</script>
		</div>
    </div>    
    
    <!--news start-->
    
    <!--<div id="news">
    	<div class="line4">		
			<div class="container">
				<div class="row Ama">
					<div class="col-md-12">
					<h3>What&rsquo;s New?</h3>
					<p>Get the latest news from our blog</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
				<div class="row news">
					<div class="col-md-6  text-left">
					<img class="img-responsive picsGall" src="images/picNews/news1.jpg"/>
					<h3><a href="#">Lorem Ipsum Dolor sit Amet Pelenntesque Sodales!</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
					<div class="col-md-6 text-right">
					<img class="img-responsive picsGall" src="images/picNews/news2.jpg"/>
					<h3><a href="#">Nam in Nisl id Ipsum Feugiat Posuere ut sit Amet Sem</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row news2 news">
					<div class="col-md-6 text-left">
					<img class="img-responsive picsGall" src="images/picNews/news3.jpg"/>
					<h3><a href="#">Lorem Ipsum Dolor sit Amet Pelenntesque Sodales!</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
					<div class="col-md-6 text-right">
					<img class="img-responsive picsGall" src="images/picNews/news4.jpg"/>
					<h3><a href="#">Nam in Nisl id Ipsum Feugiat Posuere ut sit Amet Sem</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row news2 news">
					<div class="col-md-6 text-left">
					<img class="img-responsive picsGall" src="images/picNews/news5.jpg"/>
					<h3 ><a href="#">Lorem Ipsum Dolor sit Amet Pelenntesque Sodales!</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
					<div class="col-md-6 text-right">
					<img class="img-responsive picsGall" src="images/picNews/news6.jpg"/>
					<h3><a href="#">Nam in Nisl id Ipsum Feugiat Posuere ut sit Amet Sem</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
				</div>
			</div>
			
			
			
			<div class="container hideObj2" style="display:none;">
				<div class="row news2 news">
					<div class="col-md-6 text-right">
					<img class="img-responsive picsGall" src="images/picNews/news6.jpg"/>
					<h3><a href="#">Nam in Nisl id Ipsum Feugiat Posuere ut sit Amet Sem</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
					<div class="col-md-6 text-left">
					<img class="img-responsive picsGall" src="images/picNews/news5.jpg"/>
					<h3 ><a href="#">Lorem Ipsum Dolor sit Amet Pelenntesque Sodales!</a></h3>
					<ul>
						<li><i class="fa fa-calendar"></i>April 25, 2014</li>
						<li><a href="#"><i class="fa fa-folder-open"></i>Staff</a></li>
						<li><a href="#"><i class="fa fa-comments"></i>17 comments</a></li>
					</ul>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit quisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. adipiscing vitae vel quam proin eget mauris eget. <a class="readMore" href="#">Read More <i class="fa fa-angle-right"></i></a></p>
					<hr class="hrNews">
					</div>
				</div>
			</div>
			<div class="container">
			<div class="row cBtn">
				<div class="col-md-12" style="text-align: center; margin-bottom: -90px; z-index: 10;">
					<ul class="mNews">
						<li class="dowbload bhide2"><a href="#"><i class="fa fa-arrow-down"></i>Load More news</a></li>
					</ul>
				</div>
			</div>
		</div>
    </div>-->
    
    
    <!--contact start-->
    
    <div id="contact">
    	<div class="line5">					
			<div class="container">
				<div class="row Ama">
					<div class="col-md-12">
					<h3>لديك سؤال ؟ نحن هنا لمساعدتك</h3>
					<p>كن على تواصل معنا</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php echo validation_errors(); ?>
				</div>
			</div>
			<div class="row">
			<?php if(in_array('MG',$this->sections)) { ?>
				<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1') { ?><div class="col-md-9 col-xs-12 forma">
				<?php } else { ?><div class="col-md-12 col-xs-12 forma"><?php } ?>
					<?php
						$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', 'class' => 'th-formgetintouch'*/);
						echo form_open('sendmessage', $attributes);

							$data = array(
								'type' => 'text',
								'name' => 'name',
								'id' => 'name',
								'placeholder' => 'الاسم *',
								'class' => 'col-md-6 col-xs-12 name',
								//'max' => 255,
								//'required' => 'required',
								'value' => set_value('name')
							);
							echo form_input($data);

							$data = array(
								'type' => 'email',
								'name' => 'email',
								'id' => 'email',
								'placeholder' => 'البريد الالكتروني *',
								'class' => 'col-md-6 col-xs-12 Email',
								//'max' => 255,
								//'required' => 'required',
								'value' => set_value('email')
							);
							echo form_input($data);

							$data = array(
								'type' => 'text',
								'name' => 'title',
								'id' => 'title',
								'placeholder' => 'العنوان *',
								'class' => 'col-md-12 col-xs-12 Subject',
								//'max' => 255,
								//'required' => 'required',
								'value' => set_value('title')
							);
							echo form_input($data);

							$data = array(
								'name' => 'body',
								'id' => 'body',
								'placeholder' => 'الرسالة *',
								'class' => 'col-md-12 col-xs-12 Message',
								//'max' => 255,
								//'required' => 'required',
								'value' => set_value('body')
							);
							echo form_textarea($data);
						?>
						<div class="cBtn col-xs-12">
							<ul>
								<li class="clear">
								<?php
									$data = array(
										'name' => 'submit',
										'id' => 'submit',
										'style' => 'border:0px;background-color:rgba(255, 0, 0, 0);color:#fff;',
										'value' => 'true',
										'type' => 'submit',
										//'disabled' => 'disabled',
										'content' => 'ارسال'
									);
									echo form_button($data);
								?>
								</li>
							</ul>
						</div>
					<?php
						echo form_close();
					?>
				</div>
				<?php } ?>
				<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1') { ?>
					<?php if(in_array('MG',$this->sections)) { ?><div class="col-md-3 col-xs-12 cont">
					<?php } else { ?><div class="col-md-12 col-xs-12 cont"><?php } ?>
					<ul>
						<?php if($contact->ctaddress != '') { ?><li><i class="fa fa-home"></i><?php echo ' '.$contact->ctaddress; ?></li><?php } ?>
						<?php if($contact->ctphone != '') { ?><li><i class="fa fa-phone"></i><?php echo ' '.$contact->ctphone; ?></li><?php } ?>
						<?php if($contact->ctmobile != '') { ?><li><i class="fa fa-mobile"></i><?php echo ' '.$contact->ctmobile; ?></li><?php } ?>
						<?php if($contact->ctemail != '') { echo '<li><i class="fa fa-envelope"></i> '; $emails = explode(' - ',$contact->ctemail); foreach($emails as $email) { echo '<a href="mailto:'.$email.'">'.$email.'</a> '; } echo '</li>'; } ?>
					</ul>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php if(in_array('CT',$this->sections) && isset($contact) && !empty($contact) && $contact->ctactive == '1' && $contact->ctmap != '') { ?>
			<div class="line6">
				<?php echo htmlspecialchars_decode($contact->ctmap); ?>
			</div>
		<?php } ?>
		<!--<div class="container">
			<div class="row ftext">
				<div class="col-md-12">
				<a id="features"></a>
				<h3>We Care About Our Clients and Can Make Their Life Easier!</h3>
				<p>The main peculiarity of template is the striking presentation when visitors just need to use the scrolling option to find all necessary information about your web project. </p>
				</div>
				<div class="cBtn">
					<ul style="margin-top: 23px; margin-bottom: 0px; padding-left: 26px;">
						<li class="dowbload"><a href="#"><i class="fa fa-star"></i>View All Features</a></li>
						<li class="buy"><a href="#"><i class="fa fa-download"></i>Buy This Template</a></li>
					</ul>
			</div>
			</div>
		</div>-->
		<?php if(in_array('SM',$this->sections)) { ?>
		<div class="line7">
			<div class="container">
				<div class="row footer">
					<div class="col-md-12">
						<h3>التواصل عبر الشبكات الاجتماعية</h3>
						<p>بمتابعة حساباتنا على وسائل التواصل الاجتماعية التالية تمكننا من اعلامك بما هو جديد دائما</p>
						<!--<div class="fr">
						<div style="display: inline-block;">
							<input class="col-md-6 fEmail" name='Email' placeholder='Enter Your Email'/>
							<a href="#" class="subS">Subscribe!</a>
						</div>
						</div>-->
					</div>
					<div class="soc col-md-12">
						<ul>
							<?php if($contact->smlinkedin != '') { ?><li class="soc1"><a href="<?php echo $contact->smlinkedin; ?>" target="_blank"></a></li><?php } ?>
							<?php if($contact->smfacebook != '') { ?><li class="soc2"><a href="<?php echo $contact->smfacebook; ?>" target="_blank"></a></li><?php } ?>
							<?php if($contact->smtwitter != '') { ?><li class="soc3"><a href="<?php echo $contact->smtwitter; ?>" target="_blank"></a></li><?php } ?>
							<?php if($contact->sminstagram != '') { ?><li class="soc8"><a href="<?php echo $contact->sminstagram; ?>" target="_blank"></a></li><?php } ?>
							<?php if($contact->smyoutube != '') { ?><li class="soc6"><a href="<?php echo $contact->smyoutube; ?>" target="_blank"></a></li><?php } ?>
							<?php if($contact->smgoogleplus != '') { ?><li class="soc7"><a href="<?php echo $contact->smgoogleplus; ?>" target="_blank"></a></li><?php } ?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="lineBlack">
			<div class="container">
				<div class="row downLine">
					<!--<div class="col-md-12 text-right">
						<input  id="searchPattern" type="search" name="pattern" value="Search the Site" onblur="if(this.value=='') {this.value='Search the Site'; }" onfocus="if(this.value =='Search the Site' ) this.value='';this.style.fontStyle='normal';" style="font-style: normal;">
						<input  id="searchPattern" type="search" placeholder="Search the Site"/><i class="glyphicon glyphicon-search" style="font-size: 13px; color:#a5a5a5;" id="iS"></i>
					</div>-->
					<div class="col-md-6 text-left copy">
						<p>Copyright &copy; 2017 Sajdah. Crafted by <a href="http://digitalfalcon.net/" target="_blank">Digital Falcon</a>. </p>
					</div>
					<div class="col-md-6 text-right dm">
						<ul id="downMenu">
							<?php if(in_array('CT',$this->sections)) { ?><li class="last"><a href="#contact">التواصل</a></li><?php } ?>
							<?php if(in_array('PR',$this->sections)) { ?><li><a href="#project1">الأعمال</a></li><?php } ?>
							<?php if(in_array('AB',$this->sections)) { ?><li><a href="#about">عن الشركة</a></li><?php } ?>
							<li class="active"><a href="#home">الرئيسية</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>		
		
	<?php $this->load->view('messages'); ?>
	<script src="<?php echo base_url(); ?>timber/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>timber/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>timber/js/jquery.slicknav.js"></script>
	<script>
			$(document).ready(function(){
			$(".bhide").click(function(){
				$(".hideObj").slideDown();
				$(this).hide(); //.attr()
				return false;
			});
			$(".bhide2").click(function(){
				$(".container.hideObj2").slideDown();
				$(this).hide(); // .attr()
				return false;
			});
				
			$('.heart').mouseover(function(){
					$(this).find('i').removeClass('fa-heart-o').addClass('fa-heart');
				}).mouseout(function(){
					$(this).find('i').removeClass('fa-heart').addClass('fa-heart-o');
				});
				
				function sdf_FTS(_number,_decimal,_separator)
				{
				var decimal=(typeof(_decimal)!='undefined')?_decimal:2;
				var separator=(typeof(_separator)!='undefined')?_separator:'';
				var r=parseFloat(_number)
				var exp10=Math.pow(10,decimal);
				r=Math.round(r*exp10)/exp10;
				rr=Number(r).toFixed(decimal).toString().split('.');
				b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);
				r=(rr[1]?b+'.'+rr[1]:b);

				return r;
}
				
			setTimeout(function(){
					$('#counter').text('0');
					$('#counter1').text('0');
					$('#counter2').text('0');
					setInterval(function(){
						
						var curval=parseInt($('#counter').text());
						var curval1=parseInt($('#counter1').text().replace(' ',''));
						var curval2=parseInt($('#counter2').text());
						if(curval<=707){
							$('#counter').text(curval+1);
						}
						if(curval1<=12280){
							$('#counter1').text(sdf_FTS((curval1+20),0,' '));
						}
						if(curval2<=245){
							$('#counter2').text(curval2+1);
						}
					}, 2);
					
				}, 500);
			});
	</script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#menu').slicknav();
		
	});
	</script>
	
	<script type="text/javascript">
    $(document).ready(function(){
       
        var $menu = $("#menuF");
            
        $(window).scroll(function(){
            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
                $menu.fadeOut('fast',function(){
                    $(this).removeClass("default")
                           .addClass("fixed transbg")
                           .fadeIn('fast');
                });
            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed")) {
                $menu.fadeOut('fast',function(){
                    $(this).removeClass("fixed transbg")
                           .addClass("default")
                           .fadeIn('fast');
                });
            }
        });
	});
    //jQuery
	</script>
	<script>
		/*menu*/
		function calculateScroll() {
			var contentTop      =   [];
			var contentBottom   =   [];
			var winTop      =   $(window).scrollTop();
			var rangeTop    =   200;
			var rangeBottom =   500;
			$('.navmenu').find('a').each(function(){
				contentTop.push( $( $(this).attr('href') ).offset().top );
				contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
			})
			$.each( contentTop, function(i){
				if ( winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom ){
					$('.navmenu li')
					.removeClass('active')
					.eq(i).addClass('active');				
				}
			})
		};
		
		$(document).ready(function(){
			calculateScroll();
			$(window).scroll(function(event) {
				calculateScroll();
			});
			$('.navmenu ul li a').click(function() {  
				$('html, body').animate({scrollTop: $(this.hash).offset().top - 80}, 800);
				return false;
			});
		});		
	</script>	
	<script type="text/javascript" charset="utf-8">

		jQuery(document).ready(function(){
			jQuery(".pretty a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true, social_tools: ''});
			
		});
	</script>
	</body>
	
</html>