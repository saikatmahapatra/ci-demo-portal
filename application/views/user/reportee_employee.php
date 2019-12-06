<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
			<div class="card-body">
			<h5 class="card-title">Employees</h5>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<!-- <?php echo form_open(current_url(), array( 'method' => 'get','class'=>'my-3','name' => 'search_employee_form','id' => 'search-user-form',)); ?>
					<?php echo form_hidden('form_action', 'search'); ?>
					<div class="input-group">
						<?php echo form_input(array(
							'name' => 'q',
							'id' => 'q',
							'class' => 'form-control',
							'placeholder' => 'Search by employee name, email, phone, designation',
						)); ?>
						<?php echo form_error('q'); ?>
						<div class="input-group-append">
							<button class="btn" type="submit"><i class="fa fa-fw fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				<?php echo form_close(); ?>-->


				<?php
				if(isset($data_rows) && sizeof($data_rows)<=0){
					?>
					<div class="alert alert-info"><i class="fa fa-fw fa-exclamation-circle" aria-hidden="true"></i> There are no reportees currently reporting you. If you find any irrelevant information please get in touch with HR for further process and clarification.</div>
					<?php
				}
				?> 

				<?php 
				if(isset($data_rows) && sizeof($data_rows)>0){
				?>
					
				<div class="table-responsive">
					<div class="alert alert-info">
					<i class="fa fa-fw fa-exclamation-circle" aria-hidden="true"></i> You are either L1 or L2 approver for Leave request management for the below associates. If you find any irrelevant information please get in touch with HR for further process and clarification.
					</div>
					<table class="table ci-table table-sm table-bordered text-center">
						<thead class="thead-dark">
						<tr>
							<th scope="col">Emp ID</th>
							<th scope="col">Emploee Name</th>
							<th scope="col">Designation</th>
							<th scope="col">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$count = 1;
							foreach($data_rows as $key=>$row){
								?>
								<tr class="">
									<td><?php echo isset($row['user_emp_id']) ? $row['user_emp_id'] : '';?></td>
									<td>
										<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?>
										<?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
									</td>
									<td>
										<?php echo isset($row['designation_name']) ? $row['designation_name'] : '-';?>
									</td>
									<td>
										<a target="_blank" href="<?php echo base_url($this->router->directory.'timesheet/report?redirected_from=reportee_id&q_emp='.$row['user_id']); ?>" class="btn btn-primary btn-sm">Timesheet Report</a>
									</td>
								</tr>
								<?php
								$count++;
							}
						?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-12"><?php echo isset($pagination_link) ? $pagination_link : '' ;?></div>
				<?php
				}
				?>
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->