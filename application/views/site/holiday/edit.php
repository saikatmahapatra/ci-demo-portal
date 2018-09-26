<?php
$row = $rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
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
				
			</div>
		</div>
		
		<div class="form-row">		
			<div class="form-group col-md-3">
				<label for="holiday_date" class="">Holiday Date <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'holiday_date', 'value' => (isset($_POST['holiday_date']) ? set_value('holiday_date') : $row['holiday_date']), 'id' => 'holiday_date', 'class' => 'form-control holiday-datepicker', 'placeholder' => '', 'readonly'=>true));?>
				<?php echo form_error('holiday_date'); ?>
			</div>
			<div class="form-group col-md-9">
				<label for="holiday_description" class="">Holidate Reason / Description <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'holiday_description', 'value' => (isset($_POST['holiday_description']) ? set_value('holiday_description') : $row['holiday_description']), 'id' => 'holiday_description', 'class' => 'form-control', 'placeholder' => ''));?>
				<?php echo form_error('holiday_description'); ?>
			</div>
		</div>		
		
		
		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		
		<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>                             
		<?php echo form_close(); ?>
	</div>
</div>