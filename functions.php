<?php
function my_theme_enqueue_styles() {

    $parent_style = 'storefront-style'; 

    wp_enqueue_style( $parent_style,  get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
         get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


/**
 * Adds a top bar to Storefront, before the header.
 */
function storefront_add_topbar() {
    global $current_user;
    wp_get_current_user();
    if ( ! empty( $current_user->user_firstname ) ) {
        $user = $current_user->user_firstname;
    } else {
        $user = __( 'guest', 'storefront-child' );
    }
    ?>
    <div id="sd-topbar">
        <label class="text-font">Welcome <?php echo $user ?>!<label>
         <ul id="sd-topbar-ul">
            <li class="sd-topbar-li"><a href="<?php echo get_site_url().'/my-account';?>"><label class="text-font">Signup</label></a></li>
            <li class="sd-topbar-li"><a href="<?php echo get_site_url().'/my-account';?>"><label class="text-font">Login</label></a></li>
        </ul>

     </div>
    <?php
}
add_action( 'storefront_before_header', 'storefront_add_topbar' );
?>

<?php
add_action( 'init', 'custom_remove_footer_credit', 10 );

function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
} 

function custom_storefront_credit() {
	?>
	<div class="site-info">
		 <table>
                <tr><td style="background-color:#303030;height: 20px;">&copy;<?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?></td><td style="background-color:#303030;height: 20px;">Find us on</td></tr>
               <tr><td style="background-color:#303030;height: 20px;">Developed by Shreya Deolankar</td><td style="background-color:#303030;height: 20px;"><a title="Facebook" target="_blank" href="http://www.facebook.com"><i style="font-size:24px;color:white;" class="fa"></i></a>&nbsp<a title="Twitter" target="_blank" href="http://www.twitter.com"><i style="font-size:24px;color:white;" class="fa"></i></a>&nbsp<a title="Instagram" target="_blank" href="http://www.instagram.com"><i style="font-size:24px;color:white;" class="fa"></i></a></td></tr>
               </table>

	</div><!-- .site-info -->
<?php	
}?>