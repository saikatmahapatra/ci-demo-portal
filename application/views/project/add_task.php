<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-header">Add Project Task</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'insert'); ?>
                
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="task_name" class="required">Task Parent</label>
                        <?php echo form_dropdown('task_parent_id', $task_parent_drop_down, set_value('task_parent_id'), array('class' => 'form-control')); ?>
                        <?php echo form_error('task_parent_id'); ?>
                    </div>
                
                    <div class="form-group col-lg-6">
                        <label for="task_name" class="required">Task Name</label>
                        <?php echo form_input(array('name' => 'task_name', 'value' => set_value('task_name'), 'id' => 'task_name', 'class' => 'form-control', 'placeholder' => ''));?>
                        <?php echo form_error('task_name'); ?>
                    </div>
                </div>
                
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/tasks');?>"
                    class="btn btn-outline-secondary ci-btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->