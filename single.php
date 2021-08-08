<?php wp_enqueue_style( 'blog-style', get_template_directory_uri().'/assets/css/blog.css' ); ?>

<?php get_header(); ?>

  	<div class="container-fluid">
      <div class="blog-post">
        <div class="row">
          <div class="col col-md-6">
              <div class="bgimg" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);"></div>
          </div>
          <div class="col col-md-6 wow fadeInRight" data-wow-delay=".8s">
          	<div class="arrow-container">
          	  <a href="#" class="scroll-top"><img src="/wp-content/uploads/2020/03/arrow2.png" alt=""></a>
          	</div>
            <div class="post">
              <h2><?php the_title(); ?></h2>
              <h4><?php the_date(); ?></h4>
              <?php the_content(); ?>
            </div>
            <div class="arrow-container">
			  <a href="#" class="scroll-down"><img src="/wp-content/uploads/2020/03/arrow3.png" alt=""></a>
			</div>
          </div>
        </div>
      </div>
  	</div>
<script>
var scrolled = 0;
jQuery(document).ready(function($) {
	jQuery('.post').on("mousewheel", function() {
		scrolled = jQuery('.post').scrollTop();
	});
	jQuery('.scroll-top').click(function(event) {
		event.preventDefault();
		scrolled = jQuery('.post').scrollTop();
		scrolled = scrolled - 300;
		jQuery(".post").animate({
			scrollTop:  scrolled
		}, function() { if (scrolled < 0) scrolled = 0; });
		
	});
	jQuery('.scroll-down').click(function(event) {
		event.preventDefault();
		scrolled = jQuery('.post').scrollTop();
		scrolled = scrolled + 300;
		jQuery(".post").animate({
			scrollTop:  scrolled
		}, function() { scrollHeight = jQuery('.post')[0].scrollHeight; if (scrolled > scrollHeight) scrolled = scrollHeight - 400; });
	});
});
</script>

<?php get_footer(); ?>