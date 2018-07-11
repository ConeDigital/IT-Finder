<style>
.ttext {
	   overflow: hidden;
	   text-overflow: ellipsis;
	   display: -webkit-box;
	   line-height: 16px;    
	   max-height: 32px;      
	   -webkit-line-clamp: 2;
	   -webkit-box-orient: vertical;
	}
	@media (min-width: 768px) and (max-width: 991px) {
	.row_header
	{
		margin-top: 80 !important;
	}
		}
		@media (min-width: 993px) and (max-width: 1200px) {
	.row_header
	{
		    margin-top: 80 !important;
	}
		}
	@media only screen and (min-width : 1201px) {
    .row_header {
       margin-top:22px !important;
    }
}
	@media only screen and (max-width : 769px) {
    .crm_rubrik_detail a {    margin-top: -15px;}
}

	</style>
<?php
    /**
    * Template Name: search-product
    */
	get_header();

?>

<?php


	$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$required_uri =explode("?u=",$current_url);

	$conct_url = substr($required_uri[1], 2);

	$redirect = '/search-product/?u='.$required_uri[1]; 




	$exploded_array=explode("/",$current_url);
	$currentID = $exploded_array[sizeof($exploded_array)-2];
	$array = explode('&review_stars', $_SERVER['REQUEST_URI']);
	$clear_filter = "http://".$_SERVER['HTTP_HOST'].$array[0];
 
	
	$search = $_GET['search'];
	$category = $_GET['search_category'];
	
	$all = [];
	$term_ID = $wpdb->get_results("SELECT * FROM  wp_terms where name = '$category' ");
	


	// CRM Search Link //
			$allTerms = get_terms(
				array(
					'taxonomy' => 'wpccategories',
					'hide_empty' => false,
					'parent' => 0,
				)
			);

			$compact_data;
			foreach($allTerms as $terms)
			{

				$childrenHere = get_terms(
					array(
						'taxonomy' => 'wpccategories',
						'hide_empty' => false,
						'parent' =>$terms->term_id,
					)
				);
				if($childrenHere[0]->term_id)
				{
					$compact_data .= $childrenHere[0]->term_id.',';
				} 
					
				
			}
            $compact_data = rtrim($compact_data, ',');
           
			$array=array_map('intval', explode(',', $compact_data));
			$array = implode("','",$array);
            
            $listed_categories = $wpdb->get_results("SELECT * FROM  wp_terms where term_id IN ('".$array."') AND name LIKE '%$search%' ");
			
			

	// End

	if(!empty($term_ID)) 
	{
			$ID = $term_ID[0]->term_id;		
			$childrenHere = get_terms(
				array(
					'taxonomy' => 'wpccategories',
					'hide_empty' => false,
					'parent' =>$ID 
				)
			);

			foreach($childrenHere as $key => $children)
			{
				$ID = $children->term_id;
				$term_ID = $wpdb->get_results("SELECT * 
						FROM  wp_term_relationships where term_taxonomy_id = '$ID' ");
				foreach($term_ID as $data)
				{
					$ID = $data->object_id;
					$products = $wpdb->get_results("SELECT *, ID as object_id FROM  wp_posts where ID = '$ID' AND  post_name LIKE '%$search%' ");
					if(!empty($products))
					{
						array_push($all, $products[0]);
					}
				
				}
			}


	}else
	{
		// echo '<br><br><br><br><br><br><br><br>';
		// echo 'hola hoal'; die;
		$all = $wpdb->get_results("SELECT *, ID as object_id  
		FROM  wp_posts where post_name LIKE '%$search%' and post_status = 'publish' and post_type = 'wpcproduct' ");

		
	}
	// echo '<br><br><br><br><br><br><br><br><br><br>';
	// echo '<br>'; print_r($all); die;
	if($_GET['u']==""){
		$page="1";
	}else{
		$page=$_GET['u'];
	}
	$per_page =10;
	$count = count($all);
	$pages = ceil($count/$per_page);

	$start    = ($page - 1) * $per_page;//fetch record

	$pag_sql     = $sql." LIMIT $start,$per_page";




	// filter starts from here
	// echo '<pre>'; print_r($all); die;

	// // // // // // //
	// Filter Start  //

	$product_ids = [];
	$filter_ids = '';
	foreach ($all as $key => $data) {
		array_push($product_ids, $data->ID);

	}

	// echo '<br><br><br><br><br><br><br><br><br><br>';
	// echo '<br>'; print_r($all); die;	

	if($_GET['filter']){
		$avg_value2;
		$array = [];
		$array2 = [ '', 'my_meta_box_select', 'my_meta_box_select2', 'my_meta_box_select3', 'my_meta_box_select4', 'my_meta_box_select5'];
		

		foreach($product_ids as $post_id)
		{
			$x = 0;
			$status = true;
			$get_data = $_GET;

			foreach($get_data as $data){

				if(!empty($data) && $x == 2)
				{
					
					//$obj_id = $post_array->object_id;
					$avg_review = $wpdb->get_results("SELECT AVG(reading) as reading, AVG(writing) as writing, AVG(skills) as skills, AVG(support) as support
			       		FROM reviews WHERE product_id = '$post_id'
			        	");
				
					
					$avg_value2 = (($avg_review[0]->reading + $avg_review[0]->writing + $avg_review[0]->skills + $avg_review[0]->support) /4) ;

					if(($avg_value2 <= $_GET['review_stars']) && ($avg_value2 >= $_GET['review_stars']-1)){	
					}
					else
					{
						$status = false;
					}



				}


				if(!empty($data) && $x > 2 && $x < 8)
				{

					
					$query = 'SELECT * FROM wp_postmeta where meta_key = ';
					$array[$array2[$x-2]] = $data;
					$append = "'".$array2[$x-2]."'"." AND meta_value = ".$data." AND post_id = ".$post_id;
					$append = (string)$append;
					$query =$query . $append;
					$results = $wpdb->get_results($query);
					
					if(empty($results))
					{
						$status = false;
					}
					 

				}

				$x++;


			}

			
			$query = rtrim($query, " AND ");
			
			//echo "status ".$status.'<br>';
			if($status)
			{
				$filter_ids .=  $post_id.',';
			}

			 
			 
			$filter_data = $wpdb->get_results($query);							
		}
		$filter_ids = rtrim($filter_ids, ',');

		


		$string=$filter_ids;
		$array=array_map('intval', explode(',', $string));
		$array = implode("','",$array);


		$posts_array_Count = $wpdb->get_results("SELECT * 
			FROM  wp_term_relationships 
			       JOIN wp_posts 
			         ON wp_term_relationships.object_id = wp_posts.id 
			       JOIN wp_term_taxonomy 
			         ON wp_term_relationships.term_taxonomy_id = 
			            wp_term_taxonomy.term_taxonomy_id 
				WHERE wp_posts.id IN('".$array."') "
				);
		if($_GET['u']==""){
			$page="1";
		}else{
			$page=$_GET['u'];
		}

		$per_page =10;
		$count = count($posts_array_Count);
		$pages = ceil($count/$per_page);
		$start    = ($page - 1) * $per_page;//fetch record

		$pag_sql     = $sql." LIMIT $start,$per_page";



		$all = $wpdb->get_results("SELECT * 
			FROM  wp_term_relationships 
			       JOIN wp_posts 
			         ON wp_term_relationships.object_id = wp_posts.id 
			       JOIN wp_term_taxonomy 
			         ON wp_term_relationships.term_taxonomy_id = 
			            wp_term_taxonomy.term_taxonomy_id 
				WHERE wp_posts.id IN('".$array."') $pag_sql "
				);
 
		$count = count($posts_array_Count);
					

	}	

?>
    <div class="block-3-container section-container what-we-do-container" style="margin-top: 122px !important;">
        <div class="container">
            <div class="row row_header">
				<div class="col-sm-9">	
		<?php
		if($_GET['filter']==''){
		$all = array_slice($all, $start, $per_page);
	    }
		if(!sizeof($all))
		{
			echo '<h3>Ingen IT-tjänst passade dina kriterier</h3>';
		}
		foreach($all as $key => $data)
		{
			

			$obj_id = $data->object_id;


			$data1 = $wpdb->get_results("SELECT AVG(reading) as reading, AVG(writing) as writing, AVG(skills) as skills, AVG(support) as support
	       		FROM reviews WHERE product_id = '$obj_id'
	        	");


			$link1 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE post_id = '$obj_id' AND meta_key = 'cta_link1'");
			$link2 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE post_id = '$obj_id' AND meta_key = 'cta_link2'");

			$customers = $wpdb->get_results("SELECT * FROM wp_postmeta where meta_key = 'my_meta_box_select'  AND post_id = '$obj_id' "); 

			$users = $wpdb->get_results("SELECT * FROM wp_postmeta where meta_key = 'my_meta_box_select2'  AND post_id = '$obj_id' ");

			$revenue = $wpdb->get_results("SELECT * FROM wp_postmeta where meta_key = 'my_meta_box_select3'  AND post_id = '$obj_id' ");

			$facebook = $wpdb->get_results("SELECT * FROM wp_postmeta where meta_key = 'my_meta_box_select4'  AND post_id = '$obj_id' ");

			$linkedIn = $wpdb->get_results("SELECT * FROM wp_postmeta where meta_key = 'my_meta_box_select5'  AND post_id = '$obj_id' ");

			$avg_score =  (($customers[0]->meta_value + $users[0]->meta_value + $revenue[0]->meta_value + $facebook[0]->meta_value + $linkedIn[0]->meta_value)/5) * 2 ;						

			$avg_value = ((($data1[0]->reading + $data1[0]->writing + $data1[0]->skills + $data1[0]->support) /4) ); 
			$per = $avg_value * 10;
			$imgscrfile = get_post_custom_values('product_img1_big', $obj_id);

			?>
			
			<div class="col-sm-12 p0 block-3-box wow fadeInUp crm_category_portion" style="margin-top:0px;">
					<div class="col-sm-12 p0 rubrik_main_content">
						<div class="col-sm-2 rubrik_content_img rubrik_content_cloud">
							<!--<img src="<?//= $imgscrfile[0] ?>">-->
							
							<?php
								$selected_options_data = $wpdb->get_results("select * from (select meta_value as first from wp_postmeta where post_id = ".$post_array->ID." and meta_key= 'my_meta_box_select') as first, (select meta_value as second from wp_postmeta where post_id = ".$post_array->ID." and meta_key= 'my_meta_box_select2')  as second, (select meta_value as third from wp_postmeta where post_id = ".$post_array->ID." and meta_key= 'my_meta_box_select2')  as third, (select meta_value as fourth from wp_postmeta where post_id = ".$post_array->ID." and meta_key= 'my_meta_box_select2')  as fourth, (select meta_value as fifth from wp_postmeta where post_id = ".$post_array->ID." and meta_key= 'my_meta_box_select2')  as fifth");
								
								$selected_options_data_values = $wpdb->get_results("select * from (select value_start as first_start, value_end as first_end from wp_number_scales where id = 1) as first, (select value_start as second_start, value_end as second_end from wp_number_scales1 where id = 1)  as second, (select value_start as third_start, value_end as third_end from wp_number_scales2 where id = 1)  as third, (select value_start as fourth_start, value_end as fourth_end from wp_number_scales3 where id = 1)  as fourth, (select value_start as fifth_start, value_end as fifth_end from wp_number_scales4 where id = 1)  as fifth");
								// print_r($selected_options_data_values); die;
        if(!isset($imgscrfile[0]) || empty($imgscrfile[0]))
         {
          echo '<a href="'.get_site_url().'/category_detail/'.$obj_id.'"><img src="'.get_site_url().'/wp-content/themes/twentyseventeen/assets_per/img/placeholder-image.png"/>';
         }
        else
        {?>
         <a href="<?php echo get_site_url(); ?>/category_detail/<?php echo $obj_id; ?>"><img src="<?= $imgscrfile[0]?>"></a>
       <?php }
        ?>	
						</div>
                        
                        
                       <div class="col-sm-10 p0">

						<div class="col-sm-6 crm_rubrik" style="padding-left:10px !important; text-align:left;">
							<a href="<?php echo get_site_url(); ?>/category_detail/<?php echo $data->ID; ?>"><h3><?php echo $data->post_title?></h3></a>
						</div>
						<div class="col-sm-6 crm_rubrik_detail">
							<a style="padding: 12px 25px; background: #ed833f; color: white; border-radius: 0; text-transform: uppercase; font-weight: bold;" href="<?php echo get_site_url(); ?>/category_detail/<?php echo $data->ID; ?>" class="pull-right">Läs mer</a>
						</div>
                        
                        <div class="col-sm-12 crm_rubrik p0">
								<?php $result = $wpdb->get_results("SELECT * FROM cta_links"); ?>
								<!--<h3><?php //echo $post_array->post_title?></h3>-->
                                <div class="clearfix"></div>
                                <div class="crm_rubrik_detail new_buttons_request">
                                	<a class="neon" id="<?php echo $data->post_title ?>" style="cursor: pointer; background: transparent; color: #ed833f; text-decoration: underline; padding: 0 !important; font-weight: bold; text-transform: uppercase">Testa gratis</a>
									<a class="neon" id="<?php echo $data->post_title ?>" style="cursor: pointer; background: transparent; color: #470a76; text-decoration: underline; padding: 0 0 0 5px !important; font-weight: bold; text-transform: uppercase"" >Bli kontaktad</a></div>
                                
							</div>
                        </div>
						<style>
                            .new_buttons_request
							{
								margin-top: 0px;
								margin-bottom: 12px;
								text-align: left;
								margin-left: 10px;
							}
							.new_buttons_request .neon{
								background: #44aa44;
							}
							.neon
							{
								margin-right:5px !important;
							}
                            </style>
						
							
					</div>
					<div class="col-sm-12 rubrik_content_para">
						<div class="col-sm-2 rubrik_progress_score">
						<h4>Omdöme</h4>
						</div>
						<div class="col-sm-4">

							<span class="rateyo" id="total_<?php echo $key; ?>" style="margin-top: 12px;"></span>
						</div>								
						<div class="clearfix"></div>

						<div class="col-sm-2 rubrik_progress_score">
						<h4>Betyg</h4>
						</div>

						<?php 
						$array = ["'".$selected_options_data_values[0]->first_start."-".$selected_options_data_values[0]->first_end."'", "'".$selected_options_data_values[0]->second_start."-".$selected_options_data_values[0]->second_end."'", "'".$selected_options_data_values[0]->third_start."-".$selected_options_data_values[0]->third_end."'", "'".$selected_options_data_values[0]->fourth_start."-".$selected_options_data_values[0]->fourth_end."'", "'".$selected_options_data_values[0]->fifth_start."-".$selected_options_data_values[0]->fifth_end."'"];
						?>
						<div class="col-sm-4" style="padding-right: 0px">
							

							<div class="progress rubrik_progress">
								<div class="progress-bar progress-bar-rubrik" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo ($avg_score)? $avg_score*10: 20; ?>%">
									<?php echo $avg_score; ?> / 10
								</div>
							</div>
							
						</div>
						<div class="col-sm-1" style="padding-left: 0px">
							
					          <h4 class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-html="true" title="<?php echo 'Kunder : '.$array[0].'<br> Användare : '.$array[1].'<br> Omsättning : '.$array[2].'<br> Facebook : '.$array[3].'<br> LinkedIn : '.$array[4]  ?>" data-placement="top" style="color:#2ba560"></h4>
					        
						</div>
						<div class="clearfix"></div>
<!--						<p class="ttext">--><?php //echo $data->post_content?><!--</p>-->
					</div>
			</div>
			<div class="clear10"></div>
			<script>
				$(document).ready(function(){

					var total = "#total_"+<?php echo $key; ?>;

					console.log(total);
					$(total).rateYo({

				    starWidth: "20px",
				    rating: <?php echo ($avg_value)?:0; ?>,
				    readOnly: true
				   });

				});  
			</script>				
		<?php } ?>
				
<!---->

<?php

function get_paging_info($tot_rows,$pp,$curr_page)
{

    $pages = ceil($tot_rows / $pp); // calc pages

    $data = array(); // start out array
    $data['si']        = ($curr_page * $pp) - $pp; // what row to start at
    $data['pages']     = $pages;                   // add the pages
    $data['curr_page'] = $curr_page;               // Whats the current page

    return $data; //return the paging data

}

?>
        <!-- Call our function from above -->
<?php 

// $page = $_GET['u'];
// if($page == ''){
// 	$page = 1;
	
// }

 $paging_info = get_paging_info($count,$per_page,$page);


?>

<!--pagination code here-->


<!---Pagination-->

<ul class="pagination">
    <!-- If the current page is more than 1, show the First and Previous links -->
    
    <?php if($paging_info['curr_page'] > 1) : ?>
        <a href='?u=1<?php echo '&'.$conct_url; ?>' title='Page 1'>First</a>
        <a href='?u=<?php echo ($paging_info['curr_page'] - 1) ?><?php echo '&'.$conct_url; ?>' title='Page <?php echo ($paging_info['curr_page'] - 1); ?><?php echo '&'.$conct_url; ?>'>Prev</a>
    <?php endif; ?>



    <?php
        //setup starting point

        //$max is equal to number of links shown
        $max = 5;
        if($paging_info['curr_page'] < $max)
            $sp = 1;
        elseif($paging_info['curr_page'] >= ($paging_info['pages'] - floor($max / 2)) )
            $sp = $paging_info['pages'] - $max + 1;
        elseif($paging_info['curr_page'] >= $max)
            $sp = $paging_info['curr_page']  - floor($max/2);
    ?>

    <!-- If the current page >= $max then show link to 1st page -->
    <?php if($paging_info['curr_page'] >= $max) : ?>

        <a href='?u=1<?php echo '&'.$conct_url; ?>' title='Page 1'>1</a>
        <a href="javascript:void(0)">..</a>

    <?php endif; ?>

    <!-- Loop though max number of pages shown and show links either side equal to $max / 2 -->
    <?php for($i = $sp; $i <= ($sp + $max -1);$i++) : ?>

        <?php
            if($i > $paging_info['pages'])
                continue;
        ?>

        <?php if($paging_info['curr_page'] == $i) : ?>

            <a href="?u=<?php echo $i;?><?php echo '&'.$conct_url; ?>" style="background-color:<?php echo ($_GET['u']==$i ||$_GET['u']=='')?'#480B76': ''; ?>; color:<?php echo ($_GET['u']==$i ||$_GET['u']=='' )?'white': ''; ?>"><?php echo $i; ?></a>

        <?php else : ?>

            <a href='?u=<?php echo $i;?><?php echo '&'.$conct_url; ?>' style="background-color:<?php echo ($_GET['u']==$i ||$_GET['u']=='')?'#480B76': ''; ?>; color:<?php echo ($_GET['u']==$i ||$_GET['u']=='' )?'white': ''; ?>" title='Page <?php echo $i; ?>'><?php echo $i; ?></a>

        <?php endif; ?>

    <?php endfor; ?>


    <!-- If the current page is less than say the last page minus $max pages divided by 2-->
    <?php if($paging_info['curr_page'] < ($paging_info['pages'] - floor($max / 2))) : ?>

        <a href="javascript:void(0)">..</a>
        <a href='?u=<?php echo $paging_info['pages'];?><?php echo '&'.$conct_url; ?>' style="background-color:<?php echo ($_GET['u']==$i ||$_GET['u']=='')?'#480B76': ''; ?>; color:<?php echo ($_GET['u']==$i ||$_GET['u']=='' )?'white': ''; ?>" title='Page <?php echo $paging_info['pages']; ?>'><?php echo $paging_info['pages']; ?></a>

    <?php endif; ?>

    <!-- Show last two pages if we're not near them -->
    <?php if($paging_info['curr_page'] < $paging_info['pages']) : ?>

        <a href='?u=<?php echo ($paging_info['curr_page'] + 1);?><?php echo '&'.$conct_url; ?>' title='Page <?php echo ($paging_info['curr_page'] + 1); ?>'>Nästa</a>

        <a href='?u=<?php echo $paging_info['pages']; ?><?php echo '&'.$conct_url; ?>' title='Page <?php echo $paging_info['pages']; ?>'>Föregående</a>

    <?php endif; ?>
</ul>
<!---->


		</div>
		<div class="col-sm-3">
            <div class="crm_sidebar_main">
			
				<div class="col-sm-12 p0">
					<div class="col-sm-12 crm_sidebar">
						<h3>Filtrering</h3>
					</div>
					<?php 
					$options = $wpdb->get_results("SELECT * FROM wp_number_scales");
					$options1 = $wpdb->get_results("SELECT * FROM wp_number_scales1");
					$options2 = $wpdb->get_results("SELECT * FROM wp_number_scales2");
					$options3 = $wpdb->get_results("SELECT * FROM wp_number_scales3");
					$options4 = $wpdb->get_results("SELECT * FROM wp_number_scales4");

    				 ?>
					<form action="" method="get">
						<div class="col-sm-12 crm_sidebar_checkbox review_stars_box">
							<ul class="form-option-list reviews-stars">
								<!-- <input type="hidden" name="category" value="<?php echo $_GET['search_category']; ?>"> -->
								<input type="hidden" name="u" value="1">
								<input type="hidden" name="search" value="<?php echo $_GET['search']; ?>">
								<li>

									<input class="checkbox" id="review_stars_1" name="review_stars" type="radio" value="5" <?php echo ($_GET['review_stars'] == 5)?'checked':'' ?>> &nbsp; 
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span>(4 - 5)</span>
								</li>
								<li>
									<input class="checkbox" id="review_stars_2" name="review_stars" type="radio" value="4" <?php echo ($_GET['review_stars'] == 4)?'checked':'' ?>> 
									&nbsp;
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span>(3 - 4)</span>
								</li>
								<li>
									<input class="checkbox" id="review_stars_3" name="review_stars" type="radio" value="3" <?php echo ($_GET['review_stars'] == 3)?'checked':'' ?>> &nbsp;
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span>(2 - 3)</span>
								</li>
								<li>
									<input class="checkbox" id="review_stars_4" name="review_stars" type="radio" value="2" <?php echo ($_GET['review_stars'] == 2)?'checked':'' ?>>&nbsp; 
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span>(1 - 2)</span>
								</li>
								<li>
									<input class="checkbox" id="review_stars_5" name="review_stars" type="radio" value="1" <?php echo ($_GET['review_stars'] == 1)?'checked':'' ?>>&nbsp; 
									<span><i class="fa fa-star" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
									<span>(0 - 1)</span>
								</li>
								<input class="checkbox" id="review_stars_6" name="review_stars" type="radio" value="" <?php if(empty($_GET['review_stars'])){echo 'checked';} ?> style="display: none">
							</ul>
							
							<div class="clear10"></div>
							<h5>Kunder:</h5>
							<select class="rating_select_option" id="customer" name="customer" style="width: 174px;">
							
							<option value="">Välj alternativ</option>
							
							<?php foreach($options as $key => $option){ ?>
								<?php if($_GET['customer'] == $key+1){ ?>
								<option value="<?php echo $key + 1; ?>" selected><?php echo $option->value_start; echo ($key != 5)?'-':''; echo $option->value_end; ?> </option>
								<?php }else{?>
								<option value="<?php echo $key + 1; ?>"><?php echo $option->value_start; echo ($key != 4)?'-':''; echo $option->value_end; ?> </option>
								<?php } ?>
							<?php } ?>
							</select>

							<div class="clear10"></div>
							<h5>Antal användare:</h5>
							<select class="rating_select_option" id="users" name="users" style="width: 174px;">
							
							<option value="">Välj alternativ</option>
							
							<?php foreach($options1 as $key => $option){ ?>
								<?php if($_GET['users'] == $key+1){ ?>
								<option value="<?php echo $key + 1; ?>" selected><?php echo $option->value_start; echo ($key != 5)?'-':''; echo $option->value_end; ?> </option>
								<?php }else{?>
								<option value="<?php echo $key + 1; ?>"><?php echo $option->value_start; echo ($key != 4)?'-':'-'; echo $option->value_end; ?> </option>
								<?php } ?>
							<?php } ?>
							</select>

							<div class="clear10"></div>
							<h5>Omsättning:</h5>
							<select class="rating_select_option" id="revenu" name="revenu" style="width: 174px;">
							
							<option value="">Välj alternativ</option>
							
							<?php foreach($options2 as $key => $option){ ?>
								<?php if($_GET['revenu'] == $key+1){ ?>
								<option value="<?php echo $key + 1; ?>" selected><?php echo $option->value_start; echo ($key != 5)?'-':''; echo $option->value_end; ?> </option>
								<?php }else{?>
								<option value="<?php echo $key + 1; ?>"><?php echo $option->value_start; echo ($key != 4)?'-':'-'; echo $option->value_end; ?> </option>
								<?php } ?>
							<?php } ?>
							</select>

							<div class="clear10"></div>
							<h5>Facebook följare:</h5>
							<select class="rating_select_option" id="facebook" name="facebook" style="width: 174px;">
							
							<option value="">Välj alternativ</option>
							
							<?php foreach($options3 as $key => $option){ ?>
								<?php if($_GET['facebook'] == $key+1){ ?>
								<option value="<?php echo $key + 1; ?>" selected><?php echo $option->value_start; echo ($key != 5)?'-':''; echo $option->value_end; ?> </option>
								<?php }else{?>
								<option value="<?php echo $key + 1; ?>"><?php echo $option->value_start; echo ($key != 4)?'-':'-'; echo $option->value_end; ?> </option>
								<?php } ?>
							<?php } ?>
							</select>

							<div class="clear10"></div>
							<h5>LinkedIn följare:</h5>
							<select class="rating_select_option" id="linkedin" name="linkedin" style="width: 174px;">
							
							<option value="">Välj alternativ</option>
							
							<?php foreach($options4 as $key => $option){ ?>
								<?php if($_GET['linkedin'] == $key+1){ ?>
								<option value="<?php echo $key + 1; ?>" selected><?php echo $option->value_start; echo ($key != 5)?'-':''; echo $option->value_end; ?> </option>
								<?php }else{?>
								<option value="<?php echo $key + 1; ?>"><?php echo $option->value_start; echo ($key != 4)?'-':'-'; echo $option->value_end; ?> </option>
								<?php } ?>
							<?php } ?>
							</select>
						</div>
						<a href="<?= $clear_filter ?>" class="btn btn-primary" style="background:#480B76">Rensa</a>
								<input class="btn btn-primary" type="submit" name="filter" value="Filtrera" name="filter" style="background:#480B76">
						<div class="clear10"></div>
						<div class="clear10"></div>
					</form>
				</div>
				
                	<div class="clearfix"></div>
            </div>
            					<div class="clear10"></div>
							
						<div class="col-sm-12 crm_sidebar_main">
                        
                     
							<div class="col-sm-12 crm_sidebar">
								<h3>Sök kategorier</h3>
							</div>
							
							<div class="clear10"></div>
							   <div class="col-sm-12">
							<?php if($listed_categories){ ?>
							<?php foreach ($listed_categories as $key => $category) {?>
							<div class="col-sm-12 p0 similar_cat_crm">
								<div class="col-sm-12">
									<a href="/subcategory/<?php echo $category->slug ?>"><h5><?php echo strtoupper($category->name); ?></h5></a>
								</div>
							</div>
							<?php } ?>
							<?php }else{ ?>
								<div class="col-sm-12 p0 similar_cat_crm">
								<div class="col-sm-12">
									<h5>Category Not Found</h5>
								</div>
							</div>
							<?php } ?>
							
							<!-- <div class="col-sm-12 p0 similar_cat_crm">
								<div class="col-sm-8">
									<h5>Marketing Automation</h5>
								</div>
							</div>
							
							<div class="col-sm-12 p0 similar_cat_crm">

								<div class="col-sm-8">
									<h5>Email Automation</h5>
								</div>
							</div> -->
                            </div>
						</div>
					</div>		
		</div>


	</div>
</div>



<!-- Request Model Body Start-->
<div id="requestModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <img src="http://it-finder.leadconcept.com/wp-content/themes/twentyseventeen/assets_per/img/logo.png" style="width: 140px"/>
        <h3>Kontaktförfrågan</h3>
        <h6>IT Finder kan komma att kontakta dig angående din förfrågan</h6>
      </div>
      <div class="modal-body">
      <form id="request_form" method="post" action="<?php echo get_site_url(); ?>/request-submit">
      	  <div class="row">
      	  		<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="name" style="float: left;">Namn <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="text" name="name1" class="form-control" style="border-radius:0px" id="contact_name" required>
				    </div>
      	  		</div>
      	  		<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="company" style="float: left">Företag <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="text" name="company" class="form-control" style="border-radius:0px" id="contact_company" required>
				    </div>
      	  		</div>
				<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="phone" style="float: left">Telefon <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="text" name="phone" class="form-control" style="border-radius:0px" id="contact_phone" required>
				    </div>
      	  		</div>
      	  		<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="email" style="float: left">Email <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="email" name="email" class="form-control" style="border-radius:0px" id="contact_email" required>
				    </div>
      	  		</div>
      	  		<input type="hidden" name="p_id" value="<?php echo $redirect; ?>">
      	  		<input type="hidden" id="product" name="product" value="">    	  		
      	  </div>
		  <input type="checkbox" id="accept-term-5" name="accept-term" required />
		  <label for="accept-term-5">Jag godkänner IT-Finders <a href="#">villkor</a></label>
      </form>


      </div>
      <div class="modal-footer">
        <button type="button" id="submit_request" class="btn btn-primary btn-block" style="background-color: #480b76">Skicka</button>
      </div>
    </div>

  </div>
</div>
<!---->

<!-- Request Model Body Start-->
<div id="trailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <img src="http://it-finder.leadconcept.com/wp-content/themes/twentyseventeen/assets_per/img/logo.png" style="width: 140px"/>
        <h3>Testa gratis</h3>
        <h6>IT Finder kan komma att kontakta dig angående din förfrågan</h6>
      </div>
      <div class="modal-body">
      <form id="trail_form" method="post" action="<?php echo get_site_url(); ?>/trail-submit">
      	  <div class="row">
      	  		<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="name" style="float: left;">Namn <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="text" name="name1" class="form-control" style="border-radius:0px" id="trail_name" required>
				    </div>
      	  		</div>
      	  		<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="company" style="float: left">Företag <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="text" name="company" class="form-control" style="border-radius:0px" id="trail_company" required>
				    </div>
      	  		</div>
				<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="phone" style="float: left">Telefon <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="text" name="phone" class="form-control" style="border-radius:0px" id="trail_phone" required>
				    </div>
      	  		</div>
      	  		<div class="col-sm-6">
      	  			<div class="form-group">
					    <label for="email" style="float: left">Email <span style="color:red; font-size: 15px;">*</span></label>
					    <input type="email" name="email" class="form-control" style="border-radius:0px" id="trail_email" required>
				    </div>
      	  		</div>
      	  		<input type="hidden" name="p_id" value="<?php echo $redirect; ?>">
      	  		<input type="hidden" id="product" name="product" value="">     	  		
      	  </div>
		  <input type="checkbox" id="accept-term-6" name="accept-term" required />
		  <label for="accept-term-6">Jag godkänner IT-Finders <a href="#">villkor</a></label>
      </form>


      </div>
      <div class="modal-footer">
        <button type="button" id="trail_request" class="btn btn-primary btn-block" style="background-color: #480b76">Skicka</button>
      </div>
    </div>

  </div>
</div>
<!---->	

</div>
		





<style>
@media only screen and (max-width: 425px) {
	.rubrik_content_cloud{
		margin-top:10px;
	}

	.rubrik_content_cloud img{
	    width: 70% !important;
	}
}
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 4px 8px;
    text-decoration: none;
}
/**** new ****/
.reviews-stars{
	margin:0px;
	padding:0px;
}

.reviews-stars li{
	float:left;
	list-style-type:none;
	width:100%;
	display: inline-flex;
}

.reviews-stars li span{
	padding-right: 5px;
	font-size:18px;
	color:#ffd814;
}

.review_stars_box .fa-star-o{
	color:#f2f4f6;	
}

.review_stars_box{
	padding:10px;
}

.rating_select_option{
	align-items: center;
    white-space: pre;
    -webkit-rtl-ordering: logical;
    color: black;
    background-color: white;
    cursor: default;
    border-width: 1px;
    border-style: solid;
}

@media (min-width: 768px) and (max-width: 992px) {
	.reviews-stars li {
		display: -webkit-box !important;
	}
}


</style>
<style>
	.modal-open {
	    overflow: scroll;
	    padding-right: 0 !important;
	}


</style>			
<script>
$('document').ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});

$('.neon').on('click', function (e) {
	var product_name = e.target.id;
	console.log(product_name);
	if(e.target.text == 'I want free trial')
	{
		$('#trailModal').modal('show');
	}
	else
	{
		$('#requestModal').modal('show');
	}
	
	$('#product').val(product_name);
});


 $('#submit_request').on('click', function (e) {
 		e.preventDefault();
		var name    = $('#contact_name').val();
		var company = $('#contact_company').val();
		var phone   = $('#contact_phone').val();
		var email   = $('#contact_email').val();
	 	var check   = $('#accept-term-5').is(':checked') ? 1 : '';


	 if(name != '' && company != '' && phone != '' && email != ''  && check != '')
		{
			$('#request_form').submit();
		}
		else
		{
			swal({
			   title: "Warning!",
			   text: "Please! Fill all required fields",
			   icon: "warning",
			 })
		} 		
        
 });


 $('#trail_request').on('click', function (e) {
 		e.preventDefault();
 		console.log(e.target.id);
		var name    = $('#trail_name').val();
		var company = $('#trail_company').val();
		var phone   = $('#trail_phone').val();
		var email   = $('#trail_email').val();
	 	var check   = $('#accept-term-6').is(':checked') ? 1 : '';


	 if(name != '' && company != '' && phone != '' && email != ''  && check != '')
		{
			$('#trail_form').submit();
		}
		else
		{
			swal({
			   title: "Warning!",
			   text: "Please! Fill all required fields",
			   icon: "warning",
			 })
		} 
    });

</script>
		

<?php if(get_transient('request_error')){   ?>
<script>
$(document).ready(function(e){
	swal({
	   title: "Success!",
	   text: "Thank You! for Submiting your Request.",
	   icon: "success",
	 }).then((willDelete) => {
          if (willDelete) {
   			<?php delete_transient('request_error'); ?>
          } else {
            swal("Your imaginary file is safe!");
          }
        });
	}); 
</script>

<?php } ?>

<?php get_footer();?>
