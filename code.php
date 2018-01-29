<?php
/*
版本1.0
调用大全


使用说明：
在主题制作中参考这个文件并根据需要修改相关参数。

*/?>
<?php bloginfo(’name’); ?> 网站标题
<?php wp_title(); ?> 日志或页面标题
<?php bloginfo(’stylesheet_url’); ?> WordPress主题样式表文件style.css的相对地址
<?php bloginfo(’pingback_url’); ?> WordPress博客的Pingback地址
<?php bloginfo(’template_url’); ?> WordPress主题文件的相对地址
<?php bloginfo(’version’); ?> 博客的WordPress版本
<?php bloginfo(’atom_url’); ?> WordPress博客的Atom地址
<?php bloginfo(’rss2_url’); ?> WordPress博客的RSS2地址
<?php bloginfo(’url’); ?> WordPress博客的绝对地址
<?php bloginfo(’name’); ?> WordPress博客的名称
<?php bloginfo(’html_type’); ?> 网站的HTML版本
<?php bloginfo(’charset’); ?> 网站的字符编码格式

<?php language_attributes(); ?>   ”lang=’zh-CN’”
<?php bloginfo(‘html_type’); ?>   text/html
<?php bloginfo(‘charset’); ?>  UTF-8
<?php bloginfo(‘name’); ?>
<?php bloginfo(‘description’); ?>
<?php bloginfo(‘version’); ?>” />
<?php bloginfo(‘stylesheet_url’); ?>
<?php bloginfo(‘rss2_url’); ?>
<?php bloginfo(‘pingback_url’); ?>
<?php bloginfo(‘stylesheet_directory’); ?>  引用背景图片
<?php bloginfo(‘comments_rss2_url’); ?>  生成评论RSS

<?php the_content(); ?> 日志内容
<?php if(have_posts()) : ?> 确认是否有日志
<?php while(have_posts()) : the_post(); ?> 如果有，则显示全部日志
<?php endwhile; ?> 结束PHP函数”while”
<?php endif; ?> 结束PHP函数”if”
<?php get_header(); ?> header.php文件的内容
<?php get_sidebar(); ?> sidebar.php文件的内容
<?php get_footer(); ?> footer.php文件的内容
<?php the_time(’m-d-y’) ?> 显示格式为”02-19-08″的日期
<?php comments_popup_link(); ?> 显示一篇日志的留言链接
<?php the_title(); ?> 显示一篇日志或页面的标题
<?php the_permalink() ?> 显示一篇日志或页面的永久链接/URL地址
<?php the_category(’, ‘) ?> 显示一篇日志或页面的所属分类
<?php the_author(); ?> 显示一篇日志或页面的作者
<?php the_ID(); ?> 显示一篇日志或页面的ID
<?php edit_post_link(); ?> 显示一篇日志或页面的编辑链接
<?php get_links_list(); ?> 显示Blogroll中的链接
<?php comments_template(); ?> comments.php文件的内容
<?php wp_list_pages(); ?> 显示一份博客的页面列表
<?php wp_list_cats(); ?> 显示一份博客的分类列表
<?php next_post_link(’ %link ‘) ?> 下一篇日志的URL地址
<?php previous_post_link(’%link’) ?> 上一篇日志的URL地址
<?php get_calendar(); ?> 调用日历
<?php wp_get_archives() ?> 显示一份博客的日期存档列表
<?php posts_nav_link(); ?> 显示较新日志链接(上一页)和较旧日志链接（下一页）
<?php bloginfo(’description’); ?> 显示博客的描述信息

/%postname%/ 显示博客的自定义永久链接
<?php the_search_query(); ?> 搜索表单的值
<?php _e(’Message’); ?> 打印输出信息
<?php wp_register(); ?> 显示注册链接
<?php wp_loginout(); ?> 显示登入/登出链接
<!–next page–> 在日志或页面中插入分页
<!–more–> 截断日志
<?php wp_meta(); ?> 显示管理员的相关控制信息
<?php timer_stop(1); ?> 显示载入页面的时间
<?php echo get_num_queries(); ?> 显示载入页面查询

<?php get_archives(‘postbypost’, 10); ?> (显示10篇最新更新文章)

<?php wp_get_archives(‘type=postbypost&limit=20& format=custom’); ?> 显示你博客中最新的20篇文章，其中format=custom这里主要用来自定义这份文章列表的显示样式。具体的参数和使用方法你可 以参考官方的使用说明- wp_get_archvies。(fromat=custom也可以不要，默认以UL列表显示文章标题。)

<?php
$rand_posts = get_posts(‘numberposts=10&orderby=rand’);
foreach( $rand_posts as $post ) :
?>
<!–下面是你想自定义的Loop–>
<li><a href=”<?php the_permalink(); ?>”><?php the_title(); ?></a></li>
<?php endforeach; ?>


<?php //在文章页显示相关文章

$tags = wp_get_post_tags($post->ID);

