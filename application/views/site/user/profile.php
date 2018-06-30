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
   <div class="media">
   <?php   
	$img_src = "";
	$default_path = "assets/dist/img/avatar_2x.png";
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
	<div class="profile-pic">
		<img class="img align-self-start mr-3 dp" src="<?php echo base_url($img_src);?>">
		<?php if($my_profile == TRUE){ ?>
		<div class="edit"><a href="<?php echo base_url($this->router->directory.'user/profile_pic');?>"><i class="fa fa-pencil"></i> Change</a></div>
		<?php } ?>
	</div>
  <div class="media-body">
    <h5 class="mt-0">
        <?php
            echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
            echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
            echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
        ?>
    </h5>
    <!--<div class="small"><?php //echo isset($row['role_name']) ? $row['role_name'] : ''; ?></div>-->
	<div class="small"><?php echo isset($row['designation_name']) ? $row['designation_name'] : ''; ?></div>
    <div class="">
        <i class="fa fa-envelope-o" aria-hidden="true"></i> 
        <a class="mr-2" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
    </div>
    <div class="">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <a class="mr-2" href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a>
        <a href="tel:<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?>"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?></a>
        
    </div>            
    <div>
        <?php echo (isset($row['user_bio']) && strlen($row['user_bio'])>0) ? $row['user_bio'] : '<span class="text-greyed-out">Describe who you are...</span>'; ?>
        <?php if($my_profile == TRUE){ ?>
		<a href="<?php echo base_url($this->router->directory.'user/edit_profile');?>">Edit</a>
		<?php } ?>
    </div>
    <!--<hr style="m-8 auto">
    <span class="label label-default">some text</span>
    <span class="label label-default">some text</span>-->
  </div>
</div>
</div>
</div>


<br>

<nav>
  <div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab" aria-controls="nav-basic" aria-selected="true">Basic Information</a>
	
    <!--<a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false">Address Details</a>
	
    <a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">Qualification</a>
	
	<a class="nav-item nav-link" id="nav-exp-tab" data-toggle="tab" href="#nav-exp" role="tab" aria-controls="nav-exp" aria-selected="false">Work Experience</a>-->
	
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
	<div class="row mt-3">
		<div class="col-md-12">
		<?php if($my_profile == TRUE){ ?>
        <a class="btn btn-info btn-sm" href="<?php echo base_url($this->router->directory.'user/edit_profile');?>"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
		<?php } ?>
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
			<dd class="col-sm-10"><?php echo isset($row['user_doj']) ? date('d-m-Y', strtotime($row['user_doj'])) : '-'; ?></dd>
			<dt class="col-sm-2">Designation</dt>
			<dd class="col-sm-10"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '-'; ?></dd>
			<dt class="col-sm-2">Email (Work)</dt>
			<dd class="col-sm-10"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : '-'; ?></a></dd>			
			<dt class="col-sm-2">Email (Personal)</dt>
			<dd class="col-sm-10"><a href="mailto:<?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?>"><?php echo isset($row['user_email_secondary']) ? $row['user_email_secondary'] : '-'; ?></a></dd>			
			<dt class="col-sm-2">Phone (Work)</dt>
			<dd class="col-sm-10"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '-'; ?></dd>			
			<dt class="col-sm-2">Phone (Personal)</dt>
			<dd class="col-sm-10"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : '-'; ?></dd>
			<dt class="col-sm-2">Date of Birth</dt>
			<dd class="col-sm-10"><?php echo isset($row['user_dob']) ? date('d-m-Y', strtotime($row['user_dob'])) : '-'; ?></dd>
			<dt class="col-sm-2">Gender</dt>
			<dd class="col-sm-10"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></dd>
			
		</dl><!--/dl.row-->
        
		</div>
	</div>
  </div> <!--/#nav-basic-->
  
  <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
	<div class="row mt-3">
		<div class="col-md-12">
		<?php if($my_profile == TRUE){ ?>
		<a class="btn btn-success btn-sm" href="<?php echo base_url($this->router->directory.'user/add_address');?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
		<?php } ?>
			<!--<h6>Communication Address</h6><hr>-->
				<?php if(isset($address)){
					foreach($address as $key=>$addr){
					?>
						<div class="row mb-3">
							<div class="col-md-2"><?php echo isset($address_type[$addr['address_type']])?$address_type[$addr['address_type']]:'Address'; ?></div>
							<div class="col-md-8">
								<div class="">
									<?php echo isset($addr['name'])? $addr['name'].',&nbsp;' :'';?>
									<?php echo isset($addr['phone1'])? $addr['phone1'].', ':'';?>
									<?php echo isset($addr['address']) ? $addr['address'] : '';?>
									<?php echo isset($addr['locality'])? ', '.$addr['locality'] : '';?>
									<?php echo isset($addr['city']) ? ', '.$addr['city'].', ' : '';?>
									<?php echo isset($addr['state']) ? $addr['state'] : '';?>
									<?php echo isset($addr['zip']) ? ' - '.$addr['zip'] : '';?>                                
								</div>
								<div>
								</div>
							</div>
							<div class="col-md-2">	
								<?php if($my_profile == TRUE){ ?>
								<a href="<?php echo base_url($this->router->directory.'user/edit_address/'.$addr["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
								<a href="<?php echo base_url($this->router->directory.'user/delete_address/'.$addr["id"]);?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
								<?php } ?>
							</div>
						</div>
						<!--/.row-->
					<?php
					}
				}?>
		</div>
	</div>
  </div> <!--/#nav-address-->
  
  
  <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
	<div class="row mt-3">
		<div class="col-md-12">
			<?php if($my_profile == TRUE){ ?>
			<a class="btn btn-success btn-sm" href="<?php echo base_url($this->router->directory.'user/add_education');?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
			<?php } ?>
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
									<?php if($my_profile == TRUE){ ?>
									<a href="<?php echo base_url($this->router->directory.'user/edit_education/'.$edu["id"]);?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
									<a href="<?php echo base_url($this->router->directory.'user/delete_education/'.$edu["id"]);?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
									<?php } ?>
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
		<?php if($my_profile == TRUE){ ?>
		<a class="btn btn-success btn-sm" href=""><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
		<?php } ?>
		</div>
	</div>
  </div><!--/#nav-exp-->
  
</div><!--/.tab-content-->