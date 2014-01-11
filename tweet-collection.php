<?php
/*
Plugin Name: Tweet collection
Description: This plugin collect tweets. tweets` post_type is ‘tweet’, when you save tweets general post and tweet do not mixed.
Author: Ahn, Hyoung-woo
Author URI: http://mytory.co.kr
Version: 1.1.5
*/

function tc_get_option_names () {
    return array (
        'tweet-collection-twitter-username',
        'tweet-collection-title-length',
        'tweet-collection-number-tweets',
        'tweet-collection-consumer-key',
        'tweet-collection-consumer-secret',
        'tweet-collection-access-token',
        'tweet-collection-access-token-secret',
    );
}

/**
 * from option name to variable name
 * @return [type] [description]
 */
function tc_convert_varname($opt_name){
	$varname = str_replace('tweet-collection-', '', $opt_name);
	$varname = str_replace('-', '_', $varname);
	return $varname;
}

//언어 파일 등록
function tweet_collection_init () {
    load_plugin_textdomain('tweet-collection', FALSE, dirname(plugin_basename(__FILE__)) . '/languages');
}

add_action('plugins_loaded', 'tweet_collection_init');

//커스텀 포스트 타입 등록
function tc_register_custom_post_type () {
    $labels = array (
        'name' => _x('Tweets', 'post type general name', 'tweet-collection'),
        'singular_name' => _x('Tweet', 'post type singular name', 'tweet-collection'),
        'add_new' => _x('Add New', 'tweet', 'tweet-collection'),
        'add_new_item' => __('Add New Tweet', 'tweet-collection'),
        'edit_item' => __('Edit Tweet', 'tweet-collection'),
        'new_item' => __('New Tweet', 'tweet-collection'),
        'all_items' => __('All Tweets', 'tweet-collection'),
        'view_item' => __('View Tweet', 'tweet-collection'),
        'search_items' => __('Search Tweets', 'tweet-collection'),
        'not_found' => __('No tweets found', 'tweet-collection'),
        'not_found_in_trash' => __('No tweets found in Trash', 'tweet-collection'),
        'parent_item_colon' => '',
        'menu_name' => __('Tweets', 'tweet-collection')

    );
    $args = array (
        'labels' => $labels,
        'public' => TRUE,
        'publicly_queryable' => TRUE,
        'show_ui' => TRUE,
        'show_in_menu' => TRUE,
        'query_var' => TRUE,
        'has_archive' => TRUE,
        'hierarchical' => FALSE,
        'menu_position' => 4,
        'exclude_from_search' => TRUE,
        'supports' => array ('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions')
    );
    register_post_type('tweet', $args);
}

add_action('init', 'tc_register_custom_post_type');

//옵션 페이지 html, action 등록.
add_action('admin_menu', 'tc_top_menu');
function tc_top_menu () {
    add_options_page(__('Tweet Collection', 'tweet-collection'), __('Tweet Collection', 'tweet-collection'), 'manage_options', 'tweet-collection', 'tc_menu_page');
}

function tc_menu_page () {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.', 'tweet-collection'));
    }

    $option_names = tc_get_option_names();

    if (!empty($_POST)) {
        foreach ($option_names as $option) {
        	$varname = tc_convert_varname($option);
            update_option($option, $_POST[$varname]);
        }
        $message = __('Saved!', 'tweet-collection');

        //옵션 저장하면 트윗을 한 번 긁어 와 준다.
        do_action('collect_tweets');
    }

    if(isset($_GET['delete_all_settings']) && $_GET['delete_all_settings'] == 'y'){
        tc_delete_settings();        
    }

    include 'tc-menu-page.php';
}

// 트위터 아이디 설정을 하지 않은 경우 등록하라고 메시지를 뿌린다.
function tc_should_setup_msg () {
    ?>
    <div class="updated">
        <p>
            <?php _e('Set options completely for Tweet Collection.', 'tweet-collection') ?>
            <a href="options-general.php?page=tweet-collection"><?php _e('Go to Tweet Collection Option page!', 'tweet-collection') ?></a>
        </p>
    </div>
    <?php
}

if ( ! tc_is_setup_complete()) {
    add_action('admin_notices', 'tc_should_setup_msg');
}

// 20분에 한 번씩 실행되는 옵션을 cron에 등록한다. (나중엔 얼마에 한 번씩 긁어올 지도 설정할 수 있게 한다.)
add_filter('cron_schedules', 'tc_cron_add_20m');

