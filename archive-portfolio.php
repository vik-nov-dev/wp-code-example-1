<?php wp_enqueue_style( 'portfolio', get_template_directory_uri().'/assets/css/portfolio.css' ); ?>

<?php get_header(); ?>

    <section class="jumbotron">
    	<div class="container">
    		<div class="row">
          <div class="col wow pulse" data-wow-delay=".1s">
            <h2>PORTFOLIO</h2>
            <form>
                <div class="row justify-content-md-center">
                  <div class="from-group col col-md-4">
                    <select class="form-control" name="property-type">
                      <option value="">Property Type</option>
                      <?php $types = get_terms( ['taxonomy' => 'property-type'] ); if (!empty($types)) foreach ($types as $key => $value) { ?>
                      <option value="<?= $value->slug; ?>"><?= $value->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="from-group col col-md-4">
                    <select class="form-control" name="style">
                      <option value="">Style</option>
                      <?php $styles = get_terms( ['taxonomy' => 'style'] ); if (!empty($styles)) foreach ($styles as $key => $value) { ?>
                      <option value="<?= $value->slug; ?>"><?= $value->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
            </form>
          </div>  
        </div>
    	</div>
    </section>
  	<div class="container">
      <div class="port-gal">
        <div class="row">
          <?php $i = 0; if (have_posts()) while (have_posts()) {
            the_post();
            $i++;

            $type_list = wp_get_post_terms( get_the_ID(), 'property-type');
            $type = '';
            if (!empty($type_list)) foreach ($type_list as $tk => $term) {
              if ($tk) $type .= ',';
              $type .= $term->slug;
            }

            $style_list = wp_get_post_terms( get_the_ID(), 'style');
            $style = '';
            if (!empty($style_list)) foreach ($style_list as $tk => $term) {
              if ($tk) $style .= ',';
              $style .= $term->slug;
            }
          ?>
          <div class="col-6 col-md-4 col-lg-3 wow rotateInUpLeft" data-wow-delay="<?= ($i+1 % 4) * 0.3; ?>s" data-wow-duration="1.3s" data-type='<?= $type; ?>' data-style='<?= $style; ?>'>
            <div style="position: relative;display: inline-block;">
              <?php the_post_thumbnail( 'rgithumb' ); ?>
              <a href="<?= get_the_permalink(); ?>" class="abs-link"></a>
            </div>
            <h4><a href="<?= get_the_permalink(); ?>" class="inherit-link"><?php the_title(); ?></a></h4>
            <a href="<?= get_the_permalink(); ?>">View Project <i class="fa fa-angle-right"></i></a>
          </div>
          <?php //if ($i && $i % 4 === 0) echo '</div></div><div class="port-gal"><div class="row">'; ?>
          <?php } ?>
        </div>
      </div>
  	</div>
<script>
jQuery('select[name="property-type"], select[name="style"]').change(function(event) {
  type = jQuery('select[name="property-type"]').val();
  if (!type) type = '';
  style = jQuery('select[name="style"]').val();
  if (!style) style = '';
  jQuery('.port-gal .col-6').each(function(index, el) {
    datatype = jQuery(this).attr('data-type');
    datastyle = jQuery(this).attr('data-style');
    if (!datatype.includes(type) || !datastyle.includes(style)) {jQuery(this).hide();} else {jQuery(this).show();}
  });
});

jQuery(window).load(function() {
	jQuery('select[name="property-type"]').change();
});
</script>

 	<?php get_template_part( 'template-parts/cta' ); ?>
 
<?php get_footer(); ?>