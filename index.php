<?php
/*
版本1.0
功能作用
1、清除dashboard小插件
2、移除页脚程序及版本号
3、remove meta box（移除Meta模块）可以移除文章、页面编辑界面的Meta模块，还可以移除仪表盘的Meta模块。
4、移除不必要head信息
5、禁用更新提示
6、屏蔽后台页脚信息
7、屏蔽左上logo
8、Dashicons和thickbox的清理
9、禁止加载emoji表情
10、移除 WordPress 加载的JS和CSS链接中的版本号
11、移除某些WP自带的小工具，你可以根据自己的实际需要注释掉下面的某行或某些行：
12、加载自定义jQuery库的链接(未启用)
13、禁用Google Open Sans字体。可选修改源为其他，360已经失效，目前没发现可用的
14、取消WordPress评论框下的”HTML 标签和属性
15、禁用embeds功能并移除wp-embed.min.js文件
16、为WordPress后台的文章、分类等显示ID
17、取消自动保存和修订版本
18、WordPress随机显示本地头像
19、集成用户本地上传头像功能
20、编辑器增加按钮 
21、wordpress搜索自定义字段

使用说明：
在主题中引入这个文件并根据需要开关各种功能。

本文件由九刺鱼收集整理，更多请访问：www.jiuciyu.com

*/?>
<?php
//
global $jcy_op;
require_once('optimize.php');
?>
<?php
?>
<?php
//
//编辑器增加按钮   
function enable_more_buttons($buttons) {       
$buttons[] = 'hr';       
$buttons[] = 'fontselect';   
$buttons[] = 'fontsizeselect';    
return $buttons;     
}     
add_filter("mce_buttons_3", "enable_more_buttons"); 
?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//

?>
<?php
//wordpress搜索自定义字段
/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
  global $wpdb;
  if ( is_search() ) {
    $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }
  return $join;
}
add_filter('posts_join', 'cf_search_join' );
/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
  global $pagenow, $wpdb;
  if ( is_search() ) {
    $where = preg_replace(
      "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
  }
  return $where;
}
add_filter( 'posts_where', 'cf_search_where' );
/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
  global $wpdb;
  if ( is_search() ) {
    return "DISTINCT";
  }
  return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );
?>
<?php
//

?>
<?php
//WordPress随机显示本地头像
add_filter( 'get_avatar' , 'local_random_avatar' , 1 , 5 );
function local_random_avatar( $avatar, $id_or_email, $size, $default, $alt) {
    if ( ! empty( $id_or_email->user_id ) ) {
        $avatar = ''.get_template_directory_uri().'/admin/ReduxCore/avatar/admin.jpg';
    }else{
        $random = mt_rand(1, 10);
        $avatar = ''.get_template_directory_uri().'/admin/ReduxCore/avatar/'. $random .'.jpg';
    }
    $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    return $avatar;
}
require_once('avatars.php');
?>
<?php
/* 取消自动保存和修订版本 */
remove_action(‘pre_post_update’, ‘wp_save_post_revision’ );
add_action( ‘wp_print_scripts’, ‘disable_autosave’ );
function disable_autosave() {
wp_deregister_script(‘autosave’);
}

?>
<?php
/**
 * 为WordPress后台的文章、分类等显示ID From wpdaxue.com
 */
// 添加一个新的列 ID
function ssid_column($cols) {
	$cols['ssid'] = 'ID';
	return $cols;
}
 
// 显示 ID
function ssid_value($column_name, $id) {
	if ($column_name == 'ssid')
		echo $id;
}
 
function ssid_return_value($value, $column_name, $id) {
	if ($column_name == 'ssid')
		$value = $id;
	return $value;
}
 
// 为 ID 这列添加css 
function ssid_css() {
?>
<style type="text/css">
	#ssid { width: 50px; } /* Simply Show IDs */
</style>
<?php	
}
 
