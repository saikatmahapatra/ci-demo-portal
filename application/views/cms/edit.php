<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header h6">Form</div><!--/.card-header-->

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
					<div class="form-group col-md-12">
						
					</div>
				</div>
				
				<div class="form-row">	
					<div class="form-group col-md-4">
						<label for="content_type" class="required">Content Type</label>
						<?php echo form_dropdown('content_type', $arr_content_type, (isset($_POST['content_type']) ? set_value('content_type') : $row['content_type']), array('class' => 'form-control',));?>
						<?php echo form_error('content_type'); ?>
					</div>	
					<div class="form-group col-md-8">
						<label for="content_title" class="required">Content Title</label>
						<?php echo form_input(array('name' => 'content_title', 'value' => (isset($_POST['content_title']) ? set_value('content_title') : $row['content_title']), 'id' => 'content_title', 'class' => 'form-control', 'placeholder' => ''));?>
						<?php echo form_error('content_title'); ?>
					</div>
				</div>
				
				
				
				<div class="form-group">
					<label for="content_text" class="required">Content Description</label>
					<?php echo form_textarea(array('name' => 'content_text','value' => (isset($_POST['content_text']) ? set_value('content_text') : $row['content_text']),'class' => 'form-control textarea','id' => 'content_text','rows' => '2','cols' => '50','placeholder' => '')); ?>
					<?php echo form_error('content_text'); ?>
				</div>
				

				<div class="form-row">
				<div class="form-group col-md-12">									
					<label for="content_status" class="required">Status</label>
						<?php //echo form_dropdown('content_status', array('Y'=>'Yes','N'=>'No'), (isset($_POST['content_status']) ? set_value('content_status') : $row['content_status']), array('class' => 'form-control')); ?>
							<!--<div class="">-->
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = isset($_POST['content_status']) ? $_POST['content_status'] == 'Y' : ($row['content_status'] == 'Y');

										echo form_radio(array('name' => 'content_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('content_status', 'Y'));
									?>
									<label class="custom-control-label" for="Y">Active</span></label>
								</div>
								
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = isset($_POST['content_status']) ? $_POST['content_status'] == 'N' : ($row['content_status'] == 'N');

										echo form_radio(array('name' => 'content_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('content_status', 'N'));
									?>
									<label class="custom-control-label" for="N">Inactive</span></label>
								</div>								
							<!--</div>-->
					</div>

				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<!-- <label class="">Send Email Notification to </label> -->
						<div class="custom-control custom-checkbox custom-control-inline">
							<?php
								$cb_is_checked = $this->input->post('send_email_notification') === 'Y';
								echo form_checkbox('send_email_notification', 'Y', $cb_is_checked, array('id' => 'send_email_notification','class' => 'custom-control-input'));
							?>
							<label class="custom-control-label" for="send_email_notification">Send this as an email notification </label>
						</div>
						<?php /* ?>
						<div class="custom-control custom-checkbox custom-control-inline">
							<?php
								$cb_is_checked_2 = $this->input->post('send_email_notification_2') === 'Y';
								echo form_checkbox('send_email_notification_2', 'Y', $cb_is_checked_2, array('id' => 'send_email_notification_2','class' => 'custom-control-input'));
							?>
							<label class="custom-control-label" for="send_email_notification_2">Personal email</label>
						</div>
						<?php */ ?>
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