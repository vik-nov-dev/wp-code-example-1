<?php
define( 'WPCF7_AUTOP', false );
add_theme_support('title-tag');
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
add_image_size( 'rgithumb', 255, 255, true );
add_image_size( 'rgiblogthumb', 255, 160, true );
add_image_size( 'rgithumb-large', 500, 500, true );
add_filter('loop_shop_per_page', function($cols) { return 18; }, 20);

if (!function_exists('live_edit')) {
	function live_edit($a='', $b='') {
		echo '';
	}
}

// add editor-style.css to WYSIWYG Editor
add_editor_style();

/*
* Add Formats to TinyMCE
*/
add_filter( 'mce_buttons_2', 'extend_mce_buttons_2' );
function extend_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'tiny_mce_before_init', 'extend_mce_before_init_insert_formats' );
function extend_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'Button Theme',
            'items' => [
                [
                    'title' => 'Simple',
                    'selector' => 'a',
                    'classes' => 'btn btn-theme'
                ],
                [
                    'title' => 'Right Arrowed',
                    'selector' => 'a',
                    'classes' => 'btn btn-theme btn-angle-right'
                ],
            ]
        ),
    );

    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}

/*
* Add Custom Button to TinyMCE
*/
add_action('admin_head', 'vine_add_mce_button');
function vine_add_mce_button() {
	add_filter( 'mce_external_plugins', 'vine_add_tinymce_plugin' );
	add_filter( 'mce_buttons', 'vine_register_mce_button' );
}
// register new button in the editor
function vine_register_mce_button( $buttons ) {
	array_push( $buttons, 'theme_mce_button' );
	return $buttons;
}
// declare a script for the new button
// the script will insert the shortcode on the click event
function vine_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['theme_mce_button'] = get_template_directory_uri().'/assets/js/vine-mce-theme-button.js';
	return $plugin_array;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	array_push( $toolbars['Full'][1], 'theme_mce_button' );
	return $toolbars;
}

//add_action('init', 'admin_bar_hide' );
function admin_bar_hide() {
	add_filter( 'show_admin_bar', '__return_false' , 1000 );
}

add_action('wp_head', 'fix_navbar_styles');
function fix_navbar_styles() {
	if (is_user_logged_in() && !wp_is_mobile())
		echo '<style>.sticky-top{top:32px;}</style>';
}

// Add WordPress Versioning to Files
function ss88_add_modified_time( $src ) {
    $clean_src = remove_query_arg( 'ver', $src );
	$path = wp_parse_url( $src, PHP_URL_PATH );
	
    if ( $modified_time = @filemtime( untrailingslashit( ABSPATH ) . $path ) )
		$src = add_query_arg( 'ver', $modified_time, $clean_src );
	else
		$src = add_query_arg( 'ver', time(), $clean_src );
	
    return $src;
}
add_filter( 'style_loader_src', 'ss88_add_modified_time', 99999999, 1 );
add_filter( 'script_loader_src', 'ss88_add_modified_time', 99999999, 1 );

add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
function load_admin_styles() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/admin-style.css');
}  

function my_acf_init() {
	$gmap_api_token = get_field('gmap_api_token', 'options');
	acf_update_setting('google_api_key', $gmap_api_token);
}
add_action('acf/init', 'my_acf_init');


register_sidebar(array(
		'id'            => 'shop',
        'name'          => 'Shop Sidebar',
        'description'   => 'The shop sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
));