// 通过动作/过滤器输出各种表格和CSS
function ssid_add() {
	add_action('admin_head', 'ssid_css');
 
	add_filter('manage_posts_columns', 'ssid_column');
	add_action('manage_posts_custom_column', 'ssid_value', 10, 2);
 
	add_filter('manage_pages_columns', 'ssid_column');
	add_action('manage_pages_custom_column', 'ssid_value', 10, 2);
 
	add_filter('manage_media_columns', 'ssid_column');
	add_action('manage_media_custom_column', 'ssid_value', 10, 2);
 
	add_filter('manage_link-manager_columns', 'ssid_column');
	add_action('manage_link_custom_column', 'ssid_value', 10, 2);
 
	add_action('manage_edit-link-categories_columns', 'ssid_column');
	add_filter('manage_link_categories_custom_column', 'ssid_return_value', 10, 3);
 
	foreach ( get_taxonomies() as $taxonomy ) {
		add_action("manage_edit-${taxonomy}_columns", 'ssid_column');			
		add_filter("manage_${taxonomy}_custom_column", 'ssid_return_value', 10, 3);
	}
 
	add_action('manage_users_columns', 'ssid_column');
	add_filter('manage_users_custom_column', 'ssid_return_value', 10, 3);
 
	add_action('manage_edit-comments_columns', 'ssid_column');
	add_action('manage_comments_custom_column', 'ssid_value', 10, 2);
}
 
add_action('admin_init', 'ssid_add');

?>
<?php
//禁用embeds功能并移除wp-embed.min.js文件
function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
 
    // Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
 
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 
    // Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
 
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
 
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
 
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
 
add_action( 'init', 'disable_embeds_init', 9999 );
 
/**
 * Removes the 'wpembed' TinyMCE plugin.
 *
 * @since 1.0.0
 *
 * @param array $plugins List of TinyMCE plugins.
 * @return array The modified list.
 */
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}
 
/**
 * Remove all rewrite rules related to embeds.
 *
 * @since 1.2.0
 *
 * @param array $rules WordPress rewrite rules.
 * @return array Rewrite rules without embeds rules.
 */
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
 
    return $rules;
}
 
/**
 * Remove embeds rewrite rules on plugin activation.
 *
 * @since 1.2.0
 */
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
 
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
 
/**
 * Flush rewrite rules on plugin deactivation.
 *
 * @since 1.2.0
 */
function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
 
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );
?>
<?php
add_filter( 'pre_comment_content', 'wp_specialchars' );//取消WordPress评论框下的”HTML 标签和属性
?>
<?php
/*
/**
 * Plugin Name: WPDX Replace Open Sans
 * Plugin URI:  https://www.wpdaxue.com/dw-replace-open-sans.html
 * Description: Change the load address of Open Sans.
 * Author:      Changmeng Hu
 * Author URI:  https://www.wpdaxue.com/
 * Version:     1.0
 * License:     GPL
function wpdx_replace_open_sans() {
  wp_deregister_style('open-sans');
  wp_register_style( 'open-sans', '//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600' );
  if(is_admin()) wp_enqueue_style( 'open-sans');
}
add_action( 'init', 'wpdx_replace_open_sans' );
*/
?>
<?php  
/**
 * WordPress 后台禁用Google Open Sans字体，加速网站
 function remove_open_sans() {   
    wp_deregister_style( 'open-sans' );   
    wp_register_style( 'open-sans', false );   
    wp_enqueue_style('open-sans','');   
}   
add_action( 'init', 'remove_open_sans' );
 */
// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
     // 前台删除Google字体CSS
    //add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
    // 后台删除Google字体CSS
     add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;
?>
<?php 
/*Using SinaApp jQuery CDN
function cwp_modify_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js', false, '1.9.1');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'cwp_modify_jquery'); 
*/
?>
<?php 
//移除某些WP自带的小工具
/*
function coolwp_remove_meta_widget() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     //unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
    // unregister_widget('WP_Widget_Search');
      // unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
    //register my custom widget
    register_widget('WP_Widget_Meta_Mod');
}
add_action( 'widgets_init', 'coolwp_remove_meta_widget',11 ); 
*/
?>
<?php 
/**
 * 移除 WordPress 加载的JS和CSS链接中的版本号
 * https://www.wpdaxue.com/remove-js-css-version.html
 */
