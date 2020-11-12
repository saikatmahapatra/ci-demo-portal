<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row mb-3">
    <div class="col-md-8">
        <div class="card news-card ">
            <div class="card-header">Organizational Announcements</div>
            <div class="card-body">
            
            <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
            <div class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
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
            <div class="card-footer text-center">
                <a class="btn btn-primary btn-sm" href="<?php echo base_url('home/all_news');?>">Show more</a>
            </div>
        </div><!--/.card-->
    </div>
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header">Statistics</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="list-group list-group-flush">
                            <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                            <a target="_blank" href="<?php echo $dashboard_stat['user']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Employees
                                <span class="badge badge-primary badge-pill"><?php echo $dashboard_stat['user']['count'];?></span>
                            </a>
                            <?php } ?>
                            <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                            <a target="_blank" href="<?php echo $dashboard_stat['timesheet_user']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Employees logged task *
                                <span class="badge badge-dark badge-pill"><?php echo $dashboard_stat['timesheet_user']['count'];?></span>
                            </a>
                            <?php } ?>
                            <a target="_blank" href="<?php echo $dashboard_stat['timesheet_days']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Days you logged task *
                                <span class="badge badge-info badge-pill"><?php echo $dashboard_stat['timesheet_days']['count'];?></span>
                            </a>
                            <a target="_blank" href="<?php echo $dashboard_stat['leave_to_approve']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Leave awaiting for your aproval
                                <span class="badge badge-danger badge-pill"><?php echo $dashboard_stat['leave_to_approve']['count'];?></span>
                            </a>
                        </div>
                        <div></div>
                    </div>

                    <div class="col-md-6">
                        <div class="list-group list-group-flush">
                            <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                            <a target="_blank" href="<?php echo $dashboard_stat['project']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Projects
                                <span class="badge badge-secondary badge-pill"><?php echo $dashboard_stat['project']['count'];?></span>
                            </a>
                            <?php } ?>
                            <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                            <a target="_blank" href="<?php echo $dashboard_stat['user_applied_leave']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Leave approved *
                                <span class="badge badge-info badge-pill"><?php echo $dashboard_stat['user_applied_leave']['count'];?></span>
                            </a>
                            <?php } ?>
                            <a target="_blank" href="<?php echo $dashboard_stat['timesheet_hrs']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Your logged hours *
                                <span class="badge badge-warning badge-pill"><?php echo $dashboard_stat['timesheet_hrs']['count'];?></span>
                            </a>
                            <a target="_blank" href="<?php echo $dashboard_stat['timesheet_avg_hrs']['url'];?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Your average logged hours *
                                <span class="badge badge-success badge-pill"><?php echo $dashboard_stat['timesheet_avg_hrs']['count'];?></span>
                            </a>
                        </div>
                        <div></div>
                    </div>
                    <div class="col-12 my-2 small text-sm-center text-lg-right text-muted">* Statistics of current month.</div>

                    <?php /* foreach($dashboard_stat as $key=>$data) { ?>
                        <?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="mb-3 text-center<?php echo $data['bg_css']; echo $data['text_css'];?> ">
                                <div class="">
                                    <div class="digit <?php echo $data['digit_css'];?>"><?php echo $data['count'];?></div>
                                    <div class=""><a href="<?php echo isset($data['url']) ? $data['url'] : '#';?>"><?php echo $data['heading'];?></a></div>
                                    <div class=""><?php echo $data['info_text'];?></div>
                                </div>
                            </div>
                        </div>
                        <?php } else {?>
                            <?php if($data['target_role'] !== '1'){
                                ?>
                                <div class="col-sm-6 col-md-3 col-lg-3">
                                    <div class="mb-3 text-center <?php echo $data['bg_css']; echo $data['text_css'];?> ">
                                        <div class="">
                                            <div class="digit <?php echo $data['digit_css'];?>"><?php echo $data['count'];?></div>
                                            <div class=""><a href="<?php echo isset($data['url']) ? $data['url'] : '#';?>"><?php echo $data['heading'];?></a></div>
                                            <div class=""><?php echo $data['info_text'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                            }?>
                        <?php } ?>
                    <?php } ?>

                    <?php if($data['target_role'] !== '1'){ ?>
                        <div class="col small text-sm-center text-lg-right text-muted">* Calculated based on your timesheet data of current month.</div>
                    <?php } */ ?>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <div class="card ">
            <div class="card-header">Calendar</div>
            <div class="card-body">
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