<?php wp_enqueue_style( 'blog-style', get_template_directory_uri().'/assets/css/blog.css' ); ?>

<?php get_header(); ?>

	<section class="jumbotron">
    	<div class="container">
    		<div class="row justify-content-md-center align-items-center">
          <div class="col col-md-2 wow pulse" data-wow-delay=".1s">
            <h2>Blog</h2>
          </div>
          <div class="col col-md-5">
            <form>
              <div class="from-group">
                <input type="text" class="form-control search-string" placeholder="Keyword Search">
              </div>
            </form>
          </div>  
        </div>
    	</div>
    </section>
  	<div class="container">
      <div class="blog">
        <div class="row">
          <?php $i = 0; if (have_posts()) while (have_posts()) {
          	the_post();
          	$i++;
          ?>
          <div class="col-6 col-sm-4 col-md-3 wow fadeIn" data-wow-delay="<?= ($i+1 % 4) * 0.3; ?>s" data-wow-duration="1.3s" >
          	<div class="thumb-wrap">
          	  <?php the_post_thumbnail( 'rgiblogthumb' ); ?>
          	  <a href="<?= get_the_permalink(); ?>" class="abs-link"></a>
            </div>
            <h4><a href="<?= get_the_permalink(); ?>" class="inherit-link"><?php the_title(); ?></a> <span><?= get_the_date(); ?></span></h4>
            <p><?= get_the_excerpt(); ?></p>
            <a href="<?= the_permalink(); ?>">Read More <i class="fa fa-angle-right"></i></a>
          </div>
          <?php } ?>
        </div>
        <div class="row">
          <div class="col center">
            <br>
            <a href="#" class="load-more-posts"><img src="/wp-content/uploads/2020/03/arrow1.png" alt="" class="flip-img"></a>
          </div>
        </div>
      </div>
  	</div>
<script>
jQuery('.load-more-posts').click(function(event) {
	event.preventDefault();
	var th = jQuery(this);
	var proccess = !th.hasClass('loading');
	th.addClass('loading');
	if (proccess) {
		var offset = jQuery('.blog h4').length;
		var search = jQuery('.search-string').val();
		data = {
			action: 'load_posts',
			offset: offset,
			search: search
		};
		loadPosts(data);
	}
});

var globalTimeout = null;
jQuery('.search-string').keyup(function()
{
	var str = jQuery(this).val();
	
	if(globalTimeout != null) { clearTimeout(globalTimeout); }
	
	globalTimeout = setTimeout(function() {
		globalTimeout = null;
		var offset = 0;
		var search = jQuery('.search-string').val();
		data = {
			action: 'load_posts',
			offset: offset,
			search: search
		};
		loadPosts(data, true);

	}, 350);  
});

function loadPosts(data, empty = false) {
	jQuery.post( '<?= admin_url("admin-ajax.php"); ?>', data, function(response) {
		var posts_per_page = <?= get_option( 'posts_per_page' ); ?>;
		data = jQuery.parseJSON(response);
		var container = jQuery(jQuery('.blog .row')[0]);
		if (empty) container.empty();
		if (data.length) jQuery.each(data, function(index, el) {
			if (index < posts_per_page) {
				html = '';
				html += '<div class="col-6 col-sm-4 col-md-3">';
				html += '<div class="thumb-wrap">'+el['thumbnail_html']+'<a href="'+el['permalink']+'" class="abs-link"></a></div>';
				html += '<h4><a href="'+el['permalink']+'" class="inherit-link">'+el['post_title']+'</a> <span>'+el['date']+'</span></h4>';
				html += '<p>'+el['excerpt']+'</p>';
				html += '<a href="'+el['permalink']+'">Read More <i class="fa fa-angle-right"></i></a>';
				container.append(html);
			}
		});
	
		jQuery('.load-more-posts').removeClass('loading');
		if (data.length <= posts_per_page)
			jQuery('.load-more-posts').hide();
		else
			jQuery('.load-more-posts').show();
	});
}
</script>

  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>