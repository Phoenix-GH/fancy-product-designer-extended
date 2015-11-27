<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if( !class_exists('FPD_Admin_Shortcode_Order') ) {

	class FPD_Admin_Shortcode_Order {

		public function output() {

			if( class_exists('FPD_Admin_Order') ) {

				global $wpdb;

				$pagenum = isset( $_GET['paged'] ) ? absint( $_GET['paged'] ) : 1;
				$limit = 5;
				$offset = ( $pagenum - 1 ) * $limit;
				$total = $wpdb->get_var( "SELECT COUNT(ID) FROM ".FPD_ORDERS_TABLE."" );
				$num_of_pages = ceil( $total / $limit );

				$page_links = paginate_links( array(
				    'base' => add_query_arg( 'paged', '%#%' ),
				    'format' => '',
				    'prev_text' => __( '&laquo;', 'text-domain' ),
				    'next_text' => __( '&raquo;', 'text-domain' ),
				    'total' => $num_of_pages,
				    'current' => $pagenum
				) );


				?>
				<div class="wrap" id="fpd-orders">

					<h2 class="fpd-clearfix">
						<?php _e('Orders via Shortcode', 'radykal'); ?>
						<?php fpd_admin_display_version_info(); ?>
					</h2>

					<?php if( function_exists('get_woocommerce_currency') ) : ?>
					<div class="updated">
						<p><strong><?php _e('Orders made with WooCommerce can be viewed in the order details of a WooCommerce order!', 'radykal'); ?></strong></p>
					</div>
					<?php endif; ?>

					<div class="fpd-panel">
						<h3><?php _e('Choose Order', 'radykal'); ?></h3>

						<ul id="fpd-shortcode-orders-list">

							<?php

							$orders = FPD_Shortcode_Order::get_orders($limit, $offset);

							if( is_array($orders) ) {
								foreach($orders as $order) {

									echo $this->get_order_list_item(
										$order->ID,
										$order->customer_name,
										$order->customer_mail,
										fpd_update_image_source($order->views)
									);

								}
							}

							?>


						</ul>

						<?php
						if ( $page_links ) {
						    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 0;">' . $page_links . '</div></div>';
						}
						?>

					</div>

					<div class="fpd-panel">
						<h3><?php _e('Order Viewer', 'radykal'); ?></h3>
						<?php FPD_Admin_Order::output(); ?>
					</div>

				</div>
				<script type="text/javascript">

					jQuery(document).ready(function($) {

						var $ordersList = $('#fpd-shortcode-orders-list');

						$ordersList.on('click', 'li', function() {

							if(!loadingProduct) {
								$ordersList.children('li').removeClass('fpd-active');

								var $this = $(this).addClass('fpd-active'),
									order = $this.data('views');

								orderId = $this.data('id');

								fpdLoadOrder(order);

							}

						});

						$ordersList.on('click', '.fpd-remove-order', function(evt) {

							evt.preventDefault();
							evt.stopPropagation();

							var c = confirm(fpd_admin_opts.remove);

							if(c) {

								$.ajax({
									url: fpd_admin_opts.adminAjaxUrl,
									data: {
										action: 'fpd_removeshortcodeorder',
										_ajax_nonce: fpd_admin_opts.ajaxNonce,
										id: $(this).parents('li').data('id')
									},
									type: 'post',
									dataType: 'json',
									success: function(data) {

										if(data == 0) {
											fpdMessage(fpd_admin_opts.tryAgain, 'error');
										}
										else {
											location.reload();
										}

									}
								});

							}

						});

					});

				</script>
				<?php

			}

		}

		private function get_order_list_item( $id, $name, $mail, $views ) {

			return '<li data-id="'.$id.'" data-views="'.esc_attr(stripslashes(str_replace("'", "%27", $views))).'" class="fpd-clearfix"><span>'.$name.'<br /><a href="mailto:'.$mail.'">'.$mail.'</a></span><span><a href="#" class="fpd-remove-order fpd-admin-tooltip" title="'.__('Remove', 'radykal').'"><i class="fpd-admin-icon-close"></i></a></span></li>';

		}

	}

}