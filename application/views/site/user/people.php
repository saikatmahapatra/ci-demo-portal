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
						<?php
						$img_src = "";
						$default_path = "assets/src/img/user.svg";
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
						<div class="col-md-3">
							<div class="card mb-3 text-center">
							  <div class="card-header">
								<img style="min-width:100px; width:100px; height: 100px;" class="mx-auto" src="<?php echo base_url($img_src);?>" alt="<?php echo $row['user_title'].' '.$row['user_firstname'].' '.$row['user_lastname']; ?>">
							  </div>
							  <div class="card-body">
								<h6 class="card-title"><?php echo $row['user_title'].' '.$row['user_firstname'].' '.$row['user_lastname']; ?></h6>
								<div class="card-text">
									<div class="small"><?php echo '# '.$row['user_emp_id']; ?></div>
									<div class="small"><?php echo $row['designation_name']; ?></div>
									<div class=""><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
									<div class=""><a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
								</div>
							  </div>
							</div><!--/.card-->
						</div>						
						<?php
					}
				}
				?>
</div>
<div class=""><?php echo $pagination_link;?></div>