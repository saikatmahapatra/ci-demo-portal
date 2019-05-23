<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Data Table
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/apply');?>" class="float-right btn btn-sm btn-outline-success" title="Apply Leave"> <i class="fa fa-plane"></i> Apply Leave</a>
			</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
				
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Request No</th>
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
									<td><?php echo $row['applied_for_days_count'].' day(s)';?></td>
									<td>
										<!-- <span class="small"><i class="fa fa-circle-o-notch <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>  -->
										<span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>">  <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
									</td>
									<!-- <td><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></td> -->
									<td>
									<a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>" class="btn btn-outline-info btn-sm" title="View Details"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
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
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->