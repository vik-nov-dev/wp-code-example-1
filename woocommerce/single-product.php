<?php wp_enqueue_style( 'shop-product', get_template_directory_uri().'/assets/css/shop_product.css' ); ?>

<?php get_header( 'shop' ); ?>

<section class="product">
	<div class="container">
		<div class="row">
			<div class="col-12 breadcrumbs"><?php reneder_shop_breadcrumb(); ?></div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php the_post(); ?>
				<?php wc_get_template_part( 'content', 'single-product' ); ?>
			</div>
		</div>
	</div>
</section>

<div class="pureclarity_bmz pureclarity_bmz_PP-01" data-pureclarity="bmz:PP-01;id:<?= get_the_ID() ?>"></div>
<div class="pureclarity_bmz pureclarity_bmz_PP-04" data-pureclarity="bmz:PP-04;id:<?= get_the_ID() ?>"></div>
<?php /*
$product_object =  wc_get_product( get_the_ID() );
$upsells = $product_object->get_upsell_ids( 'edit' );
if (!empty($upsells)) {
?>
<section class="related-products upsells mb-def">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center"><h4>Complete The Look</h4></div>
		</div>
		<div class="row justify-content-center">
			<?php if (!empty($upsells)) foreach ($upsells as $key=>$upsell) { $post_object = get_post( $upsell ); setup_postdata( $GLOBALS['post'] =& $post_object ); ?>
			<div class="col-6 col-md-6 col-lg-3">
		      <div class="product-tile">
		        <div class="image-overlay">
		          <?= get_the_post_thumbnail($value, 'rgithumb-large'); ?>
		          <a href="<?= get_the_permalink($value); ?>" class="abs-link"></a>
		        </div>
		        <h3><a href="<?= get_the_permalink($value); ?>" class="inherit-link"><?= get_the_title($value); ?></a></h3>
		        <a href="<?= get_the_permalink($value); ?>">View Product <i class="fa fa-angle-right"></i></a>
		      </div>
		    </div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } */ ?>

<?php /*$related_products = wc_get_related_products(get_the_ID(), 4); if (!empty($related_products)) { ?>
<section class="related-products mb-def">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center"><h4>Customers also bought</h4></div>
		</div>
		<div class="row justify-content-center">
			<?php if (!empty($related_products)) foreach ($related_products as $key => $value) { ?>
			<div class="col-6 col-md-6 col-lg-3">
		      <div class="product-tile">
		        <div class="image-overlay">
		          <?= get_the_post_thumbnail($value, 'rgithumb-large'); ?>
		          <a href="<?= get_the_permalink($value); ?>" class="abs-link"></a>
		        </div>
		        <h3><a href="<?= get_the_permalink($value); ?>" class="inherit-link"><?= get_the_title($value); ?></a></h3>
		        <a href="<?= get_the_permalink($value); ?>">View Product <i class="fa fa-angle-right"></i></a>
		      </div>
		    </div>
			<?php } ?>
		</div>
	</div>
</section><?php } */?>
<?php /*$recent_products = rgi_get_recent_products(get_the_ID()); if (!empty($recent_products)) { ?>
<section class="recent-products mb-def">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center"><h4>RECENTLY VIEWED PRODUCTS</h4></div>
		</div>
		<div class="row justify-content-center">
			<?php if (!empty($recent_products)) foreach ($recent_products as $key => $value) { ?>
			<div class="col-6 col-md-6 col-lg-3">
		      <div class="product-tile">
		        <div class="image-overlay">
		          <?= get_the_post_thumbnail($value, 'rgithumb-large'); ?>
		          <a href="<?= get_the_permalink($value); ?>" class="abs-link"></a>
		        </div>
		        <h3><a href="<?= get_the_permalink($value); ?>" class="inherit-link"><?= get_the_title($value); ?></a></h3>
		        <a href="<?= get_the_permalink($value); ?>">View Product <i class="fa fa-angle-right"></i></a>
		      </div>
		    </div>
			<?php } ?>
		</div>
	</div>
</section><?php }*/ ?>

<script>
let interval = setInterval(function(){
	if (jQuery('.woocommerce-product-gallery__trigger').length) {
		jQuery('.woocommerce-product-gallery__trigger').html('<i class="fa fa-search-plus" aria-hidden="true"></i>');
		jQuery('.woocommerce-product-gallery__trigger').show();
		clearInterval(interval);
	}
}, 200);

if ( jQuery('.woocommerce-product-gallery div[data-thumb]').length > 1 ) {
	let nav = '<div class="arrow-nav arrow-nav-prev"><button class="prev"></div><div class="arrow-nav arrow-nav-next"></button><button class="next"></button></div>';
	jQuery('.woocommerce-product-gallery').append(nav);
	jQuery('.arrow-nav-prev').click(function(event) {
		event.preventDefault();
		jQuery('.flex-control-nav .flex-active').parent().prev().find('img').click();
	});
	jQuery('.arrow-nav-next').click(function(event) {
		event.preventDefault();
		jQuery('.flex-control-nav .flex-active').parent().next().find('img').click();
	});
}
</script>
	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer( 'shop' ); ?>