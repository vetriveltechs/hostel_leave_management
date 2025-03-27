  <!-- main-area -->
  <main>
            
            <!-- breadcrumb-area -->
               <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(<?php echo base_url();?>assets/frontend/img/bg/bdrc-bg.jpg)">
                   <div class="container">
                       <div class="row align-items-center">
                           <div class="col-xl-12 col-lg-12">
                               <div class="breadcrumb-wrap text-center">
                                   <div class="breadcrumb-title">
                                       <h2>Gallery</h2>    
                                       <div class="breadcrumb-wrap">
                                 
                                   <nav aria-label="breadcrumb">
                                       <ol class="breadcrumb">
                                           <li class="breadcrumb-item"><a href="home.html">Home</a></li>
                                           <li class="breadcrumb-item active" aria-current="page">Gallery </li>
                                       </ol>
                                   </nav>
                               </div>
                                   </div>
                               </div>
                           </div>
                           
                       </div>
                   </div>
               </section>
               <!-- breadcrumb-area-end -->
               
            <!-- gallery-area -->
            <section class="profile fix pt-120">
               <div class="container"> 
                   <div class="row">
                       <div class="col-xl-12 col-lg-12">
                           <div class="my-masonry text-center mb-50">
                               <div class="button-group filter-button-group">
                                   <button class="active" data-filter="*">All</button>
                                   <button data-filter=".financial">Room</button>
                                   <button data-filter=".banking">Hall</button>
                                   <button data-filter=".insurance">Guardian</button>
                                   <button data-filter=".family">Hotel</button>
                                   <button data-filter=".business">Event Hall</button>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-12">
                           <div class="masonry-gallery-huge">
                               <div class="grid col2">
                                   <div class="grid-item banking">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img02.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img02.png" alt="img" class="img"> 
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item insurance">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img03.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img03.png" alt="img" class="img">     
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item financial">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img01.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img01.png" alt="img" class="img">   
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item family">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img04.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img04.png" alt="img" class="img">    
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item business">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img05.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img05.png" alt="img" class="img">
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item financial">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img06.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img06.png" alt="img" class="img">   
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item banking">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img07.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img07.png" alt="img" class="img"> 
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item insurance">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img08.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img08.png" alt="img" class="img">     
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item family">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img09.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img09.png" alt="img" class="img">    
                                           </figure>
                                       </a>
                                   </div>
                                   <div class="grid-item business">
                                       <a class="popup-image" href="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img10.png">
                                           <figure class="gallery-image">
                                               <img src="<?php echo base_url();?>assets/frontend/img/gallery/protfolio-img10.png" alt="img" class="img">
                                           </figure>
                                       </a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </section>
                <!-- gallery-area-end -->
          
           </main>
           <!-- main-area-end -->
            <style>
                     .masonry-gallery-huge .grid {
        display: flex;
        flex-wrap: wrap;
    }

    .masonry-gallery-huge .grid-item {
        padding: 10px;
        box-sizing: border-box;
    }

    .gallery-image img {
        width: 100%;
        height: auto;
        display: block;
    }
            </style>