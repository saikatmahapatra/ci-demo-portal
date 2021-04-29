<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-9">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'insert'); ?>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="task_name" class="required">Task Name</label>
                        <?php echo form_input(array('name' => 'task_name', 'value' => set_value('task_name'), 'id' => 'task_name', 'class' => 'form-control', 'placeholder' => ''));?>
                        <small id="task_parent_idHelp" class="form-text text-muted">To add a sub task please select a parent task from dropdown.</small>
                        <?php echo form_error('task_name'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="task_name" class="optional">Parent Task</label>
                        <?php echo form_dropdown('task_parent_id', $task_parent_drop_down, set_value('task_parent_id'), array('class' => 'form-control')); ?>
                        <?php echo form_error('task_parent_id'); ?>
                    </div>
                </div>
                
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/tasks');?>"
                    class="btn btn-light" data-button-type="cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->