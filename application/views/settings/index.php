<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-body">
                <h5 class="card-title">Options</h5>
                <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="table-responsive">
			<table class="table ci-table table-sm table-bordered text-center">
				<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Option</th>
					<th scope="col">Value</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					foreach($rows as $key=>$row){
						?>
						<tr>
							<td scope="row"><?php echo $count;?></td>
                            <td><?php echo $row['option_name']; ?></td>
                            <td><?php echo $row['option_value']; ?></td>
						</tr>
						<?php
						$count++;
					}
				?>
				</tbody>
			</table>
		</div>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->