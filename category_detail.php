<style>
	.new_buttons_request
	{
		margin-top: 0px;
		margin-bottom: 12px;
		text-align: left;
		margin-left: 10px;
		border: 0px !important; 
	}
	.new_buttons_request .neon{
		background: #44aa44;
		border: 0px !important;
	}
	.neon
	{
		margin-right:5px !important;
		border: 0px !important;
	}
.neon:hover 
	{
	background: #44aa44 !important;
	border: 0px !important;
	color:white !important;
	}


</style>
<?php
    /**
    * Template Name: category_detail
    */
    global $wpdb;
	get_header();
	

	//echo get_transient('error'); die;
?>
<!--<div class="page-title_guider  top-guider">
            <div class="page-title-text wow fadeInUp crm_title" style="height: 210px; padding-top: 87px">
				<h1>Category Detail</h1>
	
				
            </div>
        </div>-->
		
        <div class="block-3-container section-container what-we-do-container">
	        <div class="container-fluid">
	            <div class="row">
					<div class="col-sm-12 crm_rating_header">
					<?php
		 $current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 $exploded_array=explode("/",$current_url);
		 $currentID = $exploded_array[sizeof($exploded_array)-2]; 

		 $content_post = get_post($currentID);

		 // echo $currentID; die;
		 
		$postThumb = get_post_custom_values('product_img1_big', $content_post->ID);
		//$postThumb1 = get_post_custom_values('product_img2_big', $content_post->ID);
		//$postThumb3 = get_post_custom_values('product_img3_big', $content_post->ID);
		
		?>
						<div class="col-sm-2 col-xs-4 google_drive_rating">

							<?php
							 if(!isset($postThumb[0]) || empty($postThumb[0]))
								 {
								 echo '<img src="http://it-finder.leadconcept.com/wp-content/themes/twentyseventeen/assets_per/img/placeholder-image.png"/>';
								 }
								else
								{?>
									<img src="<?= $postThumb[0]?>">
							<?php	}
							 ?>
							
						</div>
						<div class="col-sm-4 col-xs-8 p0 google_drive_content">
							<h3><?php echo $content_post->post_title;?></h3>
							<p>Omdöme</p>
							<div class="rateyo"></div>
						</div>
						<?php 

						$result = $wpdb->get_results("SELECT * FROM cta_links");
						$link1 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE post_id = '$currentID' AND meta_key = 'cta_link1'");
						$link2 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE post_id = '$currentID' AND meta_key = 'cta_link2'");
						?>
						<div class="col-sm-1">
						</div>
						<div class="cd-single-product-buttons">
							<div class="">
								<a style="background:#44aa44; cursor: pointer;" id="trial" class="neon btn-request"  data-toggle="modal" data-target="#trailModal" target="blank">Testa en gratisperiod</a>
							</div>
							<div class="">
								<a class="neon" style="cursor: pointer;" data-toggle="modal" data-target="#requestModal" target="blank">Kontakta</a>
							</div>
						</div>
					</div>
				</div>
	        </div>
        </div>
		
		<div class="container p0">

		
		
			<div class="col-sm-12 p0">
				<div class="col-sm-8 rating_content_para" style="text-align:justify;">
				<?php echo $content_post->post_content;?>
					
				</div>
				<div class="col-sm-4 rating_content_img">
					
							<?php
							 if(!isset($postThumb[0]) || empty($postThumb[0]))
								 {
								 echo '<img src="http://it-finder.leadconcept.com/wp-content/themes/twentyseventeen/assets_per/img/placeholder-image.png"/>';
								 }
								else
								{?>
									<img src="<?= $postThumb[0]?>">
							<?php	}
							 ?>
				</div>
			</div>
			
			<div class="clear30"></div>

		<?php 
			// it could be in header
			// $email =  do_shortcode('[user-data]');
			// $data = $wpdb->get_results("SELECT * 
			//        FROM wp_EWD_FEUP_Users WHERE Username = '$email'
			//         ");

			$user_id = get_current_user_id();

		?>
		<?php 

			if($user_id){
			$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$exploded_array=explode("/",$current_url);
			$productID = $exploded_array[sizeof($exploded_array)-2];


			$array_data2 = $wpdb->get_results("SELECT * 
						       FROM  reviews where user_id = '$user_id' and product_id = '$productID'");



			$avg_value = ($array_data2[0]->reading + $array_data2[0]->writing + $array_data2[0]->skills + $array_data2[0]->support) / 4;
			}
			else{

			$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$exploded_array=explode("/",$current_url);
			$productID = $exploded_array[sizeof($exploded_array)-2];


			// $array_data = $wpdb->get_results("SELECT * 
			// 			       FROM  reviews where user_id = '$user_id' and product_id = '$productID'");

			
			$array_data = $wpdb->get_results("SELECT AVG(reading) as reading, AVG(writing) as writing, AVG(skills) as skills, AVG(support) as support
	       		FROM reviews WHERE product_id = '$productID'
	        	");

			
			$avg_value = ($array_data[0]->reading + $array_data[0]->writing + $array_data[0]->skills + $array_data[0]->support) / 4;
							

			}

		?>

			<div class="col-sm-12 p0 google_drive_rating_box">
				<div class="col-md-8 col-sm-6 drive_rating_box">
					<div class="col-sm-12 p0">
						<div class="col-sm-2 p0">
							<!--<img src="<?//= $postThumb[0]?>">-->
							
							<?php
							 if(!isset($postThumb[0]) || empty($postThumb[0]))
								 {
								 echo '<img src="http://it-finder.leadconcept.com/wp-content/themes/twentyseventeen/assets_per/img/placeholder-image.png"/>';
								 }
								else
								{?>
									<img src="<?= $postThumb[0]?>">
							<?php	}
							 ?>
							
						</div>
						<div class="col-sm-10 col-xs-12 p0">
							<h3><?php echo $content_post-> post_title;?></h3>
						</div>
					</div>
					<div class="clear20"></div>
					<?php echo $content_post-> post_content;?>
				</div>
				<div class="col-md-4 col-sm-6 rating_review_star p0">
					<div class="col-sm-12 rating_mobile_display p0">
						<div class="col-sm-4 col-xs-7">
							<h4>Helhetsintryck</h4>
						</div>
						<div class="col-sm-8 col-xs-5">
						<div  class="reading11" style="float: right;margin-right: 0;"></div>
						</div>
					</div>
					<div class="col-sm-12 rating_mobile_display p0">
						<div class="col-sm-4 col-xs-7">
							<h4>Användarvänlighet</h4>
						</div>
						<div class="col-sm-8 col-xs-5">
							<div class="writing22" style="float: right;margin-right: 0;"></div>
						</div>
					</div>
					<div class="col-sm-12 rating_mobile_display p0">
						<div class="col-sm-4 col-xs-7">
							<h4>Funktionalitet</h4>
						</div>
						<div class="col-sm-8 col-xs-5">
							<div class="skills33" style="float: right;margin-right: 0;"></div>
						</div>
					</div>
					<div class="col-sm-12 rating_mobile_display p0">
						<div class="col-sm-4 col-xs-7">
							<h4>Support</h4>
						</div>
						<div class="col-sm-8 col-xs-5">
							<div class="support44	" style="float: right;margin-right: 0;"></div>
						</div>
					</div>
					
					<div class="clear20"></div>
					
					<div class="col-sm-12 rating_mobile_display p0 total_rating_star">
						<div class="col-sm-4 col-xs-7">
							<h4>Totalt</h4>
						</div>
						<div class="col-sm-8 col-xs-5">
							<div class="rateyo" style="float: right;margin-right: 0;"></div>
						</div>
						
					</div>
				</div>
			</div>



		</div>
		
		<div class="clear50"></div>




		<?php //if(!empty(do_shortcode('[user-data field_name="First Name"]'))){ ?>  


<div class="container p0">
				
				<div class="col-sm-12 p0 google_drive_rating_box">
					<h3>Här kan du lämna ett omdöme.</h3>
					<form id="reviews_form" method="post" action="<?php echo get_site_url(); ?>/review_submit/">
						<div class="col-sm-6 rating_review_star p0">
							<div class="col-sm-12 rating_mobile_display p0">
								<div class="col-sm-6 col-xs-5">
									<h4>Helhetsintryck</h4>
								</div>
								<div class="col-sm-6 col-xs-7">
									<div id="reading" class="rateyo reading" style="float: right;margin-right: 47px;"></div>
									<input type="hidden" name="reading" id="reading_field" value="">
								</div>
							</div>
							<div class="col-sm-12 rating_mobile_display p0">
								<div class="col-sm-4 col-xs-5">
									<h4>Användarvänlighet</h4>
								</div>
								<div class="col-sm-8 col-xs-7">
									<div id="writing" class="rateyo writing" style="float: right;margin-right: 47px;"></div>
									<input type="hidden" name="writing" id="writing_field" value="">
								</div>
							</div>
							
							<div class="clear20"></div>
						</div>
						<div class="col-sm-6 rating_review_star p0">
							<div class="col-sm-12 rating_mobile_display p0">
								<div class="col-sm-4 col-xs-5">
									<h4>Funktionalitet</h4>
								</div>
								<div class="col-sm-8 col-xs-7">
									<div id="skills" class="rateyo skills" style="float: right;margin-right: 47px;"></div>
									<input type="hidden" name="skills"  id="skills_field" value="">
								</div>
							</div>
							<div class="col-sm-12 rating_mobile_display p0">
								<div class="col-sm-4 col-xs-5">
									<h4>Support</h4>
								</div>
								<div class="col-sm-8 col-xs-7">
									<div id="support" class="rateyo support" style="float: right;margin-right: 47px;"></div>
									<input type="hidden" name="supports" id="supports_field" value="">
								</div>
							</div>						
						</div>
					<?php //if(empty($array_data) && empty($array_data2)){ 
						//echo json_encode($array_data2); die;?>	
						<div class="col-sm-12 rating_review_star p0">

							<div class="row" style="margin:7px;">
								
								<br>
								<div class="col-sm-4">

								</div>
								<div class="col-sm-6 form_input_align" style="text-align:left;">
									<div class="form-group">
	    								<label for="name">Namn: <span style="color:red; font-size: 15px;">*</span></label>

										<input id="name" style="" class="form-control reviews-data" type="text" name="name1" value="<?php echo ($current_user->display_name)?: ''  ?>" required>
									</div>
									<div class="form-group">
	    								<label for="email">Email: <span style="color:red; font-size: 15px;">*</span></label>

										<input id="email"  class="form-control reviews-data" type="email" name="email1" value="<?php echo ($current_user->user_email)?: ''  ?>" required>

									</div>									
									<div class="form-group">
	    								<label for="email">Företagsnamn: <span style="color:red; font-size: 15px;">*</span></label>
										<input id="company" type="text" class="form-control reviews-data" name="company" value="<?php echo ($array_data[0]->companyName)?: ''  ?>" required>
									</div>
								</div>
							</div>


						</div>
					<?php //} ?>	
						
						
						<input type="hidden" name="id" value="<?php echo $user_id?:'NAN'; ?>">
						<input type="hidden" name="p_id" value="<?php echo $productID; ?>">
						
						<div class="clearfix"></div>
						<?php
						
						//if(empty($array_data2) && empty($array_data)){
						?>
					    <Button id="submit_review" class="btn btn-primary" style="background-color: #480b76; " name="request" type="submit" class="" >Skicka</Button>
					    <?php //} ?>
					   
					</form>

				</div>
				<div class="container p0"></div>
				 <div class="clear30"></div>
</div>

		<div class="container p0">
				<div class="col-sm-12 p0 google_drive_rating_box">
					<h3>Kund Omdömen</h3>
						<div class="col-sm-12 rating_review_star p0">
							<?php 

								$reviews = $wpdb->get_results("SELECT * FROM reviews WHERE product_id = '$currentID' ORDER BY reviewedTime DESC "); 
								$reviews_count = count($reviews);

								if($reviews_count == 0 ){
									echo "<h5>Det finns inga omdömen ännu!</h5></br>";
								}

								$value = 5;
								foreach ($reviews as $key => $review) {

								if($key == $value)
								{
									$value += 5;
								}

							?>
							<div id="responsive_review" class="row <?php echo $value; ?> rating_row_mrg" style="display: <?php echo ($key > 4)? 'none':''; ?>" >
								
								<br>
								<div class="col-sm-4">
									<p><strong>Namn:</strong> <?php echo ($review->name)?:'No Name'; ?></p>
									<p><strong>Företagsnamn: </strong><?php echo ($review->companyName)?:'No Company'; ?></p>
									<p><strong>Email: </strong><?php echo ($review->email)?:'No Address'; ?></p>
								</div>
								<div class="col-sm-4 " >
								<br>
									Helhetsintryck<div id="reading_review_<?php echo $key; ?>" class="review1 reading_review" style="float: right;margin-right: 100px;"></div>
									<br><br>
									Användarvänlighet<div id="writing_review_<?php echo $key; ?>" class="review1 writing_review" style="float: right;margin-right: 100px;"></div>
								</div>
								<div class="col-sm-4" >
								<br>
									Funktionalitet<div id="skills_review_<?php echo $key; ?>" class="review1 skills_review" style="float: right;margin-right: 100px;"></div>
									<br><br>
									Support<div id="support_review_<?php echo $key; ?>" class="review1 support_review" style="float: right;margin-right: 100px;"></div>
									</div>
							</div>
							<hr class="<?php echo $value; ?>" style="display: <?php echo ($key > 4)? 'none':''; ?>" >
				<script>
						$(document).ready(function(){
							var writing_review = "#writing_review_"+<?php echo $key; ?>;

							$(writing_review).rateYo({

						    starWidth: "20px",
						    rating:  <?php echo ($review->writing)?:0; ?> ,
						    readOnly: true
						   });

							var reading_review = "#reading_review_"+<?php echo $key; ?>;
						    $(reading_review).rateYo({

						    starWidth: "20px",
							rating:  <?php echo ($review->reading)?:0; ?>,
						    readOnly: true
						   });
						    var skills_review = "#skills_review_"+<?php echo $key; ?>;
						    $(skills_review).rateYo({

						    starWidth: "20px",
						    rating:  <?php echo ($review->skills)?:0; ?>,
						    readOnly: true
						   }); 

						     var support_review = "#support_review_"+<?php echo $key; ?>;
						    $(support_review).rateYo({

						    starWidth: "20px",
						    rating:  <?php echo ($review->support)?:0; ?>,
						    readOnly: true
						   });

						});  
				</script>							
							<?php } ?>

							</div>
				<?php if($reviews_count > 5){ ?>
				<a href="" id="load-more" class="btn btn-primary" style="background-color: #480b76; padding: 7px 25px 7px 25px ; color:white;" >Ladda fler ..</a>
				<br><br>
				<?php } ?>
				</div>


</div>
	
						<div class="clearfix"></div>


				</div>
				<div class="container p0"></div>
				 <div class="clear30"></div>
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
      	  		<input type="hidden" name="p_id" value="<?php echo $productID; ?>">
      	  		<input type="hidden" name="product" value="<?php echo $content_post->post_title;?>">     	  		
      	  </div>
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
        <h3>Testa en gratisperiod</h3>
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
      	  		<input type="hidden" name="p_id" value="<?php echo $productID; ?>">
      	  		<input type="hidden" name="product" value="<?php echo $content_post->post_title;?>">     	  		
      	  </div>
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

<?php 
             // $checkVal = do_shortcode('[user-data]');
             
             // if(!empty($checkVal))
			 


			 $current_user = wp_get_current_user();
						if ( 0 != $current_user->ID ) {?>
			
		<?php }else{ ?>
		<!-- <p>You have to login befor rate it! <a href="<?php echo get_site_url(); ?>/Login/">Login</a></p> -->
		<?php } ?>
		<!-- Contact us (block 2) -->

<script>

$(document).ready(function(){
	
  $(".reading").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#reading_field').val(rating);
    },
	readOnly: 0<?php //echo (!empty($array_data[0]->reading))? true:0  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: 0<?php //echo (!empty($array_data2[0]->reading))? : 0  ?>
  });

  $(".writing").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#writing_field').val(rating);
    },
	readOnly: 0<?php //echo ($array_data[0]->writing)? true:0  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: 0<?php //echo ($array_data2[0]->writing)?: 0  ?>
  });

  $(".skills").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#skills_field').val(rating);
    },
	readOnly: 0<?php //echo (!empty($array_data[0]->skills))? true:0  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: 0<?php //echo ($array_data2[0]->skills)?: 0  ?>
  }); 
  
    $(".support").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#supports_field').val(rating);
    },
	readOnly: 0<?php //echo (!empty($array_data[0]->support))? true:0  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: 0<?php //echo ($array_data2[0]->support)?: 0  ?>
  });

   $(".rateyo").rateYo({

    starWidth: "25px",
    rating: 0.3,
    rating: <?php echo ($avg_value)?: 0  ?>,
    readOnly: true
   });


         



  $(".reading11").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#reading_field').val(rating);
    },
	readOnly: <?php echo (!empty($array_data[0]->reading))? true:true  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: <?php echo ($array_data[0]->reading)?: 0  ?>
  });

  $(".writing22").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#writing_field').val(rating);
    },
	readOnly: <?php echo (!empty($array_data[0]->writing))? true:true  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: <?php echo ($array_data[0]->writing)?: 0  ?>
  });

  $(".skills33").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#skills_field').val(rating);
    },
	readOnly: <?php echo (!empty($array_data[0]->skills))? true:true  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: <?php echo ($array_data[0]->skills)?: 0  ?>
  }); 
  
    $(".support44").rateYo({
    onSet: function (rating, rateYoInstance) {
      console.log("current rating" + rating);
	  $('#supports_field').val(rating);
    },
	readOnly: <?php echo (!empty($array_data[0]->support))? true:true  ?>,
	fullStar: true,
    starWidth: "25px",
    rating: <?php echo ($array_data[0]->support)?: 0  ?>
  });        

});



