<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-12">
    <?php echo isset($alert_message) ? $alert_message : ''; ?>
		<h4>Now</h4>
		<?php echo now(); ?>
    
        <h4>Time Zone Menu</h4>
        <?php echo timezone_menu(); ?>
    
        <h4>unix_to_human</h4>
        <?php
        $now = time();
        echo unix_to_human($now); // U.S. time, no seconds
        echo '<br>';
        echo unix_to_human($now, TRUE, 'us'); // U.S. time with seconds
        echo '<br>';
        echo unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
        ?>
    </div>
</div>
