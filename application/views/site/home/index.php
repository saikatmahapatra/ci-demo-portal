<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row heading-container mb-3">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->



<div id="demo" class="carousel slide d-none" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url('assets/src/img/la.jpg');?>" alt="Los Angeles" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>We had such a great time in LA!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('assets/src/img/chicago.jpg');?>" alt="Chicago" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Chicago</h3>
        <p>Thank you, Chicago!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('assets/src/img/ny.jpg');?>" alt="New York" width="1100" height="500">
      <div class="carousel-caption">
        <h3>New York</h3>
        <p>We love the Big Apple!</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


<?php
$count = 1;
foreach($data_rows as $key=>$row){
	?>
	<?php //if ($count%3 == 1){ echo '<div class="row mb-5">'; } ?>
		<div class="col-md-12 mb-3" data-id="<?php echo $row['id'];?>">
			<div data-cms-type="<?php echo $row['pagecontent_type'];?>" class="card-news pl-2">
				<div class="card-news-header h6">
					<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$this->common_lib->encode($row['id']));?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a>
				</div>
				<div class="card-news-sig text-muted small">
					<div><?php echo ucwords($row['pagecontent_type']);?></div>
					<div>
						<?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
						<?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
						<?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true); ?>
					</div>
				</div>
				<div class="card-news-body">
					<?php echo isset($row['pagecontent_text']) ? word_limiter($row['pagecontent_text'],50) : '';?>
					<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$this->common_lib->encode($row['id']));?>">Read more</a>				
				</div>
			</div>
		<?php //if ($count%3 == 0){ echo '</div>'; } ?>
	</div>
	<?php
	$count++;
}
//if ($count%3 != 1) echo "</div>"; 
?>

<div class="row">
<div class="col-md-12"><?php echo $pagination_link; ?></div>
</div>
