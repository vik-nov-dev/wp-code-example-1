<?php /* Template Name: Careers */ ?>

<?php wp_enqueue_style( 'careers', get_template_directory_uri().'/assets/css/careers.css' ); ?>

<?php get_header(); ?>

  	<div class="container" <?php live_edit('image, text, social_links, job_links'); ?>>
      <div class="row first">
      	<?php $image = get_field('image'); if (!empty($image)) { ?>
        <div class="col col-md-6 pic wow fadeInRight" data-wow-duration="1.5s">
          <div class="row">
            <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
          </div>
        </div>
    	<?php } ?>
        <div class="col col-md-6 intro wow fadeInLeft" data-wow-delay=".8s" data-wow-duration="1.5s">
          <div class="careers">
            <?php the_field('text'); ?>
            <?php $social_links = get_field('social_links'); if (!empty($social_links)) foreach ($social_links as $key => $value) { ?>
            <a href="<?= $value['link']; ?>" class="<?= $value['font_awesome_class']; ?>"></a>
            <?php } ?>
            
          </div>
		  <?php $job_links = get_field('job_links'); if (!empty($job_links)) foreach ($job_links as $key => $value) { ?>
		  <a href="<?= $value['link']; ?>" class="job"><?= $value['title']; ?> <i class="fa fa-angle-right"></i></a><br>
		  <?php } ?>
        </div>
      </div>
  	</div>

<?php get_footer(); ?>