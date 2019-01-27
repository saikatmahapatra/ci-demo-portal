<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading: 'Page Heading'; ?></h1>
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
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
        <?php echo form_hidden('form_action', 'create_account'); ?>        
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
				<label for="user_email" class="">Email (Work) <span class="required">*</span></label>
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
				<label for="user_email_secondary" class="">Email (Personal) </label>
				<?php
				echo form_input(array(
					'name' => 'user_email_secondary',
					'value' => set_value('user_email_secondary'),
					'id' => 'user_email_secondary',
					'class' => 'form-control',
					'maxlength' => '255',
					'placeholder' => '',
				));
				?> 
				<?php echo form_error('user_email_secondary'); ?>
			</div>
		</div>
		
		<div class="form-row">			
			<div class="form-group col-md-6">                           
				<label for="user_phone1" class="">Mobile (Personal/Primary) <span class="required">*</span></label>
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
			
			<div class="form-group col-md-6">                            
					<label for="user_phone2" class="">Mobile (Work) </label>
					<?php
					echo form_input(array(
						'name' => 'user_phone2',
						'value' => set_value('user_phone2'),
						'id' => 'user_phone2',
						'maxlength' => '10',
						'class' => 'form-control',
						'placeholder' => '',
					));
					?>
					<?php echo form_error('user_phone2'); ?>
            </div>
		</div>
			
            
		
		
		<div class="form-row">
			<?php /* ?><div class="form-group col-md-6">
			  <label for="user_department" class="">Department <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_department', $arr_departments, set_value('user_department'), array(
					'class' => 'form-control'
				));
				?> 
				<?php echo form_error('user_department'); ?>
			</div><?php */ ?>
			
			<div class="form-group col-md-4">                            
				<label for="user_doj" class="">Date of Joining </label>				
				<?php
				echo form_input(array(
					'name' => 'user_doj',
					'value' => set_value('user_doj'),
					'id' => 'user_doj',
					'maxlength' => '10',
					'class' => 'form-control dob-datepicker',
					'placeholder' => '',
					'autocomplete'=>'off',
					'readonly'=>true
				));
				?>
				<?php echo form_error('user_doj'); ?>
			</div>
			
			<div class="form-group col-md-4">
			  <label for="user_designation" class="">Designation </label>
				<?php
				echo form_dropdown('user_designation', $arr_designations, set_value('user_designation'), array(
					'class' => 'form-control',									
				));
				?> 
				<?php echo form_error('user_designation'); ?>
			</div>	

			<div class="form-group col-md-4">
			  <label for="user_department" class="">Department </label>
				<?php
				echo form_dropdown('user_department', $arr_departments, set_value('user_department'), array(
					'class' => 'form-control'
				));
				?> 
				<?php echo form_error('user_department'); ?>
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
			
			<?php /* ?>
			<div class="form-row">				
				<div class="form-group col-md-6">
				  <label for="user_role" class="">Access Group <span class="required">*</span></label>
					<?php
					echo form_dropdown('user_role', $arr_roles, set_value('user_role'), array(
						'class' => 'form-control field-help'
					));
					?> 
					<?php echo form_error('user_role'); ?>
				</div>
			</div>
			<?php */ ?>
			<?php echo form_hidden('user_role', 3); ?>

        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
    </div>
</div>