add_action('init', 'projects_custom_init');
function projects_custom_init(){
	register_post_type('portfolio', array(
        'labels'             => array(
            'name'               => 'Portfolio',
            'singular_name'      => 'Portfolio',
            'add_new'            => 'Add Item',
            'add_new_item'       => 'Add Item',
            'edit_item'          => 'Edit Item',
            'new_item'           => 'New Item',
            'view_item'          => 'View Item',
            'search_items'       => 'Find Items',
            'not_found'          => 'No Items found',
            'not_found_in_trash' => 'No Items in Trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Portfolio'

          ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'menu_icon'          => 'dashicons-images-alt2',
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'thumbnail', 'editor'),
		'rewrite' 			 => [
								'with_front' => false,
								]
    ) );

    register_taxonomy('property-type', array('portfolio'), array(
		'labels'                => array(
			'name'              => 'Property Types',
			'singular_name'     => 'Property Type',
			'search_items'      => 'Search Property Types',
			'all_items'         => 'All Property Types',
			'view_item '        => 'View Property Types',
			'parent_item'       => 'Parent Property Type',
			'parent_item_colon' => 'Parent Property Types:',
			'edit_item'         => 'Edit Property Type',
			'update_item'       => 'Update Property Type',
			'add_new_item'      => 'Add New Property Type',
			'new_item_name'     => 'New Property Type',
			'menu_name'         => 'Property Types',
		),
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => false,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_tagcloud'         => false,
		'show_in_rest'          => false,
		'rest_base'             => null,
		'hierarchical'          => false,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box',
		'show_admin_column'     => true,
		'_builtin'              => false,
		'show_in_quick_edit'    => null,
	) );

	register_taxonomy('style', array('portfolio'), array(
		'labels'                => array(
			'name'              => 'Styles',
			'singular_name'     => 'Style',
			'search_items'      => 'Search for Styles',
			'all_items'         => 'All Styles',
			'view_item '        => 'View Styles',
			'parent_item'       => 'Parent Style',
			'parent_item_colon' => 'Parent Style:',
			'edit_item'         => 'Edit Style',
			'update_item'       => 'Update Style',
			'add_new_item'      => 'Add New Style',
			'new_item_name'     => 'New Style',
			'menu_name'         => 'Styles',
		),
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => false,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_tagcloud'         => false,
		'show_in_rest'          => false,
		'rest_base'             => null,
		'hierarchical'          => false,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box',
		'show_admin_column'     => true,
		'_builtin'              => false,
		'show_in_quick_edit'    => null,
	) );
}

// ACF Options Page
if( function_exists('acf_add_options_page') ) {
 
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title' 	=> 'General Settings',
		'menu_slug' 	=> 'theme-options',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Menus',
		'menu_title'	=> 'Menus',
		'parent_slug'	=> 'theme-options',
	));

	acf_add_options_sub_page(array(
        'page_title'    => 'General Template Parts',
        'menu_title'    => 'Template Parts',
        'parent_slug'   => 'theme-options',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Shortcodes',
        'menu_title'    => 'Shortcodes',
        'parent_slug'   => 'theme-options',
    ));
}

add_action('wp_ajax_load_posts', 'load_posts_callback');
add_action('wp_ajax_nopriv_load_posts', 'load_posts_callback');
function load_posts_callback() {
	$offset = intval( $_POST['offset'] );
	$search = $_POST['search'];
	$posts_per_page = get_option( 'posts_per_page' );
	$posts_per_page++;

	$params = [
		'numberposts' => $posts_per_page,
		'offset' => $offset,
	];
	if (!empty($search))
		$params['s'] = $search;

	$posts = get_posts($params);
	$data_needed = [];
	if (!empty($posts))	foreach ($posts as $key => $value) {
		$data_needed[] = [
			'post_title' => $value->post_title,
			'thumbnail_html' => get_the_post_thumbnail( $value->ID, 'rgiblogthumb' ),
			'date' => get_the_date( '', $value->ID ),
			'excerpt' => get_the_excerpt( $value->ID ),
			'permalink' => get_the_permalink( $value->ID )
		];
	}

	$data = json_encode($data_needed);
	echo $data;
	wp_die();
}

/*
* Unset limit for Portfolio Archieve
*/
function portfolio_unlimited( $query ) {
	if( $query->is_post_type_archive( 'portfolio' ) )
	{
		$query->set( 'posts_per_archive_page', 999 );
	}
		
}
add_action( 'pre_get_posts', 'portfolio_unlimited' );

