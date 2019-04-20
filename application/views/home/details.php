<?php
$row = $data_rows[0];
?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-heading"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-12 mb-4" data-id="<?php echo $row['id'];?>">
		<div class="card-news-details">
			<div class="card-news-header h5 d-none">
			<?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?>
			</div>
			<div class="card-news-sig text-muted small">
				<?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
				<?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
				<?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true); ?>
			</div>
			<div class="card-news-body"><?php echo isset($row['pagecontent_text']) ? $row['pagecontent_text'] : '';?></div>
			<a href="<?php echo base_url();?>" class="btn btn-secondary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
		</div>
	</div>
</div>