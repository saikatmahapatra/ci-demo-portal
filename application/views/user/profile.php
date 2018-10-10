<?php
   $row = $row[0];
   $user_row = $row;
   //print_r($address);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
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
						<!--<div class=""><a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile_pic');?>"><i class="fa fa-pencil"></i> Change/Remove</a></div>-->
					</div>
					<div class="col-md-10">
						<div class="h6 mt-2">
							<?php
								echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
								echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
								echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
								echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
							?>
						</div>
						<!--<div class="small"><?php //echo isset($row['role_name']) ? $row['role_name'] : ''; ?></div>-->
						<div class=""><?php echo isset($row['user_emp_id']) ? 'Emp # '.$row['user_emp_id'] : ''; ?></div>
						<div class=""><?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
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
							<!--<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>">Edit</a>-->
						</div>
					</div>
				</div>
			</div><!--/.card-header-->
			<div class="card-body">
				<nav>
					
					<div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab" aria-controls="nav-basic" aria-selected="true">Basic Info</a>
					<?php if($this->common_lib->is_auth(array('view-user-address'),false) == true){ ?>		
					<a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false">Address</a>								
					<?php } ?>
					
					<?php  if($this->common_lib->is_auth(array('view-user-education'),false) == true){ ?>		
					<a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">Academic Records</a>			
					<?php } ?>
					
					<?php if($this->common_lib->is_auth(array('view-user-exp'),false) == true){ ?>		
					<a class="nav-item nav-link" id="nav-exp-tab" data-toggle="tab" href="#nav-exp" role="tab" aria-controls="nav-exp" aria-selected="false">Work Experience</a>
					<?php } ?>
					
					<?php if($this->common_lib->is_auth(array('view-user-bank'),false) == true){ ?>		
					<a class="nav-item nav-link" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank" aria-selected="false">Bank Account</a>
					<?php } ?>

					<?php if($this->common_lib->is_auth(array('view-user-account-stat'),false) == true){ ?>		
					<a class="nav-item nav-link" id="nav-account-stat-tab" data-toggle="tab" href="#nav-account-stat" role="tab" aria-controls="nav-account-stat" aria-selected="false">Account Statistics</a>
					<?php } ?>
					
					</div>
				</nav>

				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
						<div class="row mt-3">
							<div class="col-md-12">
							<!--<a class="btn btn-primary btn-sm" href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>"> Edit</a>-->
							<!--<h6>Basic Info</h6><hr>-->		
							<dl class="row">
								<dt class="col-sm-2">Name</dt>
								<dd class="col-sm-10">
									<?php
									echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
									echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
									echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
									?>
								</dd>
								<dt class="col-sm-2">Employee ID</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : '-'; ?></dd>
								<!--<dt class="col-sm-2">Date of Joining</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></dd>-->
								<dt class="col-sm-2">Designation</dt>
								<dd class="col-sm-10"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></dd>
								<dt class="col-sm-2">Email (Work)</dt>
								<dd class="col-sm-10"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?></a></dd>
								<dt class="col-sm-2">Mobile (Work)</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : '-'; ?></dd>
								<dt class="col-sm-2">Email (Personal)</dt>
								<dd class="col-sm-10"><a href="mailto:<?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?>"><?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?></a></dd>			
								<dt class="col-sm-2">Mobile (Personal)</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '-'; ?></dd>						
								<dt class="col-sm-2">Birth Day</dt>
								<dd class="col-sm-10">
								<?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob'],NULL, TRUE) : '-'; ?>
								</dd>
								<dt class="col-sm-2">Gender</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></dd>
								<dt class="col-sm-2">Blood Group</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_blood_group']) ? $row['user_blood_group'] : ''; ?></dd>
								
							</dl><!--/dl.row-->
							
							</div>
						</div>
					</div> <!--/#nav-basic-->
					
					<?php if($this->common_lib->is_auth(array('view-user-address'),false) == true){ ?>	
					<div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
						<div class="row mt-3">
							<div class="col-md-12">
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
												</dd>												
											</dl><!--/dl.row-->
										<?php
										}
									}?>
							</div>
						</div>
					</div> <!--/#nav-address-->
					<?php } ?>
					
					<?php if($this->common_lib->is_auth(array('view-user-education'),false) == true){ ?>	
					<div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
						<div class="row mt-3">
							<div class="col-md-12">
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
											<!--<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>-->
											<!--<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_education/'.$edu["id"]);?>" class="btn btn-outline-danger btn-sm ml-1"><i class="fa fa-trash" aria-hidden="true"> Delete</i></a>-->
											</div>
										</dd>												
									</dl><!--/dl.row-->
								<?php
								}
							}*/?>
								<div class="table-responsive-sm">
									<table class="table">
										<thead>
											<tr>
											<th scope="col">Degree & Specialization</th>												
											<th scope="col">University/Board/Council</th>
											<th scope="col">Duration</th>
											<th scope="col">Marks</th>
											<!--<th scope="col"></th>-->
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
													<!--<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>-->
												</tr>
												<?php
												}
											}?>
											
										</tbody>
									</table>
								</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div> <!--/#nav-education-->
					<?php } ?>
					
					<?php if($this->common_lib->is_auth(array('view-user-exp'),false) == true){ ?>	
					<div class="tab-pane fade" id="nav-exp" role="tabpanel" aria-labelledby="nav-exp-tab">
						<div class="row mt-3">
							<div class="col-md-12">
								<?php /* ?>
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
													
													<!--<div class="mt-2 mb-2">
													<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_work_experience/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>													
													</div>-->
												</dd>												
											</dl><!--/dl.row-->
										<?php
										}
									}?>
									<?php */?>
									<div class="table-responsive-sm">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">Employer</th>												
													<th scope="col">Designation/Role</th>
													<th scope="col">From</th>
													<th scope="col">To</th>
													<!--<th scope="col"></th>-->
												</tr>
												<tr>
													<td>United Exploration India Pvt. Ltd.</td>
													<td><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></td>
													<td><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></td>
													<td>Present</td>
													<!--<td>-</td>-->
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
															<!--<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_work_experience/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td>-->
														</tr>
													<?php
													}
												}?>
											</tbody>
										</table>
									</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div><!--/#nav-exp-->
					<?php } ?>

					<?php if($this->common_lib->is_auth(array('view-user-bank'),false) == true){ ?>	
					<div class="tab-pane fade" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
						<div class="row mt-3">
							<div class="col-md-12">
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
									<table class="table">
										<thead>
											<tr>
												<th scope="col">Account Uses</th>
												<th scope="col">Account No</th>
												<th scope="col">Account Type</th>
												<th scope="col">IFSC</th>
												<th scope="col">Bank</th>
												<!-- <th scope="col"></th> -->
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
														<!-- <td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_bank_account/'.$row["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a></td> -->
													</tr>
												<?php
												}
											}?>
										</tbody>
									</table>
								</div><!--/.table-responsive-sm-->
							</div>
						</div>
					</div><!--/#nav-bank-->
					<?php } ?>

					<?php if($this->common_lib->is_auth(array('view-user-account-stat'),false) == true){ ?>		
						<div class="tab-pane fade" id="nav-account-stat" role="tabpanel" aria-labelledby="nav-account-stat-tab">
							<div class="row mt-3">
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
						</div><!--/#nav-account-stat-->
					<?php } ?>

					
					</div><!--/.tab-content-->
			</div><!--/.carrd-body-->
		</div><!--/.card-->
	</div>
</div><!--/.row-->