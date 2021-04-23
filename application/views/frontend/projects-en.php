<link rel="stylesheet" href="<?php echo base_url(); ?>idea2tech/css/projects.css">

<!--   === Our Projects ===-->
  <section class="proj">
      <div class="container">
          <h1 class="head"><?php echo $this->pages['title'.$front_lang][$pageid]; ?></h1>
          
          <p>We are proud of the work we have done for our clients. Here is a small selection of our recent work.</p>
          
		  <?php if(isset($categories,$projects) && !empty($categories) && !empty($projects)) { ?>

          <div class="choices col-xs-6 center-block">
            <ul class="list-inline list-unstyled">
                <li class="filter selected" data-filter="all">All Projects</li>
				<?php foreach($categories as $category) { ?>
					<li class="filter" data-filter=".<?php echo str_replace(' ','',$category->cgtitle); ?>"><?php echo $category->cgtitle; ?></li>
				<?php } ?>
            </ul>  
          </div>
      
     
     
      <div class="items">
		<?php foreach($projects as $project) { ?>
               <div class="col-md-3 col-sm-6 mix <?php echo str_replace(' ','',$project->cgtitle); ?>">
                <img src="<?php echo base_url().$products_thumb_folder.$project->primg; ?>" alt="<?php echo $project->prtitle; ?>">
                <div class="hover">
                   <div>
                        <button class="btn btn-default fa fa-search" data-toggle="modal" data-target="#project-<?php echo $project->prid; ?>"></button>
                    </div>
                    <h4><?php echo $project->prtitle; ?></h4>
                </div>
              </div>
		<?php } ?>
      </div>
	  

		<?php } ?>
      </div>
<!--
      <div class="load col-xs-12">
         <h3 class="text-center">LOAD MORE</h3>
      </div>
-->
</section>
<?php foreach($projects as $project) { ?>
	<div id="project-<?php echo $project->prid; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<?php echo $project->prtitle; ?>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<br>
				</div>
				<div class="modal-body">
					<center>
						<img src="<?php echo base_url().$products_folder.$project->primg; ?>" alt="<?php echo $project->prtitle; ?>">
						<br>
						<p style="text-align:justify"><?php echo $project->prdesc; ?></p>
					<center>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<script src="<?php echo base_url(); ?>idea2tech/js/mixitup.min.js"></script>
<script>var mixer = mixitup('.items');</script>