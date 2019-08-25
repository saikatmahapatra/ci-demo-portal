<?php
$row = $rows[0];
?>
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
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
					<?php echo form_hidden('form_action', 'update'); ?>
					<?php echo form_hidden('id', $row['id']); ?>
					
					<div class="form-row">						
						<div class="form-group col-md-8">
							<label for="task_activity_name" class="required">Project Name</label>
							<?php echo form_input(array('name' => 'task_activity_name', 'value' => (isset($_POST['task_activity_name']) ? set_value('task_activity_name') : $row['task_activity_name']), 'id' => 'task_activity_name', 'class' => 'form-control', 'placeholder' => ''));?>
							<?php echo form_error('task_activity_name'); ?>
						</div>		
					</div>		
					<div class="form-row">
						<div class="form-group col-md-12">									
						<label for="task_activity_status" class="required">Status</label>
								<div class="">
									<div class="custom-control custom-radio custom-control-inline">
										<?php
											$radio_is_checked = isset($_POST['task_activity_status']) ? $_POST['task_activity_status'] == 'Y' : ($row['task_activity_status'] == 'Y');

											echo form_radio(array('name' => 'task_activity_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('task_activity_status', 'Y'));
										?>
										<label class="custom-control-label" for="Y">Active</span></label>
									</div>
									
									<div class="custom-control custom-radio custom-control-inline">
										<?php
											$radio_is_checked = isset($_POST['task_activity_status']) ? $_POST['task_activity_status'] == 'N' : ($row['task_activity_status'] == 'N');

											echo form_radio(array('name' => 'task_activity_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('task_activity_status', 'N'));
										?>
										<label class="custom-control-label" for="N">Inactive</span></label>
									</div>								
								</div>
								<?php echo form_error('task_activity_status'); ?>
						</div>
					</div>
					
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
					<a href="<?php echo base_url($this->router->directory.$this->router->class.'/activity');?>" class="ml-2 btn btn-secondary">Cancel</a>                             
				<?php echo form_close(); ?>
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->