<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-6">
    <?php echo isset($alert_message) ? $alert_message : ''; ?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'assign_projects','id' => 'address_add')); ?>
        <?php echo form_hidden('form_action', 'add'); ?>
        <div class="form-group">
            <label for="academic_qualification" class="">Projects</label>
            <?php echo form_dropdown('project_id[]', $arr_projects, set_value('project_id'), array( 'class' => 'form-control ci-js-select-2', 'multiple' => 'multiple' )); ?>
            <?php echo form_error('project_id'); ?>
        </div>
        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
        <a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>"
            class="btn btn-light btn-cancel">Cancel</a>
        <?php echo form_close(); ?>
    </div>
</div>