<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->

<div class="row">	
	
	<?php
	// Show server side flash messages
	if (isset($alert_message)) {
		$html_alert_ui = '';                
		$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
		echo $html_alert_ui;
	}
	?>
		
	<?php //print_r($data_rows); ?>
				<?php
				if(isset($data_rows)){
					foreach($data_rows as $key=>$row){
						?>						
						<div class="col-md-3">							
							<div class="card mb-1">
							<?php
							$img_src = "";
							$default_path = "assets/src/img/125x125.jpg";
							if(isset($row['user_profile_pic'])){					
								$user_dp = "assets/uploads/user/profile_pic/".$row['user_profile_pic'];					
								if (file_exists(FCPATH . $user_dp)) {
									$img_src = $user_dp;
								}else{
									$img_src = $default_path;
								}
							}else{
								$img_src = $default_path;
							}
							?>
							  <img class="card-img-top" src="<?php echo base_url($img_src);?>" alt="Card image cap">
							  <div class="card-body">
								<h5 class="card-title"><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></h5>
								<div class="card-text"><?php echo $row['user_email']; ?></div>
								<div class="card-text"><?php echo $row['user_phone1']; ?></div>
								<div class="card-text"><?php echo $row['user_phone2']; ?></div>
								<a href="<?php echo base_url($this->router->directory.'user/profile/'.$row['id']);?>" class="btn btn-info btn-sm">View Profile</a>
							  </div>
							</div>
						</div>
						
						<?php
					}
				}
				?>
</div>
<div class=""><?php echo $pagination_link;?></div>