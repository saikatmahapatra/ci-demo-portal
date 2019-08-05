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
				<!-- <a href="<?php echo base_url($this->router->directory.$this->router->class.'/leave_balance');?>" class="float-right btn btn-sm btn-outline-secondary" title="Leave Balance Management"> <i class="fa fa-list"></i> Manage Leave Balance</a> -->
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
					<div class="grid-action-holder px-3 mb-3">
						<span class=""><i class="fa fa-check text-success" aria-hidden="true"></i> Approved</span>
						<span class=""><i class="fa fa-close text-danger" aria-hidden="true"></i> Rejected</span>
						<span class=""><i class="fa fa-close text-warning" aria-hidden="true"></i> Cancelled</span>	
					</div><!--/.grid-action-holder-->
					<table class="table table-striped">
						<thead class="thead-light">
							<tr>
								<th scope="col">Request No</th>
								<th scope="col">Applicant</th>
								<th scope="col">L1 Approver</th>
								<th scope="col">L2 Approver</th>
								<th scope="col">Leave Summary</th>
								<th scope="col">Status</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if(sizeof($data_rows)>0){
							foreach($data_rows as $row){
								//print_r($row);
								?>
								<tr>
									<td>
										<a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>" title="Click here to view details"><?php echo $row['leave_req_id'];?></a>
									</td>
									<td>
										<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : ''?>
										<?php echo isset($row['user_lastname']) ? $row['user_lastname'] : ''?>
										<?php echo isset($row['user_emp_id']) ? '('.$row['user_emp_id'].')' : ''?>							
									</td>
									<td>
										<?php 
										$fa_icon = '';
										if($row['supervisor_approver_status'] == 'A'){
											$fa_icon = 'fa-check';
										}
										if($row['supervisor_approver_status'] == 'R'){
											$fa_icon = 'fa-close';
										}
										if($row['supervisor_approver_status'] == 'C'){
											$fa_icon = 'fa-close';
										}
										?>
										<?php echo isset($row['supervisor_approver_status']) ? '<span class="'.$leave_status_arr[$row['supervisor_approver_status']]['css'].'"><i class="fa '.$fa_icon.'" aria-hidden="true"></i></span>' : ''; ?>
										<?php echo isset($row['supervisor_approver_firstname']) ? $row['supervisor_approver_firstname'] : ''?>
										<?php echo isset($row['supervisor_approver_lastname']) ? $row['supervisor_approver_lastname'] : ''?>
										<?php echo isset($row['supervisor_approver_emp_id']) ? '('.$row['supervisor_approver_emp_id'].')' : ''?>							
									</td>
									<td>
										<?php 
										$fa_icon = '';
										if($row['director_approver_status'] == 'A'){
											$fa_icon = 'fa-check';
										}
										if($row['director_approver_status'] == 'R'){
											$fa_icon = 'fa-close';
										}
										if($row['director_approver_status'] == 'C'){
											$fa_icon = 'fa-close';
										}
										?>
										<?php echo isset($row['director_approver_status']) ? '<span class="'.$leave_status_arr[$row['director_approver_status']]['css'].'"><i class="fa '.$fa_icon.'" aria-hidden="true"></i></span>': ''; ?>
										<?php echo isset($row['director_approver_firstname']) ? $row['director_approver_firstname'] : ''?>
										<?php echo isset($row['director_approver_lastname']) ? $row['director_approver_lastname'] : ''?>
										<?php echo isset($row['director_approver_emp_id']) ? '('.$row['director_approver_emp_id'].')' : ''?>
										
									</td>
									<td>
									<?php echo $row['leave_type'];?>
									<?php echo $this->common_lib->display_date($row['leave_from_date']);?>
									<?php echo ' to '.$this->common_lib->display_date($row['leave_to_date']);?>
									<?php //echo ', '.$row['applied_for_days_count'].' day(s)';?></td>
									<td><span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"><?php echo $leave_status_arr[$row['leave_status']]['text'];?></span></td>
									<td>
									<a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="View Details"><i class="fa fa-lg fa-info-circle" aria-hidden="true"></i></a>
									
									</td>
								</tr>
								<?php
							}
						}
						else{
							?>
							<tr>
								<td colspan="7">No result found</td>
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

<div class="row">
	<div class="col-md-12">
		<!-- <p>Please click on "Request No" to view more details and action.</p> -->
		

		
	</div>
</div>