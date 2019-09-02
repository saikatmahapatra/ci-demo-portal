<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-12">       
    <?php echo isset($alert_message) ? $alert_message : ''; ?>
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