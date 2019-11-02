<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-6">
		<div class="card ci-card">
			<div class="card-body">
			<h5 class="card-title">Change or Remove your profile photo</h5>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<div class="row">
					<div class="col-lg-4 profile-pic">
						<?php
						$img_src = "";
						$default_path = "assets/src/img/default_user.jpg";
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
						<img class="dp rounded mx-auto d-block img-thumbnail" src="<?php echo base_url($img_src);?>" alt="">
						<?php if(isset($profile_pic) && sizeof($profile_pic)>0){ ?>
							<div class="edit"><a class="btn btn-sm btn-outline-danger my-2" href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_profile_pic/'.$profile_pic);?>"><i class="fa fa-fw fa-remove"></i> Remove</a></div>
						<?php } ?>
					</div>
					<div class="col-lg-8">
						<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','role' => 'form'));?>
						<?php echo form_hidden('form_action', 'file_upload'); ?>
						<div class="form-group">
							<label for="userfile" class="control-label">Select File</label>
							<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => 'form-control',));?>
							<?php echo form_error('userfile'); ?>
							<div class="form-text small text-muted bg-light p-1">						
								<ul>
									<li>The image should be in <span class="font-weight-bold">.jpg, .jpeg</span> format and should be less than <span class="font-weight-bold">1 MB</span> in size. Verify the quality and size of the image before uploading it.</li>
									<li>Upload your individual photo and not a group photo or logo/animation or cartoon etc.</li>
									<li>Upload photos taken in professional attire only.</li>							
									<li>Photos must have plain back ground.</li>
									<li>You can delete the uploaded photo anytime if you want.</li>
								</ul>						
							</div>
							<?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
						</div>
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Upload','class' => 'btn ci-btn-primary btn-primary'));?>
						<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>" class="btn btn-light ci-btn-cancel">Cancel</a>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->