function wpdaxue_remove_cssjs_ver( $src ) {
	if( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'wpdaxue_remove_cssjs_ver', 999 );
add_filter( 'script_loader_src', 'wpdaxue_remove_cssjs_ver', 999 ); 
?>
<?php //禁止加载emoji表情
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
if ( !function_exists( 'disable_embeds_init' ) ) :
function disable_embeds_init(){
global $wp;
$wp->public_query_vars = array_diff($wp->public_query_vars, array('embed'));
remove_action('rest_api_init', 'wp_oembed_register_route');
add_filter('embed_oembed_discover', '__return_false');
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');
add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
}
add_action('init', 'disable_embeds_init', 9999);
endif;  
?>
<?php  
//Dashicons和thickbox的清理 在未登录时，就不会再加载这些文件了，而在登陆之后访问前端，为了顶部管理员工具条能够正常显示，这段代码在登陆之后会自动加载（代码中已作出判断）
add_action( 'wp_print_styles',     'my_deregister_styles', 100 );
function my_deregister_styles()    {
if(!is_user_logged_in()){
wp_deregister_style( 'amethyst-dashicons-style' );
wp_deregister_style( 'dashicons' );
wp_deregister_script('thickbox');}
}
?>
<?php
//屏蔽左上logo
function annointed_admin_bar_remove() {
        global $wp_admin_bar;
        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);  
?>
<?php
 //屏蔽后台页脚信息
 function change_footer_admin () {return '';}
 add_filter('admin_footer_text', 'change_footer_admin', 9999);
 function change_footer_version() {return '';}
 add_filter( 'update_footer', 'change_footer_version', 9999);
?>
<?php
//禁用更新提示
add_filter('pre_site_transient_update_core',    create_function('$a', "return null;")); // 关闭核心提示

add_filter('pre_site_transient_update_plugins', create_function('$a', "return null;")); // 关闭插件提示

add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;")); // 关闭主题提示

remove_action('admin_init', '_maybe_update_core');    // 禁止 WordPress 检查更新

remove_action('admin_init', '_maybe_update_plugins'); // 禁止 WordPress 更新插件

remove_action('admin_init', '_maybe_update_themes');  // 禁止 WordPress 更新主题
?>
<?php
//移除不必要head信息
function cwp_header_clean_up(){
    if (!is_admin()) {
        foreach(array('wp_generator','rsd_link','index_rel_link','start_post_rel_link','wlwmanifest_link') as $clean){remove_action('wp_head',$clean);}
        remove_action( 'wp_head', 'feed_links_extra', 3 );
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
        remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
        remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
        foreach(array('single_post_title','bloginfo','wp_title','category_description','list_cats','comment_author','comment_text','the_title','the_content','the_excerpt') as $where){
         remove_filter ($where, 'wptexturize');
        }
        /*remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );*/
        wp_deregister_script( 'l10n' );
    }
}
/*
remove_action('wp_head', 'wp_generator' ); //去除版本信息
remove_action('wp_head', 'wlwmanifest_link' );
remove_action('wp_head', 'rsd_link' );//清除离线编辑器接口
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//清除前后文信息
remove_action('wp_head', 'feed_links',2 );
remove_action('wp_head', 'feed_links_extra',3 );//清除feed信息
remove_action('wp_head', 'wp_shortlink_wp_head',10,0 );
*/?>
<?php
/*
function cwp_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'cwp_remove_dashboard_widgets',11 );
*/
// 如果需要移除其他模块，可以使用unset($wp_meta_boxes['dashboard']['normal']['core']['需要移除的模块id']);
function example_remove_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
    global $wp_meta_boxes;
 
    // 以下这一行代码将删除 "快速发布" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
 
    // 以下这一行代码将删除 "引入链接" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
 
    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
 
    // 以下这一行代码将删除 "近期评论" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
 
    // 以下这一行代码将删除 "近期草稿" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
 
    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
 
    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
 
    // 以下这一行代码将删除 "概况" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );
/*
增加后台首页模块主要使用wp_add_dashboard_widget函数。该函数的使用方法为：
wp_add_dashboard_widget(
$widget_id,//模块的ID
$widget_name, //显示名称
$callback, //内容回调函数
$control_callback//控制函数回调
)
通过函数的说明，应该可以很清楚的了解这个函数的具体使用方法了，下面给出一个完整的实例演示代码，该示例可以实现后台简单的文本输出模块。代码如下：

// 设置模块的输出内容
function example_dashboard_widget_function() {
    // Display whatever it is you want to show
    echo "演示的内容";
} 
// 增加模块
function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('example_dashboard_widget', '示例模块', 'example_dashboard_widget_function');    
} 
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' ); // 挂载example_dashboard_widge
*/
?>
<?php
/*
WordPress函数：remove meta box（移除Meta模块）
可以移除文章、页面编辑界面的Meta模块，还可以移除仪表盘的Meta模块。

用法

<?php remove_meta_box( $id, $page, $context ); ?>

参数

$id

（字符串）（必需）所要移除的Meta模块的HTML 的 id 属性。部分可用的 id 如下：

‘authordiv’ – 作者模块

‘categorydiv’ – 分类模块

‘commentstatusdiv’ – 评论状态模块

‘commentsdiv’ – 评论模块

‘formatdiv’ – 文章格式模块

‘pageparentdiv’ – 页面属性模块

‘postcustom’ – 自定义字段模块

‘postexcerpt’ – 摘要模块

‘postimagediv’ – 特色图像模块

‘revisionsdiv’ – 版本模块

‘slugdiv’ – 别名模块

‘submitdiv’ – 发布 模块

‘tagsdiv-post_tag’ – 标签模块

‘trackbacksdiv’ – 发送 trackback 模块

…

默认值：无
$page
（字符串）（必需）要从那个编辑界面移除Meta模块，可用值：

‘post’  – 文章编辑界面

‘page’  – 页面编辑界面

‘attachment’  – 附件编辑界面

‘link’ – 链接编辑界面

‘dashboard’ – 仪表盘

或者已注册的自定义文章类型的编辑界面，例如 ‘my-product’

默认值：无
$context
（字符串）（必需）所要删除的Meta模块所在的位置，可选值： ‘normal’, ‘advanced’, or ‘side’.
默认值：无
示例

对非管理员账户，移除文章和链接编辑界面的某些Meta模块：
if (is_admin()) :
function my_remove_meta_boxes() {
 if( !current_user_can('manage_options') ) {
  remove_meta_box('linktargetdiv', 'link', 'normal');
  remove_meta_box('linkxfndiv', 'link', 'normal');
  remove_meta_box('linkadvanceddiv', 'link', 'normal');
  remove_meta_box('postexcerpt', 'post', 'normal');
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  remove_meta_box('postcustom', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal');
  remove_meta_box('commentsdiv', 'post', 'normal');
  remove_meta_box('revisionsdiv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('sqpt-meta-tags', 'post', 'normal');
 }
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );
endif;
在文章编辑界面移除自定义字段模块：
<?php 
function remove_post_custom_fields() {
	remove_meta_box( 'postcustom' , 'post' , 'normal' ); 
}
add_action( 'admin_menu' , 'remove_post_custom_fields' );
?>
在文章编辑界面移除摘要模块：
<?php 
function remove_page_excerpt_field() {
	remove_meta_box( 'postexcerpt' , 'page' , 'normal' ); 
}
add_action( 'admin_menu' , 'remove_page_excerpt_field' );
?>
在页面编辑界面移除作者、评论状态和评论模块：
<?php 
function remove_page_fields() {
 remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); //removes comments status
 remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); //removes comments
 remove_meta_box( 'authordiv' , 'page' , 'normal' ); //removes author 
}
add_action( 'admin_menu' , 'remove_page_fields' );
?>
如果你想从自定义文章类型中移除某个Meta模块，可以参考下面的例子：
function remove_custom_taxonomy()
{
	remove_meta_box($custom_taxonomy_slug.'div', $custom_post_type, 'side' );
 
        // $custom_taxonomy_slug 是自定义Meta模块的别名, 例如 'genre' )
        // $custom_post_type 是自定义文章类型的别名,例如 'movies' )
}
add_action( 'admin_menu', 'remove_custom_taxonomy' );
如果有必要，你甚至可以去除“发布”模块：
function remove_publish_box()
{
	remove_meta_box( 'submitdiv', 'custom_post_id', 'side' );
}
add_action( 'admin_menu', 'remove_publish_box' );
从仪表盘中移除Meta模块，可以使用下面的代码：
function remove_dashboard_widgets(){
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // 概况
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // 近期评论
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // 链入链接
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // 插件
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // 快速发布
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // 近期草稿
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // 其它 WordPress 新闻
// 使用 'dashboard-network' 作为第二个参数，可以从多站点网络的仪表盘移除Meta模块
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

源文件

remove_meta_box() 位于 wp-admin/includes/template.php
*/
?>		
<?php
// Due to a limitations of variables and functions, you must globally define
// variables inside functions.
// global $jcyop ;  // This is your opt_name.
// print_r ($jcyop);
?>