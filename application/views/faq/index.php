<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
        <div class="col-sm-12">
            <div class="accordion" id="faqExample">
                
                <?php foreach($this->config->item('app_faq') as $key=>$faq){
                    ?>
                    <div class="card">
                        <div class="card-header text-primary" id="heading_<?php echo $key?>" data-toggle="collapse" data-target="#collapse_<?php echo $key?>" aria-expanded="true" aria-controls="collapse_<?php echo $key?>">
                            <?php echo $faq['question']; ?>
                        </div>

                        <div id="collapse_<?php echo $key?>" class="collapse <?php echo ($key==0 ? 'show' : '')?>" aria-labelledby="heading_<?php echo $key?>" data-parent="#faqExample">
                            <div class="card-body">
                                <b>Answer:</b> <?php echo $faq['answer']; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }?>
                
            </div>
        </div>
    </div>
    <!--/row-->
