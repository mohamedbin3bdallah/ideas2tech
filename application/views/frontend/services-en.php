<!--====================================-->
<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/services.css">

<div class="first ">
    <div class="container">
        <h1 class="head "><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
        <div class="design "></div>
		<?php
			$service_title_lang = 'cgtitle'.$front_lang;
			$service_desc_lang = 'cgdesc'.$front_lang;
		?>
        <div class="text col-md-6 fadeInLeft wow" data-wow-duration='1.8s' data-wow-offset="300">
                <h1 class="title2"><?php	echo $services[0]->$service_title_lang;	?> <img src="<?php echo base_url().$categories_folder.$services[0]->cgimg; ?>" width="60px" alt=""></h1>
                <?php	echo $services[0]->$service_desc_lang;	?>
                <a href=""><button class="btn button">Order Now</button></a>
        </div>
        <div class="pic col-md-6 ">
                <img src="<?php echo base_url(); ?>idea2tech/images/Levels21.jpg" class="fadeInRight wow" height="650px" alt="" data-wow-offset="200" data-wow-duration='1.8s'>
                <a href=""><button class="btn button">Order Now</button></a>
        </div>
    </div>
</div>

<!--=== App Design ===-->
<!--=== App Design ===-->
<div class="app">
    <div class="container fadeInUp wow " data-wow-duration='1.8s' data-wow-offset="200">
        <div class="pic col-md-6 text-center">
            <img src="<?php echo base_url(); ?>idea2tech/images/mobile.png" height="500px" alt="">
            
        </div>
        <div class="text col-md-6">
            <h1 class="title2"><img src="<?php echo base_url().$categories_folder.$services[1]->cgimg; ?>" width="50px" alt=""> <?php	echo $services[1]->$service_title_lang;	?></h1>
            <?php	echo $services[1]->$service_desc_lang;	?>
            <a href=""><button class="btn button">Order Now</button></a>
        </div>
        
    </div>
</div>

<!--=== Markting ===-->
<!--=== Markting ===-->
<div class="mark">
    <div class="container wow fadeInLeft" data-wow-duration='1.8s' data-wow-offset="200">
        <h1 class="title2"><?php	echo $services[2]->$service_title_lang;	?> <img src="<?php echo base_url().$categories_folder.$services[2]->cgimg; ?>" alt=""></h1>
        <?php	echo $services[2]->$service_desc_lang;	?>
        <a href=""><button class="btn button">Order Now</button></a>
    </div>
</div>


<!--=== Design ===-->
<!--=== Design ===-->
<div class="desi">
    <div class="container wow " data-wow-duration='1.8s'>
        <h1 class="title2"><?php	echo $services[3]->$service_title_lang;	?> <img src="<?php echo base_url().$categories_folder.$services[3]->cgimg; ?>" alt=""></h1>
        <?php	echo $services[3]->$service_desc_lang;	?>
        <a href=""><button class="btn button">Order Now</button></a>
    </div>
</div>

<!--=== Media ===-->
<!--=== Media ===-->
<div class="media">
    <div class="container">
       <h1 class="title2"><?php	echo $services[4]->$service_title_lang;	?> <img src="<?php echo base_url().$categories_folder.$services[4]->cgimg; ?>" alt=""></h1>
        <?php	echo $services[4]->$service_desc_lang;	?>
        <div class="part col-md-6 wow fadeInRight" data-wow-duration='1.8s' data-wow-offset="200">
            <img src="<?php echo base_url(); ?>idea2tech/images/media2.jpg" alt="">
            <a href=""><button class="btn button">Order Now</button></a>
        </div>
    </div>
</div>

<!--===Fixed Menu===-->
<!--===Fixed Menu===-->
<div class="fxdmenu">
    <div class="head">
        <?php echo $this->pages['title'.$front_lang][$pageid]; ?>
    </div>
    <div class="tail">
        <ul>
            <li id="web">Web Design</li>
            <li id="app">App Design</li>
            <li id="mark">Digital Marketing</li>
            <li id="iden">Identity Design</li>
            <li id="media">Media Managment</li>
        </ul>
    </div>
</div>
<!--============================================-->
