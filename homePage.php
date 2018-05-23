<?php
    /**
    * Template Name: HomePage
    */
	get_header();
?>


<?php
// $args = array(
	// 'posts_per_page'   => 5,
	// 'offset'           => 0,
	// 'category'         => '',
	// 'category_name'    => '',
	// 'orderby'          => 'date',
	// 'order'            => 'DESC',
	// 'include'          => '',
	// 'exclude'          => '',
	// 'meta_key'         => '',
	// 'meta_value'       => '',
	// 'post_type'        => 'post',
	// 'post_mime_type'   => '',
	// 'post_parent'      => '',
	// 'author'	   => '',
	// 'author_name'	   => '',
	// 'post_status'      => 'publish',
	// 'suppress_filters' => true
// );
// $posts_array = get_posts();echo '<pre>';
// print_r($posts_array);
// echo get_the_post_thumbnail(13);
?>

        <!-- Page title -->
        <div class="page-title top-content">
            <div class="page-title-text wow fadeInUp">
           	  <h1>Find The Best Software For Your Business</h1>
           	  <p>
              <div class="col-xs-12 col-sm-10 col-sm-offset-1 p0_res">
		    <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle search_filter" data-toggle="dropdown">
                    	<span id="search_concept">Search Filter</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than ></a></li>
                      <li><a href="#less_than">Less than < </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param " value="all" id="search_param">
                <input type="text" class="form-control search_input" name="x" placeholder="Search Your Software">
                <span class="input-group-btn">
                    <button class="btn btn-default btn_search" type="button">Search </span></button>
                </span>
            </div>
        </div>

                </p>
                <div class="clearfix"></div>
            	<div class="col-sm-6 col-sm-offset-2">
            		<a class="option_1banner" href="#"><img src="<?= get_template_directory_uri(); ?>/assets_per/img/tic_icon.png" width="24" height="20" alt=""> Search Option 1</a>
            		<a  class="option_1banner" href="#"><img src="<?= get_template_directory_uri(); ?>/assets_per/img/tic_icon.png" width="24" height="20" alt=""> Search Option 2</a>
                    <a  class="option_1banner" href="#"><img src="<?= get_template_directory_uri(); ?>/assets_per/img/tic_icon.png" width="24" height="20" alt=""> Search Option 3</a>
            	</div>
            </div>
        </div>

		<!-- What we do -->
        <div class="block-3-container section-container what-we-do-container">
	        <div class="container">

	            <div class="row">
				<?php
					$args = array(
						'posts_per_page'   => -1,
						'offset'           => 0,
						'category'         => '8',
						'category_name'    => '',
						'orderby'          => 'date',
						'order'            => 'ASC',
						'include'          => '',
						'exclude'          => '',
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'ad_post_category',
						'post_mime_type'   => '',
						'post_parent'      => '',
						'author'    => '',
						'author_name'    => '',
						'post_status'      => 'publish',
						'suppress_filters' => true
					);
					$left_right = 0;
					$posts_array = get_posts( $args );
					// print_r($posts_array);
					foreach($posts_array as $args){

						$imgscr= wp_get_attachment_url( get_post_thumbnail_id( $args->ID ) );
						?>
                	<div class="col-sm-3 block-3-box wow fadeInUp">
	                	<div class="block-3-box-icon">
           		      <img src="<?= $imgscr; ?>" width="118" height="120" alt=""></div>
           		     <!-- <img src="<?php //echo get_template_directory_uri(); ?>/assets_per/img/icon1.png" width="118" height="120" alt=""></div>-->
	                    <h3><?php echo $args->post_title;?></h3>
	                    <p><?php echo $args->post_content;?></p>
                    </div>
					<?php
					}
					?>
                   </div>
	        </div>
        </div>































        <!-- Block 2 (team member) -->
        <div class="block-2-container section-container section-container-gray about-block-2-container">
	        <div class="container">
	            <div class="row">
	            	<div class="col-sm-12 fadeInLeft">
	            		<h3 class="box_h3">Lorem Ipsum is simply dummy text </h3>
                            <div class="clear20"></div>
	            		<p>
	            			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
	            		</p>



	            	</div>
    <div class="clear30"></div>


						<?php
					$args2 = array(
						'posts_per_page'   => -1,
						'offset'           => 0,
						'category'         => '9',
						'category_name'    => '',
						'orderby'          => 'date',
						'order'            => 'ASC',
						'include'          => '',
						'exclude'          => '',
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'ad_post_property',
						'post_mime_type'   => '',
						'post_parent'      => '',
						'author'    => '',
						'author_name'    => '',
						'post_status'      => 'publish',
						'suppress_filters' => true
					);
					$left_right = 0;
					$posts_array2 = get_posts( $args2 );
					// print_r($posts_array);
					foreach($posts_array2 as $args2){

						$imgscr2= wp_get_attachment_url( get_post_thumbnail_id( $args2->ID ) );
						?>

	            	<div class="col-sm-4 wow fadeInUp">
	            		<div class="block-2-img-container">
	            			<img src="<?= $imgscr2; ?>" alt="" >

                            <div class="label_box"><?php echo $args2->post_content;?></div>

	            		</div>
	            	</div>
					<?php
					}
					?>


	            </div>
	        </div>
        </div>





<?php get_footer(); ?>