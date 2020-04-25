<?php
$row = $data_rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
		<div class="card-header"><?php echo isset($row['content_type']) ? ucwords($row['content_type']) : '';?></div>
			<div class="card-body">
			<div class="card-title mb-2"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></div>
				<div class="text-muted small mb-3">
						<?php echo isset($row['user_firstname']) ? 'Published by <a href="'.base_url('user/profile/'.$row['content_created_by']).'" target="_blank">'.$row['user_firstname'] : '';?>
						<?php echo isset($row['user_lastname']) ? $row['user_lastname']."</a> on " : '';?>
						<?php echo $this->common_lib->display_date($row['content_created_on'],true,null); ?>
				</div>
				<?php echo isset($row['content_text']) ? $row['content_text'] : '';?>
				<a href="<?php echo $redirect_back_url; ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-left" aria-hidden="true"></i> Go to dashboard</a>
			</div><!--/.card-body-->
		</div><!--/.card-->
	</div>
</div>