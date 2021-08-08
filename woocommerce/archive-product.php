<?php wp_enqueue_style( 'shop-home', get_template_directory_uri().'/assets/css/shop_home.css' ); ?>
<?php wp_enqueue_script('vide', get_template_directory_uri().'/assets/dist/vide-0.5.1/jquery.vide.min.js', [], false, true); ?>
<?php wp_enqueue_script('vide-fix', get_template_directory_uri().'/assets/dist/vide-0.5.1/vide-fix.js', ['vide'], false, true); ?>

<?php get_header('shop'); ?>

<?php
$page_id = wc_get_page_id( 'shop' );
?>
	<?php echo do_shortcode("[pureclarity-bmz id='HP-01']"); ?>

  	<div class="container-fluid" <?php live_edit('slides', $page_id); ?>>
      <?php $slides = get_field('slides', $page_id); if (!empty($slides)) { //print_r($slides); ?>
  		<div class="banner wow fadeInUp">
  			<div class="row">
  				<div class="owl-carousel owl-theme slider-shop">
            <?php foreach ($slides as $key => $value) { $bg_img = $value['image']['url']; ?>
            <div class="item" style="background: url('<?= $bg_img; ?>');background: linear-gradient(#25221e57, #25221e57), url('<?= $bg_img; ?>') center / cover;">
              <div class="container">
                <div class="row align-items-center justify-content-center">
                  <div class="col-10 col-md-7 col-lg-6">
                    <div class="wrapper">
                      <?= $value['text']; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
  				</div>
          <!--<div class="bn-logo">
            <a href="#intro" class="arrow_down"><img src="<?= wp_get_upload_dir()['baseurl']; ?>/2020/02/arrow.png" alt=""></a>
          </div>-->
  			</div>
  		</div>
      <?php } ?>
  	</div>
    <section class="quick-links mt-def" <?php live_edit('quick_links', $page_id); ?>>
      <?php $quick_links = get_field('quick_links', $page_id); if (!empty($quick_links)) { //print_r($quick_links); ?>
      <div class="container">
        <div class="row justify-content-center">
          <?php foreach ($quick_links as $key => $value) { ?>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="item">
                <div class="image-overlay">
                  <?= get_image_tag($value['image']['ID'], $value['image']['alt'], $value['image']['title'], '', 'rgithumb-large'); ?>
                </div>
                <div class="col">
                  <h3><?= $value['title']; ?></h3>
                  <?php if (!empty($value['link'])) { ?>
                  <a href="<?= $value['link']['url']; ?>"><?= $value['link']['title']; ?> <i class="fa fa-angle-right"></i></a><?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div><?php } ?>
    </section>
    <section class="trending-products" <?php live_edit('title_tp, products_tp, footer_text_tp', $page_id); ?>>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php the_field('title_tp', $page_id); ?>
          </div>
          <?php $products = get_field( 'products_tp', $page_id ); if (!empty($products)) foreach ($products as $key => $value) { $the_product = wc_get_product($value); ?>
          <div class="col-12 col-md-6 col-lg-3">
            <div class="product-tile">
              <div class="image-overlay">
              <?php
              
              $CImg = get_field('category_image', $value);
              if(is_array($CImg))
              {
                echo '<img src="'. $CImg['url'] .'" alt="'. $CImg['alt'] .'" />';
              }
              else
                echo get_the_post_thumbnail($value, 'rgithumb-large');
             
              
              ?>
              <a href="<?= get_the_permalink($value); ?>" class="abs-link"></a>
              </div>
              <h3><a href="<?= get_the_permalink($value); ?>" class="inherit-link"><?= get_the_title($value); ?></a></h3>
              <a href="<?= get_the_permalink($value); ?>"><?php echo $the_product->get_price_html(); ?></a>
              <br>
              <a href="<?= get_the_permalink($value); ?>">View Product <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <?php } ?>

        </div>
      </div>
    </section>
    <section class="trending-products-footer">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php the_field('footer_text_tp', $page_id); ?>
          </div>
        </div>
      </div>
    </section>
    <?= do_shortcode("[pureclarity-bmz id='HP-02']"); ?>
    <section class="categories mt-def" <?php live_edit('heading_text_categories', $page_id); ?>>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php the_field('heading_text_categories', $page_id); ?>
          </div>
        </div>
        <?php
        $cats = get_terms([
          'taxonomy' => 'product_cat',
		  'parent'        => 0,
		  'hide_empty'    => true
        ]);
        if (!empty($cats)) {
        ?>
        <div class="row justify-content-center">
		      <div class="col-12">
            
  				<div class="owl-carousel shop-cats">
		
          <?php foreach ($cats as $key => $value) { $thumbnail_id = get_woocommerce_term_meta( $value->term_id, 'thumbnail_id', true ); if(empty($thumbnail_id)) continue; //print_r($value); ?>
          <div class="item">
            <div class="category">
              <div class="image-overlay">
                <?= get_image_tag($thumbnail_id, '', '', '', 'rgithumb-large'); ?>
                <a href="<?= get_term_link($value->term_id); ?>" class="abs-link"></a>
              </div>
              <h3><a href="<?= get_term_link($value->term_id); ?>" class="inherit-link"><?= $value->name; ?></a></h3>
              <a href="<?= get_term_link($value->term_id); ?>">View Products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
  		  <?php } ?>
        </div>
  		  </div>
        </div>
		<?php } ?>
      </div>
    </section>

    <div class="owl-carousel owl-theme slider-videos" <?php live_edit('slides_vs', $page_id); ?>>
      <?php $slides = get_field( 'slides_vs', $page_id ); if (!empty($slides)) foreach ($slides as $key => $value) { ?>
      <div class="video-bg" data-vide-bg="<?php if (!empty($value['video']['url'])) { ?>mp4: <?= $value['video']['url']; ?>, <?php } ?>poster: <?= $value['image_poster']['url']; ?>" data-vide-options="posterType: jpg">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-10 col-md-7 col-lg-7">
              <div class="wrapper">
                <?= $value['text']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>

    <!--<section class="img-section mt-def" <?php live_edit('image_is, text_is, link_is', $page_id); ?>>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <?php $img = get_field('image_is', $page_id); if (!empty($img)) echo get_image_tag($img['id'], $img['alt'], $img['title'], '', 'full'); ?>
            <div class="text-box">
              <?php the_field('text_is', $page_id); ?>
            </div>
			<?php if(!empty(get_field('link_is', $page_id))) { ?>
			<a href="<?= get_field('link_is', $page_id); ?>" class="rm_link">Read More</a>
			<?php } ?>
          </div>
        </div>
      </div>
    </section>-->
    <section class="latest-products mt-def mb-def">
      <div class="container">
        <div class="row">
          <?php
          $products = get_posts([
            'numberposts' => 4,
            'post_type'   => 'product',
          ]);
          wp_reset_postdata();
          if (!empty($products)) foreach ($products as $key => $value) { ?>
			<!--
          <div class="col-12 col-md-6 col-lg-3">
            <div class="product">
              <div class="image-overlay">
                <?= get_the_post_thumbnail( $value->ID, 'rgithumb-large' ); ?>
                <a href="<?= get_the_permalink($value->ID); ?>" class="abs-link"></a>
              </div>
              <h3><a href="<?= get_the_permalink($value->ID); ?>" class="inherit-link"><?= $value->post_title; ?></a></h3>
              <p><?= $value->post_excerpt; ?></p>
            </div>
          </div>
//-->
          <?php } ?>
			
			<div class="col">
				<?= do_shortcode('[instagram-feed]'); ?>
			</div>
        </div>
      </div>
    </section>

  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer('shop'); ?>