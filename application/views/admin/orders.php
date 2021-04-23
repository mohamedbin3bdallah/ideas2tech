        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('orders'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 col-md-offset-9 col-sm-offset-9 col-xs-offset-7 form-group top_search">
                  <div class="input-group">
					<!--<?php //if(strpos($this->loginuser->privileges, ',pladd,') !== false) { ?><button type="button" class="btn btn-primary" onclick="location.href = 'plans/add'"><?php //echo lang('add_plan'); ?></button><?php //} ?>-->
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row" dir="<?php if($system->langs == 'ar') echo 'rtl'; ?>">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Button Example <small>Users</small></h2>-->
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
                    <!--<p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>-->
                    <?php if(!empty($orders)) { $status = array('cancel_pay'=>'danger','waiting_pay'=>'warning','success_pay'=>'success'); ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><?php echo lang('order'); ?></th>
						  <th><?php echo lang('user'); ?></th>						  						  <th><?php echo lang('plans'); ?></th>						  						  <th><?php echo lang('price'); ?></th>
						  <th><?php echo lang('status'); ?></th>
						  <th><?php echo lang('editemployee'); ?></th>
						  <th><?php echo lang('edittime'); ?></th>
						  <?php if(strpos($this->loginuser->privileges, ',odedit,') !== false) { ?><th><?php echo lang('edit'); ?></th><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',oddelete,') !== false) { ?><th><?php echo lang('delete'); ?></th><?php } ?>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($orders as $order) { $order->plans = implode(' , ',array_intersect_key($plans, array_flip(explode(',',$order->odplid)))); ?>
                        <tr>
                          <td><?php echo $order->odnumber; ?></td>						  						  <td><?php if(isset($employees[$order->odeid])) echo $employees[$order->odeid]; ?></td>						  						  <td><?php echo $order->plans; ?></td>
						  <td><?php echo $order->odprice.' '.$system->currency; ?></td>
						  <td>								<div class="alert-<?php echo $status[$order->odtype]; ?> fade in" role="alert" style="text-align:center;padding:7px;border-top-left-radius:15px;border-bottom-right-radius:15px;color:#fff;">									<strong><?php echo lang($order->odtype); ?></strong>								</div>						  </td>						  
						  <td><?php if(isset($employees[$order->oduid])) echo $employees[$order->oduid]; ?></td>
						  <td><?php if($order->odtime != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $order->odtime).' , '.date('h:i:s', $order->odtime); if(date('H', $order->odtime) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <?php if(strpos($this->loginuser->privileges, ',odedit,') !== false) { ?><td><a href="<?php echo base_url(); ?>orders/edit/<?php echo $order->odid; ?>" style="color: green;"><i style="color:green;" class="glyphicon glyphicon-edit"></i></a></td><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',oddelete,') !== false) { ?><td>
							<i id="<?php echo $order->odid; ?>" style="color:red;" class="del glyphicon glyphicon-remove-circle"></i>
							<div id="del-<?php echo $order->odid; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<?php echo lang('deletemodal'); ?>
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<button class="btn btn-danger" id="action_buttom" onclick="location.href = 'orders/del/<?php echo $order->odid; ?>'" data-dismiss="modal"><?php echo lang('yes'); ?></button>
											<button class="btn btn-success" data-dismiss="modal" aria-hidden="true"><?php echo lang('no'); ?></button>
										</center>
										</div>
									</div>
								</div>
							</div>
						</td><?php } ?>
                        </tr>
					  <?php } ?>
                      </tbody>
                    </table>
					<?php } else echo lang('no_data');?>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->