<?php
   $row = $row[0];
   //print_r($address);
?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
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
						<div class=""><a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile_pic');?>"><i class="fa fa-pencil"></i> Change/Remove</a></div>
					</div>
					<div class="col-md-10">
						<h5 class="">
							<?php
								echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
								echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
								echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
								echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
							?>
						</h5>
						<!--<div class="small"><?php //echo isset($row['role_name']) ? $row['role_name'] : ''; ?></div>-->
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
						<div>
							<?php echo (isset($row['user_bio']) && strlen($row['user_bio'])>0) ? '<span class="text-muted">'.$row['user_bio'].'</span>' : ''; ?>
							<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>">Edit</a>
						</div>
					</div>
				</div>
			</div><!--/.card-header-->
			<div class="card-body">
				<nav>
					<div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab" aria-controls="nav-basic" aria-selected="true">Basic Information</a>			
						<a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false">Communication Address</a>			
						<!--<a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">Academic Details</a>			
						<a class="nav-item nav-link" id="nav-exp-tab" data-toggle="tab" href="#nav-exp" role="tab" aria-controls="nav-exp" aria-selected="false">Work Experience</a>-->
					</div>
				</nav>

				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
						<div class="row mt-3">
							<div class="col-md-12">
							<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_profile');?>"> Edit</a>
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
								<dt class="col-sm-2">Date of Joining</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_doj']) ? $this->common_lib->display_date($row['user_doj']) : '-'; ?></dd>
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
								<dt class="col-sm-2">Date of Birth</dt>
								<dd class="col-sm-10">
								<?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob']) : '-'; ?>
								</dd>
								<dt class="col-sm-2">Gender</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></dd>
								<dt class="col-sm-2">Blood Group</dt>
								<dd class="col-sm-10"><?php echo isset($row['user_blood_group']) ? $row['user_blood_group'] : ''; ?></dd>
								
							</dl><!--/dl.row-->
							
							</div>
						</div>
					</div> <!--/#nav-basic-->
					
					<div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm mb-3" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_address');?>"> Add New</a>
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
														<?php echo isset($addr['state']) ? $addr['state'] : '';?>
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
					</div> <!--/#nav-address-->
					
					
					<div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
						<div class="row mt-3">
							<div class="col-md-12">
								<a class="btn btn-primary btn-sm" href="<?php echo base_url($this->router->directory.$this->router->class.'/add_education');?>"> Add New</a>
								<!--<h6>Educational Qualification</h6><hr>-->
									<table class="table table-sm mt-1">
										<thead>
											<tr class="small">
												<th>Qualification</th>
												<th>Specialization</th>
												<th>Duration</th>
												<th>Institute/University</th>
												<th>Marks(%)</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($education)){
											foreach($education as $key=>$edu){
											?>
												<tr>
													<td><?php echo isset($edu['qualification_name'])?$edu['qualification_name']:'';?></td>
													<td><?php echo isset($edu['specialization_name'])?$edu['specialization_name']:$edu['academic_other_specialization'];?></td>
													<td><?php echo isset($edu['academic_from_year'])?$edu['academic_from_year'].'-'.$edu['academic_to_year']:'';?></td>
													<td><?php echo isset($edu['institute_name']) ? $edu['institute_name']: $edu['academic_other_inst'];?></td>
													<td><?php echo isset($edu['academic_marks_percentage'])?$edu['academic_marks_percentage']:'';?></td>
													<td>														
														<a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
														<a href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_education/'.$edu["id"]);?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>														
													</td>
													
												</tr>
											<?php
											}
										}?>
										</tbody>				
									</table>
											
							</div>
						</div>
					</div> <!--/#nav-education-->
					
					<div class="tab-pane fade" id="nav-exp" role="tabpanel" aria-labelledby="nav-exp-tab">
						<div class="row mt-3">
							<div class="col-md-12">
							<a class="btn btn-primary btn-sm" href=""> Add New</a>
							</div>
						</div>
					</div><!--/#nav-exp-->
					
					</div><!--/.tab-content-->
			</div><!--/.carrd-body-->
		</div><!--/.card-->
	</div>
</div><!--/.row-->