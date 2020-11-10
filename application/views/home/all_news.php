<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card news-card ">
            <div class="card-header">Information</div>
            <div class="card-body">
                <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
                <div class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/all_news/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <div class="mb-1 h6"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></div>
                        </div>
                        <small class="text-muted"><?php echo $this->common_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        <small class="text-muted">by <?php echo isset($row['user_firstname']) ? $row['user_firstname'].' '.$row['user_lastname'] : '';?></small>
                    </a>
                <?php }  ?>
                </div>
                <?php } ?>
                <div class="mx-3 my-4">
                    <?php echo $pagination_link; ?>
                    <a href="<?php echo base_url(); ?>" class=""><?php echo $this->common_lib->get_icon('left_arrow'); ?> Return to dashboard</a>
                </div>
            </div>
        </div><!--/.card-->
    </div>
</div>