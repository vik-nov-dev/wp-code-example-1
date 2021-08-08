<?php wp_enqueue_style('bootstrap-4', get_template_directory_uri().'/assets/dist/bootstrap/css/bootstrap.min.css'); ?>
<?php wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css'); ?>
<?php wp_enqueue_style('owl-theme', get_template_directory_uri().'/assets/dist/owlcarousel/css/owl.theme.default.min.css'); ?>
<?php wp_enqueue_style('owl-carousel', get_template_directory_uri().'/assets/dist/owlcarousel/css/owl.carousel.min.css'); ?>
<?php wp_enqueue_style('base', get_template_directory_uri().'/assets/css/base.css', ['bootstrap-4']); ?>
<?php wp_enqueue_style('shop', get_template_directory_uri().'/assets/css/shop.css', ['base']); ?>
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
  <body <?php //body_class(); ?>>
  <?php
  $shop_page_id = get_option( 'woocommerce_shop_page_id' );
  $shop_page_url = get_the_permalink( $shop_page_id );
  ?>
  <?php $messages = get_field( 'messages_smc', 'options' ); if (!empty($messages)) { ?>
    <div class="message-carousel">
      <?php foreach ($messages as $key => $value) { ?>
      <a href="<?= $value['url']; ?>" style="<?php if ($key) echo 'display: none;'; ?>"><?= $value['text']; ?></a>
      <?php } ?>
    </div>
    <script>window.bannerRotationInterval = <?= (!empty(get_field( 'slide_duration_smc', 'options' )))? get_field( 'slide_duration_smc', 'options' ) : 5000; ?></script>
    <?php } ?>
  	<nav class="navbar navbar-expand-lg navbar-light sticky-top" <?php live_edit('logo_header, shop_menu', 'options'); ?>>
  		<div class="container">
        <div class="extra-menu-items-shop">
          <a href="/showrooms-and-contact/">Showrooms</a>
          <a href="/">Interior design site</a>
        </div>

        <a class="navbar-brand" href="<?= $shop_page_url; ?>">
          <?php $logo_header = get_field('logo_header', 'options'); if (!empty($logo_header)) { ?><img src="<?= $logo_header['url']; ?>" alt="<?= $logo_header['alt']; ?>" class="logo-small"><?php } ?>
          <?php $logo_shop_wide_header = get_field('logo_shop_wide_header', 'options'); if (!empty($logo_shop_wide_header)) { ?><img src="<?= $logo_shop_wide_header['url']; ?>" alt="<?= $logo_shop_wide_header['alt']; ?>" class="logo-wide"><?php } ?>
        </a>
        
        <div class="col-auto shop-funcs">
          <a href="#" data-toggle="modal" data-target="#searchModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="26.913" height="26.914" viewBox="0 0 26.913 26.914">
              <g id="Group_1989" data-name="Group 1989" transform="translate(-1179.854 -18.458)">
                <g id="Group_1984" data-name="Group 1984" transform="translate(1180.354 18.958)">
                  <path id="Path_3202" data-name="Path 3202" d="M1.447,2.893A10.446,10.446,0,0,0,11.893-7.553,10.446,10.446,0,0,0,1.447-18,10.446,10.446,0,0,0-9-7.553,10.446,10.446,0,0,0,1.447,2.893Z" transform="translate(9 18)" fill="none" stroke-width="1"/>
                </g>
                <g id="Group_1985" data-name="Group 1985" transform="translate(1198.755 37.36)">
                  <path id="Path_3203" data-name="Path 3203" d="M0,0,7.3,7.3" fill="none" stroke-linecap="round" stroke-width="1"/>
                </g>
              </g>
            </svg>
            <span class="txt">Search</span>
          </a>
          <a href="<?= wc_get_account_endpoint_url( 'dashboard' ); ?>" class="my-account">
            <svg xmlns="http://www.w3.org/2000/svg" width="28.346" height="28.347" viewBox="0 0 28.346 28.347">
              <g id="Group_1987" data-name="Group 1987" transform="translate(-1297.827 -509.358)">
                <g id="Group_1979" data-name="Group 1979" transform="translate(1298.327 509.858)">
                  <path id="Path_3195" data-name="Path 3195" d="M-7.242-14.484A13.673,13.673,0,0,0,6.431-28.157,13.674,13.674,0,0,0-7.242-41.831,13.674,13.674,0,0,0-20.915-28.157,13.673,13.673,0,0,0-7.242-14.484Z" transform="translate(20.915 41.831)" fill="none" stroke-width="1"/>
                </g>
                <g id="Group_1980" data-name="Group 1980" transform="translate(1306.994 514.865)">
                  <path id="Path_3196" data-name="Path 3196" d="M-2.683-5.367a5.067,5.067,0,0,0,5.067-5.067A5.066,5.066,0,0,0-2.683-15.5,5.066,5.066,0,0,0-7.75-10.433,5.067,5.067,0,0,0-2.683-5.367Z" transform="translate(7.75 15.499)" fill="none" stroke-width="1"/>
                </g>
                <g id="Group_1981" data-name="Group 1981" transform="translate(1303.998 523.855)">
                  <path id="Path_3197" data-name="Path 3197" d="M-4.238-7.071A13.61,13.61,0,0,0,2.939-9.118a8.063,8.063,0,0,0,.946-3.8A8.081,8.081,0,0,0-1.2-20.421a4.983,4.983,0,0,1-2.981,1,4.985,4.985,0,0,1-2.982-1,8.081,8.081,0,0,0-5.081,7.506,8.057,8.057,0,0,0,1.006,3.907A13.611,13.611,0,0,0-4.238-7.071Z" transform="translate(12.24 20.421)" fill="none" stroke-width="1"/>
                </g>
              </g>
            </svg>
            <span class="txt"><?= (is_user_logged_in())? 'My Account' : 'Sign in'; ?></span>
          </a>
          <a href="<?= wc_get_cart_url(); ?>" class="shop-bag">
            <svg xmlns="http://www.w3.org/2000/svg" width="24.621" height="28.672" viewBox="0 0 24.621 28.672">
              <g id="Group_1988" data-name="Group 1988" transform="translate(-1421.879 -15.111)">
                <path id="Path_3210" data-name="Path 3210" d="M.5-8.395H24.121V-26.162H.5Z" transform="translate(1421.879 51.677)" fill="none" stroke-width="1"/>
                <g id="Group_1982" data-name="Group 1982" transform="translate(1428.479 14.611)">
                  <path id="Path_3208" data-name="Path 3208" d="M-3.183-2.761v-4.19a5.712,5.712,0,0,0-5.71-5.714A5.713,5.713,0,0,0-14.6-6.951v4.19" transform="translate(14.603 13.665)" fill="none" stroke-width="1"/>
                </g>
              </g>
            </svg>
            <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            <span class="txt">Bag</span>
          </a>
        </div>

        <button class="navbar-toggler hamburger hamburger--collapse collapsed" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>

  		</div>

      <div class="collapse navbar-collapse navbar-shop" id="navbarNavAltMarkup">
        <div class="mobile-search d-md-none">
          <form action="/" class="shop-search-form">
            <input type="text" name="s" placeholder="Search...">
          </form>
        </div>
        <?php $shop_menu = get_field('shop_menu', 'options'); if (!empty($shop_menu)) { ?>
        <div class="navbar-nav">
          <?php foreach ($shop_menu as $key => $value) { ?>
          <a class="nav-item nav-link" href="<?= $value['menu_item']['url']; ?>"><?= $value['menu_item']['title']; ?></a>
          <?php } ?>
        </div><?php } ?>
        <div class="navbar-nav d-md-none extra">
          <a href="<?= wc_get_cart_url(); ?>" class="shop-bag nav-item nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="24.621" height="28.672" viewBox="0 0 24.621 28.672">
              <g id="Group_1988" data-name="Group 1988" transform="translate(-1421.879 -15.111)">
                <path id="Path_3210" data-name="Path 3210" d="M.5-8.395H24.121V-26.162H.5Z" transform="translate(1421.879 51.677)" fill="none" stroke-width="1"/>
                <g id="Group_1982" data-name="Group 1982" transform="translate(1428.479 14.611)">
                  <path id="Path_3208" data-name="Path 3208" d="M-3.183-2.761v-4.19a5.712,5.712,0,0,0-5.71-5.714A5.713,5.713,0,0,0-14.6-6.951v4.19" transform="translate(14.603 13.665)" fill="none" stroke-width="1"/>
                </g>
              </g>
            </svg>
            <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            <span class="txt">Bag</span>
          </a>
          <a href="<?= wc_get_account_endpoint_url( 'dashboard' ); ?>" class="my-account nav-item nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="28.346" height="28.347" viewBox="0 0 28.346 28.347">
              <g id="Group_1987" data-name="Group 1987" transform="translate(-1297.827 -509.358)">
                <g id="Group_1979" data-name="Group 1979" transform="translate(1298.327 509.858)">
                  <path id="Path_3195" data-name="Path 3195" d="M-7.242-14.484A13.673,13.673,0,0,0,6.431-28.157,13.674,13.674,0,0,0-7.242-41.831,13.674,13.674,0,0,0-20.915-28.157,13.673,13.673,0,0,0-7.242-14.484Z" transform="translate(20.915 41.831)" fill="none" stroke-width="1"/>
                </g>
                <g id="Group_1980" data-name="Group 1980" transform="translate(1306.994 514.865)">
                  <path id="Path_3196" data-name="Path 3196" d="M-2.683-5.367a5.067,5.067,0,0,0,5.067-5.067A5.066,5.066,0,0,0-2.683-15.5,5.066,5.066,0,0,0-7.75-10.433,5.067,5.067,0,0,0-2.683-5.367Z" transform="translate(7.75 15.499)" fill="none" stroke-width="1"/>
                </g>
                <g id="Group_1981" data-name="Group 1981" transform="translate(1303.998 523.855)">
                  <path id="Path_3197" data-name="Path 3197" d="M-4.238-7.071A13.61,13.61,0,0,0,2.939-9.118a8.063,8.063,0,0,0,.946-3.8A8.081,8.081,0,0,0-1.2-20.421a4.983,4.983,0,0,1-2.981,1,4.985,4.985,0,0,1-2.982-1,8.081,8.081,0,0,0-5.081,7.506,8.057,8.057,0,0,0,1.006,3.907A13.611,13.611,0,0,0-4.238-7.071Z" transform="translate(12.24 20.421)" fill="none" stroke-width="1"/>
                </g>
              </g>
            </svg>
            <span class="txt"><?= (is_user_logged_in())? 'My Account' : 'Sign in / Register'; ?></span>
          </a>
          <a class="nav-item nav-link nav-link-dark" href="/">Interior design site</a>
        </div>
        <?php $follow_menu = get_field('follow_menu', 'options'); if (!empty($follow_menu)) { ?>
        <div class="follow-menu d-md-none">
         <?php foreach ($follow_menu as $key => $value) { ?>
          <a href="<?= $value['link']; ?>" class="<?= $value['fontawesome_class']; ?>"></a> 
         <?php } ?>
        </div>
        <?php } ?>
      </div>
  	</nav>
    
    <div class="modal modal-search fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form action="/" class="shop-search-form">
              <input type="text" name="s" placeholder="Search...">
            </form>
          </div>
        </div>
      </div>
    </div>