<?php 
	$row = $row[0]; 
	$approver = sizeof($approvers)>0 ? $approvers[0] : null;
	//print_r($approver);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading : 'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">
    <div class="col-md-10">
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
		
			

		<div class="row mt-3 mb-3">
			<div class="col-md-2">
				<img class="align-self-center mr-3 rounded dp" src="<?php echo base_url($img_src);?>">
			</div>
			<div class="col-md-10">
				
			<div class="h5">
				<?php
					echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
					echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
					echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
					echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
				?>
			</div>
			<?php 
				$account_status_indicator = 'text-secondary';            
				if($row['user_archived'] == 'Y'){
					$account_status_indicator = 'text-danger';
					echo '<span class="badge badge-danger">User Archived</span>';
				}else{
					if($row['user_account_active'] == 'Y'){
						$account_status_indicator = 'text-success';
						echo '<span class="badge badge-success">Active Account</span>';
					}
					if($row['user_account_active'] == 'N'){
						$account_status_indicator = 'text-warning';
						echo '<span class="badge badge-warning">Inactive Account</span>';
					}
				}				
			?>
			<!--<div class="small"><?php //echo isset($row['role_name']) ? $row['role_name'] : ''; ?></div>-->
			<div class="small"><?php echo isset($row['user_emp_id']) ? 'Emp # '.$row['user_emp_id'] : ''; ?></div>
			<div class="small"><?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
			<div class="">
				<i class="fa fa-envelope-o" aria-hidden="true"></i> 
				<a class="" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
			</div>
			<div class="">
				<i class="fa fa-phone" aria-hidden="true"></i>
				<a class="" href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a>
				<a href="tel:<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?>"><?php echo isset($row['user_phone2']) ? ' / '.$row['user_phone2'] : ''; ?></a>        
			</div>
			</div>
		</div>

		
        

        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
        <?php echo form_hidden('form_action', 'update_profile'); ?>
        <?php echo form_hidden('user_email', $row['user_email']); ?>        
        <div class="form-row">
		
			<div class="form-group col-md-3">
			  <label for="user_title" class="">Title <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_title', $arr_user_title, isset($_POST['user_title']) ? set_value('user_title') : $row['user_title'], array(
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
					'value' => isset($_POST['user_firstname']) ? set_value('user_firstname') : $row['user_firstname'],
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
					'value' => isset($_POST['user_lastname']) ? set_value('user_lastname') : $row['user_lastname'],
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
				<label for="user_doj" class="">Date of Joining </label>				
				<?php
				echo form_input(array(
					'name' => 'user_doj',
					'value' => isset($_POST['user_doj']) ? set_value('user_doj') : $this->common_lib->display_date($row['user_doj']),
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
				echo form_dropdown('user_designation', $arr_designations, isset($_POST['user_designation']) ? set_value('user_designation') : $row['user_designation'], array(
					'class' => 'form-control',									
				));
				?> 
				<?php echo form_error('user_designation'); ?>
			</div>	

			<div class="form-group col-md-4">
			  <label for="user_department" class="">Department </label>
				<?php
				echo form_dropdown('user_department', $arr_departments, isset($_POST['user_department']) ? set_value('user_department') : $row['user_department'] , array(
					'class' => 'form-control'
				));
				?> 
				<?php echo form_error('user_department'); ?>
			</div>
		</div>
		
		<div class="form-row">
				<div class="form-group col-md-4">                            
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
						<?php echo form_dropdown('dob_day', $day_arr, isset($_POST['dob_day']) ? set_value('dob_day') :  $dob[2] , array('class' => 'form-control dob-inline',));?>
						<?php echo form_dropdown('dob_month', $month_arr, isset($_POST['dob_day']) ? set_value('dob_month') : $dob[1], array('class' => 'form-control dob-inline',));?>
						<?php echo form_dropdown('dob_year', $year_arr, isset($_POST['dob_day']) ? set_value('dob_year') : $dob[0], array('class' => 'form-control dob-inline'));?>
					</div>
					<?php echo form_error('dob_day'); ?>
					<?php echo form_error('dob_month'); ?>
					<?php echo form_error('dob_year'); ?>
				</div>
				<div class="form-group col-md-4">
					<label for="gender">Gender <span class="required">*</span></label>
					<div class="">
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								
								$radio_is_checked = isset($_POST['user_gender']) ? $_POST['user_gender'] == 'M' : ($row['user_gender'] == 'M');

								echo form_radio(array('name' => 'user_gender','value' => 'M','id' => 'M','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_gender', 'M'));
							?>
							<label class="custom-control-label" for="M">Male</span></label>
						</div>
						
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = isset($_POST['user_gender']) ? $_POST['user_gender'] == 'F' : ($row['user_gender'] == 'F');

								echo form_radio(array('name' => 'user_gender', 'value' => 'F', 'id' => 'F', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_gender', 'F'));
							?>
							<label class="custom-control-label" for="F">Female</span></label>
						</div>								
					</div>
					<?php echo form_error('user_gender'); ?>
			  	</div>
				<?php if($row['id'] != $this->common_lib->get_sess_user('id')){?>
				<div class="form-group col-md-4">
					<label for="user_account_active" class="">Portal Account Status <span class="required">*</span></label>
					<div class="">
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = isset($_POST['user_account_active']) ? $_POST['user_account_active'] == 'Y' : ($row['user_account_active'] == 'Y');
								echo form_radio(array('name' => 'user_account_active','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_account_active', 'Y'));
							?>
							<label class="custom-control-label" for="Y">Active</span></label>
						</div>
						
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = isset($_POST['user_account_active']) ? $_POST['user_account_active'] == 'N' : ($row['user_account_active'] == 'N');
								echo form_radio(array('name' => 'user_account_active', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_account_active', 'N'));
							?>
							<label class="custom-control-label" for="N">Inactive</span></label>
						</div>								
					</div>
					<small id="emailHelp" class="form-text text-muted">Inactive users will not be able to login.</small>
					<?php echo form_error('user_account_active'); ?>
				</div>
				<?php } else{
					echo form_hidden('user_account_active', $row['user_account_active']);
				} ?>

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
			<?php //echo form_hidden('user_role', 3); ?>
			
			
			<div class="form-row">
				<div class="form-group col-md-3 ci-select2">
                    <label for="" class="">Supervisor / Level 1 Approver</label>
                    <?php echo form_dropdown('user_supervisor_id', $user_arr, isset($approver['user_supervisor_id']) ? $approver['user_supervisor_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_supervisor_id')); ?> 
                    <?php echo form_error('user_supervisor_id'); ?>
                </div>
                <div class="form-group col-md-3 ci-select2">
                    <label for="" class="">Director / Level 2 Approver</label>
                    <?php echo form_dropdown('user_director_approver_id', $user_arr, isset($approver['user_director_approver_id']) ? $approver['user_director_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_director_approver_id')); ?> 
                    <?php echo form_error('user_director_approver_id'); ?>
                </div>
                <div class="form-group col-md-3 ci-select2">
                    <label for="" class="">HR Approver</label>
                    <?php echo form_dropdown('user_hr_approver_id', $user_arr, isset($approver['user_hr_approver_id']) ? $approver['user_hr_approver_id'] : set_value('user_hr_approver_id') ,array('class' => 'form-control select2-control', 'id'=>'user_hr_approver_id')); ?> 
                    <?php echo form_error('user_hr_approver_id'); ?>
                </div>
                <div class="form-group col-md-3 ci-select2">
                    <label for="" class="">Finance Approver</label>
                    <?php echo form_dropdown('user_finance_approver_id', $user_arr, isset($approver['user_finance_approver_id']) ? $approver['user_finance_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_finance_approver_id')); ?> 
                    <?php echo form_error('user_finance_approver_id'); ?>
                </div>
			</div>

        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>

		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/close_account/'.@$this->encrypt->encode($row['id']));?>" class="btn btn-outline-danger mr-2">Close Portal Account</a>
        <?php echo form_close(); ?>
    </div>
</div>