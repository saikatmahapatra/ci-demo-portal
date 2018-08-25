<?php
$row = $rows[0];
?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-8">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
		<?php echo form_hidden('form_action', 'update'); ?>
		<?php echo form_hidden('id', $row['id']); ?>
		
		<div class="form-row">	
			<div class="form-group col-md-12">
				<label for="project_name" class="">Project Name <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'project_name', 'value' => (isset($_POST['project_name']) ? set_value('project_name') : $row['project_name']), 'id' => 'project_name', 'class' => 'form-control', 'placeholder' => ''));?>
				<?php echo form_error('project_name'); ?>
			</div>		
		</div>
		
		<div class="form-group">
			<label for="project_desc" class="">Project Description</label>
			<?php echo form_textarea(array('name' => 'project_desc','value' => (isset($_POST['project_desc']) ? set_value('project_desc') : $row['project_desc']),'class' => 'form-control textarea','id' => 'project_desc','rows' => '2','cols' => '50','placeholder' => '')); ?>
			<?php echo form_error('project_desc'); ?>
		</div>
		
		<div class="form-row">		
			<div class="form-group col-md-3">									
				<label for="project_status" class="">Status</label>
				<?php echo form_dropdown('project_status', array('Y'=>'Shown','N'=>'Hidden'), (isset($_POST['project_status']) ? set_value('project_status') : $row['project_status']), array('class' => 'form-control')); ?>
				<?php echo form_error('project_status'); ?>
			</div>		
		</div>
		
		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		
		<a href="<?php echo base_url($this->router->directory.'project');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>                             
		<?php echo form_close(); ?>
	</div>
</div>