/*
* Woocommerce Staff
*/
function reneder_shop_breadcrumb() {
	$shop_page_id = wc_get_page_id( 'shop' );
	$q_obj = get_queried_object();
	//print_r($q_obj);
	$out = '';
	$out = '<a href="'.get_the_permalink( $shop_page_id ).'">'.get_the_title( $shop_page_id ).'</a> <i class="fa fa-angle-right"></i> ';

	// category page
	if ( is_a($q_obj, 'WP_Term') ) {
		$out .= '<span>'.$q_obj->name.'</span>';
	}

	// single product page
	if ( is_a($q_obj, 'WP_Post') && $q_obj->post_type == 'product' ) {
		$WC_Product = new WC_Product( $q_obj->ID );
		$category_ids = $WC_Product->get_category_ids();
		if (!empty($category_ids)) foreach ($category_ids as $key => $value) {
			$cat = get_term($value);
			$out .= '<a href="'.get_term_link( $value ).'">'.$cat->name.'</a> <i class="fa fa-angle-right"></i> ';
		}
		$out .= '<span>'.$q_obj->post_title.'</span>';
	}
	echo $out;
}

// Change "DESCRIPTION" to "Product info"
add_filter( 'woocommerce_product_description_heading', function(){
	return 'Product info';
});

// remove category list from sigle product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

//change price and short description in places
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 8 );

// remove WC default related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// change stock quantity message
add_filter( 'woocommerce_get_availability', 'rgi_custom_get_availability', 1, 2);
function rgi_custom_get_availability( $availability, $_product ) {
	if ( $_product->is_in_stock() ) {
		$stock_quantity = $_product->get_stock_quantity();
		if ($stock_quantity <= 5)
			$availability['availability'] = 'only '.$stock_quantity.' left - order now before its too late';
	}
	return $availability;
}

add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return 'ADD TO BAG'; 
} );

// boxed after add to cart with delivery policy etc
add_action( 'woocommerce_after_add_to_cart_form', function() {
	$product_info_links = get_field('product_info_links', 'options');
	if (!empty($product_info_links)) {
?>
<div class="infobox">
	<?php foreach ($product_info_links as $key => $value) { if ($key) echo '<div class="sep"></div>'; ?>
	<div>
		<?= get_image_tag($value['icon']['id'], $value['icon']['alt'], $value['icon']['title'], '', 'full'); ?>
		<p><?= $value['link']['title']; ?></p>
		<a href="<?= $value['link']['url']; ?>" class="abs-link-simple"></a>
	</div>
	<?php } ?>
</div>
<?php
	}
} );

// enable tracking of viewed products
function rgi_custom_track_product_view() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
        $viewed_products = array();
    else
        $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

    if ( ! in_array( $post->ID, $viewed_products ) ) {
        $viewed_products[] = $post->ID;
    }

    if ( sizeof( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }

    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}
add_action( 'template_redirect', 'rgi_custom_track_product_view', 20 );

// function to get recently viewed products
function rgi_get_recent_products($exclude_ids = 0) {
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
	$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
	if (!empty($exclude_ids)) {
		if (is_array($exclude_ids))
			$viewed_products = array_diff($viewed_products, $exclude_ids);
		else
			$viewed_products = array_diff($viewed_products, [$exclude_ids]);
	}
	return $viewed_products;
}

add_action( 'woocommerce_before_cart_table', 'rgi_add_cart_title', 1);
function rgi_add_cart_title() {
	setlocale(LC_ALL, 'en_US');
	echo '<h2 class="cart-title">My Bag <span>'.WC()->cart->get_cart_contents_count().ngettext(" item", " items", WC()->cart->get_cart_contents_count()).'</span></h2>';
}

add_action( 'woocommerce_after_cart_item_name', function($cart_item, $cart_item_key) {
	echo '<p>'.$cart_item['data']->get_short_description().'</p>';
}, 20, 2 );

