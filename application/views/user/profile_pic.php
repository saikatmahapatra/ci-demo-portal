<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-9">
		<div class="card ">
			<div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
			<div class="card-body">
			
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<div class="row">
					<div class="col-lg-4 profile-pic">
						<?php
						$img_src = "";
						$default_path = "";
						$show_name_dp = true;
						if(isset($profile_pic)){
							$user_dp = "assets/uploads/user/profile_pic/".$profile_pic;					
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
						if($show_name_dp === true) {
							?>
							<div class="dp mx-auto d-block">
							<?php
								echo substr($this->common_lib->get_sess_user('user_firstname'), 0, 1);
								echo substr($this->common_lib->get_sess_user('user_lastname'), 0, 1);
							?>
							</div>
							<?php
						} else {
							?>
							<img class="dp rounded  d-block" src="<?php echo base_url($img_src);?>" alt="">
							<?php
						}
						?>

						<?php if(isset($profile_pic) && sizeof($profile_pic)>0){ ?>
							<div class="edit"><a class="btn btn-link action-link" href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_profile_pic/'.$profile_pic);?>"><?php echo $this->common_lib->get_icon('delete'); ?> Remove</a></div>
						<?php } ?>
					</div>
					<div class="col-lg-8">
						<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','role' => 'form'));?>
						<?php echo form_hidden('form_action', 'file_upload'); ?>
						<div class="form-group">
							<label for="userfile" class="required control-label">Select File</label>
							<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => 'form-control',));?>
							<?php echo form_error('userfile'); ?>
							<div class="form-text small text-muted bg-light p-1">						
								<ul>
									<li>Only <span class="font-weight-bold">.jpg, .jpeg</span> image extensions are allowed.</li>
									<li>Image file size should not exceed <span class="font-weight-bold">300 KB.</span></li>
									<li>Upload your individual photo and not a group photo or logo/animation or cartoon etc.</li>
									<li>Upload photos taken in professional attire only.</li>
									<li>Photos must have plain back ground.</li>
									<li>You can delete the uploaded photo anytime if you want.</li>
								</ul>						
							</div>
							<?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
						</div>
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Upload','class' => 'btn btn-primary'));?>
						<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>" class="btn btn-light" data-button-type="cancel">Cancel</a>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->