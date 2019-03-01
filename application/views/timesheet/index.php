<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">


    
	
	
	
	<div class="col-md-12">		
		<nav>
			<div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="true">Log Tasks</a>
				
				<a class="nav-item nav-link" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab" aria-controls="nav-list" aria-selected="false">View Logged Tasks</a>
			</div>
		</nav>
		
		<div class="tab-content" id="nav-tabContent">
			
			<?php
			// Show server side flash messages
			if (isset($alert_message)) {
				$html_alert_ui = '';
				$html_alert_ui.='<div class="mt-2 mb-2 auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
				echo $html_alert_ui;
			}
			?>
		
			<div class="mt-3 tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">			
			<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form form-timesheet','name' => '','id' => 'ci-form-timesheet',)); ?>
			<?php echo form_hidden('form_action', 'add'); ?>		  
			<?php echo form_hidden('today_date', date('d')); ?>		  
			<?php echo form_hidden('current_month', date('m')); ?>		  
			<?php echo form_hidden('month_url', $this->uri->segment(4) ? $this->uri->segment(4) : date('m')); ?>		  
			<?php echo form_hidden('selected_date',set_value('selected_date')); ?>
			<div class="form-row">
				<div class="col-md-3">	
					<label>Select Date(s) <span class="required">*</span> </label>	
					<a class="small" href="#" data-toggle="modal" data-target="#timesheetCalModal">Need help?</a>
					<?php echo $cal; ?>					
					<div class="small">
						<div class="d-inline-block"><span class="i-today pr-2 pl-2 m-1 text-white"></span>Today</div>
						<div class="d-inline-block"><span class="i-selected pr-2 pl-2 m-1"></span>Selected</div>
						<div class="d-inline-block"><span class="i-has-data pr-2 pl-2 m-1"></span>Task Logged</div>
						<div class="d-inline-block"><span class="i-leave pr-2 pl-2 m-1"></span>Leave</div>
						<div class="d-inline-block"><span class="i-holiday pr-2 pl-2 m-1"></span>Holiday</div>
					</div>
					<?php echo form_error('selected_date'); ?>
					<div class="mt-2"><a id="clear_selected_days" class="btn btn-outline-secondary btn-sm" href="#">Clear all selected days</a></div>
					<!-- <div class="mt-3 d-none">
						<h6>Timesheet Statistics</h6>
						<div class="">Tasks logged for: <span id="total_days">0.0</span> days</div>
						<div class="">Total hours logged: <span id="total_hrs">0.0</span> hrs</div>
						<div class="">Avg. hours worked: <span class="" id="average_worked_hrs">0.0</span> hrs/day</div>
					</div>		 -->
					<a class="text-centre d-none" href="#"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download this month's timesheet</a>
				</div><!--/.col-md-3-->

				<div class="col-md-8 offset-md-1">
					<div class="form-row">
						<div class="form-group col-md-4">
						<label for="project_id" class="bmd-label-floating">Project <span class="required">*</span></label>
							<?php
							echo form_dropdown('project_id', $project_arr, set_value('project_id'), array(
								'class' => 'form-control',
							));
							?> 
							<?php echo form_error('project_id'); ?>
						</div>
								
						<div class="form-group col-md-4">
						<label for="activity_id" class="bmd-label-floating">Activity <span class="required">*</span></label>
							<?php
							echo form_dropdown('activity_id', $task_task_activity_type_array, set_value('activity_id'), array(
								'class' => 'form-control',
							));
							?> 
							<?php echo form_error('activity_id'); ?>
						</div>
							
						<div class="form-group col-md-4">
							<label for="timesheet_hours" class="bmd-label-floating">Time Spent (In Hours)<span class="required">*</span></label>							
							<?php
							echo form_input(array(
								'name' => 'timesheet_hours',
								'value' => set_value('timesheet_hours'),
								'id' => 'timesheet_hours',
								'class' => 'form-control',
								'maxlength' => '5',
								'placeholder' => '',
							));
							?>
							<?php echo form_error('timesheet_hours'); ?>
						</div>
					</div>		  
					
					
					<div class="form-group">
					<label for="timesheet_description" class="bmd-label-floating">Task / Activity Description <span class="required">*</span></label>
					<?php
					echo form_textarea(array(
						'name' => 'timesheet_description',
						'value' => set_value('timesheet_description'),
						'id' => 'timesheet_description',
						'class' => 'form-control',
						'rows' => '2',
						'cols' => '4',
						'maxlength' => '200',
						'placeholder' => 'Briefly describe in 200 characters.'
					));
					?>
					<?php echo form_error('timesheet_description'); ?>
					<!-- <div class="small text-right"><span class="" id="remaining_description_length"><?php echo isset($remaining_description_length) ? $remaining_description_length : '200'; ?></span> characters remaining.</div> -->
					</div>
					
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
				</div><!--/.col-md-9-->	  
			</div>
			
			<?php echo form_close(); ?>
			</div><!--/#nav-add-->
			
			<div class="mt-3 tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
				
				<div class="table-responsive">
					<table id="timesheet-datatable" class="table ci-table table-striped w-100">
						<thead class="thead-dark">
							<!--<tr>
								<th scope="col">Date</th>
								<th scope="col">Project</th>
								<th scope="col">Activity</th>
								<th scope="col">Hours</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>-->
							<tr>
								<th scope="col">Date & Tasks</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				
			</div><!--/#nav-list-->
		
		</div><!--/.tab-content #nav-tabContent-->
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="timesheetCalModal" tabindex="-1" role="dialog" aria-labelledby="timesheetCalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timesheetCalModalLabel">Instructions for Timesheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<ul>
					<li>You need to log timesheet of current month on daily basis.</li>
					<li>Provision for logging timesheet of current month will be disabled by 3rd day of next month.</li>
					<li>To select/unselect multimple dates click on the the calendar days.</li>
					<li>You can add multiple tasks for a particular day, if you are working on multiple projects.</li>
					<li>If you did't find a relevant project, activity please contact to your HR/Admin.</li>
				</ul>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>