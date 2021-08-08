<?php wp_enqueue_style( 'default-template', get_template_directory_uri().'/assets/css/default.css' ); ?>
<?php
if(strstr($_SERVER['REQUEST_URI'], '/shop/'))
	get_header( 'shop' );
else
	get_header();
?>
<section class="main">
  	<div class="container">
      <div class="row justify-content-center">
        <div class="col col-md-10 col-lg-8">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </div>
      </div>
  	</div>
</section>

<?php
if(strstr($_SERVER['REQUEST_URI'], '/shop/'))
	get_footer( 'shop' );
else
	get_footer();
?>