<?php /* Template Name: Team */ ?>

<?php wp_enqueue_style( 'team', get_template_directory_uri().'/assets/css/team.css' ); ?>

<?php get_header(); ?>

    <?php get_template_part( 'template-parts/jumbotron' ); ?>

  	<div class="container" <?php live_edit('team'); ?>>
      <div class="members">
        <div class="row">
        <?php $team = get_field('team'); if (!empty($team)) { ?>
          <div class="col">
          <?php	foreach ($team as $key => $value) { if ($key % 4 === 0) { // col #1 ?>
          	<div class="team wow fadeInUp" data-wow-delay=".2s" data-wow-duration="2s">
              <img src="<?= $value['image']['url']; ?>" alt="<?= $value['image']['alt']; ?>" data-skip-lazy="">
              <div class="discr discr-<?= $key; ?>">
                <h3><?= $value['person']['name']; ?><br>
                <span><?= $value['person']['job_title']; ?></span></h3>
                <div class="hide">
                  <?= $value['description']; ?>
                </div>
              </div>
            </div>
          	<?php } } ?>
          </div>
          <div class="col">
          <?php	foreach ($team as $key => $value) { if ( ($key-1) % 4 === 0 ) { // col #2 ?>
          	<div class="team wow fadeInUp" data-wow-delay=".4s" data-wow-duration="2s">
              <img src="<?= $value['image']['url']; ?>" alt="<?= $value['image']['alt']; ?>" data-skip-lazy="">
              <div class="discr discr-<?= $key; ?>">
                <h3><?= $value['person']['name']; ?><br>
                <span><?= $value['person']['job_title']; ?></span></h3>
                <div class="hide">
                  <?= $value['description']; ?>
                </div>
              </div>
            </div>
          	<?php } } ?>
          </div>
          <div class="col">
          <?php	foreach ($team as $key => $value) { if ( ($key-2) % 4 === 0 ) { // col #3 ?>
          	<div class="team wow fadeInUp" data-wow-delay=".6s" data-wow-duration="2s">
              <img src="<?= $value['image']['url']; ?>" alt="<?= $value['image']['alt']; ?>" data-skip-lazy="">
              <div class="discr discr-<?= $key; ?>">
                <h3><?= $value['person']['name']; ?><br>
                <span><?= $value['person']['job_title']; ?></span></h3>
                <div class="hide">
                  <?= $value['description']; ?>
                </div>
              </div>
            </div>
          	<?php } } ?>
          </div>
          <div class="col">
          <?php	foreach ($team as $key => $value) { if ( ($key-3) % 4 === 0 ) { // col #4 ?>
          	<div class="team wow fadeInUp" data-wow-delay=".8s" data-wow-duration="2s">
              <img src="<?= $value['image']['url']; ?>" alt="<?= $value['image']['alt']; ?>" data-skip-lazy="">
              <div class="discr discr-<?= $key; ?>">
                <h3><?= $value['person']['name']; ?><br>
                <span><?= $value['person']['job_title']; ?></span></h3>
                <div class="hide">
                  <?= $value['description']; ?>
                </div>
              </div>
            </div>
          	<?php } } ?>
          </div>
		<?php } ?>
        </div>
      </div>
  	</div>
  	<style class="team-style"></style>
  	<script>
  	jQuery(document).ready(function($) {
  		jQuery('.discr').each(function(index, el) {
  			var img = jQuery(el).parent().find('img');
  			if (img.prop('complete')) {
  				var top = jQuery(el).css('top');
		  		var text = jQuery('.team-style').text();
		  		var className = jQuery(el).attr('class').replace('discr ', '');
		  		text += ' ' + '.team .'+className+' {top: '+top+'}';
		  		jQuery('.team-style').text(text);
  			} else {
				img.load(function(){
	  				var top = jQuery(el).css('top');
		  			var text = jQuery('.team-style').text();
		  			var className = jQuery(el).attr('class').replace('discr ', '');
		  			text += ' ' + '.team .'+className+' {top: '+top+'}';
		  			jQuery('.team-style').text(text);
	  			});
  			}
  			
	  	});
  	});
  		 
  	</script>

  	<?php get_template_part( 'template-parts/cta' ); ?>

<?php get_footer(); ?>