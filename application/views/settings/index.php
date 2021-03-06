<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-md-12">
	<div class="my-3">
	<a  class="btn btn-outline-secondary" href="<?php echo base_url('settings/timesheet_settings');?>">Timesheet settings</a>
	</div>
        <div class="card ">
			<div class="card-header"><?php echo $this->common_lib->get_icon('table'); ?> Table</div>
            <div class="card-body">
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="table-responsive">
			<table class="table ci-table   table-striped w-100">
				<thead class="">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Option</th>
					<th scope="col">Value</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					foreach($rows as $key=>$val){
						?>
						<tr>
							<td scope="row"><?php echo $count;?></td>
                            <td><?php echo $key; ?></td>
                            <td><?php echo $val; ?></td>
						</tr>
						<?php
						$count++;
					}
				?>
				</tbody>
				<tfoot class="">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Option</th>
					<th scope="col">Value</th>
				</tr>
				</tfoot>
			</table>
		</div>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->

    </div>
    <!--/.col-->
</div>
<!--/.row-->