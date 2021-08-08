<?php
get_header('shop');
$searchkw = get_search_query();
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">You searched for <?= $searchkw ?></h1>
</div>

<div class="container">
		<div class="row">

<?php

	$args = [
		'post_type' => 'product',
		'post_status' => 'publish',
		'orderby' => 'date',
		'order'   => 'DESC',
		'posts_per_page' => 16,
		'paged' => $page,
		's' => $searchkw,
	];
	$posts = new WP_Query( $args );
	
	$x=1;
	foreach($posts->posts as $post)
	{
		$product = wc_get_product( $post->ID );
		
?>

						
						<div class="col-12 col-md-6 col-lg-3">
							<div class="product-tile">
							  <div class="image-overlay">
							  <?php
							  
							  $CImg = get_field('category_image');
							  if(is_array($CImg))
							  {
								  echo '<img src="'. $CImg['url'] .'" alt="'. $CImg['alt'] .'" />';
							  }
							  else
								  the_post_thumbnail('rgithumb-large');
							 
							  
							  ?>
								<a href="<?= get_the_permalink(); ?>" class="abs-link"></a>
							  </div>
							  <h3><a href="<?= get_the_permalink(); ?>" class="inherit-link"><?= get_the_title(); ?></a></h3>
							  <a href="<?= get_the_permalink(); ?>"><?php echo $product->get_price_html(); ?></a>
							</div>
						  </div>

<?php

	$x++;
	}

?>

</div>


<div class="ss88pagination">
    <?php 
        echo paginate_links( array(
            'base' => @add_query_arg('paged','%#%'),
            'total'        => $posts->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Previous', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'More', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>

</div>


<?php get_footer('shop'); ?>
