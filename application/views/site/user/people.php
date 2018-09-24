<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->


<div class="row mb-2">
	<div class="col-md-6">
	<?php echo form_open(current_url(), array( 'method' => 'get','class'=>'','name' => '','id' => 'search-user-form',)); ?>
	<?php echo form_hidden('form_action', 'search'); ?>
	<div class="form-row">
		<div class="form-group col-md-7">			
			<?php
			echo form_input(array(
				'name' => 'user_search_keywords',
				'value' => $this->input->get_post('user_search_keywords'),
				'id' => 'user_search_keywords',
				'class' => 'form-control',
				'placeholder' => 'Search by emp # / name / email / mobile',			
			));
			?>
			<?php echo form_error('user_search_keywords'); ?>
		</div>
		<div class="form-group col-md-5">
		<?php echo form_button(array('type' => 'submit', 'content' => '<i class="fa fa-search" aria-hidden="true"></i> Search', 'class' => 'btn btn-primary')); ?>&nbsp;
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/'.$this->router->method);?>" class="btn btn-secondary">Reset</a>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>


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
				if(isset($data_rows) && sizeof($data_rows)<=0){
					?>
					<div class="col-md-12">We're sorry! No result found based on your search keyword. Please verify the search keyword.</div>
					<?php
				}
				?>
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
						<?php 
						$disabled_css = '';
						if( (isset($row['user_account_active']) && $row['user_account_active'] == 'N') || (isset($row['user_archived']) && $row['user_archived'] == 'Y') ){
							$disabled_css = 'disabled disabled-user';
						}
						?>
						<div class="col-md-3">
							<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile/'.$this->common_lib->encode($row['id']));?>" data-link-type="user-profile-card">
								<div class="card user-profile-card mb-3 text-center <?php echo $disabled_css; ?>">
								<div class="card-header">
									<img style="min-width:75px; width:75px; height: 75px;" class="mx-auto img-thumbnail" src="<?php echo base_url($img_src);?>" alt="<?php echo $row['user_title'].' '.$row['user_firstname'].' '.$row['user_lastname']; ?>">
								</div>
								<div class="card-body">
									<h6 class="card-title"><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></h6>
									<div class="card-text">
										<div class="small"><?php echo '# '.$row['user_emp_id']; ?></div>
										<div class="small"><?php echo $row['designation_name']; ?></div>
										<div class=""><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
										<div class=""><a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
									</div>
								</div>
								</div><!--/.card-->
							</a>
						</div>						
						<?php
					}
				}
				?>
</div>
<div class="float-right"><?php echo $pagination_link;?></div>