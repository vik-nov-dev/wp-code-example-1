<?php
if (is_home()) {
  $page_for_posts = get_option( 'page_for_posts' );
}
?>
<section class="get-touch" <?php if (is_home()) { live_edit('use_global_cta, text_cta, button_text_cta, button_link_cta', $page_for_posts); } else { live_edit('use_global_cta, text_cta, button_text_cta, button_link_cta'); } ?>>
  <?php
  if (is_home()) {
    $use_global = get_field('use_global_cta', $page_for_posts);
  }
  else
    $use_global = get_field('use_global_cta');
  if ($use_global || is_archive()) {
    $text_cta = get_field('text_cta', 'options');
    $button_text_cta = get_field('button_text_cta', 'options');
    $button_link_cta = get_field('button_link_cta', 'options');
  } else {
    if (is_home()) {
      $text_cta = get_field('text_cta', $page_for_posts);
      $button_text_cta = get_field('button_text_cta', $page_for_posts);
      $button_link_cta = get_field('button_link_cta', $page_for_posts);
    } else {
      $text_cta = get_field('text_cta');
      $button_text_cta = get_field('button_text_cta');
      $button_link_cta = get_field('button_link_cta');
    }
  }
  ?>
	<div class="container">
		<div class="row">
			<div class="col wow pulse" data-wow-delay=".5s">
				<?= $text_cta; ?>
        <?php if (!empty($button_text_cta)) { ?>
				<a href="<?= $button_link_cta; ?>"><?= $button_text_cta; ?> <i class="fa fa-angle-right"></i></a>
        <?php } ?>
			</div>
		</div>
	</div>
</section>