<?php

/**
 * Plugin Name: WooCommerce Shipping gateway per Product
 * Plugin URI: https://www.dreamfoxmedia.com
 * Description: WooCommerce Shipping gateway per Product
 * Version: 2.5.2
 * Author: Dreamfox
 * Author URI: https://www.dreamfoxmedia.com
 * Text Domain: dreamfoxmedia
 * Domain Path: /languages
 * Copyright: Â© 2023 Dreamfox media.
 * WC tested up to: 8.5.1
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
/**
 * For multi Network
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
define( 'DFM_SGPPFW__FILE__', __FILE__ );
define( 'DFM_SGPPFW_SHIPPING_META_KEY', 'dfm_sgppfw_allow_shippings' );
add_action( 'before_woocommerce_init', function () {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );
if ( function_exists( 'dfm_sgppfw_fs' ) ) {
    dfm_sgppfw_fs()->set_basename( false, __FILE__ );
} else {
    if ( !function_exists( 'dfm_sgppfw_fs' ) ) {
        // Create a helper function for easy SDK access.
        function dfm_sgppfw_fs() {
            global $dfm_sgppfw_fs;
            if ( !isset( $dfm_sgppfw_fs ) ) {
                // Activate multisite network integration.
                if ( !defined( 'WP_FS__PRODUCT_7653_MULTISITE' ) ) {
                    define( 'WP_FS__PRODUCT_7653_MULTISITE', true );
                }
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $dfm_sgppfw_fs = fs_dynamic_init( array(
                    'id'             => '7653',
                    'slug'           => 'dfm-shipping-gateway-per-product-for-woocommerce',
                    'premium_slug'   => 'DreamfoxMediaPaymentgatewayperProductforWoocommerce-premium',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_f21a7bb601e07d62b89f55c3a832c',
                    'is_premium'     => false,
                    'premium_suffix' => 'Premium',
                    'has_addons'     => false,
                    'navigation'     => 'tabs',
                    'has_paid_plans' => true,
                    'menu'           => array(
                        'slug'    => 'softsdev-product-shippings',
                        'support' => false,
                        'parent'  => array(
                            'slug' => 'woocommerce',
                        ),
                    ),
                    'is_live'        => true,
                ) );
            }
            return $dfm_sgppfw_fs;
        }

        // Init Freemius.
        dfm_sgppfw_fs();
        // Signal that SDK was initiated.
        do_action( 'dfm_sgppfw_fs_loaded' );
    }
}
if ( !function_exists( 'is_plugin_active_for_network' ) || !function_exists( 'is_plugin_active' ) ) {
    require_once ABSPATH . '/wp-admin/includes/plugin.php';
}
require_once dirname( __FILE__ ) . '/inc/quick_bulk_edit_patch.php';
/**
 * default variable
 */
define( 'PRODUCT_SHIPPINGS_ITEM_REFERENCE', 'Product Shippings' );
//Rename this constant name so it is specific to your plugin or theme.
/**
 * Check is free plugin is installed then we will deactivate free first
 */
if ( is_plugin_active( 'woocommerce-product-shippings/woocommerce-product-shippings.php' ) ) {
    deactivate_plugins( 'woocommerce-product-shippings/woocommerce-product-shippings.php' );
}
if ( is_plugin_active( 'woocommerce-shipping-gateway-per-product/woocommrece-product-shippings.php' ) ) {
    deactivate_plugins( 'woocommerce-shipping-gateway-per-product/woocommrece-product-shippings.php' );
}
dfm_sgppfw_fs()->add_filter( 'hide_account_tabs', 'dfm_sgppfw_hide_account_tabs' );
function dfm_sgppfw_hide_account_tabs() {
    return true;
}

