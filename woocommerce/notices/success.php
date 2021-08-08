<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

foreach ( $notices as $key => $notice ) {
	if ($notice['notice'] === '<a href="/shop/cart/" tabindex="1" class="button wc-forward">View basket</a>') {
		define("SHOW_BASKET_NOTICE", true);
		if (!wp_is_mobile())
			unset($notices[$key]);
	}
}

?>

<?php if (!empty($notices)) foreach ( $notices as $notice ) : ?>
	<div class="woocommerce-message"<?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
		<?php
		if ($notice['notice'] === '<a href="/shop/cart/" tabindex="1" class="button wc-forward">View basket</a>') {
			echo '<a href="/shop/cart/" tabindex="1" class="button wc-forward d-block text-center">View basket</a>';
		} else {
			echo wc_kses_notice( $notice['notice'] );
		}
		?>
	</div>
<?php endforeach; ?>

<?php wc_clear_notices(); ?>
