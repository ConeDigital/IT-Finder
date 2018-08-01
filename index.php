<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<!-- Page title -->
	<div class="page-title top-content">
		<div class="container" data-pass="<?php echo wp_hash_password( 'slicky12' ); ?>">
		<form id="seach-submit" action="<?php get_admin_url()?>/it-finder/search-product" method="GET">
		<!--<form id="seach-submit" action="http://localhost/it-finder/product-search/" method="post">-->
		<div class="page-title-text wow fadeInUp">
		
			<!--
			//////////////////////////for custom field in front end front end header text
			
			<h1>Find The Best Software For Your Business</h1>
			-->
			<h1><?php  echo get_option( 'front_header_text', 'front_header_text' );?></h1>
			
			<p>
			<div class="col-xs-12 col-sm-12 p0_res search_filter_main">
				<div class="input-group input_group_search">
					<div class="input-group-btn search-panel search_filter_tablet">
					
						<button type="button" class="btn btn-default dropdown-toggle search_filter" data-toggle="dropdown">
							<span id="search_concept">Snabbsök</span> <span class="caret"></span>
						</button>
						

						
						<ul class="dropdown-menu filter_dropdown_menu" role="menu" style="padding-right: 107px; padding-left: 15px;">
							<?php
						$allTerms = get_terms(
							array(
								'taxonomy' => 'wpccategories',
								'hide_empty' => false,
								'parent' => 0
							)
						);
						foreach($allTerms as $terms)
						{
							?>
							
									<li class="dropdown-header dropdown_header_list"><?php // echo $terms->name?></li>
									<?php
										$childrenHere = get_terms(
											array(
												'taxonomy' => 'wpccategories',
												'hide_empty' => false,
												'parent' =>$terms->term_id
											)
										);
										foreach($childrenHere as $children)
										{
											?>
											<!--<li><a href="<?php //echo get_site_url(); ?>/subcategory/<?php //echo $children->term_id; ?>/"><?php //echo $children->name; ?></a></li>-->
											
											<li><a href="<?php echo get_site_url(); ?>/subcategory/<?php echo $children->slug; ?>"><?php echo $children->name; ?></a></li>
											
											<?php
										}
									?>
								
							<?php
						}
					?>
							
						</ul>
					</div>
					<input type="hidden" name="u" value="1" id="uri">
					<input type="hidden" name="search_category" value="all" id="search_param">
					<input type="text" class="form-control search_input" name="search" id="search1"  placeholder="Sök efter IT-tjänst">
                <span class="input-group-btn search_input_btn">
                    <button id="search-btn" class="btn btn-default btn_search btn_search_filter" type="button">Sök </span></button>
					</span>
				</div>
			</div>

			</p>
			<div class="clearfix"></div>
			<!--<div class="col-sm-6 col-sm-offset-2">
				<a class="option_1banner" href="#"><img src="<?= get_template_directory_uri(); ?>/assets_per/img/tic_icon.png" width="24" height="20" alt=""> Search Option 1</a>
				<a  class="option_1banner" href="#"><img src="<?= get_template_directory_uri(); ?>/assets_per/img/tic_icon.png" width="24" height="20" alt=""> Search Option 2</a>
				<a  class="option_1banner" href="#"><img src="<?= get_template_directory_uri(); ?>/assets_per/img/tic_icon.png" width="24" height="20" alt=""> Search Option 3</a>
			</div>-->
		</div>
		</form>
		</div>
	</div>

	<!-- What we do -->
	<?php /*
	<div class="block-3-container section-container what-we-do-container">
		<div class="container">

			<div class="row">
				<?php
				$args = array(
					'posts_per_page'   => -1,
					'offset'           => 0,
					// 'category'         => '8',
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
					<div class="col-sm-3 block-3-box wow fadeInUp inner_image">
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
	</div>*/ ?>

	<!-- Block 2 (team member) -->
	<div class="block-2-container section-container section-container-gray about-block-2-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 fadeInLeft">
					<h3 class="box_h3">Hitta rätt molntjänst för ditt företag</h3>
					<div class="clear20"></div>
					<p>
						Jämför och testa marknadsledande produkter, ta del av omdömen från andra företagare och hitta rätt lösning för din verksamhet
						IT Finder finns till för att leda rätt köpare till rätt leverantör inom molntjänster och programvaror för företag
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
				$posts_array2 = get_posts( $args2 );
				// print_r($posts_array);
				foreach($posts_array2 as $args2){

					$imgscr2= wp_get_attachment_url( get_post_thumbnail_id( $args2->ID ) );
					?>
				<div class="col-sm-4 wow fadeInUp">
					<div class="block-2-img-container">
						<img src="<?= $imgscr2; ?>" alt="" >

						<div class="label_box">
							<?php echo $args2->post_content;?>
						</div>

					</div>
				</div>
					<?php } ?>

			</div>
		</div>
	</div>
	
<script>

$('#search-btn').click(function(){
	// var category = $('#search_param').val();
	// if(category == 'all')
	// {
	//   swal({
	//   title: "Warning!",
	//   text: "Please Select Filter to Search!",
	//   icon: "warning",
	// });
	// }else{
		$('#seach-submit').submit();
	// }	
	
});
$('.dropdown-menu').click(function(e) { 
	getText = e.target.text;
	$('#search_param').val(getText);
	$('#search_concept').text(getText);
	$("#search_param").attr("value", getText);

 });
</script>
<?php get_footer();