/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && !function_exists( 'softsdev_product_shippings_settings' ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {
    require_once dirname( __FILE__ ) . '/inc/settings.php';
    function softsdev_remove_empty_items(  $ships  ) {
        if ( is_array( $ships ) ) {
            $result = array();
            foreach ( $ships as $ship ) {
                if ( is_string( $ship ) && strlen( trim( $ship ) ) > 0 ) {
                    $result[] = $ship;
                }
            }
        } else {
            $result = $ships;
        }
        return $result;
    }

    // display default admin notice
    function product_shipping_ignore_notice() {
        if ( isset( $_GET['product-shipping-ignore-notice'] ) ) {
            update_option( 'product_shipping_alert', 1 );
        }
    }

    add_action( 'admin_init', 'product_shipping_ignore_notice' );
    // Submenu on woocommerce section
    /* ----------------------------------------------------- */
    /**
     * Type: updated,error,update-nag
     */
    if ( !function_exists( 'softsdev_notice' ) ) {
        function softsdev_notice(  $message, $type  ) {
            ?>
            <div class="<?php 
            echo $type;
            ?> notice">
                <p><?php 
            echo $message;
            ?></p>
            </div>
            <?php 
        }

    }
    /**
     *
     * @param string $text
     * @return string
     */
    function softsdev_product_shippings_footer_text(  $text  ) {
        if ( isset( $_GET['page'] ) && strpos( plugin_basename( wp_unslash( $_GET['page'] ) ), 'softsdev-product-shippings' ) === 0 ) {
            $text = '<a href="https://www.dreamfoxmedia.com" target="_blank">www.dreamfoxmedia.com</a>';
        }
        return $text;
    }

    /**
     *
     * @param string $text
     * @return string
     */
    function softsdev_product_shippings_update_footer(  $text  ) {
        if ( isset( $_GET['page'] ) && strpos( plugin_basename( wp_unslash( $_GET['page'] ) ), 'softsdev-product-shippings' ) === 0 ) {
            $text = 'Version 2.4.1';
        }
        return $text;
    }

    add_action( 'add_meta_boxes', 'wps_ship_meta_box_add', 50 );
    function wps_ship_meta_box_add() {
        add_meta_box(
            'shippings',
            'Choose shipping gateway',
            'wps_shipping_form',
            'product',
            'side',
            'core'
        );
    }

    if ( !function_exists( 'wps_shipping_get_shippings_meta' ) ) {
        function wps_shipping_get_shippings_meta(  $product_id  ) {
            $shippings = get_post_meta( $product_id, DFM_SGPPFW_SHIPPING_META_KEY, true );
            if ( !is_array( $shippings ) ) {
                $shippings = [];
            }
            return $shippings;
        }

    }
    function wps_get_shipping_method_id(  $zone_id, $method  ) {
        return $zone_id . '___' . $method->instance_id;
    }

    /**
     *
     * @global type $post
     * @global type $woocommerce
     */
    function wps_shipping_form() {
        global $post;
        // Get all shipping zones
        $zones = WC_Shipping_Zones::get_zones();
        $rest_of_world_zone = WC_Shipping_Zones::get_zone( 0 );
        $rest_of_world_zone->set_zone_name( 'Rest of the world' );
        $zones[] = $rest_of_world_zone;
        $shippings = wps_shipping_get_shippings_meta( $post->ID );
        echo '<div class="wps-shipping-form">';
        // Loop through each zone to get the enabled shipping methods
        foreach ( $zones as $zone ) {
            // Use methods to get zone ID and zone name, as $zone is an object
            if ( is_array( $zone ) ) {
                $zone_id = $zone['id'];
                $zone_name = $zone['zone_name'];
                $shipping_methods = $zone['shipping_methods'];
            } elseif ( $zone instanceof WC_Shipping_Zone ) {
                $zone_id = $zone->get_id();
                $zone_name = $zone->get_zone_name();
                $shipping_methods = $zone->get_shipping_methods();
            } else {
                continue;
            }
            echo '<div class="wps-shipping-zone-group">';
            if ( count( $zones ) > 1 ) {
                echo sprintf( '<div style="margin-top:5px"><strong>%s</strong></div>', $zone_name );
            }
            // Loop through the shipping methods
            foreach ( $shipping_methods as $method ) {
                // Check if the method is enabled
                if ( $method->enabled === 'yes' ) {
                    $ship_id = wps_get_shipping_method_id( $zone_id, $method );
                    $checked = ( in_array( $ship_id, $shippings ) ? 'checked="checked"' : '' );
                    ?>
                    <div>
                        <label for="ship_<?php 
                    echo $ship_id;
                    ?>">
                            <input type="checkbox" <?php 
                    echo $checked;
                    ?> value="<?php 
                    echo $ship_id;
                    ?>" name="ship[]" id="ship_<?php 
                    echo $ship_id;
                    ?>" />
                            <span><?php 
                    echo $method->title;
                    ?></span>
                        </label>
                    </div>
                        
                    <?php 
                }
            }
            echo '</div>';
        }
        echo '</div>';
    }

    add_action(
        'save_post',
        'wps_ship_meta_box_save',
        10,
        2
    );
    /**
     *
     * @param type $post_id
     * @param type $post
     * @return type
     */
    function wps_ship_meta_box_save(  $post_id, $post  ) {
        // Restrict to save for autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || isset( $_REQUEST['action'] ) && sanitize_title( $_REQUEST['action'] ) != 'editpost' ) {
            return $post_id;
        }
        // Restrict to save for revisions
        if ( isset( $post->post_type ) && $post->post_type == 'revision' ) {
            return $post_id;
        }
        if ( get_post_type() === 'product' ) {
            delete_post_meta( $post_id, DFM_SGPPFW_SHIPPING_META_KEY );
            $productIds = get_option( 'woocommerce_product_apply_ship' );
            if ( is_array( $productIds ) && !in_array( $post_id, $productIds ) ) {
                $productIds[] = $post_id;
                update_option( 'woocommerce_product_apply_ship', $productIds );
            }
            $shippings = array();
            if ( isset( $_POST['ship'] ) ) {
                $post_ships = array_filter( array_map( 'sanitize_title', $_POST['ship'] ) );
            } else {
                $post_ships = [];
            }
            if ( $post_ships ) {
                foreach ( $post_ships as $ship ) {
                    $shippings[] = $ship;
                }
            }
            if ( count( $shippings ) ) {
                update_post_meta( $post_id, DFM_SGPPFW_SHIPPING_META_KEY, $shippings );
            } else {
                delete_post_meta( $post_id, DFM_SGPPFW_SHIPPING_META_KEY );
            }
        }
    }

    /**
     *
     * @global type $woocommerce
     * @param type $available_methods
     * @return type
     */
    /**
     *
     * @global type $woocommerce
     * @param type $available_methods
     * @return type
     */
    function wps_shipping_method_disable_country(  $packages  ) {
        $multiCartShipOption = 'expensive';
        return wps_filter_packages( $packages, $multiCartShipOption );
    }

    /**
     * Filter packages
     * 
     * @param array Packages
     * @param string option
     */
    function wps_filter_packages(  &$packages, $multiCartShipOption, $callback = null  ) {
        foreach ( $packages as &$package ) {
            $zone = WC_Shipping_Zones::get_zone_matching_package( $package );
            $zone_id = $zone->get_id();
            $allowed_shipping_methods = wps_get_allowed_shipping_methods( $package, $multiCartShipOption );
            $available_methods =& $package['rates'];
            if ( count( $allowed_shipping_methods ) > 0 ) {
                $available_method_ids = wps_get_shipping_method_ids( $zone_id, $available_methods );
                $filtered_method_ids = array_intersect( $allowed_shipping_methods, $available_method_ids );
                if ( count( $filtered_method_ids ) > 0 ) {
                    foreach ( $available_methods as $key => $available_method ) {
                        $available_method_id = wps_get_shipping_method_id( $zone_id, $available_method );
                        if ( !in_array( $available_method_id, $filtered_method_ids ) ) {
                            unset($available_methods[$key]);
                        }
                    }
                } else {
                    $available_methods = [];
                }
            } else {
                $available_methods = [];
            }
            if ( is_callable( $callback ) ) {
                $callback( $package, $available_methods, $multiCartShipOption );
            }
        }
        return $packages;
    }

    /**
     * Get shipping method ids
     * 
     * @param array List of shipping method objects
     * @return array List of shipping method ids
     */
    function wps_get_shipping_method_ids(  $zone_id, $shipping_methods  ) {
        $method_ids = [];
        foreach ( $shipping_methods as $shipping_method ) {
            $method_ids[] = wps_get_shipping_method_id( $zone_id, $shipping_method );
        }
        return $method_ids;
    }

    /**
     * Get allowed shipping methods for a package
     * 
     * @param type $package
     * @return array List of shipping methods
     */
    function wps_get_allowed_shipping_methods(  $package, $multiCartShipOption  ) {
        $package_shippings = [];
        $package_items = $package['contents'];
        $is_first = true;
        foreach ( $package_items as $item ) {
            $allow_shippings = wps_shipping_get_shippings_meta( $item['product_id'] );
            if ( count( $allow_shippings ) == 0 ) {
                $allow_shippings = wps_shipping_get_default_shippings();
            }
            if ( $is_first ) {
                $package_shippings = $allow_shippings;
                $is_first = false;
            } else {
                if ( 'common_only' == $multiCartShipOption ) {
                    $package_shippings = array_intersect( $package_shippings, $allow_shippings );
                } else {
                    $package_shippings = array_merge( $package_shippings, $allow_shippings );
                }
            }
        }
        return $package_shippings;
    }

    /**
     * Get default shippings
     */
    function wps_shipping_get_default_shippings() {
        $default_shippings = [];
        $zones = WC_Shipping_Zones::get_zones();
        $rest_of_world_zone = WC_Shipping_Zones::get_zone( 0 );
        $rest_of_world_zone->set_zone_name( 'Rest of the world' );
        $zones[] = $rest_of_world_zone;
        // Loop through each zone to get the enabled shipping methods
        foreach ( $zones as $zone ) {
            // Use methods to get zone ID and zone name, as $zone is an object
            if ( is_array( $zone ) ) {
                $zone_id = $zone['id'];
                $zone_name = $zone['zone_name'];
                $shipping_methods = $zone['shipping_methods'];
            } elseif ( $zone instanceof WC_Shipping_Zone ) {
                $zone_id = $zone->get_id();
                $zone_name = $zone->get_zone_name();
                $shipping_methods = $zone->get_shipping_methods();
            } else {
                continue;
            }
            // Loop through the shipping methods
            foreach ( $shipping_methods as $method ) {
                // Check if the method is enabled
                if ( $method->enabled === 'yes' ) {
                    $ship_id = wps_get_shipping_method_id( $zone_id, $method );
                    $default_shippings[] = $ship_id;
                }
            }
        }
        return $default_shippings;
    }

    // update new filter as depricated woocommerce_available_shipping_methods
    add_filter( 'woocommerce_shipping_packages', 'wps_shipping_method_disable_country', 99 );
    add_filter( 'softsdev_show_disabled_shippings', function () {
        return true;
    } );
    /**
     *
     */
    function update_user_database() {
        $is_shipping_updated = get_option( 'is_shipping_updated' );
        if ( !$is_shipping_updated ) {
            $args = array(
                'posts_per_page' => -1,
                'post_type'      => 'product',
                'fields'         => 'ids',
            );
            $products = get_posts( $args );
            foreach ( $products as $pro_id ) {
                $itemsShips = wps_shipping_get_shippings_meta( $pro_id );
                if ( empty( $itemsShips ) ) {
                    delete_post_meta( $pro_id, DFM_SGPPFW_SHIPPING_META_KEY );
                }
            }
            update_option( 'is_shipping_updated', true );
        }
    }

    add_action( 'wp_head', 'update_user_database' );
    add_action( 'admin_menu', 'softsdev_product_shippings_submenu_page' );
    function softsdev_product_shippings_submenu_page() {
        add_submenu_page(
            'woocommerce',
            __( 'Product Shippings', 'softsdev' ),
            __( 'Product Shippings', 'softsdev' ),
            'manage_options',
            'softsdev-product-shippings',
            'softsdev_product_shippings_settings'
        );
    }

    function softsdev_product_shippings_enqueue() {
        wp_enqueue_style( 'softsdev_product_shippings_enqueue', plugin_dir_url( __FILE__ ) . '/css/style.css' );
        wp_register_script( 'softsdev_product_shippings_setting_script', plugins_url( '/js/setting.js', __FILE__ ), array('jquery') );
        wp_enqueue_script( 'softsdev_product_shippings_setting_script' );
        $data_to_pass = array(
            'base_url' => get_bloginfo( 'url' ),
        );
        wp_localize_script( 'softsdev_product_shippings_setting_script', 'dd_settings_data', $data_to_pass );
    }

    add_action( 'admin_enqueue_scripts', 'softsdev_product_shippings_enqueue' );
}