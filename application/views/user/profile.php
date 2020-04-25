<?php
   $row = $row[0];
   $user_row = $row;
   //print_r($address);
?>
<?php 
	// Display profile tab
	$display_address = false;
	$display_education = false;
	$display_experience = false;
	$display_salary_ac = false;
	$display_uploaded_files = false;
	$display_emergency_contact = false;
	$display_others = false;
	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-user-address'),false) == true){
			$display_address = true;
		}else{
			$display_address = false;
		}
	}else{
		$display_address = true;
	}

	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-user-education'),false) == true){
			$display_education = true;
		}else{
			$display_education = false;
		}
	}else{
		$display_education = true;
	}
	
	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-user-exp'),false) == true){
			$display_experience = true;
		}else{
			$display_experience = false;
		}
	}else{
		$display_experience = true;
	}

	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-user-bank'),false) == true){
			$display_salary_ac = true;
		}else{
			$display_salary_ac = false;
		}
	}else{
		$display_salary_ac = true;
	}

	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-user-uploads'),false) == true){
			$display_uploaded_files = true;
		}else{
			$display_uploaded_files = false;
		}
	}else{
		$display_uploaded_files = false;
	}

	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-emergency-contacts'),false) == true){
			$display_emergency_contact = true;
		}else{
			$display_emergency_contact = false;
		}
	}else{
		$display_emergency_contact = true;
	}

	if($is_self_account !== true){
		if($this->common_lib->is_auth(array('view-user-account-stat'),false) == true){
			$display_others = true;
		}else{
			$display_others = false;
		}
	}else{
		$display_others = true;
	}
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card ci-dl">
			<div class="card-header">Profile Card</div>
			<div class="card-body">
			
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<div class="row">
					<div class="col-lg-3 text-center mb-3">
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
						<img class="dp rounded mx-auto d-block img-thumbnail" src="<?php echo base_url($img_src);?>">
						<?php if($is_self_account == true) { ?>
						<a class="small" href="<?php echo base_url($this->router->directory.$this->router->class.'/profile_pic');?>" data-toggle="tooltip" title="Change or remove this photo"><i class="fas fa-camera"></i> Change</a>
						<?php } ?>
						<div class="h6 mt-3 mb-0">
							<?php
								//echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
								echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
								echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
								echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
							?>
						</div>
						<div class="">
							<a class="" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
						</div>
						<div class="">
							<?php echo isset($row['user_phone1']) && strlen($row['user_phone1']) > 0 ? $row['user_phone1'] : ''; ?>
							<?php echo isset($row['user_phone2']) && strlen($row['user_phone2']) > 0 ? ' / '.$row['user_phone2'] : ''; ?>
						</div>
						<div class="small">Emp ID - <?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : ''; ?></div>
						<div class="small"><?php echo isset($row['employment_type_name']) ? $row['employment_type_name'] : ''; ?></div>
						<div class="small">Designation - <?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
						<div class="small">Department - <?php echo isset($row['department_name']) ? $row['department_name'] : ''; ?></div>

						<?php if($is_self_account == true) { ?>
							<a class="btn btn-sm btn-outline-primary mt-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit Basic Information</a>
						<?php } ?>
						
					</div><!--/.col-lg-3-->
					<div class="col-lg-9">
						<nav>
							<div class="nav nav-tabs ci-nav-tab small" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><i class="fas fa-info-circle" aria-hidden="true"></i> Basic Info</a>

								<?php if($display_address == true){  ?>
								<a class="nav-item nav-link" id="nav-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><i class="fas fa-map-marker" aria-hidden="true"></i> Address</a>
								<?php } ?>

								<?php if($display_education == true){  ?>
								<a class="nav-item nav-link" id="nav-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><i class="fas fa-certificate" aria-hidden="true"></i> Education</a>
								<?php } ?>

								<?php if($display_experience == true){  ?>
								<a class="nav-item nav-link" id="nav-4" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false"><i class="fas fa-briefcase" aria-hidden="true"></i> Experiences</a>
								<?php } ?>
								
								<?php if($display_salary_ac == true){  ?>
								<a class="nav-item nav-link" id="nav-5" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false"><i class="fas fa-credit-card" aria-hidden="true"></i> Salary A/C</a>
								<?php } ?>

								<?php if($display_emergency_contact == true){  ?>
								<a class="nav-item nav-link" id="nav-7" data-toggle="tab" href="#tab-7" role="tab" aria-controls="tab-7" aria-selected="false"><i class="fas fa-medkit" aria-hidden="true"></i> Emergency Contacts</a>
								<?php } ?>

								<?php if($display_uploaded_files == true){  ?>
								<a class="nav-item nav-link" id="nav-8" data-toggle="tab" href="#tab-8" role="tab" aria-controls="tab-7" aria-selected="false"><i class="fas fa-file-alt" aria-hidden="true"></i> Docs</a>
								<?php } ?>

								<?php if($display_others == true){  ?>
								<a class="nav-item nav-link" id="nav-6" data-toggle="tab" href="#tab-6" role="tab" aria-controls="tab-6" aria-selected="false"><i class="fas fa-list-ul" aria-hidden="true"></i> Others</a>
								<?php } ?>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="nav-1">
								<div class="row mt-3">
									<div class="col-lg-12">
										
										<dl class="row">
											<dt class="col-lg-2">Name</dt>
											<dd class="col-lg-4">
												<?php
												echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
												echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
												echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
												echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
												?>
											</dd>
											<dt class="col-lg-2">Employee ID</dt>
											<dd class="col-lg-4"><?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : '-'; ?></dd>
										
											<dt class="col-lg-2">Date of Joining</dt>
											<dd class="col-lg-4"><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></dd>
											<dt class="col-lg-2">Desg.</dt>
											<dd class="col-lg-4"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></dd>

											<dt class="col-lg-2">Emp Type</dt>
											<dd class="col-lg-4"><?php echo isset($row['employment_type_name']) ? $row['employment_type_name'] : '-'; ?></dd>
											<dt class="col-lg-2">Dept.</dt>
											<dd class="col-lg-4"><?php echo isset($row['department_name']) ? $row['department_name'] : '-'; ?></dd>

											<dt class="col-lg-2">Email (office)</dt>
											<dd class="col-lg-4"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?></a></dd>
											<dt class="col-lg-2">Mobile (office)</dt>
											<dd class="col-lg-4"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : '-'; ?></dd>
										
											<dt class="col-lg-2">Email (personal)</dt>
											<dd class="col-lg-4"><a href="mailto:<?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?>"><?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?></a></dd>			
											<dt class="col-lg-2">Mobile (personal)</dt>
											<dd class="col-lg-4"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '-'; ?></dd>						
											
											<dt class="col-lg-2"><?php echo ($is_self_account == true) ? "Date of Birth" : "Birth Day";?></dt>
											<dd class="col-lg-4">
											<?php if($is_self_account == true) {?>	
											<?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob']) : '-'; ?>
											<?php } else{?>
											<?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob'],NULL, TRUE) : '-'; ?>
											<?php } ?>
											</dd>

											<dt class="col-lg-2">Gender</dt>
											<dd class="col-lg-4"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></dd>
										
											<dt class="col-lg-2">Blood Group</dt>
											<dd class="col-lg-4"><?php echo isset($row['user_blood_group']) ? $row['user_blood_group'] : ''; ?></dd>								
										</dl><!--/dl.row-->
									</div>
								</div>
							</div> <!--/#tab-1-->
							
							<?php if($display_address == true){  ?>
							<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="nav-2">
								<div class="row mt-3">
									<div class="col-lg-12">
										<?php if($is_self_account == true) { ?>
										<a class="btn btn-outline-success btn-sm" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_address');?>"><i class="fas fa-plus" aria-hidden="true"></i> Add New</a>
										<?php } ?>
										<?php if(isset($address)){
											foreach($address as $key=>$addr){
											?>
											<div class="user-profile-section">
												<div class="section-heading">
													<?php echo isset($address_type[$addr['address_type']]) ? $address_type[$addr['address_type']] : 'Address'; ?>

													<?php if($is_self_account == true) { ?>
														<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_address/'.$addr["id"]);?>" class="btn-action" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</a>
														<!-- <a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_address/'.$addr["id"]);?>" class="btn btn-link btn-sm"><i class="fas fa-trash-o" aria-hidden="true"></i> Delete</a> -->
													<?php } ?>
												</div>
												<div>
													<?php //echo isset($addr['name'])? $addr['name'].',&nbsp;' :'';?>
													<?php echo isset($addr['address']) ? $addr['address'] : '';?>
													<?php echo isset($addr['locality'])? ', '.$addr['locality'] : '';?>
													<?php echo isset($addr['city']) ? ', '.$addr['city'].', ' : '';?>
													<?php echo isset($addr['state_name']) ? $addr['state_name'] : '';?>
													<?php echo isset($addr['zip']) ? ' - '.$addr['zip'] : '';?>  
													<?php echo isset($addr['phone1'])? '<div>Phone - '.$addr['phone1'].'</div> ':'';?>
													<?php echo isset($addr['landmark'])? '<div>Landmark - '.$addr['landmark'].'</div> ':'';?>
												</div>
											</div>
											<?php
											}
										}?>
									</div>
								</div>
							</div> <!--/#tab-2-->
							<?php } ?>
							
							<?php if($display_education == true){  ?>
							<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="nav-3">
								<div class="row mt-3">
									<div class="col-lg-12">
										<?php if($is_self_account == true) { ?>
										<a class="btn btn-outline-success btn-sm" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_education');?>"><i class="fas fa-plus" aria-hidden="true"></i> Add New</a>
										<?php } ?>
										
										<?php if(isset($education)){
											foreach($education as $key=>$edu){
											?>
											<div class="user-profile-section">
												<div class="section-heading">
												<?php echo isset($edu['qualification_name'])?$edu['qualification_name']: ' ';?> - <?php echo isset($edu['degree_name'])?$edu['degree_name']:'';?>
												<?php echo isset($edu['academic_from_year']) ? '('.$edu['academic_from_year'].'-'.$edu['academic_to_year'].')':'';?>
												<?php if($is_self_account == true) { ?>
													<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn-action" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</a>
												<?php } ?>
												</div>
												<div>
													<?php echo isset($edu['specialization_name'])?$edu['specialization_name']:'';?>
												</div>
												<div>
													<?php echo isset($edu['institute_name']) ? $edu['institute_name']: '';?>
												</div>
												<div>
													<?php echo isset($edu['academic_marks_percentage'])?$edu['academic_marks_percentage'].' %':'';?>
												</div>
											</div>
											<?php
											}
										}?>
									</div>
								</div>
							</div> <!--/#tab-3-->
							<?php } ?>
							
							<?php if($display_experience == true){  ?>
							<div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="nav-4">
								<div class="row mt-3">
									<div class="col-lg-12">
									<?php if($is_self_account == true) { ?>
										<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_work_experience');?>"><i class="fas fa-plus" aria-hidden="true"></i> Add New</a>
									<?php } ?>

											<div class="user-profile-section">
												<div class="section-heading">
													<?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?>
													
												</div>
												<div class="">
													United Exploration India Pvt. Ltd.
												</div>
												<div class="text-muted">
													<?php echo isset($row['user_doj']) ? ' '.$this->common_lib->display_date($row['user_doj'],NULL, NULL).' to ' : '-'; ?>
													<?php echo isset($row['user_dor']) ? ' '.$this->common_lib->display_date($row['user_dor'],NULL, NULL) : 'till date'; ?>
												</div>
											</div>
											
											<?php if(isset($job_exp)){
												foreach($job_exp as $key=>$row){
												?>
												<div class="user-profile-section">
														<div class="section-heading">
															<?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?>
															<?php if($is_self_account == true) { ?>		
															<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_work_experience/'.$row["id"]);?>" class="btn-action" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</a>
															<?php } ?>
														</div>
														<div class="">
															<?php echo isset($row['company_name'])? $row['company_name']: ' ';?>
														</div>
														<div class="text-muted">
															<?php echo isset($row['from_date']) ? ' '.$this->common_lib->display_date($row['from_date'],NULL, NULL).' to ' : '-'; ?>
															<?php echo isset($row['to_date']) ? ' '.$this->common_lib->display_date($row['to_date'], NULL, NULL) : 'till date'; ?>
														</div>
													</div>
												<?php
												}
											}?>
									</div>
								</div>
							</div><!--/#tab-4-->
							<?php } ?>
							
							<?php if($display_salary_ac == true){  ?>
							<div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="nav-5">
								<div class="row mt-3">
									<div class="col-lg-12">
									<?php if($is_self_account == true) { ?>
										<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_bank_account');?>"><i class="fas fa-plus" aria-hidden="true"></i> Add New</a>
									<?php } ?>
										<?php //print_r($bank_details);?>
										<?php $uni = isset($user_national_identifiers) ? $user_national_identifiers[0] : ''; ?>
										
										<dl class="row">
											<dt class="col-lg-2">PAN No</dt>
											<dd class="col-lg-4">
												<?php echo isset($uni['user_pan_no']) ? $uni['user_pan_no'] : '-';?>
											</dd>
											<dt class="col-lg-2">UAN No (PF)</dt>
											<dd class="col-lg-4">
												<?php echo isset($uni['user_uan_no']) ? $uni['user_uan_no'] : '-';?>
											</dd>
										</dl>
										<?php if(isset($bank_details)){
											foreach($bank_details as $key=>$row){
											?>
												<div class="user-profile-section">
													<div class="section-heading">
														<?php echo isset($row['bank_name'])? $row['bank_name']: ' ';?>
														<?php echo isset($row['ifsc_code']) ? '('.$row['ifsc_code'].')' : '-'; ?>
														<?php if($is_self_account == true) { ?>	<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_bank_account/'.$row["id"]);?>" class="btn-action" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</a>	<?php } ?>
													</div>
													<div class="text-muted small">
													<?php echo isset($row['account_uses'])? $account_uses[$row['account_uses']]: ' ';?>
													</div>
													<div class="">
														<?php echo isset($row['account_type']) ? $bank_ac_type[$row['account_type']] : '-'; ?>
													</div>
													<div>
														A/C No - <?php echo isset($row['bank_account_no'])? $row['bank_account_no']: ' ';?>
													</div>
												</div>
											<?php
											}
										}?>
									</div>
								</div>
							</div><!--/#tab-5-->
							<?php } ?>

							<?php if($display_others == true){  ?>
								<div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="nav-6">
									<div class="row mt-3">
										<div class="col-lg-12">
											<dl class="row">
												<dt class="col-sm-3">Account status</dt>
												<dd class="col-sm-3">
													<?php echo isset($user_row['user_status']) ? $user_status_arr[$user_row['user_status']]['text'] : '-'; ?>
												</dd>
												<dt class="col-sm-3">Registered on</dt>
												<dd class="col-sm-3"><?php echo isset($user_row['user_registration_date']) ? $this->common_lib->display_date($user_row['user_registration_date'],true) : '-'; ?></dd>									
											
												<dt class="col-sm-3">Registered from IP</dt>
												<dd class="col-sm-3"><?php echo isset($user_row['user_registration_ip']) ? $user_row['user_registration_ip'] : '-'; ?></dd>
												<dt class="col-sm-3">Last login</dt>
												<dd class="col-sm-3"><?php echo isset($user_row['user_login_date_time']) ? $this->common_lib->display_date($user_row['user_login_date_time'],true) : '-'; ?></dd>									
											</dl>
										</div>
									</div>
								</div><!--/#tab-6-->
							<?php } ?>

							<?php if($display_emergency_contact == true){  ?>
							<div class="tab-pane fade" id="tab-7" role="tabpanel" aria-labelledby="nav-7">
								<div class="row mt-3">
									<div class="col-lg-12">
										<?php if($is_self_account == true) { ?>
										<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_emergency_contact');?>"><i class="fas fa-plus" aria-hidden="true"></i> Add New</a>
										<?php } ?>




										<?php 
											if(isset($econtact) && sizeof($econtact)>0){
												foreach($econtact as $key=>$con){
												?>
												<div class="user-profile-section">
													<div class="section-heading">
														<?php echo isset($con['contact_person_name'])?$con['contact_person_name']: ' ';?>
														<?php if($is_self_account == true) { ?>
															<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_emergency_contact/'.$con["id"]);?>" class="btn-action"><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</a>
															<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_emergency_contact/'.$con["id"]);?>" class="btn-action"><i class="fas fa-times" aria-hidden="true"></i> Delete</a>
														<?php } ?>
													</div>
													<div class="text-muted small"><?php echo isset($con['relationship']) ? $con['relationship']: '';?></div>													
													<div>
														<?php echo isset($con['contact_person_address']) ? $con['contact_person_address'] : '';?>
													</div>
													<div>
														<?php echo isset($con['contact_person_phone1'])?$con['contact_person_phone1'] : '';?>
														<?php echo isset($con['contact_person_phone2']) && strlen($con['contact_person_phone2'])>0 ? ' / '.$con['contact_person_phone2'] : '';?>
													</div>
												</div>
												<?php
												}
											}else{
												?>
												<div>No records found</div>
												<?php
											}
										?>
									</div>
								</div>
							</div> <!--/#tab-7-->
							<?php } ?>
							
							<?php if($display_uploaded_files == true){  ?>
							<div class="tab-pane fade" id="tab-8" role="tabpanel" aria-labelledby="nav-8">
								<div class="row mt-3">
									<div class="col-lg-12">
										<?php
											if (isset($all_uploads) && sizeof($all_uploads) > 0) {
												foreach ($all_uploads as $key => $upload) {
											?>
											<div class="file-container row my-2" id="upload_grid_<?php echo $upload['id']; ?>">
												<div class="col-lg-6"><?php echo $arr_upload_file_type_name[$upload['upload_file_type_name']]; ?></div>
												<div class="col-lg-4">
													<div class="small">
														<div class="text-muted">
															<?php echo 'Uploaded on '.$this->common_lib->display_date($upload['upload_datetime'], true); ?>
														</div>
														<div class="text-muted">
															<?php echo $char_doc_verification[$upload['upload_is_verified']]; ?>
														</div>							
													</div>
												</div>
												<div class="col-lg-2">
													<?php
														$file_path = 'assets/uploads/'.$upload_related_to.'/docs/' . $upload_object_user_id . '/' . $upload['upload_file_name'];
														if (file_exists(FCPATH . $file_path)) {
															$file_src = base_url($file_path);
															$btn_class='';
														} else {
															$file_src = '#';
															$btn_class='disabled';	
														}
													?>
													
													<a data-target="window" target="_new" href="<?php echo $file_src;?>" title="<?php echo $upload['upload_file_type_name'];?>" data-file-name="<?php echo $upload['upload_file_name']; ?>" class="btn btn-sm view-download-btn btn-outline-secondary <?php echo $btn_class;?>"><i class="fas fa-download"></i> View</a>
												</div>
											</div>
											<?php } //foreach ?>
											<?php }else {?>
											<div class="row">
												<div class="col-lg-12">No documents uploaded...</div>
											</div>
											<?php }?>
									</div>
								</div>
							</div><!--/#tab-8-->
							<?php }  ?>

						</div><!--/.tab-content-->
					</div><!--/.col-lg-9-->
				</div><!--/.row-->
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->