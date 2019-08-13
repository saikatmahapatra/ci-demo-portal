<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Search Employees
			</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
				<?php echo form_open(current_url(), array( 'method' => 'get','class'=>'my-3','name' => '','id' => 'search-user-form',)); ?>
					<?php echo form_hidden('form_action', 'search'); ?>
					<div class="input-group">
						<?php echo form_input(array(
							'name' => 'q',
							'id' => 'q',
							'class' => 'form-control',
							'placeholder' => 'Search employee by name, email, phone, designation',
						)); ?>
						<?php echo form_error('q'); ?>
						<div class="input-group-append">
							<button class="btn" type="submit"><i class="fa fa-fw fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				<?php echo form_close(); ?>


				<?php
				if(isset($data_rows) && sizeof($data_rows)<=0){
					?>
					<div class="text-danger"><i class="fa fa-fw fa-exclamation-circle" aria-hidden="true"></i> Oops! No results found.</div>
					<?php
				}
				?>
				<?php
				if(isset($data_rows)){
					//print_r($data_rows);
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
						if( isset($row['user_status']) && ($row['user_status'] == 'A' || $row['user_status'] == 'N') ){
							$disabled_css = 'disabled disabled-user';
						}
						?>
						
						<?php if ($count%3 == 1){ echo '<div class="row">'; } ?>
						

						<div class="col-md-4">
							<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile/'.$row['id']);?>" data-link-type="user-profile-card">
							<div class="media border rounded my-2 p-2">
								<img class="align-self-center mr-3 rounded dp-sm" src="<?php echo base_url($img_src);?>">
								<div class="media-body">
									<div class=""><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?><?php echo ' ('.$row['user_emp_id'].')'; ?></div>
									<div class="small"><?php echo isset($row['designation_name']) ? $row['designation_name'] : '' ; ?></div>
									<?php
									$email_id = explode('@',$row['user_email']);
									?>
									<div class="" style="word-break: break-all;"><i class="fa fa-fw fa-envelope-open-o" aria-hidden="true"></i> <a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>" title="<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
									<div class=""><i class="fa fa-fw fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
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
				<div class="col-md-12"><?php echo $pagination_link;?></div>
				
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->