</script>

<script>

	$('document').ready(function(){
		var show_reviews = 10;
		var count_reviews = <?php echo $reviews_count;  ?> ;

		$( "#load-more" ).click(function(e) {
		 if(show_reviews > count_reviews){
		  	$("#load-more").attr('disabled', true);
		  	$("#load-more").html('Inget mer att ladda');
		 }

		  e.preventDefault();
		  $( "."+show_reviews ).show(500);
		  show_reviews += 5;
		});

	});
</script>

<style>

@media only screen and (max-width: 768px)
   {
       .rating_row_mrg
       {
           margin-right:0px;
           margin-left:0px;
       }
   }


@media only screen and (max-width: 375px) {
	#responsive_review .review1{
		margin-right: 70px !important;
	}
	.new_buttons_request #trial
	{
		margin-top: 3px !important;
	}
/*.reviews-data
{
	width:52%;
	display:inline-block;
}
.form_input_align{
	padding-left: 31px;
}*/

}

@media only screen and (max-width: 425px) {

	.new_buttons_request #trial
	{
		margin-top: 0px !important;
	}
	.rating_content_img{
		margin-top:10px;
	}

	.rating_content_img img{
	    width: 70% !important;
	}
/*	.reviews-data
	{
		width:52%;
		display:inline-block;
	}
	.form_input_align{
		padding-left: 31px;
	}*/
}


