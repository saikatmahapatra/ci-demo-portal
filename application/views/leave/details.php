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
		<div class="card card-legend">			
			<div class="card-body">
			<h6 class="card-title text-on-card">Leave Req # <?php echo $row['leave_req_id'];?></h6>

				<dl class="row">
					<dt class="col-md-2">Leave Status</dt>
					<dd class="col-md-10">
					<span class=""><i class="fa fa-square <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>
					<span class=""> <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
					</dd>
					<dt class="col-md-2">Leave Type</dt>
					<dd class="col-md-10"><?php echo $row['leave_type'];?></dd>
					<dt class="col-md-2">From Date</dt>
					<dd class="col-md-10"><?php echo $this->common_lib->display_date($row['leave_from_date']);?></dd>
					<dt class="col-md-2">To Date</dt>
					<dd class="col-md-10"><?php echo $this->common_lib->display_date($row['leave_to_date']);?></dd>
					<dt class="col-md-2">Leave Duration</dt>
					<dd class="col-md-10"><?php echo $row['leave_days'].' day(s)';?></dd>
					<dt class="col-md-2">Reason</dt>
					<dd class="col-md-10"><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></dd>					
				</dl>

				<div class="row small">					
					<ul>
						<li>11-11-2018 11.45 am  Pending - By John</li>
						<li>11-11-2018 11.45 am  Pending - By John</li>
						<li>11-11-2018 11.45 am  Pending - By John</li>
					</ul>
				</div>

				<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="ml-2 btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Back</a>

				
			</div><!--/.card-body-->
		</div><!--/.card-->
	</div>
</div>