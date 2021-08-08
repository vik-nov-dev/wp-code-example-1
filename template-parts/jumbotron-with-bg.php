	<section class="jumbotron" style="background-image: url(<?= get_field('bg_jumbotron')['url']; ?>);background-size: cover;background-position: center;" <?php live_edit('header, bg_jumbotron'); ?>>
    	<div class="container">
    		<div class="row">
          <div class="col wow pulse" data-wow-delay=".1s">
            <?php the_field('header'); ?>
          </div>  
        </div>
    	</div>
    </section>