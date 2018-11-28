<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<?php $row = $data_rows[0]; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row my-2">
	<div class="col-md-12">
	<?php
	// Show server side flash messages
	if (isset($alert_message)) {
		$html_alert_ui = '';                
		$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
		echo $html_alert_ui;
	}
	?>
	</div>	
</div>


<div class="row my-3">
	<div class="col-md-12">		
			<h6 class="card-title text-on-card">Leave Req # <?php echo $row['leave_req_id'];?></h6>
				<dl class="row">
					<dt class="col-md-2">Leave Status</dt>
					<dd class="col-md-4">
					<span class=""><i class="fa fa-square <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>
					<span class=""> <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
					</dd>
					<dt class="col-md-2">Leave Type</dt>
					<dd class="col-md-4"><?php echo $row['leave_type'];?></dd>
					<dt class="col-md-2">From Date</dt>
					<dd class="col-md-4"><?php echo $this->common_lib->display_date($row['leave_from_date']);?></dd>
					<dt class="col-md-2">To Date</dt>
					<dd class="col-md-4"><?php echo $this->common_lib->display_date($row['leave_to_date']);?></dd>
					<dt class="col-md-2">Leave Duration</dt>
					<dd class="col-md-4"><?php echo $row['leave_days'].' day(s)';?></dd>
					<dt class="col-md-2">Reason</dt>
					<dd class="col-md-4"><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></dd>					
				</dl>

				
				<div class="row ci-wizard">                
					<div class="col-sm-4 ci-wizard-step complete">
						<div class="text-center ci-wizard-stepnum">You</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="ci-wizard-dot"></a>
						<div class="ci-wizard-info text-center">							
							<div class="small">18-11-2018 10:30:23 pm</div>
							<div class="">Lorem ipsum dolor sit amet.</div>
						</div>
					</div>
					
					<div class="col-sm-4 ci-wizard-step disabled"><!-- complete -->
						<div class="text-center ci-wizard-stepnum">Anirban Nandy</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="ci-wizard-dot"></a>
						<div class="ci-wizard-info text-center">Nam mollis tristique erat vel tristique. Aliquam erat volutpat. Mauris et vestibulum nisi. Duis molestie nisl sed scelerisque vestibulum. Nam placerat tristique placerat</div>
					</div>
					
					<div class="col-sm-4 ci-wizard-step disabled"><!-- complete -->
						<div class="text-center ci-wizard-stepnum">Joydeep Banerjee</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="ci-wizard-dot"></a>
						<div class="ci-wizard-info text-center">Integer semper dolor ac auctor rutrum. Duis porta ipsum vitae mi bibendum bibendum</div>
					</div>			
            	</div><!--/.row .ci-wizard-->

				

				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/history');?>" class="ml-2 btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Back</a>

			
	</div>
</div>