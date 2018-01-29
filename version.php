<?php
 remove_action('wp_head', 'wp_generator');  //WordPress版本号
 // 同时删除head和feed中的WP版本号
function ludou_remove_wp_version() {
  return '';
}
add_filter('the_generator', 'ludou_remove_wp_version');
// 隐藏js/css附加的WP版本号
function ludou_remove_wp_version_strings( $src ) {
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
    // 用WP版本号 + 12.8来替代js/css附加的版本号
    // 既隐藏了WordPress版本号，也不会影响缓存
    // 建议把下面的 12.8 替换成其他数字，以免被别人猜出
    $src = str_replace($wp_version, $wp_version + 12.8, $src);
  }
  return $src;
}
add_filter( 'script_loader_src', 'ludou_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'ludou_remove_wp_version_strings' );
add_filter('admin_footer_text', 'left_admin_footer_text');
function left_admin_footer_text($text) {
// 左边信息改成自己的站点
$text = '感谢访问XXXX';
return $text;
}
add_filter('update_footer', 'right_admin_footer_text', 11);
function right_admin_footer_text($text) {
// 隐藏右边版本信息
}
 
  ?>