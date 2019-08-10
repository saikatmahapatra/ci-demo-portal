<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->


<?php if(isset($profile_msg) && sizeof($profile_msg > 0)){ ?>
<div class="row <?php echo ($display_reminder_modal == 'false') ? 'd-none' : ''; ?>" id="userReminderModal" data-display="<?php echo $display_reminder_modal; ?>">
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?php echo $this->common_lib->get_greetings(); ?>!</strong> You should add these details to your pofile - <?php echo implode(', ', $profile_msg);?>        
        <a href="<?php echo base_url('user/my_profile');?>" class="btn btn-sm btn-outline-secondary">Update Now</a>
        <button type="button" class="close btn_remind_later" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
</div>
<?php } ?>


<div class="row">
    <div class="col-md-8 mb-3">
        <div class="card news-card">
            <div class="card-header h6">
            <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i> Notice Board
            </div>
            <div class="card-body">
                <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
                <ul class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <li class="list-group-item">
                        <div class="subject-title"><a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a></div>
                        <div class="text-muted small">
                            <?php echo $content_type[$row['pagecontent_type']]['text']; ?>
                            <?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
                            <?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
                            <?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true,null,'d-M-Y h:i:s a'); ?>
                        </div>
                        <div class="mb-0 lh-125" style="max-height: 120px; overflow: hidden;">
                            <?php echo isset($row['pagecontent_text']) ? ($this->common_lib->remove_empty_p($row['pagecontent_text'])) : '';?>
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
    
    <div class="col-md-4 mb-3">
        <div class="card card-stat">
            <div class="card-header h6">
            <i class="fa fa-line-chart fa-lg" aria-hidden="true"></i> At a Glance
            </div>
            <div class="card-body">
                <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                    <div class="d-flex flex-column">
                        <div class="py-3 border-bottom">
                            <a title="View Details" href="<?php echo base_url('user/manage'); ?>">
                            <i class="fa fa-fw fa-id-badge fa-2x align-middle" aria-hidden="true" style="color: #a9289a;"></i> <span class="font-weight-bold"><?php echo isset($user_count) ? $user_count['data_rows'][0]['total'] : '0'; ?></span> employees
                            </a>
                        </div>
                        <div class="py-3 border-bottom">
                            <a title="View Details" href="<?php echo base_url('project'); ?>">
                                <i class="fa fa-fw fa-puzzle-piece fa-2x align-middle" aria-hidden="true" style="color: #007bff;"></i> <span class="font-weight-bold"><?php echo isset($projects_count) ? $projects_count['data_rows'][0]['total'] : '0'; ?></span> projects
                            </a>
                        </div>
                        <div class="py-3 border-bottom">
                            <a title="View Details" href="<?php echo base_url('timesheet/report'); ?>">
                                <i class="fa fa-fw fa-clock-o fa-2x align-middle" aria-hidden="true" style="color: #495057;"></i> <span class="font-weight-bold"><?php echo isset($timesheet_user) ? $timesheet_user['data_rows'][0]['total'] : '0'; ?></span> users logged task today
                            </a>
                        </div>
                        <div class="py-3">
                            <a title="View Details" href="<?php echo base_url('leave/manage/all'); ?>">
                                <i class="fa fa-fw fa-send-o fa-2x align-middle" aria-hidden="true" style="color: #fd7e14;"></i> <span class="font-weight-bold"><?php echo isset($user_approved_leave) ? $user_approved_leave['data_rows'][0]['total'] : '0'; ?></span> of <span class="font-weight-bold"><?php echo isset($user_applied_leave) ? $user_applied_leave['data_rows'][0]['total'] : '0'; ?></span> leave req. approved for <?php echo date('M');?>
                            </a>
                        </div>
                    </div><!--/.flex-column-->
                <?php } else { ?>
                    <div class="d-flex flex-column">
                        <p>Oops! There are nothing to display here for you.</p>
                    </div><!--/.flex-column-->
                <?php } ?>
            </div><!--/.card-body-->
            <div class="card-footer text-center text-muted small">
            <i class="fa fa-clock-o" aria-hidden="true"></i> Updated on <?php echo date('d-M-Y h:i:s a');?>
            </div>
        </div><!--/.card-->
    </div>
</div>