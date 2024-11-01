<?php
/**
 * QUICK Edit
 */
add_action('woocommerce_product_quick_edit_end', 'dreamfox_sd_quick_edit_shipping');

function dreamfox_sd_quick_edit_shipping() {
    echo '<br><br><h2>Choose shipping gateway</h2>';
    wps_shipping_form();
}

/**
 * BULK Edit
 */
add_action('woocommerce_product_bulk_edit_end', 'dreamfox_sd_bulk_edit_shipping', 10, 2);
function dreamfox_sd_bulk_edit_shipping() {
    dreamfox_sd_quick_edit_shipping();
}

/**
 * BULK AND QUICK EDIT
 */
add_action('woocommerce_product_quick_edit_save', 'dreamfox_sd_save_quick_edit_shipping', 10, 1);
add_action('woocommerce_product_bulk_edit_save', 'dreamfox_sd_save_quick_edit_shipping', 10, 1);
function dreamfox_sd_save_quick_edit_shipping($product) {
    if (isset($_REQUEST['ship'])) {
        $product_id = $product->id;
        /**
         * product id saving
         */
        $productIds = get_option('woocommerce_product_apply_ship', array());
        if (is_array($productIds) && !in_array($product_id, $productIds)) {
            $productIds[] = $product_id;
            update_option('woocommerce_product_apply_ship', $productIds);
        }
        /**
         * Shipping save
         */
        $shippings = array();
        if ($_REQUEST['ship']) {
            foreach ($_REQUEST['ship'] as $ship)
                $shippings[] = $ship;
        }
        if (count($shippings))
            update_post_meta($product_id, DFM_SGPPFW_SHIPPING_META_KEY, $shippings);
    }
}
    
add_action("wp_ajax_wpsf_quick_edit", "wpsf_quick_edit");
add_action("wp_ajax_nopriv_wpsf_quick_edit", "wpsf_quick_edit");

function wpsf_quick_edit() {

    $post_id = $_POST['post_id'];
    echo json_encode(wps_shipping_get_shippings_meta($post_id));
    die();
}

/**
 * Quick edit
 */
 add_action('admin_head-edit.php', 'wpsf_quickedit_get');

  function wpsf_quickedit_get() { 
    $html = '<script type="text/javascript">';
    $html .= 'jQuery(document).ready(function() {';
        $html .= 'jQuery("button.editinline").live("click", function() {';

        $html .= 'var id = inlineEditPost.getId(this);';
        $html .= 'jQuery.post(ajaxurl,{action: "wpsf_quick_edit",  post_id: id, mode: "inline" },';
        $html .= 'function(data){   jQuery.each(data, function(item, value){ jQuery("#edit-"+id+" .quick_shipping input[value="+value+"]").prop("checked", true)}) }';

    $html .= ', "json");});});';
    $html .= '</script>';
    echo $html;
}