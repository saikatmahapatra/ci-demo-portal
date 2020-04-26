<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-header">Edit Project Task</div>
            <div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'update'); ?>
                <?php echo form_hidden('id', $row['id']); ?>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="task_name" class="required">Task Parent</label>
                        <?php echo form_dropdown('task_parent_id', $task_parent_drop_down, isset($_POST['task_parent_id']) ? set_value('task_parent_id') : $row['task_parent_id'] , array('class' => 'form-control')); ?>
                        <?php echo form_error('task_parent_id'); ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="task_name" class="required">Task Name</label>
                        <?php echo form_input(array('name' => 'task_name', 'value' => (isset($_POST['task_name']) ? set_value('task_name') : $row['task_name']), 'id' => 'task_name', 'class' => 'form-control', 'placeholder' => ''));?>
                        <?php echo form_error('task_name'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="task_status" class="required">Status</label>
                        <div class="">
                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
							$radio_is_checked = isset($_POST['task_status']) ? $_POST['task_status'] == 'Y' : ($row['task_status'] == 'Y');

							echo form_radio(array('name' => 'task_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('task_status', 'Y')); ?>
                                <label class="custom-control-label" for="Y">Active</span></label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
							$radio_is_checked = isset($_POST['task_status']) ? $_POST['task_status'] == 'N' : ($row['task_status'] == 'N');

							echo form_radio(array('name' => 'task_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('task_status', 'N')); ?>
                                <label class="custom-control-label" for="N">Inactive</span></label>
                            </div>
                        </div>
                        <?php echo form_error('task_status'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/tasks');?>"
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