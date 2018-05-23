<?php
    /**
    * Template Name: register
    */
	error_reporting(0);
    wp_head();
	get_header();
?>
<div class="page-title_guider  top-guider">
            <div class="page-title-text wow fadeInUp crm_title"  style="height: 200px !important;">
				<div class="clear5"></div>
				<h1>Register</h1>
	
				
            </div>
        </div>

        <!-- Block 2 (team member) -->
<div class="clear50"></div>
<div class="clear50"></div>

<div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <?php //echo do_shortcode('[register]'); ?>
		<?php echo do_shortcode('[register redirect_page="/" ]'); ?>
    </div>
</div>

<div class="clearfix"></div>





<?php get_footer();?>
<?php //wp_footer(); ?>

<style>
    .ewd-feup-form-div{
        width: 550px;
        margin: 0 auto;
    }
    .dropdown-toggle{
    	font-size: 22px;
    }

</style>    

