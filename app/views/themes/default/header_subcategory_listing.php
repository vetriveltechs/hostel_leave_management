<?php
    if (!empty($result)) 
    {
        $listTypeValueIds = [];
       foreach ($result as $row) {
    	$listTypeValueIds[] = $row['list_type_value_id'];

   		 if ($row['list_code_2'] == 'AI-AGENTS') {
        	$category_page_link = "https://www.jesperx.ai/";
        	$category_target    = ' target="_blank"';
   		 } else {
        	$category_page_link = base_url() . "services-details/" . strtolower($row['list_code_1']) . "/" . strtolower($row['list_code_2']);
        	$category_target    = "";
   		 }
    ?>
    <li class="border-bottom border-color-extra-medium-gray py-2">
        <a href="<?php echo $category_page_link; ?>" <?php echo $category_target; ?> class="d-flex align-items-center fs-18 alt-font" id="categroy_level2_<?php echo $row['list_type_value_id'];?>">
                        <?php echo ucfirst($row['list_value']); ?>
                    </a>
    </li>
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
