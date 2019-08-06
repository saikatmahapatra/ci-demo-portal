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
    <div class="col-md-8">
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
    
    <div class="col-md-4">
        <div class="card card-recent-updates">
            <div class="card-header h6">
            <i class="fa fa-line-chart fa-lg" aria-hidden="true"></i> At a Glance
            </div>
            <div class="card-body">
                <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                    <div class="text-center home-card">
                        <div class="col-sm-12">
                            <div class="card my-1 border border-danger">
                                <div class="card-header text-danger">
                                    <i class="icon fa fa-lg fa-3x fa-calendar-check-o"></i>
                                </div>
                                <div class="card-body p-0 pt-2">
                                    <h6 class="card-title mb-0">Today</h6>
                                    <p class="card-text"><?php echo date('d-M'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card my-1 border border-info">
                                <div class="card-header text-info">
                                    <i class="icon fa fa-lg fa-3x fa-user-o"></i>
                                </div>
                                <div class="card-body p-0 pt-2">
                                    <h6 class="card-title mb-0">Employee Strength</h6>
                                    <p class="card-text"><?php echo $user_count['data_rows'][0]['total']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card my-1 border border-warning">
                                <div class="card-header text-warning">
                                    <i class="icon fa fa-lg fa-3x fa-cubes"></i>
                                </div>
                                <div class="card-body p-0 pt-2">
                                    <h6 class="card-title mb-0">Projects</h6>
                                    <p class="card-text"><?php echo $projects_count['data_rows'][0]['total']; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card my-1 border border-success">
                                <div class="card-header text-success">
                                    <i class="icon fa fa-lg fa-3x fa-clock-o"></i>
                                </div>
                                <div class="card-body p-0 pt-2">
                                    <h6 class="card-title mb-0">Timesheet Logged By</h6>
                                    <p class="card-text"><?php echo $timesheet_user['data_rows'][0]['total']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <p>Oops! There are nothing to display here.</p>
                <?php } ?>
            </div><!--/.card-body-->
            <!-- <div class="card-footer">
                As on today
            </div> -->
        </div><!--/.card-->
    </div>
</div>