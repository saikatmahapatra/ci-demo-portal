<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->




<div class="row">
	<div class="col-md-12">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<div class="card">
			<div class="card-header">
				<span class="">Report</span>
			</div>
			<div class="card-body">
				
				<div class="row mb-3">
					<div class="col-md-12">
					<?php echo form_open(current_url(), array( 'method' => 'get','class'=>'ci-form','name' => '','id' => '')); ?>
					<?php echo form_hidden('form_action', 'search'); ?>		  
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="q_emp" class="">Employee <span class="required">*</span></label>
								<?php echo form_input(array('name' => 'q_emp','value' => $this->input->get_post('q_emp'), 'id' => 'q_emp','class' => 'form-control','placeholder' => ''));?> 
								<?php echo form_error('q_emp'); ?>
							</div>
							
							<div class="form-group col-md-4">
								<label for="q_emp" class="">Project <span class="required">*</span></label>
								<?php echo form_input(array('name' => 'q_emp','value' => $this->input->get_post('q_emp'), 'id' => 'q_emp','class' => 'form-control','placeholder' => ''));?> 
								<?php echo form_error('q_emp'); ?>
							</div>

							<div class="form-group col-md-2">									
								<label for="from_date" class="">From</label>
								<?php echo form_input(array('name' => 'from_date','value' => $this->input->get_post('from_date'),'id' => 'from_date','class' => 'form-control report-datepicker', 'placeholder' => 'dd-mm-yyyy','readonly'=>true));?>
								<?php echo form_error('from_date'); ?>
							</div>
						
							<div class="form-group col-md-2">									
								<label for="to_date" class="">To</label>
								<?php echo form_input(array('name' => 'to_date','value' => $this->input->get_post('to_date'),'class' => 'form-control report-datepicker','id' => 'to_date','placeholder' => 'dd-mm-yyyy','readonly'=>true));?>
								<?php echo form_error('to_date'); ?>
							</div>


						</div>					
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-search"></i> Search','class' => 'btn btn-primary'));?>
						<?php echo form_button(array('name' => 'reset_btn','type' => 'reset','content' => 'Reset','class' => 'btn btn-secondary'));?>
						 
						<?php echo form_close(); ?>
					</div>
				</div>
				

				<div class="table-responsive">
					<table class="table table-sm">
						<thead>
							<tr>
								<th scope="col" style="width:10%;">Date</th>
								<th scope="col" style="width:15%;">Employee</th>
								<th scope="col" style="width:20%;">Project</th>
								<th scope="col" style="width:10%;">Activity</th>
								<th scope="col" style="width:5%;">Hours</th>
								<th scope="col" style="width:40%;">Description</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							if(sizeof($data_rows)>0){
								foreach($data_rows as $row){
									?>
									<tr>
										<td><?php echo $this->common_lib->display_date($row['timesheet_date']);?></td>
										<td><?php echo $row['user_firstname'].' '.$row['user_lastname'];?></td>
										<td><?php echo $row['project_name'];?></td>
										<td><?php echo $row['task_activity_name'];?></td>
										<td><?php echo $row['timesheet_hours'];?></td>
										<td><?php echo $row['timesheet_description'];?></td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Employee</th>
								<th scope="col">Project</th>
								<th scope="col">Activity</th>
								<th scope="col">Hours</th>
								<th scope="col">Description</th>								
							</tr>
						</tfoot>
					</table>
					
				</div>
				<?php echo $pagination_link; ?>
			</div>
		</div>
	</div>
</div><!--/.row-->
