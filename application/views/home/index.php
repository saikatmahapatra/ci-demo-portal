<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->


<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
<div class="row text-center home-card">
    <div class="col-sm-6 col-md-3">
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

    <div class="col-sm-6 col-md-3">
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

    <div class="col-sm-6 col-md-3">
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

    <div class="col-sm-6 col-md-3">
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
<?php } ?>



<div class="card card-recent-updates mt-4">
  <div class="card-header h6">
  <i class="fa fa-newspaper-o text-primary" aria-hidden="true"></i> News & Updates
  </div>
  <div class="card-body">
    <?php foreach($data_rows as $key=>$row) { ?>
        <div class="my-2 py-2 border-bottom border-gray">
            <div class="mb-0 lh-125" style="max-height: 130px; overflow: hidden;">
                    <div class="subject-title text-gray-dark h5"><a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a></div>
                    <strong class="text-muted text-gray-dark small">
                        <?php echo $content_type[$row['pagecontent_type']]['text']; ?>
                        <?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
                        <?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
                        <?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true,null,'d-M-Y h:i:sa'); ?>
                    </strong>
                    <?php echo isset($row['pagecontent_text']) ? $this->common_lib->remove_empty_p($row['pagecontent_text']) : '';?>
            </div>
        </div>
    <?php } ?>
  </div>
  <div class="card-footer">
    <?php echo $pagination_link;?>
  </div>
</div>

<!-- Modal -->
<div data-display="<?php echo $display_reminder_modal; ?>" class="modal fade" id="userReminderModal" tabindex="-1" role="dialog" aria-labelledby="userReminderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userReminderModalLabel">Hi <?php echo $this->session->userdata['sess_user']['user_firstname'];?>,  <?php echo $this->common_lib->get_greetings(); ?> !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Here are few tips to make your profile better.
                <ul>
                    <?php 
                    if(isset($profile_completion_status)){
                        foreach($profile_completion_status as $key => $msg){
                            ?>
                            <li><?php echo $msg; ?></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn_remind_later">Remind Me Later</button>
                <a href="<?php echo base_url('user/my_profile');?>" class="btn btn-primary">Update Now</a>
            </div>
        </div>
    </div>
</div>