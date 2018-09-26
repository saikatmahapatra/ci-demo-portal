<?php $row = $row[0]; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading : 'Page Heading'; ?></h1>
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
		<?php   
			$img_src = "";
			$default_path = "assets/dist/img/default_user.jpg";
			if(isset($profile_pic)){					
				$user_dp = "assets/uploads/user/profile_pic/".$profile_pic;					
				if (file_exists(FCPATH . $user_dp)) {
					$img_src = $user_dp;
				}else{
					$img_src = $default_path;
				}
			}else{
				$img_src = $default_path;
			}
		?>

		<div class="row">
			<div class="col-md-2 mt-3">
				<img class="align-self-center mr-3 rounded dp" src="<?php echo base_url($img_src);?>">
			</div>
			<div class="col-md-10">
				<h3 class="mt-3"><?php echo $row['user_title'].' '.$row['user_firstname'].' '.$row['user_lastname']; ?></h3>
				<h6 class="mt-1">
					<?php 
						if($row['user_account_active']=='Y'){
							?>
							<span class="badge badge-success">Active Account</span>                        
							<?php
						}
						if($row['user_account_active']=='N'){
							?>
							<span class="badge badge-danger">Inactive Account</span>
							<?php
						}
					?>            
				</h6>
				<h6 class="mt-1">
				<?php echo 'Emp # '.$row['user_emp_id']; ?>
				</h6>
				<h6 class="mt-1">
				<i class="fa fa-envelope-o"></i> <?php echo $row['user_email'].' , '.$row['user_email_secondary']; ?>
				</h6>
				<h6 class="mt-1 mb-4">
					<i class="fa fa-phone"></i> <?php echo $row['user_phone1'].' , '.$row['user_phone2']; ?>
				</h6>
			</div>
		</div>

		
        

        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
        <?php echo form_hidden('form_action', 'update_profile'); ?>
        <?php echo form_hidden('user_email', $row['user_email']); ?>        
        <div class="form-row">
		
			<div class="form-group col-md-3">
			  <label for="user_title" class="">Title <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_title', $arr_user_title, isset($row['user_title']) ? $row['user_title'] : set_value('user_title'), array(
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
					'value' => isset($row['user_firstname']) ? $row['user_firstname'] : set_value('user_firstname'),
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
					'value' => isset($row['user_lastname']) ? $row['user_lastname'] : set_value('user_lastname'),
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
				<label for="user_doj" class="">Date of Joining <span class="required">*</span></label>				
				<?php
				echo form_input(array(
					'name' => 'user_doj',
					'value' => isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : set_value('user_doj'),
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
			  <label for="user_designation" class="">Designation <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_designation', $arr_designations, isset($row['user_designation']) ? $row['user_designation'] : set_value('user_designation'), array(
					'class' => 'form-control',									
				));
				?> 
				<?php echo form_error('user_designation'); ?>
			</div>	

			<div class="form-group col-md-4">
			  <label for="user_department" class="">Department <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_department', $arr_departments, isset($row['user_department']) ? $row['user_department'] : set_value('user_department'), array(
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
                        <?php
                        $dob = explode('-',$row['user_dob']);
                        //print_r($dob);
                        ?>
						<?php echo form_dropdown('dob_day', $day_arr, isset($dob[2])?$dob[2]:set_value('dob_day'), array('class' => 'form-control dob-inline',));?>
						<?php echo form_dropdown('dob_month', $month_arr, isset($dob[1])?$dob[1]:set_value('dob_month'), array('class' => 'form-control dob-inline',));?>
						<?php echo form_dropdown('dob_year', $year_arr, isset($dob[0])?$dob[0]:set_value('dob_year'), array('class' => 'form-control dob-inline'));?>
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
								$radio_is_checked = ($this->input->post('user_gender') === 'M' || $row['user_gender'] == 'M');
								echo form_radio(array('name' => 'user_gender','value' => 'M','id' => 'M','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_gender', 'M'));
							?>
							<label class="custom-control-label" for="M">Male</span></label>
						</div>
						
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = ($this->input->post('user_gender') === 'F' || $row['user_gender'] == 'F');
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
				<div class="form-group col-md-4">
				  <label for="user_role" class="">Access Group <span class="required">*</span></label>
					<?php
					echo form_dropdown('user_role', $arr_roles, isset($row['user_role'])?$row['user_role']:set_value('user_role'), array(
						'class' => 'form-control field-help'
					));
					?> 
					<?php echo form_error('user_role'); ?>
				</div>
			</div>

			<?php */ ?>
			<?php echo form_hidden('user_role', 3); ?>

            <div class="form-row">				
				<div class="form-group col-md-4">
				  <label for="user_account_active" class="">Account Active ? <span class="required">*</span></label>
				  	<div class="">
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = ($this->input->post('user_account_active') === 'Y' || $row['user_account_active'] == 'Y');
								echo form_radio(array('name' => 'user_account_active','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_account_active', 'Y'));
							?>
							<label class="custom-control-label" for="Y">Yes</span></label>
						</div>
						
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = ($this->input->post('user_account_active') === 'N' || $row['user_account_active'] == 'N');
								echo form_radio(array('name' => 'user_account_active', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_account_active', 'N'));
							?>
							<label class="custom-control-label" for="N">No</span></label>
						</div>								
					</div>
					<?php echo form_error('user_account_active'); ?>
				</div>
			</div>

        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
    </div>
</div>