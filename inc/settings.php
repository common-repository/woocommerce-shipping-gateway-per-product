<?php

function softsdev_product_shippings_settings() {
    wp_register_script( 'dd_horztab_script', plugins_url( '/js/dd_horizontal_tabs.js', DFM_SGPPFW__FILE__ ) );
    wp_enqueue_script( 'dd_horztab_script' );
    add_filter( 'admin_footer_text', 'softsdev_product_shippings_footer_text' );
    add_filter( 'update_footer', 'softsdev_product_shippings_update_footer' );
    $setting_url = get_bloginfo( 'url' ) . '/wp-admin/admin.php?page=softsdev-product-shippings';
    $softsdev_wps_plugin_settings = get_option( 'sdwps_plugin_settings', array(
        'default_option_mp' => 'expensive',
    ) );
    $default_option_mp = $softsdev_wps_plugin_settings['default_option_mp'];
    ?>
    <div class="wrap wrap-mc-paid fs-section dd-wc-product-shippings"><div id="icon-tools" class="icon32"></div>
    <h2 class="nav-tab-wrapper" id="settings">
        <a href="<?php 
    echo $setting_url;
    ?>" class="nav-tab fs-tab nav-tab-active home">Settings</a>
    </h2>
    <h2 class="title"><?php 
    echo __( 'Woocommerce Product Shippings', 'softsdev' );
    ?></h2></div>
    <div class="left-dd-paid ">
        <div class="left_box_container">
            <ul class="horz_tabs">
                <li <?php 
    if ( !isset( $_GET['tab'] ) ) {
        ?> class="active" <?php 
    }
    ?> id="information">
                    <a href="javascript:;">Information</a>
                </li>
                <li id="settings" <?php 
    if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'settings' ) {
        ?>class="active" <?php 
    }
    ?>>
                    <a href="javascript:;">Settings</a>
                </li>
                <li id="newsletter" <?php 
    if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'newsletter' ) {
        ?>class="active" <?php 
    }
    ?>>
                    <a href="javascript:;">Newsletter</a>
                </li>
                <li id="faq">
                    <a href="javascript:;">FAQ</a>
                </li>
                <li id="support" <?php 
    if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'support' ) {
        ?>class="active" <?php 
    }
    ?>>
                    <a href="<?php 
    echo admin_url( 'admin.php?page=softsdev-product-shippings-contact' );
    ?>">Support</a>
                </li>
                <li id="dfmplugins">
                    <a href="javascript:;">DFM Plugins</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-dd-paid ">
        <div id="tab_information" class="postbox <?php 
    if ( !isset( $_GET['tab'] ) ) {
        ?>active<?php 
    }
    ?>" style="padding: 10px; margin: 10px 0px;">
            <?php 
    add_filter( 'admin_footer_text', 'softsdev_product_shippings_footer_text' );
    add_filter( 'update_footer', 'softsdev_product_shippings_update_footer' );
    echo '<div class="wrap wrap-mc-paid"><div id="icon-tools" class="icon32"></div>';
    echo '<h2 class="title">' . __( 'Woocommerce Product Shippings - Information', 'softsdev' ) . '</h2></div>';
    ?>
            <p>This plugin for woocommerce lets you select the available shipping gateways for each individual product.
                You can select for eacht individual product the shipping gateway that will be used by checkout.
                If no selection is made, then the default shipping gateways are displayed.
                If you for example only select local delivery then only local delivery will available for that product by checking out.</p>
            <p>This plugin allows you to improve your customer service by giving the best shipping service for your customers.</p>
            <img src="<?php 
    echo plugins_url( 'img/attention.png', DFM_SGPPFW__FILE__ );
    ?>"><br>
            IMPORTANT: We are using a new license system. If you have trouble with your license then see this link:<br>
            <a href="https://support.dreamfoxmedia.com/kb/article/5/transferring-our-licenses-from-dreamfoxmedia-to-freemius" target="_blank">Click here to see the complete article</a>

        </div>

        <div id="tab_settings" class="postbox <?php 
    if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'settings' ) {
        ?>active<?php 
    }
    ?>" style="padding: 10px; margin: 10px 0px;">
            <?php 
    add_filter( 'admin_footer_text', 'softsdev_product_shippings_footer_text' );
    add_filter( 'update_footer', 'softsdev_product_shippings_update_footer' );
    echo '<div class="wrap wrap-mc-paid"><div id="icon-tools" class="icon32"></div>';
    echo '<h2 class="title">' . __( 'Woocommerce Product Shippings - Settings', 'softsdev' ) . '</h2></div>';
    ?>
            <div id="freeversion">
                <div id="woo_sdwps">
                    <div>
                        <h3 class="hndle"><?php 
    echo __( 'Multiple products in cart with different shipping gateway', 'softsdev' );
    ?></h3>
                        <select id="sdwps_default_payment" name="sdwps_setting[default_option_mp]" disabled="disabled">
                            <option value="none" <?php 
    selected( $default_option_mp, 'none' );
    ?>>Do not show shipping gateway</option>
                            <option value="cheapest" <?php 
    selected( $default_option_mp, 'cheapest' );
    ?>>Choose the cheapest gateway</option>
                            <option value="expensive" <?php 
    selected( $default_option_mp, 'expensive' );
    ?>>Choose the expensive gateway</option>
                            <option value="let_customer_decide" <?php 
    selected( $default_option_mp, 'let_customer_decide' );
    ?>>Let customer decide</option>
                            <option value="common_only" <?php 
    selected( $default_option_mp, 'common_only' );
    ?>>Only common gateways</option>
                        </select>
                        <br />
                        <br />
                        <small><?php 
    echo __( 'In case of multiple products from diffrent shipping', 'softsdev' );
    ?></small>
                    </div>
                    <br />
                    <input class="button-large button-primary" type="submit" value="Save changes" disabled="disabled" />

                    <div style="color: red;margin-top: 30px;">This is a Premium feature.</div>
                </div>
            </div>

            <?php 
    ?>
        </div>
        <div id="tab_newsletter" class="postbox" style="padding: 10px; margin: 10px 0px;">
            <?php 
    add_filter( 'admin_footer_text', 'softsdev_product_shippings_footer_text' );
    add_filter( 'update_footer', 'softsdev_product_shippings_update_footer' );
    echo '<div class="wrap wrap-mc-paid"><div id="icon-tools" class="icon32"></div>';
    echo '<h2 class="title">' . __( 'Woocommerce Product Shippings - Newsletter', 'softsdev' ) . '</h2></div>';
    ?>
            <!-- Begin SendInBlue Form -->
            <iframe width="540" height="505" src="https://322fdba5.sibforms.com/serve/MUIEAFes3bCeqXwMM73xl9lmUpZWzxWQzKtb6q7UAmyNuOkeNZXOSXgXqzs-pZVxVfFj-u6BapzchhtobGU0BRe75Z4OdQAha2ig6ontnxzfNd4sewU5EZZFzBwDgYeAMLvQhCbACfNIkkX7h7VvnPlE2i8KmM0b_XAO6JL01j9SBk1ft5Qn7vyVVzjMvMJG135pRnZ0URuEd_pY" frameborder="0" scrolling="auto" allowfullscreen style="display: block;margin-left: auto;margin-right: auto;max-width: 100%;"></iframe>
            <!--  END -->
        </div>
        <div id="tab_faq" class="postbox" style="padding: 10px; margin: 10px 0px;">
            <?php 
    add_filter( 'admin_footer_text', 'softsdev_product_shippings_footer_text' );
    add_filter( 'update_footer', 'softsdev_product_shippings_update_footer' );
    echo '<div class="wrap wrap-mc-paid"><div id="icon-tools" class="icon32"></div>';
    echo '<h2 class="title">' . __( 'Woocommerce Product Shippings - FAQ', 'softsdev' ) . '</h2></div>';
    ?>
            <div>
                <!-- Begin freshdeskForm -->
                If you want to read the FAQ about this plugin then click on below link. We will take you right there in a breeze.<br>
                You can also click on the help button in the bottom right corner to see the most ask questions.
                <script>
                    window.fwSettings = {
                        'widget_id': 72000002383
                    };
                    ! function() {
                        if ("function" != typeof window.FreshworksWidget) {
                            var n = function() {
                                n.q.push(arguments)
                            };
                            n.q = [], window.FreshworksWidget = n
                        }
                    }()
                </script>
                <script type='text/javascript' src='https://widget.freshworks.com/widgets/72000002383.js' async defer></script>
                <a href="https://support.dreamfoxmedia.com/kb/section/8" target="_blank">Click here to see the Shipping Plugin FAQ</a>

                <p><?php 
    echo sprintf( __( 'If your answer can not be found in the resources listed above, please use our supportsystem <a href="%s">here</a>.' ), 'https://support.dreamfoxmedia.com' );
    ?></p>
                <p>Found a bug? Please open an issue <a href="https://support.dreamfoxmedia.com/support/tickets/create" target="_blank">here.</a></p>
                <!--  END - We recommend to place the above code in head tag of your website html -->
            </div>
        </div>

        <div id="tab_dfmplugins" class="postbox" style="padding: 10px; margin: 10px 0px;">
            <?php 
    add_filter( 'admin_footer_text', 'softsdev_product_shippings_footer_text' );
    add_filter( 'update_footer', 'softsdev_product_shippings_update_footer' );
    echo '<div class="wrap wrap-mc-paid"><div id="icon-tools" class="icon32"></div>';
    echo '<h2 class="title">' . __( 'Woocommerce Product Shippings - Dreamfox Media Plugins', 'softsdev' ) . '</h2></div>';
    ?>
            <?php 
    $url = 'https://raw.githubusercontent.com/dreamfoxmedia/dreamfoxmedia/gh-pages/plugins/dfmplugins.json';
    $response = wp_remote_get( $url, array() );
    $response_code = wp_remote_retrieve_response_code( $response );
    $response_body = wp_remote_retrieve_body( $response );
    if ( $response_code != 200 || is_wp_error( $response ) ) {
        echo '<div class="error below-h2"><p>There was an error retrieving the list from the server.</p></div>';
        switch ( $response_code ) {
            case '403':
                echo '<div class="error below-h2"><p>Seems your host is blocking <strong>' . dirname( $url ) . '</strong>. Please request to white list this domain </p></div>';
                break;
        }
        wp_die();
    }
    $addons = json_decode( $response_body );
    ?>
            <div class="wrap">
                <h3>Here you see our great Free and Premium Plugins of Dreamfox Media</h3>
                <link href="<?php 
    echo plugins_url( '/css/addons-style.min.css', DFM_SGPPFW__FILE__ );
    ?>" rel="stylesheet" type="text/css">
                <ul class="addons-wrap">
                    <?php 
    foreach ( $addons as $addon ) {
        if ( !empty( $addon->hidden ) ) {
            continue;
        }
        $addon->link = ( isset( $addon->link ) ? add_query_arg( array(
            'utm_source'   => 'Dreamfox Media Plugin Page',
            'utm_medium'   => 'link',
            'utm_campaign' => 'Dreamfox Plugins Add Ons',
        ), $addon->link ) : '' );
        ?>
                        <li class="mymail-addon <?php 
        if ( !empty( $addon->is_free ) ) {
            echo ' is-free';
        }
        if ( !empty( $addon->is_feature ) ) {
            echo ' is-feature';
        }
        if ( isset( $addon->image ) ) {
            $image = str_replace( 'http//', '//', $addon->image );
        } elseif ( isset( $addon->image_ ) ) {
            $image = str_replace( 'http//', '//', $addon->image_ );
        }
        ?>">
                            <div class="bgimage" style="min-height: 500px; background-repeat: no-repeat; background-image:url(<?php 
        echo $image;
        ?>)">
                                <?php 
        if ( isset( $addon->wpslug ) ) {
            ?>
                                    <a href="plugin-install.php?tab=plugin-information&plugin=<?php 
            echo dirname( $addon->wpslug );
            ?>&from=import&TB_iframe=true&width=745&height=745" class="thickbox">&nbsp;</a>
                                <?php 
        } else {
            ?>
                                    <a href="<?php 
            echo $addon->link;
            ?>">&nbsp;</a>
                                <?php 
        }
        ?>
                            </div>
                            <h4><?php 
        echo $addon->name;
        ?></h4>
                            <p class="author">by
                                <?php 
        if ( $addon->author_url ) {
            echo '<a href="' . $addon->author_url . '">' . $addon->author . '</a>';
        } else {
            echo $addon->author;
        }
        ?>
                            </p>
                            <p class="description"><?php 
        echo $addon->description;
        ?></p>
                            <div class="action-links">
                                <?php 
        if ( !empty( $addon->wpslug ) ) {
            ?>
                                    <?php 
            if ( is_dir( dirname( WP_PLUGIN_DIR . '/' . $addon->wpslug ) ) ) {
                ?>
                                        <?php 
                if ( is_plugin_active( $addon->wpslug ) ) {
                    ?>
                                            <a class="button" href="<?php 
                    echo wp_nonce_url( 'plugins.php?action=deactivate&amp;plugin=' . $addon->wpslug, 'deactivate-plugin_' . $addon->wpslug );
                    ?>"><?php 
                    _e( 'Deactivate', 'mymail' );
                    ?></a>
                                        <?php 
                } elseif ( is_plugin_inactive( $addon->wpslug ) ) {
                    ?>
                                            <a class="button" href="<?php 
                    echo wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $addon->wpslug, 'activate-plugin_' . $addon->wpslug );
                    ?>"><?php 
                    _e( 'Activate', 'mymail' );
                    ?></a>
                                        <?php 
                }
                ?>
                                    <?php 
            } else {
                ?>
                                        <?php 
                if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
                    ?>
                                            <a class="button button-primary" href="<?php 
                    echo wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . dirname( $addon->wpslug ) . '&mymail-addon' ), 'install-plugin_' . dirname( $addon->wpslug ) );
                    ?>"><?php 
                    _e( 'Install', 'mymail' );
                    ?></a>
                                        <?php 
                }
                ?>
                                    <?php 
            }
            ?>
                                <?php 
        } else {
            ?>
                                    <a class="button button-primary" href="<?php 
            echo $addon->link;
            ?>"><?php 
            _e( 'Purchase', 'mymail' );
            ?></a>
                                <?php 
        }
        ?>
                            </div>
                        </li>
                    <?php 
    }
    ?>
                </ul>
            </div>
        </div>
    </div>
<?php 
}
