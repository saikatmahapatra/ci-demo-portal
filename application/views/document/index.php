<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row mt-3">
	<div class="col-md-12">
		<div class="card card-legend">			
			<div class="card-body">
				<h6 class="card-title text-on-card">Upload New Documents</h6>
				<?php
				// Show server side flash messages
				if (isset($alert_message)) {
					$html_alert_ui = '';
					$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
					echo $html_alert_ui;
				}
				?>
				<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' => 'form'));?>
				<?php echo form_hidden('form_action', 'file_upload'); ?>
				<?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="upload_document_type_name" class="">Document <span class="required">*</span></label>
						<?php echo form_dropdown('upload_document_type_name', $arr_upload_document_type_name, set_value('upload_document_type_name'), array('class' => 'form-control','id' => 'upload_document_type_name',));?>
						<?php echo form_error('upload_document_type_name'); ?>
					</div>

					<div class="form-group col-md-4">
						<label for="userfile" class="">Select File <span class="required">*</span></label>
						<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => 'form-control','aria-describedby'=>'docHelp'));?>
						<small id="docHelp" class="form-text text-muted bg-light p-1">
							<ul>
								<li>Only png, jpg, jpeg, doc, docx, pdf files are allowed.</li>
								<li>File size should not larger than 1 MB(1024 KB).</li>
							</ul>							 
						</small>
						<?php echo form_error('userfile'); ?>
					</div>		
				</div>
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Upload','class' => 'btn btn-primary'));?>
				<?php echo form_close(); ?>				
			</div><!--./card-body-->
		</div><!--/.card .card-legend-->
	</div>
</div>




<div class="row mt-4">
	<div class="col-md-12">
		<div class="card card-legend">
			<div class="card-body">
				<h6 class="card-title text-on-card">Uploaded Documents</h6>
				<?php
				if (isset($all_uploads) && sizeof($all_uploads) > 0) {
					foreach ($all_uploads as $key => $upload) {
				?>
				<div class="file-container row my-3" id="upload_grid_<?php echo $upload['id']; ?>">
					<div class="col-md-8"><?php echo $arr_upload_document_type_name[$upload['upload_document_type_name']]; ?></div>
					<div class="col-md-4">
						<?php
							$file_path = 'assets/uploads/'.$upload_object_name.'/docs/' . $id . '/' . $upload['upload_file_name'];
							if (file_exists(FCPATH . $file_path)) {
								$file_src = base_url($file_path);
								$btn_class='';
							} else {
								$file_src = '#';
								$btn_class='disabled';	
							}
						?>
						<a href="<?php echo $file_src;?>" title="<?php echo $upload['upload_document_type_name'];?>" data-file-name="<?php echo $upload['upload_file_name']; ?>" class="btn btn-sm view-download-btn btn-outline-secondary <?php echo $btn_class;?>" target="_new"><i class="fa fa-download"></i> View/Download</a>

						<a href="#" class="btn btn-sm btn-outline-danger btn-delete-file ml-2" data-confirmation="1" data-confirmation-message="Are you sure, you want to delete this?" data-upload_id="<?php echo $upload['id'];?>" title="Delete <?php echo $upload['upload_document_type_name']; ?>" data-path="<?php echo $file_path;?>"><i class="fa fa-trash"></i> Delete</a>
					</div>
				</div>
				<?php } //foreach ?>
				<?php }else {?>
				<div class="row">
					<div class="col-md-12">No documents uploaded...</div>
				</div>
				<?php }?>
			</div><!--./card-body-->
		</div><!--/.card .card-legend-->
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-12" id="file-container">
				<object id="file-container-object" width="100%" height="400px" data="">
				<p>
					It appears your Web browser is not configured to display PDF/DOC files.
					No worries, just <a href="your_file.pdf">click here to download the PDF file.</a>
    		</p>
				</object>
			</div>
		</div>
	  	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>