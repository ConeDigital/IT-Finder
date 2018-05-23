<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
        <title>IT Finder</title>

        <?php //echo wp_head(); ?>
        <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets_per/bootstrap/css/bootstrap.min.css">
		
        <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets_per/font-awesome/css/font-awesome.min.css">
		
        <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets_per/css/animate.css">
		
        <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets_per/css/style.css">
		
        <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets_per/css/media-queries.css">
		
        <link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/assets_per/css/jquery.rateyo.css">
		
       <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
      <script src="<?= get_template_directory_uri(); ?>/assets_per/js/jquery-1.11.1.min.js"></script>
      

    </head>

    <body>
    
		
		<nav class="navbar navbar-inverse  navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
    	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo get_site_url(); ?>">My Store</a>
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse navbar_position_right">
		<ul class="nav navbar-nav navbar-nav-padding">
			<li class="dropdown mega-dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">KATEGORIER <span class="caret"></span></a>				
				<ul class="dropdown-menu mega-dropdown-menu mega_menu_list">
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
							<li class="col-sm-3">
								<ul>
									<li class="dropdown-header dropdown_header_list"><?php echo $terms->name?></li>
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
								</ul>
							</li>
							<?php
						}
					?>
				</ul>			
			</li>
            <li class="dropdown mega-dropdown">
    			<a href="<?php echo get_site_url(); ?>/guider/">GUIDER</a>				
				<!--<ul class="dropdown-menu mega-dropdown-menu">
					<li class="col-sm-3">
    					<ul>
							<li class="dropdown-header">1</li>
							<li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left & Right Navigation</a></li>
							<li><a href="#">Four Columns Grid</a></li>
							
							
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">2</li>
							<li><a href="#">Navbar Inverse</a></li>
							<li><a href="#">Pull Right Elements</a></li>
							<li><a href="#">Coloured Headers</a></li>                            
							<li><a href="#">Primary Buttons & Default</a></li>							
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">3e</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
                    <li class="col-sm-3">
						<ul>
							<li class="dropdown-header">3</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
                    
				</ul>	-->			
			</li>
            <li class="dropdown mega-dropdown">
    			<a href="<?php echo get_site_url(); ?>/om-oss/">OM OSS</a>				
				<!--<ul class="dropdown-menu mega-dropdown-menu">
					<li class="col-sm-3">
    					<ul>
							<li class="dropdown-header">1</li>
							<li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left & Right Navigation</a></li>
							<li><a href="#">Four Columns Grid</a></li>
							
							
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">2</li>
							<li><a href="#">Navbar Inverse</a></li>
							<li><a href="#">Pull Right Elements</a></li>
							<li><a href="#">Coloured Headers</a></li>                            
							<li><a href="#">Primary Buttons & Default</a></li>							
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">3e</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
                    <li class="col-sm-3">
						<ul>
							<li class="dropdown-header">3</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
                    
				</ul>	-->			
			</li>
             <li class="btn_contact2"><a class="btn_contact" href="<?php echo get_site_url(); ?>/contact/">KONTAKT</a></li>
			 <li style="color: #00006f; padding-left: 5px; padding-top: 9px;"><span><i class="fa fa-phone" aria-hidden="true"></i></span> 404 915-5121</li>
			 <div class="clearfix" ></div>
             <?php 
						$current_user = wp_get_current_user();

						
						if ( 0 == $current_user->ID ) {?>
							<p class="pull-right" style="font-size: 12px; margin:10px 5px 0px 5px; "><a href="<?php echo get_site_url(); ?>/Login/">Login</a> </p>
							<?php
						} else {?>
							 <p class="pull-right" style="font-size: 12px;  margin:10px 5px 0px 5px; "><a href="javascript:void(0)"><?php echo $current_user->user_email; ?></a> | <a id="logout-btn" href="<?php echo get_site_url(); ?>/logout2/">Logout</a></p>
						<?php
						}
						// die;
						
						// echo 'User email: ' . $current_user->user_email . '<br />';
						
			?>
			
			
			
             <?php 
             // $checkVal = do_shortcode('[user-data]');
             
             // if(empty($checkVal)){?>
              
             <?php //}else{ ?> 
             
             <?php //} ?>
		</ul>
        
	</div><!-- /.nav-collapse -->
	</div>
  </nav>
 
