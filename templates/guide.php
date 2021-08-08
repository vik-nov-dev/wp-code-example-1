<?php /* Template Name: Design Guide */ ?>

<?php wp_enqueue_style( 'guide', get_template_directory_uri().'/assets/css/guide.css' ); ?>

<?php get_header(); ?>

    <?php get_template_part( 'template-parts/jumbotron-with-bg' ); ?>

    <div class="container-fluid" <?php live_edit('repeater'); ?>>
      <?php $repeater = get_field('repeater'); if (!empty($repeater)) foreach ($repeater as $key => $value) if ($key % 2 == 0) { ?>
      <div class="main">
        <div class="row no-gutters first flexrow">
          <div class="col col-md-5 col-lg-4 offset-lg-1 intro wow fadeInRight" data-wow-delay=".8s">
            <div class="content">
              <?= $value['text']; ?>
            </div>
          </div>
          <div class="col col-md-7 col-lg-6 wow fadeInLeft">
          	<?php if (!empty($value['images'])) foreach ($value['images'] as $k => $img) { ?>
          	<div class="bgimg" style="background-image:url(<?= $img['image']['image']['url']; ?>); height: <?= $img['image']['height']; ?>%;<?php if ($k) { ?>margin-top: 30px;<?php } ?>"></div>
          	<?php } ?>
          </div>
        </div>
      </div>
      <?php } else { ?>
      <div class="main">
        <div class="row no-gutters justify-content-between flexrow">
          <div class="col col-md-5 col-lg-4 offset-lg-1 wow fadeInLeft" data-wow-delay=".8s">
            <div class="content">
              <?= $value['text']; ?>
            </div>
          </div>
          <div class="col col-md-7 col-lg-6 wow fadeInRight">
            <?php if (!empty($value['images'])) foreach ($value['images'] as $k => $img) { ?>
          	<div class="bgimg" style="background-image:url(<?= $img['image']['image']['url']; ?>); height: <?= $img['image']['height']; ?>%;<?php if ($k) { ?>margin-top: 30px;<?php } ?>"></div>
          	<?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>

  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>