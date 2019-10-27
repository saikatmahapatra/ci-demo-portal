<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <!-- <div class="card-header h6"></div> -->
            <!--/.card-header-->
            <div class="card-body">
            <h5 class="card-title">Add Project</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'insert'); ?>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="project_number" class="required">Project Number/Code</label>
                        <?php echo form_input(array('name' => 'project_number', 'value' => set_value('project_number'), 'id' => 'project_number', 'class' => 'form-control', 'placeholder' => '', 'maxlength'=>'15'));?>
                        <?php echo form_error('project_number'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="project_name" class="required">Name of Project</label>
                        <?php echo form_input(array('name' => 'project_name', 'value' => set_value('project_name'), 'id' => 'project_name', 'class' => 'form-control', 'placeholder' => ''));?>
                        <?php echo form_error('project_name'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="project_desc" class="optional">Description of Project</label>
                        <?php echo form_textarea(array('name' => 'project_desc','value' => set_value('project_desc'),'class' => 'form-control textarea','id' => 'project_desc','rows' => '2','cols' => '50','placeholder' => '')); ?>
                        <?php echo form_error('project_desc'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="project_status" class="required">Status</label>
                        <div class="">
                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
								$radio_is_checked = $this->input->post('project_status') == 'Y';
								echo form_radio(array('name' => 'project_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('project_status', 'Y')); ?>
                                <label class="custom-control-label" for="Y">Active</span></label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
								$radio_is_checked = $this->input->post('project_status') == 'N';
								echo form_radio(array('name' => 'project_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('project_status', 'N'));?>
                                <label class="custom-control-label" for="N">Inactive</span></label>
                            </div>
                        </div>
                        <?php echo form_error('project_status'); ?>
                    </div>
                </div>
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
            <!-- <div class="card-footer d-none">
            </div> -->
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->