function tc_cron_add_20m ($schedules) {
    // Adds once weekly to the existing schedules.
    $schedules['20m'] = array (
        'interval' => 60 * 20,
        'display' => __('Once by 20 minutes', 'tweet-collection')
    );
    return $schedules;
}

//텍스트로 있는 링크에 a 태그를 붙여서 실제 링크로 만들어 주는 함수
function tc_linkfy ($s) {
    return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a class="link-shared" href="$1">$1</a>', $s);
}

// 텍스트를 받아서 첫 번째로 나오는 URL을 리턴해 주는 함수다.
function tc_extract_link ($s) {
    preg_match('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', $s, $matches);
    if (count($matches) > 0) {
        return $matches[0];
    } else {
        return FALSE;
    }
}

// 설정값이 모두 제대로 들어가 있는지 검사한다.
function tc_is_setup_complete () {
    $tc_option_names = tc_get_option_names();
    foreach ($tc_option_names as $opt_name) {
        if ( ! get_option($opt_name)) {
            return FALSE;
        }
    }
    return TRUE;
}

/**
 * 트위터의 json을 긁어서 집어 넣을 콘텐츠를 만든다.
 * @return array
 */
function tc_get_timeline () {
    require_once("twitteroauth/twitteroauth/twitteroauth.php"); //Path to twitteroauth library

    $twitter_username = get_option('tweet-collection-twitter-username');
    $number_tweets = get_option('tweet-collection-number-tweets');
    $consumer_key = get_option('tweet-collection-consumer-key');
    $consumer_secret = get_option('tweet-collection-consumer-secret');
    $access_token = get_option('tweet-collection-access-token');
    $access_token_secret = get_option('tweet-collection-access-token-secret');

    $connection = get_connection_with_access_token($consumer_key, $consumer_secret, $access_token, $access_token_secret);

    $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $twitter_username . "&count=" . $number_tweets);

    return $tweets;
}

function get_connection_with_access_token ($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
}

/**
 * 제목을 넣을 때 사용하는 특수문자 디코딩 함수.
 * PHP5부터 있기 때문에 4에서는 함수 정의를 해 줘야 한다.
 */
if (!function_exists('htmlspecialchars_decode')) {
    function htmlspecialchars_decode ($string, $style = ENT_COMPAT) {
        $translation = array_flip(get_html_translation_table(HTML_SPECIALCHARS, $style));
        if ($style === ENT_QUOTES) {
            $translation['&#039;'] = '\'';
        }
        return strtr($string, $translation);
    }
}

// 트위터의 xml을 긁어 와서 새 Tweet Post Type으로 등록하는 함수를 만든다.
function tc_insert_tweet_custom_post () {
    //설정이 제대로 안 돼 있으면 중단.
    if ( ! tc_is_setup_complete()) {
        return FALSE;
    }
    $timeline = tc_get_timeline();
    
    foreach ($timeline as $tweet) {
        
        $post_content = tc_get_post_content($tweet->text, $tweet->entities->urls);
        $post_title = htmlspecialchars_decode(strip_tags($post_content));
        $tweet_guid = 'http://twitter.com/mytory/statuses/' . $tweet->id_str;
        if (tc_is_already_insert($tweet_guid) > 0) {
            continue;
        }
        $gmt_offset = get_option('gmt_offset');
        $datetime = tc_get_datetime($tweet->created_at, $gmt_offset);
        $post_date_gmt = tc_get_post_date_gmp($tweet->created_at, $gmt_offset);
        $args = array (
            'comment_status' => 'closed',
            'post_date' => $post_date_gmt,
            'ping_status' => 'closed',
            'post_content' => $post_content . "\n\n" . "<a class='tweet-permalink' href='{$tweet_guid}' title='Tweet Permalink'>{$datetime}</a>",
            'post_status' => 'publish',
            'post_title' => $post_title,
            'post_type' => 'tweet',
        );

        $post_id = wp_insert_post($args);

        if ($post_id) {
            add_post_meta($post_id, 'tc_tweet_guid', (string)$tweet_guid, TRUE);
        }
    }
    return TRUE;
}

/**
 * text에 있는 URL을 실제 URL로 변경한다.
 * @param  string $text 
 * @param  array $urls URL 정보가 있는 배열
 * @return string t.co URL text를 실제 URL text와 HTML 링크로 변경한 문자열
 */
