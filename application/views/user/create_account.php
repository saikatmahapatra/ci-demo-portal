<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-9">
		
		<div class="card ci-card">
			<div class="card-body">
			<h5 class="card-title">Create Account</h5>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
				<?php echo form_hidden('form_action', 'create_account'); ?>        
				<div class="form-row">		
					<div class="form-group col-lg-6">
						<label for="user_firstname" class="required">First Name</label>
						<?php echo form_input(array( 'name' => 'user_firstname', 'value' => set_value('user_firstname'), 'id' => 'user_firstname', 'class' => 'form-control', 'maxlength' => '30', 'placeholder' => '', )); ?>
						<?php echo form_error('user_firstname'); ?>
					</div>
					
					<div class="form-group col-lg-6">
						<label for="user_lastname" class="required">Last Name</label>
						<?php echo form_input(array( 'name' => 'user_lastname', 'value' => set_value('user_lastname'), 'id' => 'user_lastname', 'class' => 'form-control', 'maxlength' => '50', 'placeholder' => '', )); ?>
						<?php echo form_error('user_lastname'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_email" class="required">Email (office)</label>
						<?php echo form_input(array( 'name' => 'user_email', 'value' => set_value('user_email'), 'id' => 'user_email', 'class' => 'form-control', 'maxlength' => '255', 'placeholder' => '', )); ?> 
						<?php echo form_error('user_email'); ?>
					</div>
					<div class="form-group col-lg-6">
						<label for="user_phone1" class="required">Mobile (personal)</label>
						<?php echo form_input(array( 'name' => 'user_phone1', 'value' => set_value('user_phone1'), 'id' => 'user_phone1', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => '', )); ?>
						<?php echo form_error('user_phone1'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_dob" class="required">Date of Birth</label>
						<?php echo form_input(array( 'name' => 'user_dob', 'value' => set_value('user_dob'), 'id' => 'user_dob', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => 'dd-mm-yyyy', 'autocomplete'=>'off', 'readonly'=>true )); ?>
						<?php echo form_error('user_dob');?>
					</div>
					<div class="form-group col-lg-6">
							<label for="gender" class="required">Gender</label>
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
							</div>
							<?php echo form_error('user_gender'); ?>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_email_secondary" class="optional">Email (personal) </label>
						<?php echo form_input(array( 'name' => 'user_email_secondary', 'value' => set_value('user_email_secondary'), 'id' => 'user_email_secondary', 'class' => 'form-control', 'maxlength' => '255', 'placeholder' => '', )); ?> 
						<?php echo form_error('user_email_secondary'); ?>
					</div>
					<div class="form-group col-lg-6">
							<label for="user_phone2" class="optional">Mobile (office) </label>
							<?php echo form_input(array( 'name' => 'user_phone2', 'value' => set_value('user_phone2'), 'id' => 'user_phone2', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => '', )); ?>
							<?php echo form_error('user_phone2'); ?>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-6">
					<label for="user_designation" class="optional">Designation </label>
					<?php echo form_dropdown('user_designation', $arr_designations, set_value('user_designation'), array( 'class' => 'form-control', )); ?> 
						<?php echo form_error('user_designation'); ?>
					</div>
					<div class="form-group col-lg-6">
					<label for="user_department" class="optional">Department </label>
						<?php
						echo form_dropdown('user_department', $arr_departments, set_value('user_department'), array(
							'class' => 'form-control'
						));
						?> 
						<?php echo form_error('user_department'); ?>
					</div>
				</div>
					
					
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_doj" class="optional">Date of Joining </label>
						<?php echo form_input(array( 'name' => 'user_doj', 'value' => set_value('user_doj'), 'id' => 'user_doj', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => 'dd-mm-yyyy', 'autocomplete'=>'off', 'readonly'=>true )); ?>
						<?php echo form_error('user_doj'); ?>
					</div>
				</div>
					
				<?php echo form_hidden('user_role', 3); ?>

				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage');?>" class="btn btn-light ci-btn-cancel">Cancel</a>
				<?php echo form_close(); ?>
			
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->