<?php /* Template Name: Showrooms */ ?>

<?php wp_enqueue_style( 'showrooms', get_template_directory_uri().'/assets/css/showrooms_n_contacts.css' ); ?>
<?php wp_enqueue_script( 'acf-map',  get_template_directory_uri().'/assets/js/acf-map.js', [], false, true ); ?>
<?php wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?key='.get_field('gmap_api_token', 'options'), ['acf-map'], false, true ); ?>

<?php get_header(); ?>

  <?php get_template_part( 'template-parts/jumbotron' ); ?>

<?php
$showrooms = get_field('showrooms');
if (!empty($showrooms)):
	foreach ($showrooms as $key => $showroom) {
		if ($key % 2 === 1) {
			echo '<section class="mid">';
			$reorder = 'reorder';
			$pic = '';
			$adrs = '';
      $wow_map = 'Left';
		} else {
			$reorder = '';
			$adrs = 'right';
      $wow_map = 'Right';
		}
?>
  <div class="container"  <?php live_edit('showrooms'); ?>>
    <div class="showroom">
    <div class="row <?= $reorder; ?>">
     <div class="col col-md-8 <?= $pic; ?> wow fadeIn picbg" style="background-image:url(<?= $showroom['main']['image']['url']; ?>);">
       <!--<img src="<?= $showroom['main']['image']['url']; ?>" alt="<?= $showroom['main']['image']['alt']; ?>">//-->
     </div>
    <div class="col col-md-4  <?= $adrs; ?> wow fadeIn<?= $wow_map; ?>" data-wow-delay=".8s">
      <div class="content">
        <h1><?= $showroom['main']['title']; ?></h1>
        <p><?= $showroom['contacts']['address']; ?> &bull; <?= $showroom['contacts']['postal_code']; ?><br>
        <a href="tel:<?= $showroom['contacts']['phone']; ?>"><?= $showroom['contacts']['phone']; ?></a></p>
        <div class="acf-map">
          <?php
          if (!empty($showroom['contacts']['map'])) { $map = $showroom['contacts']['map'];
          ?>
          <div class="marker" data-lat="<?= $map['lat']; ?>" data-lng="<?= $map['lng']; ?>"><div class="badge"><?= $map['address']; ?></div></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
		if ($key % 2 === 1) echo '</section>';
	}
?>
<?php endif; ?>

<section class="contact" id="form" <?php live_edit('title_bottom, content_bottom'); ?>>
  <div class="container wow pulse" data-wow-delay=".1s">
    <div class="row">
      <div class="col">
        <?php the_field('title_bottom'); ?>
      </div>
    </div>
    <?php the_field('content_bottom'); ?>
  </div>
</section>

<script> jQuery(document).ready(function() { new_map(); }); </script>

<?php get_footer(); ?>