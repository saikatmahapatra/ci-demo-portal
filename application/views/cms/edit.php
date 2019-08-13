<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Data Table
				<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="float-right btn btn-sm btn-outline-secondary" title=""> <i class="fa fa-list"></i> View All</a>
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
					<div class="form-group col-md-12">
						
					</div>
				</div>
				
				<div class="form-row">	
					<div class="form-group col-md-4">
						<label for="pagecontent_type" class="">Content Type <span class="required">*</span></label>
						<?php echo form_dropdown('pagecontent_type', $arr_content_type, (isset($_POST['pagecontent_type']) ? set_value('pagecontent_type') : $row['pagecontent_type']), array('class' => 'form-control',));?>
						<?php echo form_error('pagecontent_type'); ?>
					</div>	
					<div class="form-group col-md-8">
						<label for="pagecontent_title" class="">Content Title <span class="required">*</span></label>
						<?php echo form_input(array('name' => 'pagecontent_title', 'value' => (isset($_POST['pagecontent_title']) ? set_value('pagecontent_title') : $row['pagecontent_title']), 'id' => 'pagecontent_title', 'class' => 'form-control', 'placeholder' => ''));?>
						<?php echo form_error('pagecontent_title'); ?>
					</div>
				</div>
				
				
				
				<div class="form-group">
					<label for="pagecontent_text" class="">Content(HTML) <span class="required">*</span></label>
					<?php echo form_textarea(array('name' => 'pagecontent_text','value' => (isset($_POST['pagecontent_text']) ? set_value('pagecontent_text') : $row['pagecontent_text']),'class' => 'form-control textarea','id' => 'pagecontent_text','rows' => '2','cols' => '50','placeholder' => '')); ?>
					<?php echo form_error('pagecontent_text'); ?>
				</div>
				

				<div class="form-row">
				<div class="form-group col-md-12">									
					<label for="pagecontent_status" class="">Display Status <span class="required">*</span></label>
						<?php //echo form_dropdown('pagecontent_status', array('Y'=>'Yes','N'=>'No'), (isset($_POST['pagecontent_status']) ? set_value('pagecontent_status') : $row['pagecontent_status']), array('class' => 'form-control')); ?>
							<!--<div class="">-->
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = isset($_POST['pagecontent_status']) ? $_POST['pagecontent_status'] == 'Y' : ($row['pagecontent_status'] == 'Y');

										echo form_radio(array('name' => 'pagecontent_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('pagecontent_status', 'Y'));
									?>
									<label class="custom-control-label" for="Y">Publish</span></label>
								</div>
								
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = isset($_POST['pagecontent_status']) ? $_POST['pagecontent_status'] == 'N' : ($row['pagecontent_status'] == 'N');

										echo form_radio(array('name' => 'pagecontent_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('pagecontent_status', 'N'));
									?>
									<label class="custom-control-label" for="N">Unpublish</span></label>
								</div>								
							<!--</div>-->
					</div>

				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<!-- <label class="">Send Email Notification to (optional)</label> -->
						<div class="custom-control custom-checkbox custom-control-inline">
							<?php
								$cb_is_checked = $this->input->post('send_email_notification') === 'Y';
								echo form_checkbox('send_email_notification', 'Y', $cb_is_checked, array('id' => 'send_email_notification','class' => 'custom-control-input'));
							?>
							<label class="custom-control-label" for="send_email_notification">Send Email Notification to office email (optional)</label>
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