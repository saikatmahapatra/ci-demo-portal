<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header h6">
				Form
			</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
				<div class="row">
					<div class="col-md-4">
						<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leavebalance',)); ?>
						<?php echo form_hidden('form_action', 'leave_balance_update'); ?>
						<?php echo form_hidden('id', ''); ?>
						<div class="form-group">
							<label for="user_id" class="required">Employee</label>
							<?php
							echo form_dropdown('user_id', $user_dropdwon, set_value('user_id'), array(
								'class' => 'form-control',
								'id' => 'user_dropdown'
							));
							?> 
							<?php echo form_error('user_id'); ?>
						</div>
						<div class="form-group">
							<label for="cl" class="required">Casual Leave</label>
							<?php echo form_input(array('name' => 'cl','value' => set_value('cl'),'id' => 'cl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
							<?php echo form_error('cl'); ?>
						</div>
						<div class="form-group">
							<label for="pl" class="required">Priviledge Leave</label>		
							<?php echo form_input(array('name' => 'pl','value' => set_value('pl'),'id' => 'pl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
							<?php echo form_error('pl'); ?>
						</div>
						<div class="form-group">
							<label for="ol" class="required">Optional Leave</label>
							<?php echo form_input(array('name' => 'ol','value' => set_value('ol'),'id' => 'ol', 'class' => 'form-control','placeholder'=>'','maxlength' => '6'));
							?>
							<?php echo form_error('ol'); ?>				
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
						<?php echo form_close(); ?>
					</div>
					<div class="col-md-6">
						<div>Leave balance added on : <span id="created_on"></span></div>
						<div>Leave balance updated on : <span id="updated_on"></span></div>
						<div>PL auto updated on : <span id="pl_updated_by_cron_on"></span></div>
						<div>CL auto updated on : <span id="cl_updated_by_cron_on"></span></div>
						<div>OL auto updated on : <span id="ol_updated_by_cron_on"></span></div>
					</div>
				</div>
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->