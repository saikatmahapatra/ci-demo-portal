<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

		
<?php
if(isset($data_rows) && sizeof($data_rows)<=0 || !isset($data_rows)){
    ?>
    <div class="row">
        <div class="alert alert-danger col-md-12">We're sorry! No result found based on your search keyword. Please verify the search keyword.</div>
    </div>        
    <?php
}
?>


<?php
if(isset($data_rows)){
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
        <div class="row border-bottom">
            <div class="col-md-12 mt-3 mb-3">
                <a href="<?php echo base_url($this->router->directory.'user/profile/'.$row['id']);?>" data-link-type="user-profile-card">
                    <div class="media">
                        <img class="align-self-center mr-3 rounded dp-sm" data-src="holder.js/64x64" alt="64x64" src="<?php echo base_url($img_src);?>">
                        <div class="media-body">
                        <div class="h6"><?php echo $row['user_firstname'].' '.$row['user_lastname']; ?></div>                            
                        <div class="small"><?php echo 'Emp ID : '.$row['user_emp_id']; ?></div>									
                        <div class=""><a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a></div>
                        <div class=""><a href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>			
        <?php
    }
}
?>


<div class="float-right mt-3"><?php echo isset($pagination_link) ? $pagination_link : '';?></div>