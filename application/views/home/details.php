<?php
$row = $data_rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="card">
	<div class="card-header h6">
		<?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?>
	</div>
	<div class="card-body">
		<?php echo isset($row['pagecontent_text']) ? $row['pagecontent_text'] : '';?>
		<a href="<?php echo $redirect_back_url; ?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
	</div><!--/.card-body-->
	<div class="card-footer">
			
			<div class="text-center text-muted small">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
				<?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
				<?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true,null,'d-M-Y h:i:s a'); ?>
			</div>
	</div>
</div><!--/.card-->