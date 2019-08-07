<div class="row justify-content-center">
	<div class="col-md-8">		
		<div class="card">
			<div class="card-header text-center bg-primary text-white">
				<img class="mb-1" style="width:80px;" src="<?php echo base_url('assets/dist/img/logo.svg');?>">
				<h6><?php echo $this->config->item('app_company_product');?></h6>
				<h5 class=""><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h5>
			</div>
			<div class="card-body">
				<?php
				// Show server side flash messages
				if (isset($alert_message)) {
					$html_alert_ui = '';                
					$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
					echo $html_alert_ui;
				}
				?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
				<?php echo form_hidden('form_action', 'self_registration'); ?>        
				<?php echo form_hidden('user_role', 3); ?>        
				<div class="form-row">
				
					<div class="form-group col-md-3">
					  <label for="user_title" class="">Title <span class="required">*</span></label>
						<?php
						echo form_dropdown('user_title', $arr_user_title, set_value('user_title'), array(
							'class' => 'form-control field-help'
						));
						?> 
						<?php echo form_error('user_title'); ?>
					</div>
				
					<div class="form-group col-md-4">                            
						<label for="user_firstname" class="">First Name <span class="required">*</span></label>
						<?php
						echo form_input(array(
							'name' => 'user_firstname',
							'value' => set_value('user_firstname'),
							'id' => 'user_firstname',
							'class' => 'form-control',
							'maxlength' => '30',
							'placeholder' => '',
						));
						?>
						<?php echo form_error('user_firstname'); ?>
					</div>
					
					<div class="form-group col-md-5">                            
						<label for="user_lastname" class="">Last Name <span class="required">*</span></label>
						<?php
						echo form_input(array(
							'name' => 'user_lastname',
							'value' => set_value('user_lastname'),
							'id' => 'user_lastname',
							'class' => 'form-control',
							'maxlength' => '50',
							'placeholder' => '',
						));
						?>
						<?php echo form_error('user_lastname'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="user_email" class="">Email ID (Office) <span class="required">*</span></label>
						<?php
						echo form_input(array(
							'name' => 'user_email',
							'value' => set_value('user_email'),
							'id' => 'user_email',
							'class' => 'form-control',
							'maxlength' => '255',
							'placeholder' => '',
						));
						?> 
						<?php echo form_error('user_email'); ?>
					</div>
					
					<div class="form-group col-md-6">
						<label for="user_phone1" class="">10-digit Mobile Number (Personal) <span class="required">*</span></label>
						<?php
						echo form_input(array(
							'name' => 'user_phone1',
							'value' => set_value('user_phone1'),
							'id' => 'user_phone1',
							'maxlength' => '10',
							'class' => 'form-control',
							'placeholder' => '',
						));
						?>
						<?php echo form_error('user_phone1'); ?>
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
							'class' => 'form-control',
							'maxlength' => '12',
							'placeholder' => '',
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
							'maxlength' => '12',
							'placeholder' => '',
						));
						?> 
						<?php echo form_error('user_password_confirm'); ?>
					</div>
				</div>
				
				
				
				<div class="form-row">
						<div class="form-group col-md-6">                            
							<label for="user_dob" class="">Date of Birth <span class="required">*</span></label>				
							<?php
							/*echo form_input(array(
								'name' => 'user_dob',
								'value' => set_value('user_dob'),
								'id' => 'user_dob',
								'maxlength' => '10',
								'class' => 'form-control dob-datepicker',
								'placeholder' => 'dd-mm-yyyy',
								'autocomplete'=>'off',
								'readonly'=>true
							));*/
							?>
							<?php /*echo form_error('user_dob'); */?>
							<div class="">
								<?php echo form_dropdown('dob_day', $day_arr, set_value('dob_day'), array('class' => 'form-control dob-inline',));?>
								<?php echo form_dropdown('dob_month', $month_arr, set_value('dob_month'), array('class' => 'form-control dob-inline',));?>
								<?php echo form_dropdown('dob_year', $year_arr, set_value('dob_year'), array('class' => 'form-control dob-inline'));?>
							</div>
							<?php echo form_error('dob_day'); ?>
							<?php echo form_error('dob_month'); ?>
							<?php echo form_error('dob_year'); ?>
						</div>
						<div class="form-group col-md-6">
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
							</div>
							<?php echo form_error('user_gender'); ?>
					  </div>
					</div>

				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="ml-2 btn btn-secondary">Cancel</a>
				<?php echo form_close(); ?>
				<div class="mt-3">
					<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to login</a>
				</div>
			</div>
		</div>
	</div>