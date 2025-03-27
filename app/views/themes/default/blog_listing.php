<?php
    if (!empty($result)) 
    {
        $blogIds = [];
        foreach ($result as $blogAll) 
        {
            if (in_array($blogAll['blog_id'], $blogIds)) {
                continue;
            }

            $blogIds[] = $blogAll['blog_id'];
            $url = "uploads/blogs/" . $blogAll['blog_id'] . ".png";
            ?>
            <div class="col-lg-6 col-md-6 grid-item blog_category_<?php echo $blogAll['list_type_value_id']; ?>">
                <div class="portfolio_item">
                    <div class="portfolio_thumb">
                        <img src="<?php echo base_url() . $url; ?>" alt="No-Image">
                        <div class="portfolio_content">
                            <div class="prot-text">    
                                <span><?php echo ucfirst($blogAll['list_value']); ?></span>                                
                                <h3> <a href="javascript:void(0)"><?php echo ucfirst($blogAll['blog_title']); ?></a></h3>    
                            </div>    
                            <div class="port_right">
                                <a href="javascript:void(0)"><i class="bi bi-arrow-right-short"></i></a>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>    
            <?php
        }
    }
    else 
    {
        ?>
            <div class="text-center">
                <img src="<?php echo base_url(); ?>uploads/nodata.png" alt="No data available" style="max-width: 100px;">
                
            </div>
        <?php
    }
?>
