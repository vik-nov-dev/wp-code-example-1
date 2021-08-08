<?php /* Template Name: Shop Simple */ ?>
<?php get_header('shop'); ?>
<section class="<?php if(!is_cart()) { ?>mt-def<?php } else { ?>mt-4<?php } ?> mb-def">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer('shop'); ?>