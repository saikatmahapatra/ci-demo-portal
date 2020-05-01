<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
			<div class="card-header">Employees</div>
			<div class="card-body">
			
				<?php echo isset($alert_message) ? $alert_message : ''; ?>
				
				<div class="row justify-content-center mb-3 mt-0">
					<div class="col-lg-6 col-md-8">
						<?php echo form_open(base_url('user/people'), array( 'method' => 'get','class'=>'my-3','name' => '','id' => 'search-user-form',)); ?>
						<?php echo form_hidden('form_action', 'search'); ?>
						<div class="form-row">
							<div class="input-group">
								<?php echo form_input(array(
									'name' => 'q',
									'id' => 'q',
									'class' => 'form-control',
									'placeholder' => 'Search by name, email, phone, designation',
								)); ?>
								<?php echo form_error('q'); ?>
								<div class="input-group-append">
									<button class="btn" type="submit"><?php echo $this->common_lib->get_icon('search'); ?></button>
								</div>
								<?php 
								if($this->input->get('form_action') == 'search') {
									?>
									<a href="<?php echo base_url('user/people'); ?>" class="btn btn-light text-secondary mx-2">Reset</a>
									<?php
								}
								?>
							</div>
						</div>
					<?php echo form_close(); ?>
					</div>
				</div>


				<?php
				if(isset($data_rows) && sizeof($data_rows)<=0){
					?>
					<div class="text-muted"><?php echo $this->common_lib->get_icon('warning'); ?> No results found.</div>
					<?php
				}
				?>
				<?php
				if(isset($data_rows)){
					//print_r($data_rows);
					$count = 1;
					foreach($data_rows as $key=>$row){
						?>
						<?php
						$img_src = "";
						$default_path = "assets/src/img/default_user.jpg";
						if(isset($row['user_profile_pic'])){					
							$user_dp = "assets/uploads/user/profile_pic/".$row['user_profile_pic'];					
							if (file_exists(FCPATH . $user_dp)) {
								$img_src = $user_dp;
							}else{
								$img_src = $default_path;
							}
						}else{
							$img_src = $default_path;
						}
						?>
						<?php 
						$disabled_css = '';
						if( isset($row['user_status']) && ($row['user_status'] == 'A' || $row['user_status'] == 'N') ){
							$disabled_css = 'disabled disabled-user';
						}
						?>
						
						<?php if ($count%3 == 1){ echo '<div class="row">'; } ?>
						<div class="col-lg-4">
							<div class="card-deck profile-card-conntainer">
								<div class="ci-card card">
									<img class="show-pointer card-img-top rounded mx-auto d-block mt-2 dp-sm" src="<?php echo base_url($img_src);?>" alt="<?php echo substr($row['user_firstname'], 0, 1).substr($row['user_lastname'], 0, 1); ?>" onclick="window.open('<?php echo base_url('user/profile/'.$row['id']);?>');">
									<div class="card-body text-center">
										<div class="show-pointer card-text" onclick="window.open('<?php echo base_url('user/profile/'.$row['id']);?>');" data-first-name>
											<?php echo $row['user_firstname'].' '.$row['user_lastname']; ?>
										</div>
										<div class="other-info">Employee ID <?php echo  $row['user_emp_id']; ?></div>
										<div class="other-info"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '' ; ?></div>
										<?php
										$email_id = explode('@',$row['user_email']);
										?>
										<div class="other-info"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
										<div class="other-info"><a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
									</div>
								</div>
							</div>
						</div>
						<?php if ($count%3 == 0){ echo '</div>'; } ?>
						<?php
						$count++;
					}
					if ($count%3 != 1) echo "</div>"; 
				}
				?>
				<div class="col-lg-12"><?php echo $pagination_link;?></div>
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->