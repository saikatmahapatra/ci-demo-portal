<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-5 mb-3">
        <div class="card ci-card">
            <div class="card-header">Upload Files</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' => 'form'));?>
                <?php echo form_hidden('form_action', 'file_upload'); ?>
                <?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="upload_file_type_name" class="required">Type of Document</label>
                        <?php echo form_dropdown('upload_file_type_name', $arr_upload_file_type_name, set_value('upload_file_type_name'), array('class' => 'form-control','id' => 'upload_file_type_name',));?>
                        <?php echo form_error('upload_file_type_name'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="userfile" class="required">Select File</label>
                        <?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => 'form-control','aria-describedby'=>'docHelp'));?>
                        <div id="docHelp" class="form-text ci-form-help-text text-muted bg-light">
                            <ul>
                                <li>Only png, jpg, jpeg, doc, docx, pdf files are allowed.</li>
                                <li>File size should not larger than 1 MB(1024 KB).</li>
                            </ul>
                        </div>
                        <?php echo form_error('userfile'); ?>
                    </div>
                </div>
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->

    <div class="col-lg-7 mb-3">
        <div class="card ci-card">
            <div class="card-header">My Uploaded Files</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table ci-table table-sm table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Uploaded Document(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
					if (isset($all_uploads) && sizeof($all_uploads) > 0) {
						foreach ($all_uploads as $key => $upload) {
					?>
                            <tr class="file-container" id="upload_grid_<?php echo $upload['id']; ?>">
                                <?php
								$file_path = 'assets/uploads/'.$upload_related_to.'/docs/' . $id . '/' . $upload['upload_file_name'];
								if (file_exists(FCPATH . $file_path)) {
									$file_src = base_url($file_path);
									$btn_class='';
								} else {
									$file_src = '#';
									$btn_class='disabled';	
								}
							?>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-danger btn-delete-file mr-3"
                                        data-confirmation="1"
                                        data-confirmation-message="Are you sure, you want to delete this?"
                                        data-upload_id="<?php echo $upload['id'];?>"
                                        title="Delete <?php echo $upload['upload_file_type_name']; ?>"
                                        data-path="<?php echo $file_path;?>"><i class="fas fa-trash-alt"></i></a>
                                    <a href="<?php echo $file_src;?>"
                                        title="<?php echo $upload['upload_file_type_name'];?>"
                                        data-file-name="<?php echo $upload['upload_file_name']; ?>"
                                        class="<?php echo $btn_class;?>"
                                        target="_new"><?php echo $arr_upload_file_type_name[$upload['upload_file_type_name']]; ?></a>
                                </td>

                            </tr>
                            <?php } //foreach ?>
                            <?php }else {?>
                            <tr>
                                <td colspan="2">No documents found.</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                <!--/.table-responsive-->
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->


</div>
<!--/.row-->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                <!-- <button type="button" class="btn ci-btn-primary btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>