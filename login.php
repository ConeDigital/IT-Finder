<?php
    /**
    * Template Name: login
    */
	
	
	error_reporting(0);
    wp_head();
	get_header();
?>
<style>


@media (min-width: 767px) and (max-width: 1199px){
	.ccc{
		    font-size: 50px !important;
			margin-top: 20px; 
	}
}
	
	@media screen and (min-device-width: 768px) and (max-device-width: 1199px) {
	
	.page-title_guider {
        padding: 80px 0 80px 0 !important;
}
}
	@media screen and (min-device-width: 1199px) {
	
	.page-title_guider {
               padding: 54px 0 80px 0;
}
}
	

.theme-4 .apsl-icon-block.icon-google {
    background: #dc4b38 none repeat scroll 0 0;
    border-radius: 5px;
    color: #ffffff;
    font-size: 13px;
    line-height: 28px;
    padding: 10px 27px;
    vertical-align: top;
    display: inline-block;
    margin-left: 9px;
}</style>
<div class="page-title_guider  top-guider">
            <div class="page-title-text wow fadeInUp crm_title ccc"  style="height: 135px !important; 	padding-top: 40px;">
				<div class="clear5"></div>
				<h1 class="ccc">Login</h1>
	
				
            </div>
        </div>

        <!-- Block 2 (team member) -->
        
        

<div class="clear50"></div>


<div class="">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <?php //echo do_shortcode('[login]'); ?>
		<?php //echo do_shortcode('[login redirect_page="/"]'); ?>
		<?php echo do_shortcode('[wpli_login_link redirect=http://it-finder.leadconcept.com]'); ?>
    </div>
</div>

<div class="clearfix"></div>
<b>Or</b>
			
<div class="">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
        <?php //echo do_shortcode('[login]'); ?>
		<?php //echo do_shortcode('[login redirect_page="/"]'); ?>
		<?php echo do_shortcode('[apsl-login-lite]'); ?>
    </div>
</div>

<div class="clear50"></div>
<div class="clearfix"></div>

<?php //echo do_shortcode('[restricted]'); ?>
<?php //echo do_shortcode('[user-data]'); ?>
<?php //echo do_shortcode('[restricted]'); ?>




<?php get_footer();?>
<?php //wp_footer(); ?>

<style>
    .ewd-feup-login-form-div{
        width: 550px;
        margin: 0 auto;
    }

    .dropdown-toggle{
        font-size: 22px;
    }

</style>    
