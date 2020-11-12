<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ">
			<div class="card-header"><?php echo $this->common_lib->get_icon('search_data'); ?> Search</div>
			<div class="card-body">
			
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<?php echo form_open(current_url(), array( 'method' => 'get','class'=>'my-3','name' => 'search_employee_form','id' => 'search-user-form',)); ?>
					<?php echo form_hidden('form_action', 'search'); ?>
					<div class="input-group">
						<?php echo form_input(array(
							'name' => 'q',
							'id' => 'q',
							'class' => 'form-control',
							'placeholder' => 'Search by employee name, email, phone, designation',
						)); ?>
						<?php echo form_error('q'); ?>
						<div class="input-group-append">
							<button class="btn" type="submit"><?php echo $this->common_lib->get_icon('search'); ?></button>
						</div>
					</div>
				<?php echo form_close(); ?>


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
						$default_path = "";
						$show_name_dp = true;
						if(isset($row['user_profile_pic'])){					
							$user_dp = "assets/uploads/user/profile_pic/".$row['user_profile_pic'];					
							if (file_exists(FCPATH . $user_dp)) {
								$img_src = $user_dp;
								$show_name_dp = false;
							}else{
								$img_src = $default_path;
								$show_name_dp = true;
							}
						}else{
							$img_src = $default_path;
							$show_name_dp = true;
						}
						?>
						<?php 
						$disabled_css = '';
						if( isset($row['user_status']) && ($row['user_status'] == 'A' || $row['user_status'] == 'N') ){
							$disabled_css = 'disabled disabled-user';
						}
						?>
						
						<?php if ($count%3 == 1){ echo '<div class="row">'; } ?>
						

						<div class="col-lg-12">
							<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile/'.$row['id']);?>" class="user-profile-card-people">
							<div class="media border rounded my-2 p-2">
									<?php 
										if($show_name_dp === true) {
											?>
											<div class="people-dp mx-auto d-block mt-2">
											<?php
												//echo isset($row['user_title']) ? $row['user_title'] . '&nbsp;' : '';
												echo isset($row['user_firstname']) ? substr($row['user_firstname'], 0, 1) : 'NO';
												echo isset($row['user_lastname']) ? substr($row['user_lastname'], 0, 1) : 'IMG';
											?>
											</div>
											<?php
										} else {
											?>
											<img class="people-dp rounded mx-auto d-block mt-2" src="<?php echo base_url($img_src);?>" onclick="window.open('<?php echo base_url('user/profile/'.$row['id']);?>');">
											<?php
										}
									?>
								<div class="media-body">
									<div class=""><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?><?php echo ' ('.$row['user_emp_id'].')'; ?></div>
									<div class="small"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '' ; ?></div>
									<?php
									$email_id = explode('@',$row['user_email']);
									?>
									<div class="small" style="word-break: break-all;"><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
									<div class="small"><a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
								</div>
							</div>
							</a>
						</div>

						<?php if ($count%3 == 0){ echo '</div>'; } ?>
						
						<?php
						$count++;
					}
					if ($count%3 != 1) echo "</div>"; 
				}
				?>
				<div class="col-lg-12"><?php echo isset($pagination_link) ? $pagination_link : '' ;?></div>
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->