.form-control
{
	display:inline-block;

}
/* Checkbox and Radio buttons */
.form-group input[type="radio"],
.form-group input[type="checkbox"]{
	display: none;
}

.form-group input[type="checkbox"] + .btn-group > label,
.form-group input[type="radio"] + .btn-group > label{
	white-space: normal;
}

.form-group input[type="checkbox"] + .btn-group > label.btn-default,
.form-group input[type="radio"] + .btn-group > label.btn-default{
	color: #333;
	background-color: #fff;
	border-color: #ccc;
}
.form-group input[type="checkbox"] + .btn-group > label.btn-primary,
.form-group input[type="radio"] + .btn-group > label.btn-primary{
	color: #fff;
	background-color: #428bca;
	border-color: #357ebd;
}
.form-group input[type="checkbox"] + .btn-group > label.btn-success,
.form-group input[type="radio"] + .btn-group > label.btn-success{
	color: #fff;
	background-color: #5cb85c;
	border-color: #4cae4c;
}
.form-group input[type="checkbox"] + .btn-group > label.btn-info,
.form-group input[type="radio"] + .btn-group > label.btn-info{
	color: #fff;
	background-color: #5bc0de;
	border-color: #46b8da;
}
.form-group input[type="checkbox"] + .btn-group > label.btn-warning,
.form-group input[type="radio"] + .btn-group > label.btn-warning{
	color: #fff;
	background-color: #f0ad4e;
	border-color: #eea236;
}
.form-group input[type="checkbox"] + .btn-group > label.btn-danger,
.form-group input[type="radio"] + .btn-group > label.btn-danger{
	color: #fff;
	background-color: #d9534f;
	border-color: #d43f3a;
}
.form-group input[type="checkbox"] + .btn-group > label.btn-link,
.form-group input[type="radio"] + .btn-group > label.btn-link {
	font-weight: normal;
	color: #428bca;
	border-radius: 0;
}

