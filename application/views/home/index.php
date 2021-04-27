<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<?php if(isset($sliders) && sizeof($sliders)>0){ ?>
<div class="row my-4">
	<div class="col-sm-12">

        

		<div id="demo" class="carousel slide" data-ride="carousel">
		<ul class="carousel-indicators">
			<?php foreach($sliders as $key=> $row){ ?>
				<li data-target="#demo" data-slide-to="<?php echo $key;?>"></li>
			<?php }?>
		</ul>
		<div class="carousel-inner w-100 h-100">
			<?php foreach($sliders as $key=> $row){ ?>
				<?php
					$img_src = "";
					$default_path = "assets/src/img/no-image.png";
					if(isset($row['upload_file_name'])){					
						$banner_img = "assets/uploads/banner_img/".$row['upload_file_name'];					
						if (file_exists(FCPATH . $banner_img)) {
							$img_src = $banner_img;
						}else{
							$img_src = $default_path;
						}
					}else{
						$img_src = $default_path;
					}
				?>
				<div class="carousel-item <?php echo ($key==0)? 'active': '';?>">
					<img src="<?php echo base_url($img_src);?>">
					<div class="carousel-caption">
						<h3><?php echo isset($row['upload_text_1']) ? $row['upload_text_1'] : '';?></h3>
						<p><?php echo isset($row['upload_text_2']) ? $row['upload_text_2'] : '';?></p>
					</div>   
				</div><!--/.carousel-item-->
			<?php }?>
		</div><!--/.carousel-inner-->
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
		</div>
	</div><!--/.col-->
</div><!--/.row-->
<?php } ?>
<div class="row">
    <div class="col-md-8 mb-3">
        <div class="card news-card ">
            <div class="card-header"><?php echo $this->app_lib->get_icon('notice_board'); ?> Organization Announcements</div>
            <div class="card-body">
            
            <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
            <div class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <a href="<?php echo base_url('home/details/'.$row['id']);?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <div class="mb-1"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></div>
                        <small class="d-none d-md-block  text-muted"><?php echo $this->app_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        </div>
                        <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
                        <small class="d-xs-block d-md-none text-muted"><?php echo $this->app_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        <small class="text-muted">by <?php echo isset($row['user_firstname']) ? $row['user_firstname'].' '.$row['user_lastname'] : '';?></small>
                    </a>
                <?php }  ?>
            </div>
            <?php } ?>
            </div>
            <div class="card-footer text-center pt-0">
                <a class="btn btn-link action-link" href="<?php echo base_url('home/all_news');?>">View more <?php echo $this->app_lib->get_icon('right_fwd'); ?></a>
            </div>
        </div><!--/.card-->
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header"><?php echo $this->app_lib->get_icon('stat'); ?> Statistics</div>
            <div class="card-body">
                <div class="d-flex flex-column dashboard-stat">
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['user']['url'];?>">
                                <div class="media-body">
                                <i class="fa fa-fw dash-stat-icon fa-users align-middle" aria-hidden="true" style="color:#1a73e8;"></i> <span class="count"><?php echo $dashboard_stat['user']['count'];?></span> employees
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['project']['url'];?>">
                                <div class="media-body">
                                <i class="fa fa-fw dash-stat-icon fa-puzzle-piece" aria-hidden="true" style="color:#fd7e14;"></i> <span class="count"><?php echo $dashboard_stat['project']['count'];?></span> projects
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_user']['url'];?>">
                                <div class="media-body">
                                <i class="fa fa-fw dash-stat-icon fa-check-square-o" aria-hidden="true" style="color: #6f42c1;"></i> <span class="count"><?php echo $dashboard_stat['timesheet_user']['count'];?></span> employees logged task*
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['user_applied_leave']['url'];?>">
                                <div class="media-body">
                                <i class="fa fa-fw dash-stat-icon fa-plane" aria-hidden="true" style="color:#28a745;"></i> <span class="count"><?php echo $dashboard_stat['user_applied_leave']['count'];?></span> leaves approved
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['leave_to_approve']['url'];?>">
                            <div class="media-body">
                            <i class="fa fa-fw dash-stat-icon fa-plane" aria-hidden="true" style="color: #0062cc;"></i> <span class="count"><?php echo $dashboard_stat['leave_to_approve']['count'];?></span> leaves need your aproval
                            </div>
                        </a>
                    </div>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_days']['url'];?>">
                            <div class="media-body">
                            <i class="fa fa-fw dash-stat-icon fa-calendar" aria-hidden="true" style="color: #dfad17;"></i> <span class="count"><?php echo $dashboard_stat['timesheet_days']['count'];?></span> days tasks you've logged*
                            </div>
                        </a>
                    </div>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_hrs']['url'];?>">
                            <div class="media-body">
                            <i class="fa fa-fw dash-stat-icon fa-clock-o" aria-hidden="true" style="color: #6610f2;"></i> <span class="count"><?php echo $dashboard_stat['timesheet_hrs']['count'];?></span> hrs tasks you've logged*
                            </div>
                        </a>
                    </div>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_avg_hrs']['url'];?>">
                            <div class="media-body">
                            <i class="fa fa-fw dash-stat-icon fa-code" aria-hidden="true" style="color:#6c757d;"></i><span class="count"><?php echo $dashboard_stat['timesheet_avg_hrs']['count'];?></span> hrs avg./day you've logged*
                            </div>
                        </a>
                    </div>
                </div>
                <div class="my-2 small text-muted">* Statistics of current month.</div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        <div class="card ">
            <div class="card-header"><?php echo $this->app_lib->get_icon('calendar'); ?> Calendar</div>
            <div class="card-body">
                <div class="btn-group mb-4" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('home/log_timesheet'); ?>" class="btn  btn-outline-secondary"><?php echo $this->app_lib->get_icon('timesheet'); ?> Log Timesheet</a>
                    <a href="<?php echo base_url('home/apply_leave'); ?>" class="btn  btn-outline-secondary"><?php echo $this->app_lib->get_icon('leave'); ?> Apply Leave</a>
                </div>
                <div id="ci_full_calendar"></div>
            </div>
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn ci-btn-primary btn-primary" data-toggle="modal" data-target="#fcEventDetailsModal">
            Launch demo modal
            </button> -->

            <!-- Modal -->
            <div class="modal fade" id="fcEventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="fcEventDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fcEventDetailsModalLabel">Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="fcEventDetailsModalBody">Loading...</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn ci-btn-primary btn-primary">More Details</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>