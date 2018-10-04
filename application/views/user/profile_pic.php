<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->


<div class="row">
	
    <div class="col-md-8">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<div class="row">
			<div class="col-md-3 profile-pic">
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
				<img class="align-self-center mr-3 rounded dp" src="<?php echo base_url($img_src);?>" alt="">
				<?php if(isset($profile_pic) && sizeof($profile_pic)>0){ ?>
					<div class="edit"><a class="btn btn-sm btn-link mt-2" href="<?php echo base_url($this->router->directory.$this->router->class.'/delete_profile_pic/'.$profile_pic);?>"><i class="fa fa-remove"></i> Remove</a></div>
				<?php } ?>
			</div>
			<div class="col-md-9">
				<?php //print_r($row); ?>
				<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','role' => 'form'));?>
				<?php echo form_hidden('form_action', 'file_upload'); ?>
				
					
				<div class="form-group">								
					<label for="userfile" class="control-label">Select File</label>
					<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => '',));?>
					<?php echo form_error('userfile'); ?>
					<?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
					
					<div class="text-muted help-block mt-3">
						<h6>Instructions:</h6>
						<ul>
							<li>Upload your individual photo and not a group photo or logo/animation or cartoon etc.</li>
							<li>Upload photos taken in professional attire only.</li>
							<li>The image should be in <span class="font-weight-bold">.JPG, .JPEG</span> format and should be less than <span class="font-weight-bold">1 MB</span> in size. Verify the quality and size of the image before uploading it.</li>
							<li>Photos must have plain back ground.</li>
							<li>You can delete the uploaded photo anytime if you want.</li>
						</ul>						
					</div>
				</div>
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Upload','class' => 'btn btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
				<?php echo form_close(); ?>
			</div>
		</div>
    </div><!--/.col-md-6-->
</div>