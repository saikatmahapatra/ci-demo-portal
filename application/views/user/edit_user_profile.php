<?php 
	$row = $row[0]; 
	$approver = sizeof($approvers)>0 ? $approvers[0] : null;
	//print_r($approver);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<label class="row">
	<label class="col-lg-9">
		<label class="card ci-card">
			<div class="card-header">Edit Profile</div>
			<label class="card-body">
			
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
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
				<div class="row text-center mb-3">
					<div class="col-sm-12">
						<img class="dp rounded mx-auto d-block img-thumbnail" src="<?php echo base_url($img_src);?>">
						<div class="h5 my-2">
							<?php
								echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
								echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
								echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
							?>
						</div>
						<div class="">
							<a class="" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
						</div>
						<div class="">
							<a class="" href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a>
							<a href="tel:<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?>"><?php echo isset($row['user_phone2']) ? ' / '.$row['user_phone2'] : ''; ?></a>
						</div>
						<div class="">Employee ID - <?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : ''; ?></div>
						<div class="">Designation - <?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
						<div class="">Department - <?php echo isset($row['department_name']) ? $row['department_name'] : ''; ?></div>
					</div>
				</div>

				
				

				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
				<?php echo form_hidden('form_action', 'update_profile'); ?>
				<?php echo form_hidden('user_email', $row['user_email']); ?>        
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_firstname" class="required">First Name</label>
						<?php echo form_input(array( 'name' => 'user_firstname', 'value' => isset($_POST['user_firstname']) ? set_value('user_firstname') : $row['user_firstname'], 'id' => 'user_firstname', 'class' => 'form-control', 'maxlength' => '30', 'placeholder' => '', )); ?>
						<?php echo form_error('user_firstname'); ?>
					</div>
					
					<div class="form-group col-lg-6">
						<label for="user_lastname" class="required">Last Name</label>
						<?php echo form_input(array( 'name' => 'user_lastname', 'value' => isset($_POST['user_lastname']) ? set_value('user_lastname') : $row['user_lastname'], 'id' => 'user_lastname', 'class' => 'form-control', 'maxlength' => '50', 'placeholder' => '', )); ?>
						<?php echo form_error('user_lastname'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_designation" class="optional">Designation </label>
						<?php echo form_dropdown('user_designation', $arr_designations, isset($_POST['user_designation']) ? set_value('user_designation') : $row['user_designation'], array( 'class' => 'form-control', )); ?> 
						<?php echo form_error('user_designation'); ?>
					</div>	

					<div class="form-group col-lg-6">
						<label for="user_department" class="optional">Department </label>
						<?php echo form_dropdown('user_department', $arr_departments, isset($_POST['user_department']) ? set_value('user_department') : $row['user_department'] , array( 'class' => 'form-control' )); ?>
						<?php echo form_error('user_department'); ?>
					</div>
				</div>

				<div class="form-row">
						<div class="form-group col-lg-6">
							<label for="user_dob" class="required">Date of Birth</label>
							<?php echo form_input(array( 'name' => 'user_dob', 'value' => isset($_POST['user_dob']) ? set_value('user_dob') : $this->common_lib->display_date($row['user_dob']), 'id' => 'user_dob', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => 'dd-mm-yyyy', 'autocomplete'=>'off', 'readonly'=>true )); ?>
							<?php echo form_error('user_dob');?>
						</div>
						<div class="form-group col-lg-6">
							<label for="gender" class="required">Gender</label>
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
				</div>
					
				<div class="form-row">
					<div class="form-group col-lg-6 ci-select2">
						<label for="" class="optional">Supervisor / Level 1 Approver</label>
						<?php echo form_dropdown('user_supervisor_id', $user_arr, isset($approver['user_supervisor_id']) ? $approver['user_supervisor_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_supervisor_id')); ?> 
						<?php echo form_error('user_supervisor_id'); ?>
					</div>
					<div class="form-group col-lg-6 ci-select2">
						<label for="" class="optional">Director / Level 2 Approver</label>
						<?php echo form_dropdown('user_director_approver_id', $user_arr, isset($approver['user_director_approver_id']) ? $approver['user_director_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_director_approver_id')); ?> 
						<?php echo form_error('user_director_approver_id'); ?>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-lg-6 ci-select2">
						<label for="" class="optional">HR Approver</label>
						<?php echo form_dropdown('user_hr_approver_id', $user_arr, isset($approver['user_hr_approver_id']) ? $approver['user_hr_approver_id'] : set_value('user_hr_approver_id') ,array('class' => 'form-control select2-control', 'id'=>'user_hr_approver_id')); ?> 
						<?php echo form_error('user_hr_approver_id'); ?>
					</div>
					<div class="form-group col-lg-6 ci-select2">
						<label for="" class="optional">Finance Approver</label>
						<?php echo form_dropdown('user_finance_approver_id', $user_arr, isset($approver['user_finance_approver_id']) ? $approver['user_finance_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_finance_approver_id')); ?> 
						<?php echo form_error('user_finance_approver_id'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-6">
						<label for="user_doj" class="optional">Date of Joining </label>
						<?php echo form_input(array( 'name' => 'user_doj', 'value' => isset($_POST['user_doj']) ? set_value('user_doj') : $this->common_lib->display_date($row['user_doj']), 'id' => 'user_doj', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => '', 'autocomplete'=>'off', 'readonly'=>true )); ?>
						<?php echo form_error('user_doj'); ?>
					</div>

					<div class="form-group col-lg-6">
						<label for="user_employment_type" class="optional">Employment Type </label>
						<?php echo form_dropdown('user_employment_type', $arr_employment_types, isset($_POST['user_employment_type']) ? set_value('user_employment_type') : $row['user_employment_type'] , array( 'class' => 'form-control' )); ?>
						<?php echo form_error('user_employment_type'); ?>
					</div>
				</div>

				<div class="form-group">
				<?php if($row['id'] != $this->common_lib->get_sess_user('id')){?>
						<label class="form-group col-lg-6">
							<label for="user_status" class="required">Account Status</label>
							<div class="">
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = isset($_POST['user_status']) ? $_POST['user_status'] == 'Y' : ($row['user_status'] == 'Y');
										echo form_radio(array('name' => 'user_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_status', 'Y'));
									?>
									<label class="custom-control-label" for="Y">Active</span></label>
								</div>
								
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										$radio_is_checked = isset($_POST['user_status']) ? $_POST['user_status'] == 'N' : ($row['user_status'] == 'N');
										echo form_radio(array('name' => 'user_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_status', 'N'));
									?>
									<label class="custom-control-label" for="N">Inactive</span></label>
								</div>
							</div>
							<?php echo form_error('user_status'); ?>
						</label>
						<?php } else{
							echo form_hidden('user_status', $row['user_status']);
						} ?>
				</div>

				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage');?>" class="btn btn-light ci-btn-cancel">Cancel</a>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/close_account/'.@$this->encrypt->encode($row['id']));?>" class="btn btn-light">Delete Account</a>
				<?php echo form_close(); ?>
			
			</label><!--./card-body-->
		</label><!--/.card-->
	</label><!--/.col-->
</label><!--/.row-->