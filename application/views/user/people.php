<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->


<div class="row mb-2 d-none">
	<div class="col-md-6">
	<?php echo form_open(current_url(), array( 'method' => 'get','class'=>'form-inline','name' => '','id' => 'search-user-form',)); ?>
	<?php echo form_hidden('form_action', 'search'); ?>
				
			<?php
			echo form_input(array(
				'name' => 'user_search_keywords',				
				'id' => 'user_search_keywords',
				'class' => 'form-control',
				'placeholder' => 'Search Employee...',			
			));
			?>
			<?php echo form_error('user_search_keywords'); ?>
		
		<?php echo form_button(array('type' => 'submit', 'content' => '<i class="fa fa-search" aria-hidden="true"></i> Search', 'class' => 'btn btn-primary')); ?>&nbsp;
		
		
	<?php echo form_close(); ?>
	</div>
</div>


	
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
				if(isset($data_rows) && sizeof($data_rows)<=0){
					?>
					<div class="col-md-12">We're sorry! No result found based on your search keyword. Please verify the search keyword.</div>
					<?php
				}
				?>
				<?php
				if(isset($data_rows)){
					$count = 1;
					foreach($data_rows as $key=>$row){
						?>
						<?php
						$img_src = "";
						$default_path = "assets/src/img/default_user.jpg";
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
						<?php 
						$disabled_css = '';
						if( (isset($row['user_account_active']) && $row['user_account_active'] == 'N') || (isset($row['user_archived']) && $row['user_archived'] == 'Y') ){
							$disabled_css = 'disabled disabled-user';
						}
						?>
						
						<?php if ($count%3 == 1){ echo '<div class="row">'; } ?>
						
						<div class="col-md-4 content-wrap">
							<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile/'.$row['id']);?>" data-link-type="user-profile-card">
							<div class="media border mb-2 mt-2 p-2">
								<img class="align-self-center mr-3 rounded dp-sm" src="<?php echo base_url($img_src);?>">
								<div class="media-body">
									<div class="h6"><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></div>                            
									<div class="small"><?php echo 'Emp # '.$row['user_emp_id']; ?></div>									
									<div class=""><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
									<div class=""><a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
									                           
								</div>
							</div>
							</a>
						</div>
						<?php if ($count%3 == 0){ echo '</div>'; } ?>
						
						<?php
						$count++;
					}
					if ($count%3 != 1) echo "</div>"; 
				}
				?>

<div class="row">
	<div class="col-md-12"><?php echo $pagination_link;?></div>
</div>