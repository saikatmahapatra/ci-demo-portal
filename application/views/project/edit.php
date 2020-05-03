<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-header">Edit Project</div>
            <div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'update'); ?>
                <?php echo form_hidden('id', $row['id']); ?>

                <div class="form-row">
                    <div class="form-group col-lg-4">
                        <label for="project_number" class="required">Project Number</label>
                        <?php echo form_input(array('name' => 'project_number', 'value' => (isset($_POST['project_number']) ? set_value('project_number') : $row['project_number']), 'id' => 'project_number', 'class' => 'form-control', 'placeholder' => '','maxlength'=>'15'));?>
                        <?php echo form_error('project_number'); ?>
                    </div>
                
                    <div class="form-group col-lg-8">
                        <label for="project_name" class="required">Project Name</label>
                        <?php echo form_input(array('name' => 'project_name', 'value' => (isset($_POST['project_name']) ? set_value('project_name') : $row['project_name']), 'id' => 'project_name', 'class' => 'form-control', 'placeholder' => ''));?>
                        <?php echo form_error('project_name'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="project_desc" class="optional">Description</label>
                        <?php echo form_textarea(array('name' => 'project_desc','value' => (isset($_POST['project_desc']) ? set_value('project_desc') : $row['project_desc']),'class' => 'form-control textarea','id' => 'project_desc', 'maxlength'=> '150', 'rows' => '2','cols' => '50','placeholder' => 'briefly describe in 150 characters')); ?>
                        <?php echo form_error('project_desc'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="project_status" class="required">Status</label>
                        <div class="">
                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
							$radio_is_checked = isset($_POST['project_status']) ? $_POST['project_status'] == 'Y' : ($row['project_status'] == 'Y');

							echo form_radio(array('name' => 'project_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('project_status', 'Y'));
						?>
                                <label class="custom-control-label" for="Y">Active</span></label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
							$radio_is_checked = isset($_POST['project_status']) ? $_POST['project_status'] == 'N' : ($row['project_status'] == 'N');

							echo form_radio(array('name' => 'project_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('project_status', 'N'));
						?>
                                <label class="custom-control-label" for="N">Inactive</span></label>
                            </div>
                        </div>
                        <?php echo form_error('project_status'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>

                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light ci-btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->