if ($tags) {

$first_tag = $tags[0]->term_id;

$args=array(

‘tag__in’ => array($first_tag),

‘post__not_in’ => array($post->ID),

‘showposts’=>10,

‘ignore_sticky_posts’=>1

);

$my_query = new WP_Query($args);

if( $my_query->have_posts() ) {

while ($my_query->have_posts()) : $my_query->the_post(); ?>

<li><a href=”<?php the_permalink() ?>” rel=”bookmark” title=”<?php the_title_attribute(); ?>”><?php the_title();?> <?php comments_number(‘ ‘,’(1)’,'(%)’); ?> </a></li>

<?php

endwhile;

}

}

wp_reset_query();

?>

wordpress调用指定分类的文章

<?php $posts = get_posts( “category=4&numberposts=10″ ); ?>
<?php if( $posts ) : ?>
<ul><?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
<li>
<a href=”<?php the_permalink() ?>” rel=”bookmark” title=”<?php the_title(); ?>”><?php the_title(); ?></a>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>




1、日志总数：

<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>
1
2、草稿数目：

<?php $count_posts = wp_count_posts(); echo $draft_posts = $count_posts->draft; ?>
1
3、评论总数：

<?php echo $wpdb->get_var(“SELECT COUNT(*) FROM $wpdb->comments”);?>
1
4、成立时间：

<?php echo floor((time()-strtotime(“2008-8-18″))/86400); ?>
1
5、标签总数：

<?php echo $count_tags = wp_count_terms(‘post_tag’); ?>
1
6、页面总数：

<?php $count_pages = wp_count_posts(‘page’); echo $page_posts = $count_pages->publish; ?>
1
7、分类总数：

<?php echo $count_categories = wp_count_terms(‘category’); ?>
1
8、链接总数：

<?php $link = $wpdb->get_var(“SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = ‘Y’”); echo $link; ?>
1
9、用户总数：

<?php $users = $wpdb->get_var(“SELECT COUNT(ID) FROM $wpdb->users”); echo $users; ?>
1
10、最后更新：

<?php $last = $wpdb->get_results(“SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = ‘post’ OR post_type = ‘page’) AND (post_status = ‘publish’ OR post_status = ‘private’)”);$last = date(‘Y-n-j’, strtotime($last[0]->MAX_m));echo $last; ?>
1
9.wordpress判断语句

is_single()
1
判断是否是具体文章的页面

is_single(’2′)
1
判断是否是具体文章（id=2）的页面

is_single(’Beef Stew’)
1
判断是否是具体文章（标题判断）的页面

is_single(’beef-stew’)
1
判断是否是具体文章（slug判断）的页面

comments_open()
1
是否留言开启

pings_open()
1
是否开启ping

is_page()
1
是否是页面

is_page(’42′)
1
id判断，即是否是id为42的页面

is_page(’About Me’)
1
判断标题

is_page(’about-me’)
1
slug判断

is_category()
1
是否是分类

is_category(’6′)
1
id判断，即是否是id为6的分类

is_category(’Cheeses’)
1
分类title判断

is_category(’cheeses’)
1
分类 slug判断

in_category(’5′)
1
判断当前的文章是否属于分类5

is_author()
1
将所有的作者的页面显示出来

is_author(’1337′)
1
显示author number为1337的页面

is_author(’Elite Hacker’)
1
通过昵称来显示当前作者的页面

is_author(’elite-hacker’)
1
下面是通过不同的判断实现以年、月、日、时间等方式来显示归档

is_date()

is_year()

is_month()

is_day()

is_time()

判断当前是否是归档页面

is_archive()
1
判断是否是搜索

is_search()
1
判断页面是否404

is_404()
1
判断是否翻页，比如你当前的blog是http://domain.com 显示http://domain.com?paged=2的时候，这个判断将返 回真，通过这个函数可以配合is_home来控制某些只能在首页显示的界面，

例如：

<?php if(is_single()):?>

//这里写你想显示的内容，包括函数

<?php endif;?>
1
2
3
4
5
或者：

<?php if(is_home() && !is_paged() ):?>

//这里写你想显示的内容，包括函数

<?php endif;?>
1
2
3
4
5
10.wordpress 非插件调用评论表情

<!–smilies–>
<?php

function wp_smilies() {

global $wpsmiliestrans;

if ( !get_option(‘use_smilies’) or (empty($wpsmiliestrans))) return;

$smilies = array_unique($wpsmiliestrans);

$link=”;

foreach ($smilies as $key => $smile) {

$file = get_bloginfo(‘wpurl’).’/wp-includes/images/smilies/’.$smile;

$value = ” “.$key.” “;

$img = “<img src=\”{$file}\” alt=\”{$smile}\” />”;

$imglink = htmlspecialchars($img);

$link .= “<a href=\”#commentform\” title=\”{$smile}\” onclick=\”document.getElementById(‘comment’).value += ‘{$value}’\”>{$img}</a>&nbsp;”;

}

echo ‘<div>’.$link.’</div>’;

}

?>

<?php wp_smilies();?>

<!–smilies—>
将以上代码复制到 comments.php 中合适的位置：