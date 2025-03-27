<?php
    if (!empty($result)) 
    {
        $caseStudyIds = [];
        foreach ($result as $caseStudyAll) 
        {
            if (in_array($caseStudyAll['casestudies_id'], $caseStudyIds)) {
                continue;
            }

            $caseStudyIds[] = $caseStudyAll['casestudies_id'];
            $url = "uploads/case_studies/".$caseStudyAll['casestudies_id'].".png";
            ?>
            <div class="col-lg-4 col-md-6 case_studies_slide_card case_study_<?php echo $caseStudyAll['list_type_value_id'];?>">
                <div class="single-blog-box">
                    <div class="single-blog-thumb">
                        <img src="<?php echo base_url().$url;?>" alt="No-Image">							
                    </div>
                    <div class="blog-content">
                        <div class="meta-blog">
                            <p><span class="solution"><?php echo ucfirst($caseStudyAll['list_value']); ?></span><?php echo isset($caseStudyAll['created_date']) ? date("d M, Y",strtotime($caseStudyAll['created_date'])) : "";?></p>
                        </div>
                        <div class="blog-title">
                            <h3><a href="javascript:void(0)"><?php echo ucfirst($caseStudyAll['title']); ?></a></h3>
                        </div>
                        <div class="blog_btn">
                            <a href="javascript:void(0)">Read More <i class="flaticon flaticon-right-arrow"></i></a>
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
