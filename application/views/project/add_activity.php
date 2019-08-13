<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Form
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/activity');?>" class="float-right btn btn-sm btn-outline-secondary" title=""> <i class="fa fa-fw fa-list"></i> View All</a>
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
					<?php echo form_hidden('form_action', 'insert'); ?>
					
					<div class="form-row">
						<div class="form-group col-md-6">									
							<label for="task_activity_name" class="">Activity Name <span class="required">*</span></label>
							<?php echo form_input(array('name' => 'task_activity_name', 'value' => set_value('task_activity_name'), 'id' => 'task_activity_name', 'class' => 'form-control', 'placeholder' => ''));?>
							<?php echo form_error('task_activity_name'); ?>
						</div>		
					</div>

					<div class="form-row">
						<div class="form-group col-md-12">									
							<label for="task_activity_status" class="">Display Status <span class="required">*</span></label>				
							<div class="">
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = $this->input->post('task_activity_status') == 'Y';
										echo form_radio(array('name' => 'task_activity_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('task_activity_status', 'Y'));
									?>
									<label class="custom-control-label" for="Y">Publish</span></label>
								</div>
								
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = $this->input->post('task_activity_status') == 'N';
										echo form_radio(array('name' => 'task_activity_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('task_activity_status', 'N'));
									?>
									<label class="custom-control-label" for="N">Unpublish</span></label>
								</div>								
							</div>
							<small class="form-text text-muted">Unpublished projects will not appear at timesheet project list dropdown.</small>
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