<?php
   $row = $row[0];
   $user_row = $row;
   //print_r($address);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

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
		<div class="card user-profile-card">
			<div class="card-header">
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
					<div class="col-md-2">
						<img class="align-self-center mr-3 rounded dp" src="<?php echo base_url($img_src);?>">
						<div class=""><a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile_pic');?>"><i class="fa fa-pencil"></i> Change</a></div>
					</div>
					<div class="col-md-10">
						<div class="h5">
							<?php
								//echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
								echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
								echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
								echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
							?>
						</div>
						<!--<div class="small"><?php //echo isset($row['role_name']) ? $row['role_name'] : ''; ?></div>-->
						<div class="">Employee ID : <?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : ''; ?></div>
						<div class="">Designation : <?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
						<div class="">
							<i class="fa fa-envelope-o" aria-hidden="true"></i> 
							<a class="" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
						</div>
						<div class="">
							<i class="fa fa-phone" aria-hidden="true"></i>
							<a class="" href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a>
							<a href="tel:<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?>"><?php echo isset($row['user_phone2']) ? ' / '.$row['user_phone2'] : ''; ?></a>        
						</div>            
						<div class="d-none">
							<?php echo (isset($row['user_bio']) && strlen($row['user_bio'])>0) ? '<span class="text-muted">'.$row['user_bio'].'</span>' : ''; ?>							
						</div>
					</div>
				</div>
			</div><!--/.card-header-->
			
			<div class="card-body d-none"></div><!--/.card-body-->			
		</div><!--/.card-->

		<div id="accordion">
			<div class="card ">
				<div class="card-header" id="heading_1" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1">
					<a href="#heading_1" class="h6"><i class="fa fa-info" aria-hidden="true"></i> Basic Info</a>
				</div><!--/.card-header-->

				<div id="collapse_1" class="collapse show" aria-labelledby="heading_1" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
							<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>"> Edit</a>
							<!--<h6>Basic Info</h6><hr>-->		
							<dl class="row">
								<dt class="col-md-2">Name</dt>
								<dd class="col-md-10">
									<?php
									echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
									echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
									echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
									echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
									?>
								</dd>
								<dt class="col-md-2">Employee ID</dt>
								<dd class="col-md-10"><?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : '-'; ?></dd>
								<dt class="col-md-2">Date of Joining</dt>
								<dd class="col-md-10"><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></dd>
								<dt class="col-md-2">Designation</dt>
								<dd class="col-md-10"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></dd>
								<dt class="col-md-2">Email (Work)</dt>
								<dd class="col-md-10"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?></a></dd>
								<dt class="col-md-2">Mobile (Work)</dt>
								<dd class="col-md-10"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : '-'; ?></dd>
								<dt class="col-md-2">Email (Personal)</dt>
								<dd class="col-md-10"><a href="mailto:<?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?>"><?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?></a></dd>			
								<dt class="col-md-2">Mobile (Personal)</dt>
								<dd class="col-md-10"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '-'; ?></dd>						
								<dt class="col-md-2">Date of Birth</dt>
								<dd class="col-md-10">
								<?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob']) : '-'; ?>
								</dd>
								<dt class="col-md-2">Gender</dt>
								<dd class="col-md-10"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></dd>
								<dt class="col-md-2">Blood Group</dt>
								<dd class="col-md-10"><?php echo isset($row['user_blood_group']) ? $row['user_blood_group'] : ''; ?></dd>
								
							</dl><!--/dl.row-->
							
							</div>
						</div>
					</div><!--/.card-body-->
				</div>
			</div><!--/.card-->
			<div class="card ">
				<div class="card-header" id="heading_2" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" aria-controls="collapse_2">
					<a href="#heading_2" class="h6"><i class="fa fa-map-marker" aria-hidden="true"></i> Communication Address</a>
				</div><!--/.card-header-->
				<div id="collapse_2" class="collapse" aria-labelledby="heading_2" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_address');?>"> Add</a>
								<!--<h6>Communication Address</h6><hr>-->
									<?php if(isset($address)){
										foreach($address as $key=>$addr){
										?>
											<dl class="row">
												<dt class="col-md-12"><?php echo isset($address_type[$addr['address_type']]) ? $address_type[$addr['address_type']] : 'Address'; ?></dt>
												<dd class="col-md-12">
													<div class="mt-2">
														<?php //echo isset($addr['name'])? $addr['name'].',&nbsp;' :'';?>
														<?php echo isset($addr['address']) ? $addr['address'] : '';?>
														<?php echo isset($addr['locality'])? ', '.$addr['locality'] : '';?>
														<?php echo isset($addr['city']) ? ', '.$addr['city'].', ' : '';?>
														<?php echo isset($addr['state_name']) ? $addr['state_name'] : '';?>
														<?php echo isset($addr['zip']) ? ' - '.$addr['zip'] : '';?>  
														<?php echo isset($addr['phone1'])? '<div>Phone: '.$addr['phone1'].'</div> ':'';?>                              
														<?php echo isset($addr['landmark'])? '<div>Landmark: '.$addr['landmark'].'</div> ':'';?>
													</div>
													<div class="mt-2 mb-2">
														<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_address/'.$addr["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
														<!--<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_address/'.$addr["id"]);?>" class="btn btn-outline-danger btn-sm ml-1"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>-->
													</div>
												</dd>												
											</dl><!--/dl.row-->
										<?php
										}
									}?>
							</div>
						</div>
					</div><!--/.card-body-->
				</div>
			</div><!--/.card-->
			<div class="card ">
				<div class="card-header" id="heading_3" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" aria-controls="collapse_3">
					<a href="#heading_3" class="h6"><i class="fa fa-certificate" aria-hidden="true"></i> Education</a>
				</div><!--/.card-header-->
				<div id="collapse_3" class="collapse" aria-labelledby="heading_3" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_education');?>"> Add</a>
									<?php /*if(isset($education)){
										foreach($education as $key=>$edu){
										?>
											<dl class="row">
												<dt class="col-md-12"><?php echo isset($edu['qualification_name'])?$edu['qualification_name']: ' ';?> : <?php echo isset($edu['degree_name'])?$edu['degree_name']:'';?> <?php echo isset($edu['academic_from_year']) ? $edu['academic_from_year'].'-'.$edu['academic_to_year']:'';?></dt>
												<dd class="col-md-12">
													<div class=""><?php echo isset($edu['specialization_name'])?$edu['specialization_name']:'';?></div>
													<div class=""><?php echo isset($edu['institute_name']) ? $edu['institute_name']: '';?></div>
													<div class=""><?php echo isset($edu['academic_marks_percentage'])?$edu['academic_marks_percentage'].' %':'';?></div>
													<div class="mt-2 mb-2">
													<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
													<!--<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_education/'.$edu["id"]);?>" class="btn btn-outline-danger btn-sm ml-1"><i class="fa fa-trash" aria-hidden="true"> Delete</i></a>-->
													</div>
												</dd>												
											</dl><!--/dl.row-->
										<?php
										}
									}*/?>

									<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-dark">
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
														<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>
													</tr>
													<?php
													}
												}?>
												
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div><!--/.card-body-->
				</div>
			</div><!--/.card-->
			<div class="card ">
				<div class="card-header" id="heading_4" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" aria-controls="collapse_4">
					<a href="#heading_4" class="h6"><i class="fa fa-briefcase" aria-hidden="true"></i> Work Experience</a>
				</div><!--/.card-header-->
				<div id="collapse_4" class="collapse" aria-labelledby="heading_4" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_work_experience');?>"> Add</a>
								<?php /*
								<dl class="row">
									<dt class="col-md-12">United Exploration India Pvt Ltd</dt>
									<dd class="col-md-12">
										<div class="row">
											<div class="col-md-9">
												<div class=""><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></div>													
												</div>
											<div class="col-md-3">
												<?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']).' to Present' : '-'; ?>
											</div>
										</div>
									</dd>												
								</dl><!--/dl.row-->

								<?php //print_r($job_exp);?>
								<?php if(isset($job_exp)){
										foreach($job_exp as $key=>$row){
										?>
											<dl class="row">
												<dt class="col-md-12">																										
													<?php echo isset($row['company_name'])? $row['company_name']: ' ';?><br>												
												</dt>
												<dd class="col-md-12">
													<div class="row">
														<div class="col-md-9">
															<div class=""><?php echo isset($row['designation_name']) ? $row['designation_name'] : '';?></div>																
																<div class="mt-1">
																	Key Roles  : 
																	<?php echo isset($row['job_description']) ? $row['job_description'] : '';?>
																</div>
															</div>
														<div class="col-md-3"><?php echo isset($row['from_date']) ? $this->common_lib->display_date($row['from_date']).' to '.$this->common_lib->display_date($row['to_date']):'';?></div>
													</div>
													
													<div class="mt-2 mb-2">
													<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_work_experience/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>													
													</div>
												</dd>												
											</dl><!--/dl.row-->
										<?php
										}
									}?>
									*/ ?>


									<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-dark">
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
													<td>Present</td>
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
															<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_work_experience/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>
														</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->


							</div>
						</div>
					</div><!--/.card-body-->
				</div>
			</div><!--/.card-->
			<div class="card ">
				<div class="card-header" id="heading_5" data-toggle="collapse" data-target="#collapse_5" aria-expanded="true" aria-controls="collapse_5">
					<a href="#heading_5" class="h6"><i class="fa fa-credit-card" aria-hidden="true"></i> Bank Account</a>
				</div><!--/.card-header-->
				<div id="collapse_5" class="collapse" aria-labelledby="heading_5" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_bank_account');?>"> Add</a>
								<?php //print_r($bank_details);?>
								<?php $uni = isset($user_national_identifiers) ? $user_national_identifiers[0] : ''; ?>
								
								<dl class="row">
									<dt class="col-md-2">PAN No</dt>
									<dd class="col-md-10">
										<?php echo isset($uni['user_pan_no']) ? $uni['user_pan_no'] : '-';?>
									</dd>
									<dt class="col-md-2">Aadhar No</dt>
									<dd class="col-md-10">
										<?php echo isset($uni['user_aadhar_no']) ? $uni['user_aadhar_no'] : '-';?>
									</dd>
									<dt class="col-md-2">Passport No</dt>
									<dd class="col-md-10">
										<?php echo isset($uni['user_passport_no']) ? $uni['user_passport_no'] : '-';?>
									</dd>
									<dt class="col-md-2">UAN No (PF)</dt>
									<dd class="col-md-10">
										<?php echo isset($uni['user_uan_no']) ? $uni['user_uan_no'] : '-';?>
									</dd>
								</dl>

								<div class="table-responsive-sm">
										<table class="table table-striped">
											<thead class="thead-dark">
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
															<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_bank_account/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>
														</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div><!--/.card-body-->
				</div>
			</div><!--/.card-->
			<div class="card ">
				<div class="card-header" id="heading_6" data-toggle="collapse" data-target="#collapse_6" aria-expanded="true" aria-controls="collapse_6">
					<a href="#heading_6" class="h6"><i class="fa fa-pie-chart" aria-hidden="true"></i> Others</a>
				</div><!--/.card-header-->
				<div id="collapse_6" class="collapse" aria-labelledby="heading_6" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<dl class="row">
									<dt class="col-sm-2">Account/Login Status</dt>
									<dd class="col-sm-10"><?php echo isset($user_row['user_account_active']) ? ($user_row['user_account_active']=='Y' ? 'Active' : ($user_row['user_account_active']=='N' ? 'Inactive' : '' )) : '-'; ?></dd>
									<dt class="col-sm-2">Registered on</dt>
									<dd class="col-sm-10"><?php echo isset($user_row['user_registration_date']) ? $this->common_lib->display_date($user_row['user_registration_date'],true) : '-'; ?></dd>									
									<dt class="col-sm-2">Registered from IP</dt>
									<dd class="col-sm-10"><?php echo isset($user_row['user_registration_ip']) ? $user_row['user_registration_ip'] : '-'; ?></dd>
									<dt class="col-sm-2">Last Login Date Time</dt>
									<dd class="col-sm-10"><?php echo isset($user_row['user_login_date_time']) ? $this->common_lib->display_date($user_row['user_login_date_time'],true) : '-'; ?></dd>
									<dt class="col-sm-2">User Archived</dt>
									<dd class="col-sm-10"><?php echo isset($user_row['user_archived']) ? ($user_row['user_archived']=='Y' ? 'Yes' : ($user_row['user_archived']=='N' ? 'No' : '' )) : '-'; ?></dd>
								</dl>
							</div>
						</div>
					</div><!--/.card-body-->
				</div>
			</div><!--/.card-->
		</div> <!--/#accordion-->

	</div>
</div><!--/.row-->