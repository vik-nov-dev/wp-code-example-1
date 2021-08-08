<?php wp_enqueue_style( 'portfolio', get_template_directory_uri().'/assets/css/portfolio.css' ); ?>
<?php wp_enqueue_style( 'lightgallery', get_template_directory_uri().'/assets/dist/lightgallery/lightgallery.min.css' ); ?>
<?php wp_enqueue_script( 'lightgallery', get_template_directory_uri().'/assets/dist/lightgallery/lightgallery-all.min.js', [], false, true ); ?>

<?php get_header(); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col wow fadeInUp">
          <div class="row bb" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
          	<?php //echo get_the_post_thumbnail( null, 'full', array('class' => 'img-fluid') ); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="intro">
        <div class="row">
          <div class="col wow pulse" data-wow-delay=".2s">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid" <?php live_edit('rows'); ?>>
      <div class="gallery">
      	<div class="row photos">
      	<?php
      	$rows = get_field('rows'); if (!empty($rows)) foreach ($rows as $key => $value) { ?>
      	  <?php
      	  $images = $value['images'];
      	  if (!empty($images)) foreach ($images as $k => $image) {
      	  	$img = $image['image']['image']['url'];
      	  	$thumb = $image['image']['image']['sizes']['thumbnail'];
      	  	if ($image['image']['size'] === '1of3') $size = '4';
      	  	if ($image['image']['size'] === '2of3') $size = '8';
      	  	if ($image['image']['size'] === '1of4') $size = '3';
      	  	if ($image['image']['size'] === '1of2') $size = '6';
      	  	if ($image['image']['size'] === '3of4') $size = '9';
      	  	if ($image['image']['size'] === '1of1') $size = '12';
      	  	if ($k === 0) $nlft = 'nlft'; else $nlft = '';
      	  	if ($k + 1 === count($images)) $nrgt = 'nrgt'; else $nrgt = '';
      	  ?>
      	  <div class="col col-md-<?= $size; ?> <?= $nlft; ?> <?= $nrgt; ?> wow rotateInUpRight" data-wow-delay="<?= (4-$k % 4) * 0.3; ?>s" data-wow-duration="1.3s"  data-src="<?= $img; ?>">
      	  	<img src="<?= $thumb; ?>" alt="<?= $image['image']['image']['alt']; ?>" style="display: none;">
            <div class="portfolio-img" style="background-image: url('<?= $img; ?>');" ></div>
          </div>
      	  <?php } ?>
      	<?php } ?>
      	</div>
        <div class="row">
          <div class="col center wow fadeIn" data-wow-delay="1.5s">
            <a href="/portfolio" class="back"><i class="fa fa-angle-left"></i> BACK TO PORTFOLIO</a>
          </div>
        </div>
      </div>
    </div>

<script>
jQuery(document).ready(function() {
	jQuery('.gallery .photos').lightGallery({
		download:false,
	});
});
</script>

<?php get_footer(); ?>