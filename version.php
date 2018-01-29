<?php
 remove_action('wp_head', 'wp_generator');  //WordPress�汾��
 // ͬʱɾ��head��feed�е�WP�汾��
function ludou_remove_wp_version() {
  return '';
}
add_filter('the_generator', 'ludou_remove_wp_version');
// ����js/css���ӵ�WP�汾��
function ludou_remove_wp_version_strings( $src ) {
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
    // ��WP�汾�� + 12.8�����js/css���ӵİ汾��
    // ��������WordPress�汾�ţ�Ҳ����Ӱ�컺��
    // ���������� 12.8 �滻���������֣����ⱻ���˲³�
    $src = str_replace($wp_version, $wp_version + 12.8, $src);
  }
  return $src;
}
add_filter( 'script_loader_src', 'ludou_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'ludou_remove_wp_version_strings' );
add_filter('admin_footer_text', 'left_admin_footer_text');
function left_admin_footer_text($text) {
// �����Ϣ�ĳ��Լ���վ��
$text = '��л����XXXX';
return $text;
}
add_filter('update_footer', 'right_admin_footer_text', 11);
function right_admin_footer_text($text) {
// �����ұ߰汾��Ϣ
}
 
  ?>