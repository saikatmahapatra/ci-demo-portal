<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row heading-container mb-3">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->


<?php if ($this->session->userdata['sess_user']['user_role'] == 1) { ?>
<div class="row my-3">
    <div class="col-xl-3 col-md-6 text-white">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-success justify-content-center rounded-left">
                <i class="fa fa-user fa-3x"></i>
            </div>
            <div class="col-8 py-3 bg-success-light rounded-right">
                <div class="h2 mt-0"><?php echo $user_count['data_rows'][0]['total']; ?></div>
                <div class="text-uppercase">Active Employees</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 text-white">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-danger justify-content-center rounded-left">
                <i class="fa fa-cubes fa-3x"></i>
            </div>
            <div class="col-8 py-3 bg-danger-light rounded-right">
                <div class="h2 mt-0"><?php echo $projects_count['data_rows'][0]['total']; ?>                    
                </div>
                <div class="text-uppercase">Projects</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-12 text-white">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-primary justify-content-center rounded-left">
                <i class="fa fa-calendar fa-3x"></i>
            </div>
            <div class="col-8 py-3 bg-primary-light rounded-right">
                <div class="h2 mt-0"><?php echo $timesheet_user['data_rows'][0]['total']; ?></div>
                <div class="text-uppercase"><?php echo date('M-y').' Timesheet'?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-12 text-white">
        <!-- START card-->
        <div class="card flex-row align-items-center align-items-stretch border-0">
            <div class="col-4 d-flex align-items-center bg-warning justify-content-center rounded-left">
                <i class="fa fa-user fa-3x"></i>
            </div>
            <div class="col-8 py-3 bg-warning-light rounded-right">
                <div class="h2 mt-0">{some value}</div>
                <div class="text-uppercase">{some text}</div>
            </div>
        </div>
    </div>    
</div>
<?php } ?>



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
	<?php if ($count%3 == 1){ echo '<div class="row my-3">'; } ?>
		<div class="col-md-4 mb-2" data-id="<?php echo $row['id'];?>">
			<div data-cms-type="<?php echo $row['pagecontent_type'];?>" class="card-news pl-2">
				<div class="card-news-header h3">
					<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a>
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
					<?php echo isset($row['pagecontent_text']) ? word_limiter($row['pagecontent_text'],30) : '';?>
					<a class="d-none" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>">Read more</a>				
				</div>
			</div>
		<?php if ($count%3 == 0){ echo '</div>'; } ?>
	</div>
	<?php
	$count++;
}
//if ($count%3 != 1) echo "</div>"; 
?>

<div class="row">
<div class="col-md-12"><?php echo $pagination_link; ?></div>
</div>
