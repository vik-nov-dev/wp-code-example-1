<?php wp_enqueue_style('bootstrap-4', get_template_directory_uri().'/assets/dist/bootstrap/css/bootstrap.min.css'); ?>
<?php wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css'); ?>
<?php wp_enqueue_style('owl-theme', get_template_directory_uri().'/assets/dist/owlcarousel/css/owl.theme.default.min.css'); ?>
<?php wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/dist/owlcarousel/css/owl.carousel.min.css'); ?>
<?php wp_enqueue_style('base', get_template_directory_uri().'/assets/css/base.css', ['bootstrap-4']); ?>
<?php wp_enqueue_style('bakersville-font', get_template_directory_uri().'/assets/css/bakersville-font.css'); ?>
<?php wp_enqueue_style('hamburgers', get_template_directory_uri().'/assets/css/hamburgers.css', ['base']); ?>
<?php wp_enqueue_script('popper', get_template_directory_uri().'/assets/dist/popper/popper.min.js', [], false, true); ?>
<?php wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/dist/bootstrap/js/bootstrap.min.js', ['popper'], false, true); ?>
<?php wp_enqueue_script('owl-carousel', get_template_directory_uri().'/assets/dist/owlcarousel/js/owl.carousel.min.js', [], false, true); ?>
<?php wp_enqueue_script('main', get_template_directory_uri().'/assets/js/main.js', ['bootstrap', 'owl-carousel'], false, true); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
     WebFontConfig = {
        google: { families: [ 'Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap' ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })(); 
    </script>
    <?php wp_head(); ?>
    <?php the_field('header_code', 'options'); ?>
  </head>
  <body>
  	<nav class="navbar navbar-light sticky-top" <?php live_edit('logo_header, logo_shrink_header, main_menu, extra_menu_item', 'options'); ?>>
  		<div class="container">
        <a class="navbar-brand" href="/">
          <?php $logo_header = get_field('logo_header', 'options'); if (!empty($logo_header)) { ?><img src="<?= $logo_header['url']; ?>" alt="<?= $logo_header['alt']; ?>" class="logo-main"><?php } ?>
          <?php $logo_shrink_header = get_field('logo_shrink_header', 'options'); if (!empty($logo_shrink_header)) { ?><img src="<?= $logo_shrink_header['url']; ?>" alt="<?= $logo_shrink_header['alt']; ?>" class="logo-shrink"><?php } ?></a>
        <?php $extra_menu_item = get_field('extra_menu_item', 'options'); $extra_menu_item_2 = get_field('extra_menu_item_2', 'options'); if (!empty($extra_menu_item) || !empty($extra_menu_item_2)) { ?>
        <div class="extra-menu-items">
          <?php if (!empty($extra_menu_item)) { ?>
          <a href="<?= $extra_menu_item['link']; ?>"><?= $extra_menu_item['title']; ?></a>
          <?php } ?>
          <?php if (!empty($extra_menu_item_2)) { ?>
          <a href="<?= $extra_menu_item_2['link']; ?>"><?= $extra_menu_item_2['title']; ?></a>
          <?php } ?>
        </div>
        <?php } ?>
        <button class="navbar-toggler hamburger hamburger--collapse collapsed" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
  		</div>
      <div class="collapse navbar-collapse navbar-main" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <?php $main_menu = get_field('main_menu', 'options'); if (!empty($main_menu)) foreach ($main_menu as $key => $value) { if ($value['has_submenu']) { ?>
            <li class="nav-item">
              <a class="nav-link dropdown" id="navbarDropdown-<?= $key; ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?= $value['item']['url']; ?>"><?= $value['item']['title']; ?></a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown-<?= $key; ?>">
                <?php if (!empty($value['submenu'])) foreach ($value['submenu'] as $k => $val) { ?>
                <a class="dropdown-item" href="<?= $val['item']['url']; ?>"><?= $val['item']['title']; ?></a>
                <?php } ?>
              </div>
            </li>
            <?php } else { ?>
            <a class="nav-item nav-link" href="<?= $value['item']['url']; ?>"><?= $value['item']['title']; ?></a>
            <?php } ?>
          <?php } ?>
        </div>
        <div class="nav-showrooms">
          <?php
          $showrooms_ = get_pages(array(
              'meta_key' => '_wp_page_template',
              'meta_value' => 'templates/showrooms.php'
          ));
          if (isset($showrooms_[0]->ID)) {
            $showrooms = get_field('showrooms', $showrooms_[0]->ID);
            if (!empty($showrooms)) {
              foreach ($showrooms as $key => $showroom) {
          ?>
          <p><?= $showroom['contacts']['address']; ?> &bull; <?= $showroom['contacts']['postal_code']; ?><br>
            <span><a href="tel:<?= $showroom['contacts']['phone']; ?>" class="showroom-link"><?= $showroom['contacts']['phone']; ?></a></span></p>
          <?php
              }
            }
          }
          ?>
        </div>
        <?php $follow_menu = get_field('follow_menu', 'options'); if (!empty($follow_menu)) { ?>
        <div class="follow-menu">
         <?php foreach ($follow_menu as $key => $value) { ?>
          <a href="<?= $value['link']; ?>" class="<?= $value['fontawesome_class']; ?>"></a> 
         <?php } ?>
        </div>
        <?php } ?>
      </div>
  	</nav>