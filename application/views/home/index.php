<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row">
    <div class="col-md-8 mb-3">
        <div class="card news-card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('notice_board'); ?> Organizational Announcements</div>
            <div class="card-body">
            
            <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
            <div class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <a href="<?php echo base_url('home/details/'.$row['id']);?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <div class="mb-1"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></div>
                        <small class="d-none d-md-block  text-muted"><?php echo $this->common_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        </div>
                        <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
                        <small class="d-xs-block d-md-none text-muted"><?php echo $this->common_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        <small class="text-muted">by <?php echo isset($row['user_firstname']) ? $row['user_firstname'].' '.$row['user_lastname'] : '';?></small>
                    </a>
                <?php }  ?>
            </div>
            <?php } ?>
            </div>
            <div class="card-footer text-center pt-0">
                <a class="btn btn-primary btn-sm" href="<?php echo base_url('home/all_news');?>">Show more</a>
            </div>
        </div><!--/.card-->
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('stat'); ?> Statistics</div>
            <div class="card-body">
                <div class="d-flex flex-column dashboard-stat">
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['user']['url'];?>">
                                <i class="fa fa-fw fa-user fa-2x align-middle" aria-hidden="true" style="color: #0062cc;"></i>
                                <div class="media-body">
                                    <span class="count"><?php echo $dashboard_stat['user']['count'];?></span> employees
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['project']['url'];?>">
                                <i class="fa fa-fw fa-puzzle-piece fa-2x align-middle" aria-hidden="true" style="color: #fd7e14;"></i>
                                <div class="media-body">
                                    <span class="count"><?php echo $dashboard_stat['project']['count'];?></span> projects
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_user']['url'];?>">
                                <i class="fa fa-fw fa-check-square-o fa-2x align-middle" aria-hidden="true" style="color: #6f42c1;"></i>
                                <div class="media-body">
                                    <span class="count"><?php echo $dashboard_stat['timesheet_user']['count'];?></span> employees logged task*
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="media">
                            <a class="d-flex" href="<?php echo $dashboard_stat['user_applied_leave']['url'];?>">
                                <i class="fa fa-fw fa-plane fa-2x align-middle" aria-hidden="true" style="color: #28a745;"></i>
                                <div class="media-body">
                                    <span class="count"><?php echo $dashboard_stat['user_applied_leave']['count'];?></span> leaves approved
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['leave_to_approve']['url'];?>">
                            <i class="fa fa-fw fa-plane fa-2x align-middle" aria-hidden="true" style="color: #0062cc;"></i>
                            <div class="media-body">
                                <span class="count"><?php echo $dashboard_stat['leave_to_approve']['count'];?></span> leaves need your aproval
                            </div>
                        </a>
                    </div>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_days']['url'];?>">
                            <i class="fa fa-fw fa-calendar fa-2x align-middle" aria-hidden="true" style="color: #dfad17;"></i>
                            <div class="media-body">
                                <span class="count"><?php echo $dashboard_stat['timesheet_days']['count'];?></span> days tasks you've logged*
                            </div>
                        </a>
                    </div>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_hrs']['url'];?>">
                            <i class="fa fa-fw fa-clock-o fa-2x align-middle" aria-hidden="true" style="color: #6610f2;"></i>
                            <div class="media-body">
                                <span class="count"><?php echo $dashboard_stat['timesheet_hrs']['count'];?></span> hrs tasks you've logged
                            </div>
                        </a>
                    </div>
                    <div class="media">
                        <a class="d-flex" href="<?php echo $dashboard_stat['timesheet_avg_hrs']['url'];?>">
                            <i class="fa fa-fw fa-code fa-2x align-middle" aria-hidden="true" style="color: #343a40;"></i>
                            <div class="media-body">
                                <span class="count"><?php echo $dashboard_stat['timesheet_avg_hrs']['count'];?></span> hrs avg. you've logged
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
            <div class="card-header"><?php echo $this->common_lib->get_icon('calendar'); ?> Calendar</div>
            <div class="card-body">
                <div class="btn-group mb-4" role="group" aria-label="Basic example">
                    <a href="<?php echo base_url('event_calendar/log_timesheet'); ?>" class="btn btn-sm btn-secondary"><?php echo $this->common_lib->get_icon('timesheet'); ?> Log Timesheet</a>
                    <a href="<?php echo base_url('event_calendar/apply_leave'); ?>" class="btn btn-sm btn-secondary"><?php echo $this->common_lib->get_icon('leave'); ?> Apply Leave</a>
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