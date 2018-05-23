<?php
 error_reporting(1);
    /**
    * Template Name: review_submit
    */
    global $wpdb;
?>
	

		<?php

			$reading = $_POST['reading'];
			$writing = $_POST['writing'];
			$skills = $_POST['skills'];
			$supports = $_POST['supports'];
			$name = $_POST['name1'];
			$email = $_POST['email1'];
			$company = $_POST['company'];
			$id = $_POST['id'];
			$p_id = $_POST['p_id'];
			

		    $wpdb->get_results("INSERT INTO reviews (user_id, product_id, reading, writing, skills, support, name, email, companyName)
			VALUES ('$id', '$p_id', '$reading', '$writing','$skills','$supports' ,'$name', '$email', '$company') ");

			$url = get_site_url()."/category_detail/".$p_id;
			set_transient('error', 'Thank You! for Submiting your review.');

			wp_redirect( $url );
			
		?>

