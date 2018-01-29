﻿<?php
add_filter( 'get_avatar' , 'local_random_avatar' , 1 , 5 );
function local_random_avatar( $avatar, $id_or_email, $size, $default, $alt) {
    if ( ! empty( $id_or_email->user_id ) ) {
        $avatar = ''.get_template_directory_uri().'/rudex/avatar/admin.jpg';
    }else{
        $random = mt_rand(1, 10);
        $avatar = ''.get_template_directory_uri().'/rudex/avatar/'. $random .'.jpg';
    }
    $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    return $avatar;
}?>
<?php
function remove_open_sans_from_wp_core() {
wp_deregister_style( ‘open-sans’ );
wp_register_style( ‘open-sans’, false );
wp_enqueue_style(‘open-sans’,”);
}
add_action( ‘init’, ‘remove_open_sans_from_wp_core’ );
?>
<?php
function remove_dns_prefetch( $hints, $relation_type ) {
if ( 'dns-prefetch' === $relation_type ) {
return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

// Remove emoji script
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );
?>
<?php
/**
 * Disable the emoji's
 */
 function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 }
 add_action( 'init', 'disable_emojis' );
/**
 * Filter function used to remove the tinymce emoji plugin.
 */
 function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
 }
 ?>