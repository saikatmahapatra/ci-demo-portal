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

<div class="row dashboard-card-widgets">
<?php foreach($dashboard_stat as $key=>$data) { ?>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-3 text-center <?php echo $data['bg_css']; echo $data['text_css'];?> ">
            <div class="card-body">
                <div class="digit <?php echo $data['digit_css'];?>"><?php echo $data['count'];?></div>
                <div class="card-title"><?php echo $data['heading'];?></div>
                <div class="card-text"><?php echo $data['info_text'];?></div>
            </div>
        </div>
    </div>
<?php } ?>
</div>

<div class="row">
    <div class="col-lg-8 mb-3">
        <div class="card ci-card">
            <div class="card-body">
                <!-- <a href="#" class="btn btn-link btn-sm float-right"><i class="fa fa-fw fa-window-maximize" aria-hidden="true"></i> Full Screen</a> -->
                <h5 class="card-title">Event Calendar</h5>
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
                    <li class="list-group-item pl-0 pr-0">
                        <div class="subject-title"><a target="_blank" class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></a></div>
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