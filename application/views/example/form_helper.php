<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->


<div class="row">
	<div class="col-md-8">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => '')); ?>
		<?php echo form_hidden('form_action', 'add'); ?>		  
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="user_email" class="">Email <span class="required">*</span></label>			
					<?php
					echo form_input(array(
						'name' => 'user_email',
						'value' => set_value('user_email'),
						'id' => 'user_email',
						'class' => 'form-control field-help',
						'placeholder' => '',
						'minlength' => '',
						'maxlength' => '',
						'aria-describedby'=>'emailHelpBlock',
						'data-help-text' => 'We will not share your email to any thirrd party websites.',
						'data-help-text-class' => 'p-3 mt-1 mb-2 bg-info text-white'
					));
					?>
					<?php echo form_error('user_email'); ?>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-6">
				  <label for="user_password" class="">Password <span class="required">*</span></label>
					<?php
					echo form_password(array(
						'name' => 'user_password',
						'value' => set_value('user_password'),
						'id' => 'user_password',
						'class' => 'form-control field-help',
						'placeholder' => '',
						'minlength' => '6',
						'maxlength' => '16',
						'data-help-text' => 'A strong password should contains the followings <ul><li>Atleast one upper case.</li><li>Atleast one lower case.</li><li>Atleast one digit.</li><li>Some special characters.</li></ul>',
						'aria-describedby'=>'passwordHelpBlock'
					));
					?> 
					<?php echo form_error('user_password'); ?>
				</div>
				<div class="form-group col-md-6">
				  <label for="user_password_confirm" class="">Confirm Password <span class="required">*</span></label>
					<?php
					echo form_password(array(
						'name' => 'user_password_confirm',
						'value' => set_value('user_password_confirm'),
						'id' => 'user_password_confirm',
						'class' => 'form-control',
						'placeholder' => '',
						'minlength' => '6',
						'maxlength' => '16',
					));
					?> 
					<?php echo form_error('user_password_confirm'); ?>
				</div>
		  </div>
		  
		  <div class="form-row">
			<div class="form-group col-md-12">
				<label for="address" class="">Address <span class="required">*</span></label>
				<?php
				echo form_textarea(array(
					'name' => 'address',
					'value' => set_value('address'),
					'id' => 'address',
					'class' => 'form-control',
					'rows' => '1',
					'cols' => '4',
					'placeholder' => '',
					'minlength' => '10',
					'maxlength' => '200',
				));
				?>
				<?php echo form_error('address'); ?>
			</div>
		  </div>
		  
		  <div class="form-row">
			<div class="form-group col-md-6">
			  <label for="job_role" class="">Job Role <span class="required">*</span></label>
				<?php
				echo form_dropdown('job_role', $job_role_arr, set_value('job_role'), array(
					'class' => 'form-control',
				));
				?> 
				<?php echo form_error('job_role'); ?>
			</div>
			<div class="form-group col-md-6">
			  <label for="functional_domain" class="">Job Domain <span class="required">*</span></label>
				<?php
				echo form_multiselect('functional_domain', $domain_arr, set_value('functional_domain'), array(
					'class' => 'form-control field-help',
					'aria-describedby'=>'jobDomainHelpBlock',
					'data-help-text' => 'Press control key to select multiple job domains',
					'data-help-text-class' => 'p-3 mt-1 mb-2 bg-warning text-white'
				));
				?> 
				<?php echo form_error('functional_domain'); ?>
			</div>
		  </div>
		  
		  <div class="form-row">
			<div class="form-group col-md-12">
				<label for="userfile" class="">Resume <span class="required">*</span></label>
					
					<div class="custom-file">
						<?php
						echo form_upload(array(
							'name' => 'userfile',
							'id' => 'userfile',
							'class' => 'custom-file-input field-help',
							'aria-describedby'=>'uploaderHelpBlock',
							'data-help-text' => 'Please read the file upload instructions given below: <ul><li>doc, docx, pdf, jpg, png formats are supported.</li><li>File size should not exceed 2 MB</li></ul>',
							'data-help-text-class' => 'p-3 mt-1 mb-2 bg-warning text-white'
						));
						?>
						<label class="custom-file-label" for="userfile">Choose file</label>
					</div>
													
					<?php echo form_error('userfile'); ?>
				</div>
			</div>
		  
		  <div class="form-row">
			<div class="form-group col-md-12">
				<label for="gender">Gender <span class="required">*</span></label>
				
				<div class="">
					<div class="custom-control custom-radio custom-control-inline">
						<?php
							$radio_is_checked = $this->input->post('user_gender') === 'M';
							echo form_radio(array('name' => 'user_gender','value' => 'M','id' => 'M','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_gender', 'M'));
						?>
						<label class="custom-control-label" for="M">Male</span></label>
					</div>
					
					<div class="custom-control custom-radio custom-control-inline">
						<?php
							$radio_is_checked = $this->input->post('user_gender') === 'F';
							echo form_radio(array('name' => 'user_gender', 'value' => 'F', 'id' => 'F', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_gender', 'F'));
						?>
						<label class="custom-control-label" for="F">Female</span></label>
					</div>
					
					<div class="custom-control custom-radio custom-control-inline">
						<?php
						$radio_is_checked = $this->input->post('user_gender') === 'T';
						echo form_radio(array('name' => 'user_gender', 'value' => 'T', 'id' => 'T', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_gender', 'T'));
						?>
						<label class="custom-control-label" for="T">Better, I would not say</span></label>
					</div>
				</div>
				<?php echo form_error('user_gender'); ?>
			</div>
		  </div>
		  
		  <div class="form-row">
			<div class="form-group col-md-12">
				<div class="form-check">
					<?php
						$cb_is_checked = $this->input->post('terms') === 'accept';
						echo form_checkbox('terms', 'accept', $cb_is_checked, array('id' => 'trems','class' => 'form-check-input'));
					?>				
					<label class="form-check-label" for="trems">
					<span class="required">*</span>I've read & accepting the <a href="#" data-toggle="modal" data-target="#tncModal">Terms of Uses Agreement</a>
					</label>				
				</div>
				<?php echo form_error('terms'); ?>
			</div>
		 </div>
		  
		  <?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'id' => 'btn_submit', 'class' => 'btn btn-primary')); ?> 
		<?php echo form_close(); ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tncModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Terms of Services</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body tnc-content">
				<p>Modal body content</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>