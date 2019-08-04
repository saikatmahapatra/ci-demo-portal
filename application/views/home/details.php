<?php
$row = $data_rows[0];
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
		<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>        
    </div>
</div><!--/.page-title-container-->


<div class="card">
	<div class="card-header h6">
		<?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?>
	</div>
	<div class="card-body">
		<?php echo isset($row['pagecontent_text']) ? $row['pagecontent_text'] : '';?>
		<a href="<?php echo base_url();?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to dashboard</a>
	</div><!--/.card-body-->
	<div class="card-footer">
			
			<div class="text-center small">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
				<?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
				<?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
				<?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true); ?>
			</div>
	</div>
</div><!--/.card-->