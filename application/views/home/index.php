<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<?php if(isset($profile_msg) && sizeof($profile_msg > 0)){ ?>
<div class="row <?php echo ($display_reminder_modal == 'false') ? 'd-none' : ''; ?>" id="userReminderModal" data-display="<?php echo $display_reminder_modal; ?>">
    <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        You can improve your profile details by adding <?php echo implode(', ', $profile_msg);?>
        <a href="<?php echo base_url('user/profile');?>" class="btn btn-sm btn-outline-secondary">Update Now</a>
        <button type="button" class="close btn_remind_later" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
</div>
<?php } ?>
<!-- 
<div class="row">
    <div class="col-12 mb-3">
        <div id="calendar"></div>
    </div>
</div> -->

<div class="row">
    <div class="col-lg-4 mb-3">
        <div class="card news-card">
            <div class="card-header h6">
            <i class="fa fa-fw fa-newspaper-o fa-lg" aria-hidden="true"></i> Notice Board
            </div>
            <div class="card-body">
                <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
                <ul class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <li class="list-group-item">
                        <div class="subject-title"><a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></a></div>
                        <div class="text-muted small">
                            <?php echo $content_type[$row['content_type']]['text']; ?>
                            <?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
                            <?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
                            <?php echo $this->common_lib->display_date($row['content_created_on'],true,null,'d-M-Y h:i:s a'); ?>
                        </div>
                        <div class="mb-0 lh-125" style="max-height: 120px; overflow: hidden;">
                            <?php echo isset($row['content_text']) ? ($this->common_lib->remove_empty_p($row['content_text'])) : '';?>
                        </div>
                    </li>
                <?php }  ?>
                </ul>
                <?php } ?>
            </div>
            <div class="card-footer text-center">
                <?php echo $pagination_link;?>
            </div>
        </div><!--/.card-->
    </div>

    <div class="col-lg-8 mb-3">
        <div id="calendar"></div>
    </div>
    
    <div class="col-lg-4 mb-3 d-none">
        <div class="card card-stat">
            <div class="card-header h6">
            <i class="fa fa-fw fa-line-chart fa-lg" aria-hidden="true"></i> At a Glance
            </div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                    
                        <div class="stat media">
                            <a title="View Details" class="d-flex" href="<?php echo base_url('user/manage'); ?>">
                                <i class="fa fa-fw fa-id-badge fa-2x align-middle mr-2" aria-hidden="true" style="color: #a9289a;"></i> 
                                
                                <div class="media-body">
                                    <span class="count"><?php echo isset($user_count) ? $user_count['data_rows'][0]['total'] : '0'; ?></span> employees
                                </div>
                            </a>
                        </div>

                        <div class="stat media">
                            <a title="View Details" class="d-flex" href="<?php echo base_url('project'); ?>">
                                <i class="fa fa-fw fa-puzzle-piece fa-2x align-middle mr-2" aria-hidden="true" style="color: #007bff;"></i> 

                                <div class="media-body">
                                    <span class="count"><?php echo isset($projects_count) ? $projects_count['data_rows'][0]['total'] : '0'; ?></span> projects
                                </div>
                            </a>
                        </div>

                        <div class="stat media">
                            <a title="View Details" class="d-flex" href="<?php echo base_url('timesheet/report?form_action=search&from_date='.date('d-m-Y').'&to_date='.date('d-m-Y').''); ?>">
                                <i class="fa fa-fw fa-clock-o fa-2x align-middle mr-2" aria-hidden="true" style="color: #495057;"></i> 

                                <div class="media-body">
                                    <span class="count"><?php echo isset($timesheet_user) ? $timesheet_user['data_rows'][0]['total'] : '0'; ?></span> employees logged task today
                                </div>
                            </a>
                        </div>

                        <div class="stat media">
                            <a title="View Details" class="d-flex" href="<?php echo base_url('leave/manage/all'); ?>">
                                <i class="fa fa-fw fa-send-o fa-2x align-middle mr-2" aria-hidden="true" style="color: #fd7e14;"></i> 
                                <div class="media-body">
                                    <span class="count"><?php echo isset($user_approved_leave) ? $user_approved_leave['data_rows'][0]['total'] : '0'; ?></span> of <span class="count"><?php echo isset($user_applied_leave) ? $user_applied_leave['data_rows'][0]['total'] : '0'; ?></span> leave requests for this month has been approved
                                </div>
                            </a>
                        </div>
                    <?php } else{ ?>
                        <!-- <p>
                            Oops! There are nothing to display here for you.
                        </p> -->
                    <?php } ?>

                    <div class="stat media">
                        <a title="View Details" class="d-flex" href="<?php echo base_url('timesheet/index'); ?>">
                            <i class="fa fa-fw fa-list fa-2x align-middle mr-2" aria-hidden="true" style="color: #AC193D;"></i> 
                            <div class="media-body">
                                <span class="count"><?php echo isset($user_timesheet_stat) ? $user_timesheet_stat['stat_data']['total_days'] : '0'; ?></span> days task logged by you in this month
                            </div>
                        </a>
                    </div>

                    <div class="stat media">
                        <a title="View Details" class="d-flex" href="<?php echo base_url('leave/manage/assigned_to_me'); ?>">
                            <i class="fa fa-fw fa-check-square-o fa-2x align-middle mr-2" aria-hidden="true" style="color: #6f42c1;"></i> 
                            <div class="media-body">
                                <span class="count"><?php echo isset($pending_leave_action) ? $pending_leave_action['data_rows'][0]['total'] : '0'; ?></span> leave req. waiting for your approval in this month
                            </div>
                        </a>
                    </div>
                </div><!--/.flex-column-->
            </div><!--/.card-body-->
            <div class="card-footer text-center text-muted small">
            <i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> Updated on <?php echo date('d-M-Y h:i:s a');?>
            </div>
        </div><!--/.card-->
    </div>
</div>