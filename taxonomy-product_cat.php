<?php wp_enqueue_style( 'shop-cat', get_template_directory_uri().'/assets/css/shop_category.css' ); ?>

<?php get_header('shop'); ?>
<?php
$q_obj = get_queried_object();
//print_r($q_obj)

    // Get subcategories of the current category
    $terms    = get_terms([
        'taxonomy'    => 'product_cat',
        'hide_empty'  => true,
        'parent'      => get_queried_object_id()
    ]);

?>
<script>
jQuery(document).ready(function($) {
	jQuery('.switcher a').click(function(event) {
		event.preventDefault();
		jQuery(this).hide();
		jQuery("#sidebar-shop").toggleClass('open');
	});
	jQuery('#sidebar-shop .close').click(function(event) {
		event.preventDefault();
		jQuery("#sidebar-shop").removeClass('open');
		setTimeout(function(){
			jQuery('.switcher a').show();
		}, 500);
	});
});
</script>
	<div class="switcher"><a href="#">Click here to show filters</a></div>
	<section class="main mb-def">
		<div class="container">
			<div class="row">
			<?php if(count($terms)==0) { ?>
				<div class="col-9 col-md-3 breadcrumbs" id="sidebar-shop">
					<?php dynamic_sidebar( 'shop' ); ?>
					<div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
				</div>
				
				<div class="col-12 col-md-9">
			<?php } else { ?>
				<div class="col-12">
			<?php } ?>
					<div class="row">
						<div class="col-12 breadcrumbs"><?php reneder_shop_breadcrumb(); ?></div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-5 toptop <?php if($q_obj->parent) { echo 'col-md-12  col-lg-12 topheader'; } ?>">
							<h2><?= $q_obj->name; ?></h2>
							<p><?= $q_obj->description; ?></p>
						</div>
					</div>
					<div class="row">
						<?php foreach ( $terms as $term ) {
							  $term_link = get_term_link( $term, 'product_cat' );
							  $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
							  $image = wp_get_attachment_image_src( $thumbnail_id , 'rgithumb-large');
						?>
						<div class="col-12 col-md-6 col-lg-3">
							<div class="product-tile">
							  <div class="image-overlay">
								<?= '<img src="' . $image[0] . '" alt="' . $term->name . '" />' ?>
								<a href="<?= $term_link; ?>" class="abs-link"></a>
							  </div>
							  <h3><a href="<?= $term_link; ?>" class="inherit-link"><?= $term->name; ?></a></h3>
							  <a href="<?= $term_link; ?>">View Products <i class="fa fa-angle-right"></i></a>
							</div>
						  </div>
						<?php } ?>
					
					
						<?php if (have_posts() && count($terms)==0) while (have_posts()) { the_post(); ?>
						<div class="col-12 col-md-6 col-lg-4">
							<div class="product-tile">
							  <div class="image-overlay">
							  <?php
							  
							  $CImg = get_field('category_image');
							  if(is_array($CImg))
							  {
								  echo '<img src="'. $CImg['url'] .'" alt="'. $CImg['alt'] .'" />';
							  }
							  else
								  the_post_thumbnail('rgithumb-large');
							 
							  
							  ?>
								<a href="<?= get_the_permalink(); ?>" class="abs-link"></a>
							  </div>
							  <h3><a href="<?= get_the_permalink(); ?>" class="inherit-link"><?= get_the_title(); ?></a></h3>
							  <a href="<?= get_the_permalink(); ?>"><?php echo $product->get_price_html(); ?></a>
							</div>
						  </div>
						<?php } ?>
						
						<?php if (have_posts() && count($terms)==0) { ?>
						<div class="col-12">
<div class="ss88pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            //'total'        => $wc_query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Previous', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Next', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>
<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    <?= do_shortcode("[pureclarity-bmz id='PL-01']"); ?>
  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer('shop'); ?>