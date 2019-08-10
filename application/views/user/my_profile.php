<?php
   $row = $row[0];
   $user_row = $row;
   //print_r($address);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
   <div class="col-12">
      <?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>             
   </div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="card ci-card user-profile-card">
			<div class="card-header profile-header">
				<div class="row">
					<div class="col-lg-2">
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
						<img class="align-self-center dp img-thumbnail d-block mb-2" src="<?php echo base_url($img_src);?>">
						<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile_pic');?>" data-toggle="tooltip" title="Change or remove this profile image"><i class="fa fa-camera"></i> Change</a>
					</div>

					<div class="col-lg-10">
						<div class="row">
							<div class="col-lg-6">
								<h5>
									<?php
										//echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
										echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
										echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
										echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
									?>
								</h5>
								<div class="">Employee ID : <?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : ''; ?></div>
								<div class="">Designation : <?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
								<div class="">
									<i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i> 
									<a class="" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
								</div>
								<div class="">
									<i class="fa fa-fw fa-phone" aria-hidden="true"></i>
									<a class="" href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a>
									<a href="tel:<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?>"><?php echo isset($row['user_phone2']) ? ' / '.$row['user_phone2'] : ''; ?></a>        
								</div>
							</div>

							<div class="col-lg-6">
								<?php 
									$approver = isset($approvers[0]) ? $approvers[0] : null;
								?>
								<label class=""><i class="fa fa-user" aria-hidden="true"></i> Leave Approvers</label>
								<div class="">L1 Approver : <?php echo isset($approver) ? $approver['supervisor_firstname'].' '.$approver['supervisor_lastname'].' ('.$approver['supervisor_emp_id'].')':''; ?>
								</div>
								<div class="">L2 Approver : <?php echo isset($approver) ? $approver['director_firstname'].' '.$approver['director_lastname'].' ('.$approver['director_emp_id'].')' : ''; ?></div>
								<div class="d-none">HR : <?php echo isset($approver) ? $approver['hr_firstname'].' '.$approver['hr_lastname'].' ('.$approver['hr_emp_id'].')' : ''; ?></div>
								
								<div class="d-none">Finance : <?php echo isset($approver) ? $approver['finance_firstname'].' '.$approver['finance_lastname'].' ('.$approver['finance_emp_id'].')' : ''; ?></div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.card-header-->

			<div class="card-body">
				<nav>
					<div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><i class="fa fa-info-circle" aria-hidden="true"></i> Basic Info</a>			
						<a class="nav-item nav-link" id="nav-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</a>									
						<a class="nav-item nav-link" id="nav-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><i class="fa fa-certificate" aria-hidden="true"></i> Education</a>			
						<a class="nav-item nav-link" id="nav-4" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false"><i class="fa fa-briefcase" aria-hidden="true"></i> Experiences</a>
						<a class="nav-item nav-link" id="nav-5" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false"><i class="fa fa-credit-card" aria-hidden="true"></i> Salary A/C</a>
						<a class="nav-item nav-link" id="nav-7" data-toggle="tab" href="#tab-7" role="tab" aria-controls="tab-7" aria-selected="false"><i class="fa fa-medkit" aria-hidden="true"></i> Emergency Contacts</a>
						<?php if($this->common_lib->is_auth(array('view-user-account-stat'),false) == true){ ?>		
						<a class="nav-item nav-link" id="nav-6" data-toggle="tab" href="#tab-6" role="tab" aria-controls="tab-6" aria-selected="false"><i class="fa fa-pie-chart" aria-hidden="true"></i> Others</a>
						<?php } ?>
					</div>
				</nav>


				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="nav-1">
						<div class="row mt-3">
							<div class="col-md-12">
							<a class="btn btn-outline-secondary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit Basic Info</a>
							<!--<h6>Basic Info</h6><hr>-->		
							<dl class="row">
								<dt class="col-md-2">Name</dt>
								<dd class="col-md-4">
									<?php
									echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
									echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
									echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
									echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
									?>
								</dd>
								<dt class="col-md-2">Employee ID</dt>
								<dd class="col-md-4"><?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : '-'; ?></dd>
							
								<dt class="col-md-2">Date of Joining</dt>
								<dd class="col-md-4"><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></dd>
								<dt class="col-md-2">Designation</dt>
								<dd class="col-md-4"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></dd>
							
								<dt class="col-md-2">Email (Office)</dt>
								<dd class="col-md-4"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?></a></dd>
								<dt class="col-md-2">Mobile (Office)</dt>
								<dd class="col-md-4"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : '-'; ?></dd>
							
								<dt class="col-md-2">Email (Personal)</dt>
								<dd class="col-md-4"><a href="mailto:<?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?>"><?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?></a></dd>			
								<dt class="col-md-2">Mobile (Personal)</dt>
								<dd class="col-md-4"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '-'; ?></dd>						
							
								<dt class="col-md-2">Date of Birth</dt>
								<dd class="col-md-4">
								<?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob']) : '-'; ?>
								</dd>
								<dt class="col-md-2">Gender</dt>
								<dd class="col-md-4"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></dd>
							
								<dt class="col-md-2">Blood Group</dt>
								<dd class="col-md-4"><?php echo isset($row['user_blood_group']) ? $row['user_blood_group'] : ''; ?></dd>								
							</dl><!--/dl.row-->
							
							</div>
						</div>
					</div> <!--/#tab-1-->
					
					<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="nav-2">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_address');?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>

								<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-light">
												<tr>
												<th scope="col">Address Type</th>
												<th scope="col">Address</th>
												<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($address)){
													foreach($address as $key=>$addr){
													?>
													<tr>
														<td>
															<?php echo isset($address_type[$addr['address_type']]) ? $address_type[$addr['address_type']] : 'Address'; ?>
														</td>
														<td>
															<?php //echo isset($addr['name'])? $addr['name'].',&nbsp;' :'';?>
															<?php echo isset($addr['address']) ? $addr['address'] : '';?>
															<?php echo isset($addr['locality'])? ', '.$addr['locality'] : '';?>
															<?php echo isset($addr['city']) ? ', '.$addr['city'].', ' : '';?>
															<?php echo isset($addr['state_name']) ? $addr['state_name'] : '';?>
															<?php echo isset($addr['zip']) ? ' - '.$addr['zip'] : '';?>  
															<?php echo isset($addr['phone1'])? '<div>Phone: '.$addr['phone1'].'</div> ':'';?>
															<?php echo isset($addr['landmark'])? '<div>Landmark: '.$addr['landmark'].'</div> ':'';?>
														</td>
														<td>
															<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_address/'.$addr["id"]);?>" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit" aria-hidden="true"></i></a>
															<!--<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_address/'.$addr["id"]);?>" class="btn btn-outline-danger btn-sm ml-1"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>-->
														</td>
													</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div> <!--/#tab-2-->
					
					
					<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="nav-3">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_education');?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
									<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-light">
												<tr>
												<th scope="col">Degree & Specialization</th>
												<th scope="col">University/Board/Council</th>
												<th scope="col">Duration</th>
												<th scope="col">Marks</th>
												<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
											<?php if(isset($education)){
													foreach($education as $key=>$edu){
													?>
													<tr>
														<td>
															<?php echo isset($edu['qualification_name'])?$edu['qualification_name']: ' ';?> - <?php echo isset($edu['degree_name'])?$edu['degree_name']:'';?><br>
															<?php echo isset($edu['specialization_name'])?$edu['specialization_name']:'';?>
														</td>
														<td><?php echo isset($edu['institute_name']) ? $edu['institute_name']: '';?></td>
														<td><?php echo isset($edu['academic_from_year']) ? $edu['academic_from_year'].'-'.$edu['academic_to_year']:'';?></td>
														<td><?php echo isset($edu['academic_marks_percentage'])?$edu['academic_marks_percentage'].' %':'';?></td>
														<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit" aria-hidden="true"></i></a></td>
													</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div> <!--/#tab-3-->
					
					<div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="nav-4">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_work_experience');?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
									<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-light">
												<tr>
													<th scope="col">Employer</th>
													<th scope="col">Designation/Role</th>
													<th scope="col">From</th>
													<th scope="col">To</th>
													<th scope="col"></th>
												</tr>
												<tr>
													<td>United Exploration India Pvt. Ltd.</td>
													<td><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></td>
													<td><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></td>
													<td><?php echo isset($row['user_dor']) ? $this->common_lib->display_date($row['user_dor']) : '-'; ?></td>
													<td>-</td>
												</tr>
											</thead>
											<tbody>
												<?php if(isset($job_exp)){
													foreach($job_exp as $key=>$row){
													?>
														<tr>
															<td><?php echo isset($row['company_name'])? $row['company_name']: ' ';?></td>
															<td><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></td>
															<td><?php echo isset($row['from_date']) ? $this->common_lib->display_date($row['from_date']) :'';?></td>
															<td><?php echo isset($row['to_date']) ? $this->common_lib->display_date($row['to_date']) :'';?></td>															
															<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_work_experience/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit" aria-hidden="true"></i></a></td>
														</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div><!--/#tab-4-->

					<div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="nav-5">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_bank_account');?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
								<?php //print_r($bank_details);?>
								<?php $uni = isset($user_national_identifiers) ? $user_national_identifiers[0] : ''; ?>
								
								<dl class="row">
									<dt class="col-md-2">PAN No</dt>
									<dd class="col-md-4">
										<?php echo isset($uni['user_pan_no']) ? $uni['user_pan_no'] : '-';?>
									</dd>
									<dt class="col-md-2">Aadhar No</dt>
									<dd class="col-md-4">
										<?php echo isset($uni['user_aadhar_no']) ? $uni['user_aadhar_no'] : '-';?>
									</dd>
								
									<dt class="col-md-2">Passport No</dt>
									<dd class="col-md-4">
										<?php echo isset($uni['user_passport_no']) ? $uni['user_passport_no'] : '-';?>
									</dd>
									<dt class="col-md-2">UAN No (PF)</dt>
									<dd class="col-md-4">
										<?php echo isset($uni['user_uan_no']) ? $uni['user_uan_no'] : '-';?>
									</dd>
								</dl>

								<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-light">
												<tr>
													<th scope="col">Account Uses</th>
													<th scope="col">Account No</th>
													<th scope="col">Account Type</th>
													<th scope="col">IFSC</th>
													<th scope="col">Bank</th>
													<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
												<?php if(isset($bank_details)){
													foreach($bank_details as $key=>$row){
													?>
														<tr>
															<td><?php echo isset($row['account_uses'])? $account_uses[$row['account_uses']]: ' ';?></td>
															<td><?php echo isset($row['bank_account_no'])? $row['bank_account_no']: ' ';?></td>
															<td><?php echo isset($row['account_type']) ? $bank_ac_type[$row['account_type']] : '-'; ?></td>															
															<td><?php echo isset($row['ifsc_code']) ? $row['ifsc_code'] : '-'; ?></td>
															<td><?php echo isset($row['bank_name'])? $row['bank_name']: ' ';?></td>															
															<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_bank_account/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit" aria-hidden="true"></i></a></td>
														</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div><!--/#tab-5-->

					<?php if($this->common_lib->is_auth(array('view-user-account-stat'),false) == true){ ?>		
						<div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="nav-6">
							<div class="row mt-3">
								<div class="col-md-12">
									<dl class="row">
										<dt class="col-sm-2">User Status</dt>
										<dd class="col-sm-4">
											<?php echo isset($user_row['user_status']) ? '<span class="'.$user_status_arr[$user_row['user_status']]['css'].'">'.($user_status_arr[$user_row['user_status']]['text'] ).'</span>' : '-'; ?>
										</dd>
										<dt class="col-sm-2">Registered on</dt>
										<dd class="col-sm-4"><?php echo isset($user_row['user_registration_date']) ? $this->common_lib->display_date($user_row['user_registration_date'],true) : '-'; ?></dd>									
									
										<dt class="col-sm-2">Registered from IP</dt>
										<dd class="col-sm-4"><?php echo isset($user_row['user_registration_ip']) ? $user_row['user_registration_ip'] : '-'; ?></dd>
										<dt class="col-sm-2">Last Login Date Time</dt>
										<dd class="col-sm-4"><?php echo isset($user_row['user_login_date_time']) ? $this->common_lib->display_date($user_row['user_login_date_time'],true) : '-'; ?></dd>									
									</dl>
								</div>
							</div>
						</div><!--/#tab-6-->
					<?php } ?>

					<div class="tab-pane fade" id="tab-7" role="tabpanel" aria-labelledby="nav-7">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-outline-success btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_emergency_contact');?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
									<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-light">
												<tr>
												<th scope="col">Contact Person</th>
												<th scope="col">Relationship</th>
												<th scope="col">Contact Number(s)</th>
												<th scope="col">Communication Address</th>
												<th scope="col"></th>
												</tr>
											</thead>
											<tbody>
											<?php 
												if(isset($econtact) && sizeof($econtact)>0){
													foreach($econtact as $key=>$con){
													?>
													<tr>
														<td>
															<?php echo isset($con['contact_person_name'])?$con['contact_person_name']: ' ';?>
														</td>
														<td><?php echo isset($con['relationship']) ? $con['relationship']: '';?></td>
														
														<td>
															<?php echo isset($con['contact_person_phone1'])?$con['contact_person_phone1'] : '';?>

															<?php echo isset($con['contact_person_phone2']) && strlen($con['contact_person_phone2'])>0 ? ' / '.$con['contact_person_phone2'] : '';?>
														</td>
														<td><?php echo isset($con['contact_person_address']) ? $con['contact_person_address'] : '';?></td>
														<td>
															<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_emergency_contact/'.$con["id"]);?>" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-lg fa-edit" aria-hidden="true"></i></a>
															<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_emergency_contact/'.$con["id"]);?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-lg fa-trash" aria-hidden="true"></i></a>
													</td>
													</tr>
													<?php
													}
												}else{
													?>
													<tr>
														<td colspan="5">No records found</td>
													</tr>
													<?php
												}
											?>
												
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div> <!--/#tab-7-->
				</div><!--/.tab-content-->
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->