function tc_get_post_content($text, $urls){
	foreach ($urls as $url_info) {
		$a_tag = "<a href='{$url_info->expanded_url}'>{$url_info->display_url}</a>";
		$text = str_replace($url_info->url, $a_tag, $text);
	}
	return $text;
}

function tc_get_post_date_gmp($created_at, $gmt_offset){
    $post_date_gmt = date('Y-m-d H:i:s', $gmt_offset * 60 * 60 + strtotime($created_at));
    return $post_date_gmt;
}

function tc_get_datetime($created_at, $gmt_offset){
	$timestamp = $gmt_offset * 60 * 60 + strtotime($created_at);
    $datetime = date_i18n(get_option('date_format') . ' ' . get_option('time_format'), $timestamp);
    return $datetime;
}

//중복 컨텐츠 확인을 위한 함수
function tc_is_already_insert ($tweet_guid) {
    $query = new WP_Query('meta_key=tc_tweet_guid&meta_value=' . $tweet_guid . '&post_type=tweet&post_status=publish,future');
    return $query->post_count;
}

// 플러그인 활성화할 때 wp_cron 등록
add_action('collect_tweets', 'tc_insert_tweet_custom_post');
function tweet_collection_activate () {
    wp_schedule_event(time(), '20m', 'collect_tweets');
}

/**
 * cron 등록 여부를 확인하고 등록이 해제돼 있으면 재등록.
 */
function tc_check_cron(){
    if(wp_get_schedule('collect_tweets') == false){
        wp_schedule_event(time(), '20m', 'collect_tweets');
    }
}
tc_check_cron();

register_activation_hook(__FILE__, 'tweet_collection_activate');

// 플러그인 비활성화할 때 wp_cron 해제
function tweet_collection_deactivate () {
    wp_clear_scheduled_hook('collect_tweets');
}

register_deactivation_hook(__FILE__, 'tweet_collection_deactivate');

//트윗 검색
function tc_print_searchform () {
    ?>
    <form id="searchform" class="search-tweets-form" method="get" action="<?php bloginfo('url') ?>">
        <label class="assistive-text" for="s"><?php _e('Search Tweets', 'tweet-collection') ?></label>
        <input type="text"
               value="<?php echo get_search_query() ?>" id="s" name="s" class="field">
        <input type="hidden" name="post_type" value="tweet">
        <input type="submit" value="<?php _e('Search Tweets', 'tweet-collection') ?>" id="searchsubmit"
               class="submit button-primary">
    </form>
<?php
}

include_once 'widget.php';

function tc_text_dot ($text, $len) {
    $text = strip_tags($text);
    if (strlen($text) <= $len) {
        return $text;
    } else {
        $text = wp_specialchars_decode($text);
        $text = mb_substr($text, 0, $len, 'utf-8');
        $text = esc_html($text);
        return $text . "…";
    }
}

//트윗 제목에서 내 ID 제거
function tc_remove_my_username_from_title ($title) {
    if (get_post_type() == 'tweet') {
        $username = get_option('tweet-collection-twitter-username');
        $username_length = mb_strlen($username);
        if (mb_substr($title, 0, $username_length + 2) == $username . ': ') {
            return mb_substr($title, $username_length + 2);
        } else {
            return $title;
        }
    }
    return $title;
}

add_action('the_title', 'tc_remove_my_username_from_title', 1);
add_filter('single_post_title', 'tc_remove_my_username_from_title', 1);

//트윗 제목 길이
function tc_apply_title_length ($title) {
    if (get_post_type() == 'tweet') {
        $title_length = get_option('tweet-collection-title-length');
        return tc_text_dot($title, $title_length);
    }
    return $title;
}

if (get_option('tweet-collection-title-length') AND get_option('tweet-collection-title-length') !== 0) {
    add_action('the_title', 'tc_apply_title_length');
    add_filter('single_post_title', 'tc_apply_title_length');
} 

function tc_rss_template ( $archive_template ) {
    if (is_post_type_archive ('tweet') AND isset($_GET['rss']) AND $_GET['rss'] == 'for-fb') {
        $args = array(
            'post_type' => 'tweet',
            'posts_per_page' => 20,
        );
        $wp_query = new WP_Query($args);
        $archive_template = dirname(__FILE__) . '/rss.php';
    }
    return $archive_template;
}
add_filter( 'archive_template', 'tc_rss_template' ) ;

/**
 * If user want, delete settings.
 * @return
 */
function tc_delete_settings(){
    $option_names = tc_get_option_names();
    foreach ($option_names as $option) {
        delete_option($option);
    }
}
