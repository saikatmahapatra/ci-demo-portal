<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <div class="card-body">
            <h5 class="card-title">Add Timesheet Activity</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'insert'); ?>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="task_activity_name" class="required">Activity Name</label>
                        <?php echo form_input(array('name' => 'task_activity_name', 'value' => set_value('task_activity_name'), 'id' => 'task_activity_name', 'class' => 'form-control', 'placeholder' => ''));?>
                        <?php echo form_error('task_activity_name'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="task_activity_status" class="required">Status</label>
                        <div class="">
                            <div class="custom-control custom-radio custom-control-inline">
                                <?php $radio_is_checked = $this->input->post('task_activity_status') == 'Y';
							echo form_radio(array('name' => 'task_activity_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('task_activity_status', 'Y')); ?>
                                <label class="custom-control-label" for="Y">Active</span></label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                            <?php $radio_is_checked = $this->input->post('task_activity_status') == 'N';
							echo form_radio(array('name' => 'task_activity_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('task_activity_status', 'N')); ?>
                                <label class="custom-control-label" for="N">Inactive</span></label>
                            </div>
                        </div>
                        <?php echo form_error('task_activity_status'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/activity');?>"
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