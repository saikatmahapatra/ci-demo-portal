<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-md-12">       
    <?php echo isset($alert_message) ? $this->common_lib->display_flash_message($alert_message, $alert_message_css) : ''; ?>
        <h4>Read Only Sub Dir</h4>        
        <?php 
        echo '<pre>';
        print_r($sub_folders); 
        echo '</pre>';
        ?>
            <h4>Read Sub Dir + Files</h4>
        <?php 
        echo '<pre>';
        print_r($read_dir); 
        echo '</pre>';
        ?>
    </div>

</div>