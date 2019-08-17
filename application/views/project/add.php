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
					<?php echo form_hidden('form_action', 'insert'); ?>
					
					<div class="form-row">		
						<div class="form-group col-md-4">									
							<label for="project_number" class="">Project Number/Code <span class="required">*</span></label>
							<?php echo form_input(array('name' => 'project_number', 'value' => set_value('project_number'), 'id' => 'project_number', 'class' => 'form-control', 'placeholder' => '', 'maxlength'=>'15'));?>
							<?php echo form_error('project_number'); ?>
						</div>		
						<div class="form-group col-md-8">									
							<label for="project_name" class="">Project Name <span class="required">*</span></label>
							<?php echo form_input(array('name' => 'project_name', 'value' => set_value('project_name'), 'id' => 'project_name', 'class' => 'form-control', 'placeholder' => ''));?>
							<?php echo form_error('project_name'); ?>
						</div>		
					</div>
					
					<div class="form-row">
						<div class="form-group col-md-12">									
							<label for="project_desc" class="">Project Description (Optional)</label>
							<?php echo form_textarea(array('name' => 'project_desc','value' => set_value('project_desc'),'class' => 'form-control textarea','id' => 'project_desc','rows' => '2','cols' => '50','placeholder' => '')); ?>
							<?php echo form_error('project_desc'); ?>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-12">									
							<label for="project_status" class="">Status <span class="required">*</span></label>				
							<div class="">
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = $this->input->post('project_status') == 'Y';
										echo form_radio(array('name' => 'project_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('project_status', 'Y'));
									?>
									<label class="custom-control-label" for="Y">Active</span></label>
								</div>
								
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = $this->input->post('project_status') == 'N';
										echo form_radio(array('name' => 'project_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('project_status', 'N'));
									?>
									<label class="custom-control-label" for="N">Inactive</span></label>
								</div>								
							</div>
							<small class="form-text text-muted">Unpublished projects will not appear at timesheet project list dropdown.</small>
							<?php echo form_error('project_status'); ?>
						</div>		
					</div>
					
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
					<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="ml-2 btn btn-secondary">Cancel</a>
				<?php echo form_close(); ?>
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->