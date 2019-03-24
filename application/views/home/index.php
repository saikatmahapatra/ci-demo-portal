<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row heading-container mb-3">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->


<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
<div class="row text-center home-card">
    <div class="col-sm-6 col-md-3">
        <div class="card my-1 border border-success">
            <div class="card-header text-success">
                <i class="icon fa fa-lg fa-3x fa-users"></i>
            </div>
            <div class="card-body p-0 pt-2">
                <h6 class="card-title text-uppercase mb-0">Employees</h6>
                <p class="card-text"><?php echo $user_count['data_rows'][0]['total']; ?></p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card my-1 border border-info">
            <div class="card-header text-info">
                <i class="icon fa fa-lg fa-3x fa-cubes"></i>
            </div>
            <div class="card-body p-0 pt-2">
                <h6 class="card-title text-uppercase mb-0">Projects</h6>
                <p class="card-text"><?php echo $projects_count['data_rows'][0]['total']; ?></p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card my-1 border border-warning">
            <div class="card-header text-warning">
                <i class="icon fa fa-lg fa-3x fa-calendar"></i>
            </div>
            <div class="card-body p-0 pt-2">
                <h6 class="card-title text-uppercase mb-0">Task logged by</h6>
                <p class="card-text"><?php echo $timesheet_user['data_rows'][0]['total']; ?></p>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card my-1 border border-danger">
            <div class="card-header text-danger">
                <i class="icon fa fa-lg fa-3x fa-star"></i>
            </div>
            <div class="card-body p-0 pt-2">
                <h6 class="card-title text-uppercase mb-0">{{key}}</h6>
                <p class="card-text">{{value}}</p>
            </div>
        </div>
    </div>

</div>
<?php } ?>


<div class="col-12 p-3 bg-white rounded shadow-sm recent-updates">
   <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
   <?php $array_color = array('#007bff', '#AC193D', '#6f42c1','#DC572E'); ?>
   <?php foreach($data_rows as $key=>$row) { ?>
   <div class="media text-muted pt-3">
      <div class="mr-2 text-primary <?php //echo $content_type[$row['pagecontent_type']]['css']; ?>"><i class="fa fa-bell-o" aria-hidden="true"></i></div>
      <svg class="bd-placeholder-img mr-2 d-none rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
         <title>Placeholder</title>
         <rect fill="<?php echo $array_color[array_rand($array_color, 1)]; ?>" width="100%" height="100%"></rect>
         <text fill="<?php echo $array_color[array_rand($array_color, 1)]; ?>" dy=".3em" x="50%" y="50%"></text>
      </svg>
      <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
        <div class="d-block text-gray-dark h5"><a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a></div>
        <strong class="d-block text-gray-dark small">
            <?php echo $content_type[$row['pagecontent_type']]['text']; ?>
            <?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
            <?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
            <?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true,null,'d-M-Y h:i:sa'); ?>
        </strong>
        <?php echo isset($row['pagecontent_text']) ? word_limiter($this->common_lib->remove_empty_p($row['pagecontent_text']),30) : '';?>
      </div>
   </div>
   <?php } ?>
   <small class="d-block text-right mt-3">
    <?php echo $pagination_link;?>
   </small>
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