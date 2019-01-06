<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row heading-container mb-3">
    <div class="col-12">
        <h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
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
                <div class="">Active Employees</div>
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
                <div class="">Projects</div>
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
                <div class="">Emp Logged Task</div>
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
                <div class="">{some text}</div>
            </div>
        </div>
    </div>    
</div>
<?php } ?>

<?php
/*
$count = 1;
foreach($data_rows as $key=>$row){
	?>
	<?php if ($count%3 == 1){ echo '<div class="row my-3">'; } ?>
		<div class="col-md-4 mb-2" data-id="<?php echo $row['id'];?>">
			<div data-cms-type="<?php echo $row['pagecontent_type'];?>" class="card-news pl-2">
				<div class="card-news-header h4 font-weight-normal">
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
echo $pagination_link;
*/
?>


<div class="col-12 p-3 bg-white rounded shadow-sm recent-updates">
   <h6 class="border-bottom border-gray pb-2 mb-0">Recent updates</h6>
   <?php $array_color = array('#007bff', '#AC193D', '#6f42c1','#DC572E'); ?>
   <?php foreach($data_rows as $key=>$row) { ?>
   <div class="media text-muted pt-3">
      <div class="mr-2 <?php echo $content_type[$row['pagecontent_type']]['css']; ?>"><i class="fa fa-tags" aria-hidden="true"></i></div>
      <svg class="bd-placeholder-img mr-2 d-none rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
         <title>Placeholder</title>
         <rect fill="<?php echo $array_color[array_rand($array_color, 1)]; ?>" width="100%" height="100%"></rect>
         <text fill="<?php echo $array_color[array_rand($array_color, 1)]; ?>" dy=".3em" x="50%" y="50%"></text>
      </svg>
      <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
        <div class="d-block text-gray-dark h5"><a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id']);?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a></div>
        <strong class="d-block text-gray-dark small">
            <?php echo $content_type[$row['pagecontent_type']]['text']; ?>
            <?php echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
            <?php echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
            <?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true,null,'d-M-Y h:i:sa'); ?>
        </strong>
        <?php echo isset($row['pagecontent_text']) ? word_limiter($this->common_lib->remove_empty_p($row['pagecontent_text']),30) : '';?>
      </div>
   </div>
   <?php } ?>
   <small class="d-block text-right mt-3">
    <?php echo $pagination_link;?>
   </small>
</div>