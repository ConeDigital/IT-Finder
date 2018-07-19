<?php
 error_reporting(1);
    /**
    * Template Name: request_submit
    */
    global $wpdb;
?>
	

		<?php

			$name    = $_POST['name1'];
			$company = $_POST['company'];
			$phone   = $_POST['phone'];
			$sender  = $_POST['email'];
			$p_id    = $_POST['p_id'];
			$product = $_POST['product'];

			$to = 'andreas.varnava@itfinder.se';

		    $subject = "Contact";

		    //$con_desc= $_POST['pdesc'];

		    $con_message1 = "Subject : " . $subject . "\n";

		    $con_message1 .= "Name : " . $name . "\n";

		    $con_message1 .= "Email Address : " . $sender . "\n";

		    $con_message1 .= "Message :" . $name . "is intrested to buy a product ". $product ." \n";

		    $con_headers = 'From: ' . $name . ' < ' . $sender . ' > ' . "\r\n";



		    $wpmail=wp_mail( $to, $subject, $con_message1, $con_headers );

		    if($wpmail)

		    {

		        if(is_numeric($p_id))
		    	{
		        	$url = get_site_url()."/category_detail/".$p_id;
		    	}else
		    	{
		    		$url = get_site_url().$p_id;
		    	}

				set_transient('request_error', 'Thank You! for Submiting your Request.');
				
				wp_redirect( $url );

		    }

		    else

		    {

		        echo "<script>alert('Not Send');</script>";
		        die;

		    }


			
		?>