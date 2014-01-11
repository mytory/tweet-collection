<?php
/**
 * Tweet Collection Feed Template based on WP RSS2 Feed Template.
 * This feed has link be in tweet content. So feed subscriber can go recommended link in tweet at once.
 */
include "../../../wp-blog-header.php";

status_header( 200 );

$args = array(
    'post_type' => 'tweet',
    'posts_per_page' => 20,
);
$wp_query = new WP_Query($args);

header('Content-Type: text/xml; charset=UTF-8');
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    <?php do_action('rss2_ns'); ?>
>

<channel>
    <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
    <atom:link href="<?php echo home_url('?post_type=tweet&amp;rss=for-fb')?>" rel="self" type="application/rss+xml" />
    <link><?php bloginfo_rss('url') ?></link>
    <description><?php bloginfo_rss("description") ?></description>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <language><?php bloginfo_rss( 'language' ); ?></language>
    <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
    <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
    <?php do_action('rss2_head'); ?>
    <?php while( have_posts()) : the_post(); ?>
    <item>
        <title><?php the_title_rss() ?></title>
        <?php
        preg_match('/href=["|\']([^ ]+)["|\']/', get_the_content(), $match);
        $is_there_url = count($match);
        if($is_there_url){
            $url = $match[1];
        }else{
            $url = get_permalink();
        }
        ?>
        <link><?php echo esc_url($url) ?></link>
        <comments><?php comments_link_feed(); ?></comments>
        <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
        <dc:creator><?php the_author() ?></dc:creator>
        <?php the_category_rss('rss2') ?>

        <guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if (get_option('rss_use_excerpt')) : ?>
        <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
<?php else : ?>
        <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
    <?php $content = get_the_content_feed('rss2'); ?>
    <?php if ( strlen( $content ) > 0 ) : ?>
        <content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
    <?php else : ?>
        <content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
    <?php endif; ?>
<?php endif; ?>
        <wfw:commentRss><?php echo esc_url( get_post_comments_feed_link(null, 'rss2') ); ?></wfw:commentRss>
        <slash:comments><?php echo get_comments_number(); ?></slash:comments>
<?php rss_enclosure(); ?>
    <?php do_action('rss2_item'); ?>
    </item>
    <?php endwhile; ?>
</channel>
</rss>
