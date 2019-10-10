<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row justify-content-center">
    <div class="col-lg-9">
        <?php echo isset($alert_message) ? $alert_message : ''; ?>
        <div id="calendar"></div>
    </div>
    <!--/.col-->
</div>
<!--/.row-->