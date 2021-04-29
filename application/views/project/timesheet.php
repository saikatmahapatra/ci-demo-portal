<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<p class="small"><?php echo $this->common_lib->get_icon('question'); ?> Looking for help or information? Click <a class=""
        href="#" data-toggle="modal" data-target="#timesheetCalModal">here to read.</a></p>

<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <nav>
                    <div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-add-tab" data-toggle="tab" href="#nav-add"
                            role="tab" aria-controls="nav-add" aria-selected="true">Log Tasks</a>
                        <a class="nav-item nav-link" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab"
                            aria-controls="nav-list" aria-selected="false">Logged Tasks</a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="mt-3 tab-pane fade show active" id="nav-add" role="tabpanel"
                        aria-labelledby="nav-add-tab">
                        <?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form form-timesheet','name' => '','id' => 'ci-form-timesheet',)); ?>
                        <?php echo form_hidden('form_action', 'add'); ?>
                        <?php echo form_hidden('selected_date',set_value('selected_date')); ?>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <label class="required">Select Dates</label>
                                <div class="mb-2"><?php echo form_error('selected_date'); ?></div>
                                <?php echo $cal; ?>
                                <div class="small my-2">
                                    <div class="d-inline-block"><span
                                            class="i-today pr-2 pl-2 m-1 text-white"></span>Today
                                    </div>
                                    <div class="d-inline-block"><span class="i-selected pr-2 pl-2 m-1"></span>Selected
                                    </div>
                                    <div class="d-inline-block"><span class="i-has-data pr-2 pl-2 m-1"></span>Logged</div>
                                    <!-- <div class="d-inline-block"><span class="i-leave pr-2 pl-2 m-1"></span>Leave</div>
                                    <div class="d-inline-block"><span class="i-holiday pr-2 pl-2 m-1"></span>Holiday
                                    </div> -->
                                    <div class="d-inline-block"><span class="i-disabled-date pr-2 pl-2 m-1"></span>Disabled
                                    </div>
                                </div>
                                <div class="mb-2"><a id="clear_selected_days" class="btn btn-outline-secondary"
                                        href="#">Clear selected dates</a></div>
                                
                            </div>
                            <!--/.col-lg-3-->

                            <div class="col-lg-6 offset-lg-1">

                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="project_id" class="required">Project</label>
                                        <?php echo form_dropdown('project_id', $project_arr, set_value('project_id'), array('class' => 'form-control', 'id' => 'dd_projects')); ?>
                                        <?php echo form_error('project_id'); ?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="task_id_1" class="required">Task</label>
                                        <?php echo form_dropdown('task_id_1', $arr_task_id_1, set_value('task_id_1'), array('class' => 'form-control', 'id' => 'dd_tasks', 'data-render-target'=>'task_id_2', 'data-order'=>'2'));?>
                                        <?php echo form_error('task_id_1'); ?>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label id="task_id_2" for="task_id_2" class="">Sub Task</label>
                                        <?php echo form_dropdown('task_id_2', $arr_task_id_2, set_value('task_id_2'), array('class' => 'form-control', 'id' => 'dd_sub_tasks'));?>
                                        <?php echo form_error('task_id_2'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="timesheet_hours" class="required">Hours</label>
                                        <?php echo form_input(array('name' => 'timesheet_hours', 'value' => set_value('timesheet_hours'),'id' => 'timesheet_hours', 'class' => 'form-control','maxlength' => '3','placeholder' => '0.0',)); ?>
                                        <?php echo form_error('timesheet_hours'); ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="timesheet_description" class="required">Description</label>
                                        <?php echo form_textarea(array('name' => 'timesheet_description','value' => set_value('timesheet_description'),'class' => 'form-control textarea', 'maxlength'=> '200', 'id' => 'timesheet_description','rows' => '2','cols' => '50','placeholder' => 'briefly describe in 200 characters')); ?>
                                        <?php echo form_error('timesheet_description'); ?>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!--/.col-lg-6-->
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
                            <table id="timesheet-datatable" class="table ci-table   table-striped w-100">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Hours</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Hours</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <!--/#nav-list-->

                </div>
                <!--/.tab-content #nav-tabContent-->
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->

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

<div class="modal fade" id="timesheetDetailsInfoModal" tabindex="-1" role="dialog" aria-labelledby="timesheetDetailsInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="timesheetDetailsInfoModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <dl class="row">
            <dt class="col-lg-3">Employee</dt>
            <dd class="col-lg-9" id="ts_emp_name"></dd>
            <dt class="col-lg-3">Project</dt>
            <dd class="col-lg-9" id="ts_project"></dd>
            <dt class="col-lg-3">Task</dt>
            <dd class="col-lg-9" id="ts_task"></dd>
            <dt class="col-lg-3">Hours</dt>
            <dd class="col-lg-9" id="ts_hours"></dd>
            <dt class="col-lg-3">Description</dt>
            <dd class="col-lg-9" id="ts_desc"></dd>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>