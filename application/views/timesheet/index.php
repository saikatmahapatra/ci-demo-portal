<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<p><i class="fa fa-fw fa-question-circle-o" aria-hidden="true"></i> Looking for help or information? Click <a class=""
        href="#" data-toggle="modal" data-target="#timesheetCalModal">here to read.</a></p>

<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-header h6">Log Tasks</div>
            <!--/.card-header-->
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <nav>
                    <div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-add-tab" data-toggle="tab" href="#nav-add"
                            role="tab" aria-controls="nav-add" aria-selected="true">Log Tasks</a>
                        <a class="nav-item nav-link" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab"
                            aria-controls="nav-list" aria-selected="false">View Logged Tasks</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="mt-3 tab-pane fade show active" id="nav-add" role="tabpanel"
                        aria-labelledby="nav-add-tab">
                        <?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form form-timesheet','name' => '','id' => 'ci-form-timesheet',)); ?>
                        <?php echo form_hidden('form_action', 'add'); ?>
                        <?php echo form_hidden('today_date', date('d')); ?>
                        <?php echo form_hidden('current_month', date('m')); ?>
                        <?php echo form_hidden('month_url', $this->uri->segment(4) ? $this->uri->segment(4) : date('m')); ?>
                        <?php echo form_hidden('selected_date',set_value('selected_date')); ?>
                        <div class="form-row">
                            <div class="col-sm-3">
                                <label class="required">Select Date(s)</label>
                                <?php echo $cal; ?>
                                <div class="small">
                                    <div class="d-inline-block"><span
                                            class="i-today pr-2 pl-2 m-1 text-white"></span>Today
                                    </div>
                                    <div class="d-inline-block"><span class="i-selected pr-2 pl-2 m-1"></span>Selected
                                    </div>
                                    <div class="d-inline-block"><span class="i-has-data pr-2 pl-2 m-1"></span>Task
                                        Logged</div>
                                    <div class="d-inline-block"><span class="i-leave pr-2 pl-2 m-1"></span>Leave</div>
                                    <div class="d-inline-block"><span class="i-holiday pr-2 pl-2 m-1"></span>Holiday
                                    </div>
                                </div>
                                <?php echo form_error('selected_date'); ?>
                                <div class="mt-2"><a id="clear_selected_days" class="btn btn-outline-secondary btn-sm"
                                        href="#">Clear selection</a></div>
                            </div>
                            <!--/.col-lg-3-->

<<<<<<< HEAD
                            <div class="col-md-6">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="required">Select Date(s)</label>
                                        <div id="dp_timesheet"></div>
                                        <?php echo form_error('selected_date'); ?>
                                    </div>
                                </div>
=======
                            <div class="col-lg-4 offset-md-1">
>>>>>>> parent of ef1dbf6... bs dp added

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="project_id" class="required">Project</label>
                                        <?php echo form_dropdown('project_id', $project_arr, set_value('project_id'), array('class' => 'form-control',)); ?>
                                        <?php echo form_error('project_id'); ?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="activity_id" class="required">Activity</label>
                                        <?php echo form_dropdown('activity_id', $task_task_activity_type_array, set_value('activity_id'), array('class' => 'form-control',));?>
                                        <?php echo form_error('activity_id'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="timesheet_hours" class="required">Hours</label>
                                        <?php echo form_input(array('name' => 'timesheet_hours', 'value' => set_value('timesheet_hours'),'id' => 'timesheet_hours', 'class' => 'form-control w-25','maxlength' => '5','placeholder' => '0',)); ?>
                                        <?php echo form_error('timesheet_hours'); ?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="timesheet_description" class="required">Task Description</label>
                                        <?php echo form_textarea(array('name' => 'timesheet_description','value' => set_value('timesheet_description'),'id' => 'timesheet_description','class' => 'form-control','rows' => '2','cols' => '4','maxlength' => '200','placeholder' => 'Briefly describe in 200 characters.')); ?>
                                        <?php echo form_error('timesheet_description'); ?>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!--/.col-lg-9-->
                        </div>

                        <div class="mt-3 d-none">
                            <h6>Monthly Timesheet Statistics: </h6>
                            <div class="">You have logged tasks for : <span id="total_days">0.0</span> days</div>
                            <div class="">Monthly working efforts : <span id="total_hrs">0.0</span> hrs</div>
                            <div class="">Average working efforts : <span class="" id="average_worked_hrs">0.0</span>
                                hrs/day
                            </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                    <!--/#nav-add-->

                    <div class="mt-3 tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">

                        <div class="table-responsive">
                            <table id="timesheet-datatable" class="table ci-table table-striped w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Hours</th>
                                        <th scope="col">Description</th>
                                        <!-- <th scope="col"></th> -->
                                    </tr>
                                    <!-- <tr>
								<th scope="col">Date & Tasks</th>
							</tr> -->
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                    <!--/#nav-list-->

                </div>
                <!--/.tab-content #nav-tabContent-->
            </div>
            <!--/.card-body-->
            <div class="card-footer d-none">
            </div>
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->

<!-- Modal -->
<div class="modal fade" id="timesheetCalModal" tabindex="-1" role="dialog" aria-labelledby="timesheetCalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timesheetCalModalLabel">Timesheet - Help & Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>All employees need to log timesheet for current month on daily basis with proper working efforts
                        and information.</li>
                    <li>Employees will not be able to log time sheet for previous or next months.</li>
                    <li>To select/unselect multimple dates click on the the calendar days.</li>
                    <li>Employees can add multiple tasks for a particular day, if you are working on multiple projects.
                    </li>
                    <li>If you did't find a relevant project, activity please contact to your HR/Admin.</li>
                    <li>Employees's tasks activities are reviewed by senior management regularly or periodically.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>