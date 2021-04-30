<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-12">
        <div class="card news-card">
            <div class="card-header"><?php echo $this->common_lib->get_icon('notice_board'); ?> More News</div>
            <div class="card-body">
                <?php if( isset($data_rows) && sizeof($data_rows) > 0 ){ ?>
                <div class="list-group list-group-flush">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <div class="news-item mb-3">
                        <div><a href="<?php echo base_url('home/details/'.$row['id']);?>" class=""><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></a></div>
                        <div class="small text-muted"><?php echo $this->common_lib->relative_time($row['content_created_on'],true,null); ?></div>
                        <div class="small text-muted">by <?php echo isset($row['user_firstname']) ? $row['user_firstname'].' '.$row['user_lastname'] : '';?></div>
                    </div>
                <?php }  ?>
                </div>
                <?php } ?>
                <div class="my-2">
                    <?php echo $pagination_link; ?>
                    <a href="<?php echo base_url(); ?>" class="btn btn-link action-link"><?php echo $this->common_lib->get_icon('left_back'); ?> Return to dashboard</a>
                </div>
            </div>
        </div><!--/.card-->
    </div>
</div>