.form-group input[type="radio"] + .btn-group > label span:first-child,
.form-group input[type="checkbox"] + .btn-group > label span:first-child{
	display: none;
}

.form-group input[type="radio"] + .btn-group > label span:first-child + span,
.form-group input[type="checkbox"] + .btn-group > label span:first-child + span{
	display: inline-block;
}

.form-group input[type="radio"]:checked + .btn-group > label span:first-child,
.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child{
	display: inline-block;
}

.form-group input[type="radio"]:checked + .btn-group > label span:first-child + span,
.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child + span{
	display: none;  
}

.form-group input[type="checkbox"] + .btn-group > label span[class*="fa-"],
.form-group input[type="radio"] + .btn-group > label span[class*="fa-"]{
	width: 15px;
	float: left;
	margin: 4px 0 2px -2px;
}

.form-group input[type="checkbox"] + .btn-group > label span.content,
.form-group input[type="radio"] + .btn-group > label span.content{
	margin-left: 10px;
}
/* End::Checkbox and Radio buttons */
</style>


<?php get_footer();?>

<script>
	
	$('#submit_review').click(function(e){
		e.preventDefault();
		var reading  = $('#reading_field').val();
		var writing  = $('#writing_field').val();
		var skills   = $('#skills_field').val();
		var supports = $('#supports_field').val();
		var name     = $('#name').val();
		var email    = $('#email').val();
		var company  = $('#company').val();
		if(reading != '' && writing != '' && skills != '' && supports != '' && name != '' && email != '' && company != '')
		{
			$('#reviews_form').submit();
		}
		else
		{
			swal({
			   title: "Warning!",
			   text: "Please! Fill all required fields",
			   icon: "warning",
			 })
		}
		//$('#seach-submit').submit();
	
	});



 $('#submit_request').on('click', function (e) {
 		e.preventDefault();
		var name    = $('#contact_name').val();
		var company = $('#contact_company').val();
		var phone   = $('#contact_phone').val();
		var email   = $('#contact_email').val();

		if(name != '' && company != '' && phone != '' && email != '')
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
		var name    = $('#trail_name').val();
		var company = $('#trail_company').val();
		var phone   = $('#trail_phone').val();
		var email   = $('#trail_email').val();

		if(name != '' && company != '' && phone != '' && email != '')
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
<?php if(get_transient('error')){ ?>
<script>
	swal({
	   title: "Success!",
	   text: "Thank You! for Submiting your review.",
	   icon: "success",
	 }).then((willDelete) => {
          if (willDelete) {
   			<?php delete_transient('error'); ?>
          } else {
            swal("Your imaginary file is safe!");
          }
        });
</script>
<?php } ?>

<?php if(get_transient('request_error')){   ?>
<script>
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
</script>
<?php } ?>



<style>
	.modal-open {
	    overflow: scroll;
	    padding-right: 0 !important;
	}


</style>







