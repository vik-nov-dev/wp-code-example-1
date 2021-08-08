<?php /* Template Name: About Us / Process */ ?>

<?php wp_enqueue_style( 'about-us', get_template_directory_uri().'/assets/css/about.css' ); ?>

<?php get_header(); ?>

    <?php get_template_part( 'template-parts/jumbotron' ); ?>
    
  	<div class="container-fluid" <?php live_edit('repeater'); ?>>
  		<?php
      $repeater = get_field('repeater');
      if (!empty($repeater)):
        foreach ($repeater as $key => $value) {
          $first = 'first'; $intro = 'intro';
          $wow_img = 'Left'; $wow_txt = 'Right';
          if ($key % 2 === 1) {
            $first = $intro = '';
            $wow_img = 'Right'; $wow_txt = 'Left';
          }
      ?>
  		<div class="main">
  			<div class="row <?= $first; ?> flexrow">
  				<div class="col col-md-4 <?= $intro; ?> wow fadeIn<?= $wow_txt; ?>" data-wow-delay=".8s">
            <div class="content">
    			   <?= $value['text']; ?>
            </div>
  				</div>
  				<div class="col col-md-8 wow fadeIn<?= $wow_img; ?>">
						<?php if (!empty($value['image'])) { ?>
							  <!--<img src="<?= $value['image']['url']; ?>" alt="<?= $value['image']['alt']; ?>">//-->
							  <div class="bgimg" style="background-image:url(<?= $value['image']['url']; ?>);"></div>
						<?php } ?>
  				</div>
  			</div>
  		</div>
  		<?php } ?>
  	<?php endif; ?>
  	</div>
  	
  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>