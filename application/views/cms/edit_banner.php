<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-9">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
			<?php echo form_hidden('form_action', 'update'); ?>
			<?php echo form_hidden('upload_file_type_name', 'slider_img'); ?>
			<?php echo form_hidden('id', $row['id']); ?>
			<?php echo form_hidden('upload_file_name', $row['upload_file_name']); ?>

			
			<div class="form-row">			
				<div class="form-group col-md-12">
					<?php
						$img_src = "";
						$default_path = "assets/src/img/no-image.png";
						if(isset($row['upload_file_name'])){					
							$banner_img = "assets/uploads/banner_img/".$row['upload_file_name'];					
							if (file_exists(FCPATH . $banner_img)) {
								$img_src = $banner_img;
							}else{
								$img_src = $default_path;
							}
						}else{
							$img_src = $default_path;
						}
					?>
					<img src="<?php echo base_url($img_src);?>" class="img banner-img-sm">
				</div>		
			</div>
			
			<div class="form-row">			
				<div class="form-group col-md-12">									
					<label for="userfile" class="">Image (Only 1200x300 dimensions are allowed)</label>
					<?php
						echo form_upload(array(
							'name' => 'userfile',
							'id' => 'userfile',
							'class' => 'form-control'
						));
						?>
					<?php echo form_error('userfile'); ?>
					<small>Only .jpg, .jpeg, .png are allowed</small>
				</div>		
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-12">									
					<label for="upload_text_1" class="">Text Line 1 (Optional)</label>
					<?php echo form_input(array('name' => 'upload_text_1', 'value' => (isset($_POST['upload_text_1']) ? set_value('upload_text_1') : $row['upload_text_1']), 'id' => 'upload_text_1', 'class' => 'form-control', 'placeholder' => ''));?>
					<?php echo form_error('upload_text_1'); ?>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-12">									
					<label for="upload_text_2" class="">Text Line 2 (Optional)</label>
					<?php echo form_input(array('name' => 'upload_text_2', 'value' => (isset($_POST['upload_text_2']) ? set_value('upload_text_2') : $row['upload_text_2']), 'id' => 'upload_text_2', 'class' => 'form-control', 'placeholder' => ''));?>
					<?php echo form_error('upload_text_2'); ?>
				</div>
			</div>
			

			<div class="form-row">
				<div class="form-group col-md-12">									
					<label for="upload_status" class="required">Status</label>
					<?php //echo form_dropdown('upload_status', array('Y'=>'Yes','N'=>'No'), (isset($_POST['upload_status']) ? set_value('upload_status') : $row['upload_status']), array('class' => 'form-control')); ?>
						<!--<div class="">-->
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = isset($_POST['upload_status']) ? $_POST['upload_status'] == 'Y' : ($row['upload_status'] == 'Y');

									echo form_radio(array('name' => 'upload_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('upload_status', 'Y'));
								?>
								<label class="custom-control-label" for="Y">Publish</span></label>
							</div>
							
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = isset($_POST['upload_status']) ? $_POST['upload_status'] == 'N' : ($row['upload_status'] == 'N');

									echo form_radio(array('name' => 'upload_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('upload_status', 'N'));
								?>
								<label class="custom-control-label" for="N">Unpublish</span></label>
							</div>								
						<!--</div>-->
						<?php echo form_error('upload_status'); ?>
				</div>
			</div>


			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn btn-lg btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage_banner');?>" class="btn btn-lg btn-light" data-button-type="cancel">Cancel</a>
			<?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->