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





<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
<div class="card ci-card ci-card-widget">
    <div class="no-gutters row">
        <div class="col-md-12 col-lg-4">
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('user/manage'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Employees</div>
                                    <div class="widget-subheading">Registered active user</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success"><?php echo isset($user_count) ? $user_count['data_rows'][0]['total'] : '0'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('project'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Projects</div>
                                    <div class="widget-subheading">Added for timesheet</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-primary">
                                    <?php echo isset($projects_count) ? $projects_count['data_rows'][0]['total'] : '0'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-12 col-lg-4">
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('timesheet/report?form_action=search&from_date='.date('d-m-Y').'&to_date='.date('d-m-Y').''); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Timesheet Users</div>
                                    <div class="widget-subheading">People logged task today</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger"><?php echo isset($timesheet_user) ? $timesheet_user['data_rows'][0]['total'] : '0'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('leave/manage/all'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Leave Requests</div>
                                    <div class="widget-subheading">Total monthly leave</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning">
                                        <?php echo isset($user_approved_leave) ? $user_approved_leave['data_rows'][0]['total'] : '0'; ?>
                                        /
                                        <?php echo isset($user_applied_leave) ? $user_applied_leave['data_rows'][0]['total'] : '0'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-12 col-lg-4">
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('timesheet/index'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">My Timesheet</div>
                                    <div class="widget-subheading">Number of days worked</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success">
                                    <?php echo isset($user_timesheet_stat) ? $user_timesheet_stat['stat_data']['total_days'] : '0'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('leave/manage/assigned_to_me'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Leave Action</div>
                                    <div class="widget-subheading">Leave waiting for your action</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-primary">
                                    <?php echo isset($pending_leave_action) ? $pending_leave_action['data_rows'][0]['total'] : '0'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div> <!--/.row-->
</div> <!--/.card-->
<?php } else { ?>
    <div class="card ci-card">
    <div class="no-gutters row">
        <div class="col-md-12 col-lg-4">
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('user/people'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Coworkers</div>
                                    <div class="widget-subheading">Find your colleagues</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success"><?php echo isset($user_count) ? $user_count['data_rows'][0]['total'] : '0'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-12 col-lg-4">
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('leave/manage/assigned_to_me'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Leave Action</div>
                                    <div class="widget-subheading">Leave waiting for your action</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-danger"><?php echo isset($pending_leave_action) ? $pending_leave_action['data_rows'][0]['total'] : '0'; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-12 col-lg-4">
            <ul class="list-group list-group-flush">
                <li class="bg-transparent list-group-item">
                    <div class="ci-dashboard-widget widget-content p-0">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper" data-url="<?php echo base_url('timesheet/index'); ?>">
                                <div class="widget-content-left">
                                    <div class="widget-heading">My Timesheet</div>
                                    <div class="widget-subheading">Number of days worked</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-success">
                                    <?php echo isset($user_timesheet_stat) ? $user_timesheet_stat['stat_data']['total_days'] : '0'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div> <!--/.row-->
</div> <!--/.card-->
<?php } ?>
<div class="row">
    <div class="col-lg-8 mb-3">
        <div class="card ci-card">
            <div class="card-body">
                <h5 class="card-title">Calendar - Beta</h5>
                <div class="alert alert-warning small">
                    This widget is a beta release on top of current application version. This is still under development & testing phase. In case if you find any dummy or irrelevant contents, you can ignore for the time being
                </div>
                <!-- <a href="<?php echo base_url('calendar/index'); ?>" class="btn btn-link btn-sm float-right"><i class="fa fa-fw fa-window-maximize" aria-hidden="true"></i> Full Screen</a> -->
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
    <div class="col-lg-4 mb-3">
        <div class="card news-card ci-card">
            <div class="card-body">
                <h5 class="card-title">Notice Board</h5>
                <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
                <ul class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <li class="list-group-item">
                        <div class="subject-title"><a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></a></div>
                        <div class="text-muted small">
                            <?php //echo $content_type[$row['content_type']]['text']; ?>
                            <?php echo isset($row['user_firstname']) ? 'By <a href="'.base_url('user/profile/'.$row['content_created_by']).'" target="_blank">'.$row['user_firstname'] : '';?>
                            <?php echo isset($row['user_lastname']) ? $row['user_lastname']."</a> on " : '';?>
                            <?php echo $this->common_lib->display_date($row['content_created_on'],true,null,'d-M-Y h:i:s a'); ?>
                        </div>
                        <div class="mb-0 lh-125" style="max-height: 120px; overflow: hidden;">
                            <?php echo isset($row['content_text']) ? ($this->common_lib->remove_empty_p($row['content_text'])) : '';?>
                        </div>
                    </li>
                <?php }  ?>
                </ul>
                <?php } ?>
                <div class="text-center mt-3">
                <?php echo $pagination_link;?>
                </div>
            </div>
        </div><!--/.card-->
    </div>
</div>