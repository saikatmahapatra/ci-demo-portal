<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-12">
        <div class="card news-card">
            <div class="card-header"><?php echo $this->app_lib->get_icon('notice_board'); ?> Organization Announcements</div>
            <div class="card-body">
                <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
                <div class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/all_news/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <div class="mb-1"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></div>
                        <small class="d-none d-md-block  text-muted"><?php echo $this->app_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        </div>
                        <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
                        <small class="d-xs-block d-md-none text-muted"><?php echo $this->app_lib->relative_time($row['content_created_on'],true,null); ?></small>
                        <small class="text-muted">by <?php echo isset($row['user_firstname']) ? $row['user_firstname'].' '.$row['user_lastname'] : '';?></small>
                    </a>
                <?php }  ?>
                </div>
                <?php } ?>
                <div class="my-2">
                    <?php echo $pagination_link; ?>
                    <a href="<?php echo base_url(); ?>" class="btn btn-link action-link"><?php echo $this->app_lib->get_icon('left_back'); ?> Return to dashboard</a>
                </div>
            </div>
        </div><!--/.card-->
    </div>
</div>