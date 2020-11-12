<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <?php echo isset($alert_message) ? $alert_message : ''; ?>
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('calendar'); ?> Calendar</div>
            <div class="card-body">

            <div class="btn-group mb-4" role="group" aria-label="Basic example">
                <a href="<?php echo base_url('event_calendar/log_timesheet'); ?>" class="btn btn-outline-secondary"><?php echo $this->common_lib->get_icon('timesheet'); ?> Log Timesheet</a>
                <a href="<?php echo base_url('event_calendar/apply_leave'); ?>" class="btn btn-outline-secondary"><?php echo $this->common_lib->get_icon('leave'); ?> Apply Leave</a>
            </div>

                <div id="ci_full_calendar"></div>
            </div>
        </div>
    </div>
    <!--/.col-->
</div>
<!--/.row-->

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