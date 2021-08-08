<?php wp_enqueue_style( 'front-style', get_template_directory_uri().'/assets/css/style.css', ['base'] ); ?>

<?php get_header(); ?>
  	<div class="container-fluid" <?php live_edit('slides'); ?>>
      <?php $slides = get_field('slides'); if (!empty($slides)) { //print_r($slides); ?>
  		<div class="banner wow fadeInUp">
  			<div class="row">
  				<div class="owl-carousel owl-theme slider">
            <?php foreach ($slides as $key => $value) { $bg_img = $value['image']['url']; ?>
            <div class="item" style="background: url('<?= $bg_img; ?>');background: linear-gradient(#25221e57, #25221e57), url('<?= $bg_img; ?>') center / cover;">
            </div>
            <?php } ?>
  				</div>
  				<div class="bn-logo">
            <?php $logo_image_slider = get_field('logo_image_slider'); if (!empty($logo_image_slider)) { ?>
  					<img src="<?= $logo_image_slider['url']; ?>" alt="<?= $logo_image_slider['alt']; ?>"><br>
            <?php } ?>
  					<!--<a href="#intro" class="arrow_down"><img src="<?= wp_get_upload_dir()['baseurl']; ?>/2020/02/arrow.png" alt=""></a>-->
  				</div>
  			</div>
  		</div>
      <?php } ?>
  	</div>
  	<div class="container-fluid" id="intro" <?php live_edit('sections_intro'); ?>>
  		<?php $sections_intro = get_field('sections_intro');
      if (!empty($sections_intro)) {
        foreach ($sections_intro as $key => $value) {
          $first = $intro = '';
          $wow_img = 'Right'; $wow_txt = 'Left';
          if ($key % 2 === 0) { $first = 'first'; $intro = 'intro'; $wow_img = 'Left'; $wow_txt = 'Right'; }
      ?>
  		<div class="main">
  			<div class="row <?= $first; ?> flexrow">
  				<div class="col col-md-4 <?= $intro; ?> wow fadeIn<?= $wow_txt; ?>" data-wow-delay=".8s">
            <div class="content">
    			<?= $value['text']; ?>
    			<?php $link = $value['link']; if (!empty($link)) { ?>
    			<a href="<?= $link['link']; ?>" class="link"><?= $link['title']; ?> <i class="fa fa-angle-right"></i></a>
    			<?php } ?>
            </div>
  				</div>
  				<div class="col col-md-8 wow fadeIn<?= $wow_img; ?>">
  				<?php $img = ''; if (!empty($value['image'])) $img = $value['image']; if (!empty($img)) { ?>
  				<!--<img src="<?= $img['url']; ?>" alt="<?= $img['alt']; ?>">//-->
				<div class="bgimg" style="background-image:url(<?= $img['url']; ?>);"></div>
  				<?php } ?>
  				</div>
  			</div>
  		</div>
  		<?php } ?>
  		<?php } ?>
  	</div>
  	<div class="gallery" <?php live_edit('posts_to_show_portfolio'); ?>>
  		<div class="container wow fadeInUp">
  			<div class="row">
          <?php $posts_to_show = get_field('posts_to_show_portfolio'); if (!empty($posts_to_show)) { ?>
          <div class="owl-carousel owl-theme portfolio">
            <?php foreach ($posts_to_show as $key => $value) { ?>
            <div class="item">
              <div class="image-overlay">
              <?= get_the_post_thumbnail( $value->ID, 'rgithumb-large' ); ?>
              </div>
              <div class="col">
                <h3><?= $value->post_title; ?></h3>
                <a href="<?= get_the_permalink($value->ID); ?>">View in portfolio <i class="fa fa-angle-right"></i></a>
              </div>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
  			</div>
  		</div>
  	</div>
<script>
jQuery('a[href="#intro"]').click(function(event) {
  event.preventDefault();
  jQuery("html, body").animate({ scrollTop: jQuery(jQuery(this).attr("href")).offset().top - 40 }, 1200);
});
</script>

  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>