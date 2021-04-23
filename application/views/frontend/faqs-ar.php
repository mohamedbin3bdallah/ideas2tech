<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/faqs.css">

<h1 class="head"><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
  <div class="serv">
      <div class="container">
			
			<?php if(isset($faqs) && !empty($faqs)) { ?>
				<div class="panel-group col-md-8 col-md-offset-2 col-xs-12" id="accordion">
				<?php foreach($faqs as $faq) { ?>
					<div class="panel panel-default accordion-offer-default">
						<div class="panel-heading accordion-offer-header">
							<h4 class="panel-title">
								<a class="accordion-offer-title" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $faq->faid; ?>"><?php echo $faq->fatitle; ?></a>
							</h4>
						</div>
						<div id="collapse<?php echo $faq->faid; ?>" class="panel-collapse collapse <?php if($faq === reset($faqs)) echo 'in' ; ?>">
							<div class="panel-body">
								<div class="offer-img">
								</div>
								<div class="offer-desc">
									<?php echo $faq->fadesc; ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			<?php } ?>
              
            <!--<button class="center-block  read">Read More</button>-->
               
       </div>
   </div>