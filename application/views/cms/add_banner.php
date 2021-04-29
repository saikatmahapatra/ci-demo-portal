<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">




    <div class="col-md-8">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
				<?php echo form_hidden('form_action', 'insert'); ?>
				<?php echo form_hidden('upload_file_type_name', 'slider_img'); ?>
				<?php echo form_hidden('upload_status', 'Y'); ?>

				
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="userfile" class="required">Image</label>
						<?php
							echo form_upload(array(
								'name' => 'userfile',
								'id' => 'userfile',
								'class' => 'form-control field-help'
							));
							?>
						<?php echo form_error('userfile'); ?>
						<small>Only .jpg, .jpeg, .png are allowed</small>
					</div>		
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="content_title" class="">Text Line 1 (Optional)</label>
						<?php echo form_input(array('name' => 'upload_text_1', 'value' => set_value('upload_text_1'), 'id' => 'upload_text_1', 'class' => 'form-control', 'placeholder' => ''));?>
						<?php echo form_error('upload_text_1'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-12">									
						<label for="content_title" class="">Text Line 2 (Optional)</label>
						<?php echo form_input(array('name' => 'upload_text_2', 'value' => set_value('upload_text_2'), 'id' => 'upload_text_2', 'class' => 'form-control', 'placeholder' => ''));?>
						<?php echo form_error('upload_text_2'); ?>
					</div>
				</div>

				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn  btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage_banner');?>" class="btn  btn-light" data-button-type="cancel">Cancel</a>
				<?php echo form_close(); ?>
			</div>
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->

<div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Crop and Resize Image</h4>
			</div>
			<div class="modal-body">
				<div id="img_prev" style="width:400px;"></div>
				<button class="btn  btn-primary crop_my_image">Crop Image</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>