// remove WC styles
add_filter( 'woocommerce_enqueue_styles', function ( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );
	unset( $enqueue_styles['woocommerce-layout'] );
	unset( $enqueue_styles['woocommerce-smallscreen'] );
	return $enqueue_styles;
} );



function add_modified_time( $src ) {
    $clean_src = remove_query_arg( 'ver', $src );
	$path = wp_parse_url( $src, PHP_URL_PATH );
	
    if ( $modified_time = @filemtime( untrailingslashit( ABSPATH ) . $path ) )
		$src = add_query_arg( 'ver', $modified_time, $clean_src );
	else
		$src = add_query_arg( 'ver', time(), $clean_src );
	
    return $src;
}
add_filter( 'style_loader_src', 'add_modified_time', 99999999, 1 );
add_filter( 'script_loader_src', 'add_modified_time', 99999999, 1 );

/*
* WC Coupon Messages
*/
add_filter( 'woocommerce_checkout_coupon_message', 'woocommerce_checkout_coupon_message_filter_function' );
function woocommerce_checkout_coupon_message_filter_function( $html ){
	return 'Have a Gift Voucher or Promotion Code?'.' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>';
}

add_filter( 'gettext', 'woocommerce_rename_coupon_field_on_checkout', 10, 3 );
function woocommerce_rename_coupon_field_on_checkout( $translated_text, $text, $text_domain ) {
	if ( is_admin() || 'woocommerce' !== $text_domain ) {
		return $translated_text;
	}
	if ( 'Apply coupon' === $text ) {
		$translated_text = 'Apply Code';
	}
	if ( 'Coupon code' === $text ) {
		$translated_text = 'Voucher / Promotion Code';
	}
	if ( 'If you have a coupon code, please apply it below.' === $text ) {
		$translated_text = 'If you have a voucher or promotion code, please apply it below.';
	}
	return $translated_text;
}

add_filter( 'woocommerce_coupon_error','coupon_error_message_change',10,3 );
function coupon_error_message_change($err, $err_code, $parm )
{
	switch ( $err_code ) {
		case 105:
		$err = sprintf( __( 'Voucher / Promotion "%s" does not exist!', 'woocommerce' ), $parm->get_code() );
       break;
	}
	return $err;
}



// define the wc_add_to_cart_message callback 
function filter_wc_add_to_cart_message( $message, $product_id ) { 
    return '<a href="/shop/cart/" tabindex="1" class="button wc-forward">View basket</a>'; 
}; 
         
// add the filter 
add_filter( 'wc_add_to_cart_message', 'filter_wc_add_to_cart_message', 10, 2 ); 











add_action( 'woocommerce_after_checkout_form', 'bbloomer_disable_shipping_local_pickup' );
  
function bbloomer_disable_shipping_local_pickup( $available_gateways ) {
    
   // Part 1: Hide shipping based on the static choice @ Cart
   // Note: "#customer_details .col-2" strictly depends on your theme
 
   $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
   $chosen_shipping = $chosen_methods[0];
   if ( 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
   ?>
      <script type="text/javascript">
         jQuery('#customer_details .col-2').fadeOut();
      </script>
   <?php  
   } 
 
   // Part 2: Hide shipping based on the dynamic choice @ Checkout
   // Note: "#customer_details .col-2" strictly depends on your theme
 
   ?>
      <script type="text/javascript">
         jQuery('form.checkout').on('change', hideShipping);
		 function hideShipping() {
            var val = jQuery( 'input[name^="shipping_method"]:checked' ).val();
            if (val.match("^local_pickup")) {
                     jQuery('#customer_details .woocommerce-shipping-fields').fadeOut();
               } else {
               jQuery('#customer_details .woocommerce-shipping-fields').fadeIn();
            }
         }
		 hideShipping();
      </script>
   <?php
  
}







?>