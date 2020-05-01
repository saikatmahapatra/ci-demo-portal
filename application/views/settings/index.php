<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
			<div class="card-header">Options</div>
            <div class="card-body">
                
                <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="table-responsive">
			<table class="table ci-table table-sm table-bordered w-100">
				<thead class="thead-light">
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