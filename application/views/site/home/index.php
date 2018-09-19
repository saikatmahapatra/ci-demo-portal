<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->


<?php
foreach($data_rows as $key=>$row){
	?>
	<div class="row">
		<div class="col-md-12 mb-4" data-id="<?php echo $row['id'];?>">
			<div data-cms-type="<?php echo $row['pagecontent_type'];?>" class="card-news pl-2" style="border-left: 3px solid blue;">
				<div class="card-news-header h5">
				<?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?>
				</div>
				<div class="card-news-sig text-muted small">
					<?php echo isset($row['pagecontent_created_on']) ? $row['pagecontent_created_on'] : '';?>
				</div>
				<div class="card-news-body"><?php echo isset($row['pagecontent_text']) ? word_limiter($row['pagecontent_text'],30) : '';?></div>
			</div>
		</div>
	</div>
	<?php
}
?>

<div class="row">
<div class="col-md-12"><?php echo $pagination_link; ?></div>
</div>
