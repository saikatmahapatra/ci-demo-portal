<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
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
	<div class="table-responsive">
		<div class="mb-2 d-none">
			<span class="mx-2"><i class="fa fa-circle text-secondary" aria-hidden="true"></i> Pending</span>					
			<span class="mx-2"><i class="fa fa-circle text-success" aria-hidden="true"></i> Approved</span>
			<span class="mx-2"><i class="fa fa-circle text-warning" aria-hidden="true"></i> Cancelled</span>
			<span class="mx-2"><i class="fa fa-circle text-danger" aria-hidden="true"></i> Rejected</span>
		</div>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Leave Req #</th>
					<th scope="col">Leave Type</th>
					<th scope="col">From Date</th>
					<th scope="col">To Date</th>
					<th scope="col">Days</th>
					<th scope="col">Leave Status</th>
					<!-- <th scope="col">Reason</th>-->
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
			<?php 
			if(sizeof($data_rows)>0){
				foreach($data_rows as $row){
					?>
					<tr>
						<td><a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>"><?php echo $row['leave_req_id'];?></a></td>
						<td><?php echo $leave_type_arr[$row['leave_type']];?></td>
						<td><?php echo $this->common_lib->display_date($row['leave_from_date']);?></td>
						<td><?php echo $this->common_lib->display_date($row['leave_to_date']);?></td>
						<td><?php echo $row['leave_days'].' day(s)';?></td>
						<td>
							<!-- <span class="small"><i class="fa fa-circle <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>  -->
							<span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"> <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
						</td>
						<!-- <td><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></td> -->
						<td>
						<a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>" class="btn btn-outline-info btn-sm">Details</a>
						<!-- <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>" class="btn btn-outline-danger btn-sm">Cancel Request</a> -->
						</td>
					</tr>
					<?php
				}
			}
			else{
				?>
				<tr>
					<td colspan="7"> No leave records found</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div class="float-right"><?php echo $pagination_link; ?></div>			
	</div><!--/.table-responsive-->
	</div>
</div>